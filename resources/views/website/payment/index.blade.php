@extends('layouts.website.index')

@section('title', 'User Account')

@section('navbar')

    @include('website.navbar')

@endsection

@section('content')
    Payment page
    @if($paymentStatus != '')
        @if($paymentStatus == 'Valid')
            <div class="alert alert-success">
                {{-- {{ $paymentStatus }} --}}
                Thank you for buying form Mezagebt Net. An email is sent to you with your invoice.
            </div>
        @elseif ($paymentStatus == 'Failed')
            <div class="alert alert-danger">
                {{-- {{ $paymentStatus }} --}}
                Sorry, we couldn't validate this transaction.
            </div>
        @endif
    @endif
    <a class="btn  btn-dark btn-sm btn-flat" href="{{ route('user.payment.checkout') }}">Checkout Now</a> <br/>
    <a href="{{ route('user.payment.log') }}">Log</a>
    <form method="post" action="http://localhost:8000/user/payment-ipn">
        <input type="hidden" name="test" value="2">
        <button type="submit" class="btn btn-primary">TEST IPN</button>
    </form>
    <a href="http://localhost:8000/user/payment-ipn?test=2">IPN Test</a>

    <form method="post" action="https://test.yenepay.com/">
        <input type="hidden" name="Process" value="Express">
        <!--A unique identifier for the payment order. Yenepay will attach it to the order and
            echo it back when sending you any inforamtion about the order. To let the customer complete
            unfinished order you can send it again with the same order info-->
        <input type="hidden" name="MerchantOrderId" value="">
        <!--Your yenepay merchant code-->
        <input type="hidden" name="MerchantId" value="SB0716">
        <!-- The ipn url that you want yenepay to send you ipn messages to. Note localhost is not accepted here-->
        <input type="hidden" name="IPNUrl" value="http://localhost:8000/user/payment-ipn">
        <!-- The url in your website or application that you want yenepay to redirect the customer after completing their payment. Note localhost is not accepted here-->
        <input type="hidden" name="SuccessUrl" value="http://localhost:8000/user/payment">
        <!-- The url in your website or application that you want yenepay to redirect the customer when canceling their payment. Note localhost is not accepted here-->
        <input type="hidden" name="CancelUrl" value="https://sandbox.yenepay.com/Home/Details/0957b2d0-5d0a-4c0c-9cf4-f6e9993b2a4a?custId=a8aafedf-3b26-4da5-b824-f5f19fb4d4c6">
        <!--A unique identifier for each item in the order. You can leave this blank if you want too.-->
        <input type="hidden" name="ItemId" value="b019cd90-6035-419a-aa66-b19a8817291b">
        <!--The name for the item that that your customer is paying for-->
        <input type="hidden" name="ItemName" value="Test Item 1">
        <!--The unit price for the item this must be a positive decimal number and can not be empty or zero-->
        <input type="hidden" name="UnitPrice" value="1.00">
        <!--The quantity for the item this must be a positive integer number with minimum value of 1-->
        <!--The total price for the item will be determined by multiplying UnitPrice x Quantity for the item-->
        <input type="hidden" name="Quantity" value="1">
        <!--Submit button-->
        <input type="submit" value="Buy Now">
    </form>
@endsection
