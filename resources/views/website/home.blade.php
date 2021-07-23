@extends('layouts.website.index')

@section('title', 'User Account')

@section('navbar')

    @include('website.navbar')

@endsection

@section('content')


<div class="navbar-search-block">
    <form class="form-inline">
        <div class="input-group input-group-sm">
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class=" dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  All
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                  <a class="dropdown-item" href="#">All</a>
                  <a class="dropdown-item" href="#">Books</a>
                </div>
              </div>
            <input class="form-control form-control-navbar" type="search" placeholder="Search"
                aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </form>
</div>





    Landing Page
@endsection