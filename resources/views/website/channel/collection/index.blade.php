@extends('layouts.website.index')

@section('title', 'Channels')

@section('styles')
    <style>
        .dark-mode .widget-user-username, .dark-mode .widget-user-desc{
            color: white;
        }

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
            border-radius: 16px;

            max-width: 350px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 16px;

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

<div class="banner-section-wrapper">
    <section
        style=" width: 100%; padding:0;
                margin-top: -1px;
                background-color: #faebd72e;
                background-image: linear-gradient(to bottom, #000000ad, #00000063, #0000008f), url({{ asset('storage/' . $gize_channel->banner_image_url) }});
                height: 186px;
                /* background-attachment: fixed; */
                background-position: center center;
                background-size: cover;

                                                                                                                                                                                        "
        class=" mb-3 pb-0 w:100 jumbotron text-center channel-banner">
        <div style=" ">

            <div class="d-flex align-items-center flex-column bd-highlight ">
                <div class="mb-auto p-2 bd-highlight">
                    <h3 class="channel-title my-auto mt-sm-3">
                        {{ app()->getLocale() == 'am' ? $gize_channel->name : $gize_channel->name_en }}</h3>

                    <p class="channel-description lead">@if ($gize_channel->producer != null || $gize_channel->producer != ''){{ __('Producer') }} - {{ $gize_channel->producer }}@endif</p>

                </div>
            </div>

            <div class="d-flex align-items-center flex-column bd-highlight ">
                <div class="pb-0 mb-n3 bd-highlight">
                    <div class="channel-logo"></div>
                </div>
            </div>
        </div>
    </section>
</div>



<div class="videos-grid-wrapper px-4 pt-4 pt-5 pb-4">

    <div class="row">
        {{-- <div class="col-sm-4 order-sm-2 col-md-3 order-md-2 mb-xs-3 mb-2"> --}}

        {{-- @include('website.channel.group_stream.sidebar') --}}

        {{-- </div> --}}
        <div class="col-sm-12  order-sm-1 col-md-12  ">

            <h4 class="mt-3">{{ __('Bundle Videos From This Channel') }}</h4>
            <h6 class=" text-muted mb-0">
                {{ __('Series Video Collection Grouped in the form of a Book/Chapters or Season/Episoids') }}
                <button class="btn btn-xs btn-outline-info btn-refresh float-right mr-2 mt-1">
                    <i class="fa fa-recycle"></i> {{ __('Reload') }}
                </button>
            </h6>
            <hr />

            <div class=" ">
                @foreach ($collections as $collection)

                    <div style="max-width: 400px; width: 100%;">

                        <x-channels.collection-card :channel="$gize_channel"
                        :collection="$collection"
                        />

                    </div>

                @endforeach
            </div>


        </div>

</div><!-- /.container-fluid -->





@endsection

@section('js')


    <script>

    </script>
@endsection
