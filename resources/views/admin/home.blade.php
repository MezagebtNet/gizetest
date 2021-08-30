@extends('layouts.admin.index')

@section('title', 'Overview')

@section('styles')
    <link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet" />

    <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
    <!-- <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script> -->
@endsection

@section('navbar')
    @include('admin.navbar')
@endsection

@section('notifications-dropdown')
    @include('admin.navbar-notifications-dropdown')
@endsection

@section('mainsidebar')
    @include('admin.mainsidebar')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>

                <div class="card-body">

                </div>
            </div>
        </div>
    </div>

@endsection


@section('modals')

@endsection


@section('js')
    <script src="https://vjs.zencdn.net/7.14.3/video.min.js"></script>
@endsection
