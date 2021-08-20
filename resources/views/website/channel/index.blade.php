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




@section('content')
    {{-- <main role="main" > --}}

    <section class="jumbotron text-center channel-banner" style="
                background-image: linear-gradient(to bottom, #0000006b, #0000007d, #000000d6), url({{ asset('assets/image/background.jpg') }});
        ">
        <div class="container">
            <h1 class="channel-title">የመጽሐፈ አድሜስ ማብራሪያ ቪድዮዎች</h1>
            <p class="channel-description lead">በጤንነት ሰጠኝ (ወ/ሩፋኤል)</p>
            <p>
                <a href="#" class="btn btn-primary my-2">Group Streaming</a>
                <a href="#" class="btn btn-secondary my-2">Channel Videos</a>
            </p>
        </div>
    </section>

    <div class="album ">
        <div class="row">
            <div class="col-md-6 div.col-sm-12 mx-auto">
                <ul class="nav nav-pills nav-justified">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">My Videos for me</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Schedule</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container">
            Content here...
        </div>
    </div>

    {{-- </main> --}}

@endsection
