@extends('layouts.website.index')

@section('title', 'User Account')

@section('styles')
    <style>
        .grow {
            transition: all .2s ease-in-out;
        }

        .grow:hover, .grow:focus  {
            transform: scale(1.02);
        }

        .channel-card:hover, .channel-card:focus {
            border-color: rgba(255, 175, 2);
            /* border: red groove ; */
            box-shadow: 0 0px 7px rgba(248, 221, 164);
            /* box-shadow: 0 0px 12px rgba(205, 200, 185, 0.09); */
            cursor: pointer;
            text-decoration: none;
            background-color:rgba(255, 243, 134, 0.162);
            /* border:1px solid gray */
        }
        a.channel-card-link  {
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
        }

         article.card-body  {
            border-radius: 16px;
            border: 1px solid #c3c3c3;
            background-color: #fff;
        }

        .dark-mode .channel-card  {
            border-radius: 16px;
            border: 1px solid #545454;
        }

    </style>
    {{-- <style>
        .channel-card {
            min-width: 340px;
            max-width: 340px;
            /* margin: 0 auto; */
            /* Added */
            float: none;
            /* Added */
            /* Added */
        }


        .chnl-card {
            border-radius: 1.25rem;
            overflow: hidden;

            min-width: 220px;
            max-width: 220px;
            height: 250px;
            margin-left: 10px;

        }

        .chnl-card .card-footer {
            background-color: #3f3f3f;
        }

        .chnl-card .description-block .description-header,
        .description-text {
            color: #f7ffda;
        }

        .widget-user .widget-user-image > img{
            border: 2px solid #ccc;
            /* width: 55px; */
        }

    </style> --}}
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
                <h2 class="mb-4">{{ __('Gize Channels') }}</h2>
            </div>
        </div>
        <div class="grid-container">
            <div class="justify-content-center ">
                {{-- <center> --}}
                <div class=" row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 ">
                    @foreach ($gize_channels as $gize_channel)

                        <x-channels.card :name="$gize_channel->name" :producer="$gize_channel->producer" :id="$gize_channel->id" :slug="$gize_channel->slug" />

                    @endforeach
                </div>
                {{-- </center> --}}
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
