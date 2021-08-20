@extends('layouts.website.index')

@section('title', 'Overview')

@section('styles')
    @livewireStyles

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

        .channel-title {
            color: aliceblue;
            font-size: 1.5rem;
        }

        .channel-description {
            color: rgb(235, 235, 235);
            font-size: 1rem;
        }

        .channel-banner {

            border-radius: 0;
            box-shadow: 0 0px 13px #000000cf;
        }

    </style>

@endsection

@section('navbar')
    @include('website.navbar')
@endsection

@section('notifications-dropdown')
    {{-- @include('admin.notifications-dropdown') --}}
@endsection


@section('content')
    <section class="jumbotron text-center channel-banner" style="
                background-image: linear-gradient(to bottom, #0000006b, #0000007d, #000000d6), url({{ asset('assets/image/background.jpg') }});
        ">
        <div class="container">
            <h1 class="channel-title">የመጽሐፈ አድሜስ ማብራሪያ ቪድዮዎች</h1>
            <p class="channel-description lead">በጤንነት ሰጠኝ (ወ/ሩፋኤል)</p>
            <p>
                {{-- <a href="#" class="btn btn-primary my-2">Apply for Group Streaming</a>
                <a href="#" class="btn btn-secondary my-2">Channel Videos</a> --}}
            </p>
        </div>
    </section>
    <div class="px-4">

        {{-- @include('website.user.top-menu') --}}

        <div class="row">
            <div class="col-sm-4 order-sm-2 col-md-3 order-md-2 mb-xs-3 mb-2">

                @include('website.channel.group_stream.sidebar')

            </div>
            <div class="col-sm-8  order-sm-1 col-md-9  order-md-1 ">
                {{-- <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Well done!</h4>
                    <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                    <hr>
                    <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
                </div> --}}
                <h2 class="py-2">My Videos</h2>
                <div class="row grid-container">
                    <div class="justify-content-center ">
                        {{-- <center> --}}
                        <div class=" row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 ">
                            <x-channels.card />
                            <x-channels.card />
                            <x-channels.card />
                            <x-channels.card />
                            <x-channels.card />
                            <x-channels.card />
                        </div>
                        {{-- </center> --}}
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection


@section('modals')

@endsection


@section('js')



@endsection
