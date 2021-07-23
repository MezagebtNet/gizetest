@extends('layouts.admin.index')

@section('title', 'Overview')

@section('styles')

@endsection

@section('navbar')
    @include('admin.navbar')
@endsection

@section('notifications-dropdown')
    @include('admin.notifications-dropdown')
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


@endsection
