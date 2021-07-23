@extends('layouts.website.index')

@section('title', 'Overview')

@section('styles')
    @livewireStyles
@endsection

@section('navbar')
    @include('website.navbar')
@endsection

@section('notifications-dropdown')
    {{-- @include('admin.notifications-dropdown') --}}
@endsection


@section('content-header')
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> My Account</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">My Account</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="container">

        @include('website.user.top-menu')

        <div class="row">
            <div class="col-sm-4 order-sm-2 col-md-3 order-md-2 mb-xs-3 mb-2">

                @include('website.user.author.sidebar')

            </div>
            <div class="col-sm-8  order-sm-1 col-md-9  order-md-1 ">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Well done!</h4>
                    <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                    <hr>
                    <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
                </div>
                  Author Overview Page
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection


@section('modals')

@endsection


@section('js')



@endsection
