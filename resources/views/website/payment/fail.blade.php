@extends('layouts.website.index')

@section('title', 'User Account')

@section('navbar')

    @include('website.navbar')

@endsection

@section('content')
    Unknown Error has occured during payment process. <br/>

    <a href="{{ route('user.payment.index') }}">< Back to Checkout Page   </a>
@endsection
