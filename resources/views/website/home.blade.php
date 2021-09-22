@extends('layouts.website.index')

@section('title', 'User Account')

@section('styles')
    <style>
        .grow {
            transition: all .2s ease-in-out;
        }

        .grow:hover,
        .grow:focus {
            transform: scale(1.02);
        }

        .channel-card:hover,
        .channel-card:focus {
            border-color: rgba(255, 175, 2);
            /* border: red groove ; */
            box-shadow: 0 0px 7px rgba(248, 221, 164);
            /* box-shadow: 0 0px 12px rgba(205, 200, 185, 0.09); */
            cursor: pointer;
            text-decoration: none;
            background-color: rgba(255, 243, 134, 0.162);
            /* border:1px solid gray */
        }

        a.channel-card-link {
            text-decoration: none;
            color: black;
        }

        .channel-card {
            min-height: 230px;
            max-height: 230px;
            /* margin: 0 auto; */
            /* Added */
            float: none;
            /* Added */
            margin-bottom: 10px;
            /* Added */
            border-radius: 16px;

            max-width: 350px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 16px;

        }

        article.card-body {
            border-radius: 16px;
            border: 1px solid #c3c3c3;
            background-color: #fff;
        }

        .dark-mode .channel-card {
            border-radius: 16px;
            border: 1px solid #545454;
        }

    </style>

@endsection

@section('navbar')
    @include('website.navbar')
@endsection




@section('content')



    {{-- <div class="row"> --}}
    {{-- <div class="d-flex justify-content-center"> --}}

    <div class="container pb-4">
        <div class="row pt-4">
            <div class="col">
                <h2 class="mb-4">Banner</h2>
            </div>
        </div>

        <div class="container" style="background-color: #f0f8ff14;
        border: 1px solid #74747452;
        border-radius: 8px;">
            <div class="row" style="min-height: 200px;padding: 2rem 0;">
                <div class=" col-12 col-sm-8"
                style="padding: 1rem;display: inline-block !important;margin-top: auto;margin-bottom: auto;">
                    <p class="h4 text-right text-center text-sm-right"
                    style="vertical-align: middle !important;">{{ __("Have you subscribed to a regular series of 'Book of Addmes' videos?") }}</p>
                    <p class="text-sm pb-0 mb-0 text-muted font-italic text-center text-sm-right">{{ __('For more info') }}: <a target="_blank" href="tel:+251911448945">(+251) 911448945</a></p>
                    <p class="text-sm pb-0 text-muted font-italic text-center text-sm-right">{{ __('Website') }}: <a target="_blank" href="https://addmes.mezagebtnet.com/courses">https://addmes.mezagebtnet.com/courses</a></p>
                    <p class="text-sm text-muted font-italic text-center text-sm-right">{{ __('by Addmesh Book Trading') }} </p>
                </div>
                <div class="col-12 col-sm-4 d-inline-block text-center text-sm-left"
                style="margin-top: auto;margin-bottom: auto; padding: 1rem;display: block;display: inline-block !important;">
                    <span class=" justify-content-center align-middle"
                   >
                        <p style="mb-0" style="margin-bottom: 0;">{{ __('To watch the videos') }} </p>
                        <a href="{{ route('channel.landing', 'addmes') }}" class="btn btn-block bg-gradient-warning btn-lg mx-atuo ">{{ __('Enter Here') }}!</a>

                    </span>

                </div>
            </div>
        </div>

    </div>

    {{-- </div> --}}
    {{-- </div> --}}


@endsection

@section('js')


    <script>

    </script>
@endsection
