@extends('layouts.website.index')

@section('title', 'User Account')

@section('styles')
    <style>
        .channel-card {
            min-width: 340px;
            max-width: 340px;
            /* margin: 0 auto; */
            /* Added */
            float: none;
            /* Added */
            margin-bottom: 10px;
            /* Added */
        }

    </style>
@endsection

@section('navbar')
    @include('website.navbar')
@endsection




@section('content')



    {{-- <div class="row"> --}}
    {{-- <div class="d-flex justify-content-center"> --}}
    <div class="row">
        <div class="col">
            <h1>Channels</h1>
        </div>
    </div>
    <div class="row grid-container">
        <div class="justify-content-center ">
            {{-- <center> --}}
            <div class=" row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 ">
                <x-channels.card />
                <x-channels.card />
                <x-channels.card />
            </div>
            {{-- </center> --}}
        </div>
    </div>
    {{-- </div> --}}
    {{-- </div> --}}


@endsection
