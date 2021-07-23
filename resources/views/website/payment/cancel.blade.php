@extends('layouts.website.index')

@section('title', 'User Account')

@section('navbar')

    @include('website.navbar')

@endsection

@section('content')
    Your Payment has been canceled. <br/>

    <a href="{{ route('user.payment.index') }}">< Back to Checkout Page   </a>
@endsection
