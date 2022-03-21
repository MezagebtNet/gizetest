@extends('layouts.website.index')

@section('seo')

    {{-- {!! SEOMeta::generate() !!} --}}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {{-- {!! JsonLd::generate() !!} --}}

    {!! SEO::generate(true) !!}

@endsection

@section('title', 'Fitrete Hibuat 1 Book Video Chapters')

@section('styles')
    <!--Video JS -->
    <link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet" />
    <link href="{{ asset('vendors/videojs/vim.css') }}" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('storage/favicon.png') }}">

    <style>
        .book-image {
            max-width: 230px;
            width: 80%;
            text-align: center;
        }

        .cart_info{
            background: black;
            border: 2px solid gray;
            border-bottom: 0;
            border-radius: 8px 8px 8px 8px ;
            min-width: 170px;
            box-shadow: 9px 9px 27px 0px rgba(0,0,0,0.68);
        }

        .chapters {
            padding: 1.5rem;
            margin-right: 0;
            margin-left: 0;
            border-width: .2rem;
        }

        .chapters {
            position: relative;
            /* padding: 1rem; */
            /* margin: 1rem -15px 0; */
            /* margin-right: -15px;
            margin-left: -15px; */
            /* border: solid #f8f9fa;
            border-top-width: medium;
            border-right-width: medium;
            border-bottom-width: medium;
            border-left-width: medium; */
            /* border-width: .2rem 0 0; */
        }


        @media (min-width: 576px) {
            .chapter-content {
                /* overflow-y: scroll; */
                /* max-height: 600px; */
            }

            .chapter-outline {
                /* overflow-y: scroll; */
                /* height: 450px; */
            }
        }

    </style>

    <style>
        .product {
            border: none !important;
        }

        /* .product img {
                height: 150px;
                width: auto;
                margin-bottom: -50px;
                margin-left: 1rem;
                transition: 0.5s;
            }

            .product:hover img {
                transform: scale(1.05) rotate(-10deg);
            } */

        .product .card-title {
            margin-top: 50px;
        }

        .img-in-cart {
            height: 50px;
        }

        .overflow-scroll {
            overflow: scroll;
        }

    </style>

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


        .video-js .vjs-control-bar {
            color: #fff3d3;
            font-size: 0.8rem;
            height: 40px;
            background-color: rgb(25 20 6 / 70%);

        }

        .vjs-menu-button-popup .vjs-menu .vjs-menu-content {
            background-color: #2B333F;
            background-color: rgba(31, 28, 22, 0.76);
            position: absolute;
            width: 100%;
            bottom: 1.5em;
            max-height: 20em;
            right: 60px;
        }

        .video-js .vjs-control {
            position: relative;
            text-align: center;
            margin: 0;
            padding: 0;
            height: 100%;
            width: 2.7em;
        }

        .carousel-item {
            height: 230px;
        }






        .channel-banner {

            border-radius: 0;
            box-shadow: 0 0px 13px #000000cf;
            }

            .channel-logo {
            width: 100px;
            height: 100px;
            background-size: contain;
            background-position: center;
            background-color: black;
            border: 1px solid #ccc;
            background-image: url("{{ asset('storage/' . $gize_channel->logo_image_url) }}");
            border-radius: 5%;
            box-shadow: 0 4px 16px #000000de;

            }

    </style>

    <style>
        .design-process-section .text-align-center {
            line-height: 25px;
            margin-bottom: 12px;
        }
        .design-process-content {
            border: 1px solid #e9e9e9;
            position: relative;
            /* padding: 16px 34% 30px 30px; */
            padding: 10px 7px;
            border-radius: 8px;
        }
        .design-process-content img {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            z-index: 0;
            max-height: 100%;
        }
        .design-process-content h3 {
            margin-bottom: 16px;
        }
        .design-process-content p {
            line-height: 26px;
            margin-bottom: 12px;
        }
        .process-model {
            list-style: none;
            padding: 0;
            position: relative;
            /* max-width: 600px; */
            /* margin: 20px auto 26px; */
            border: none;
            z-index: 0;
        }
        .process-model li::after {
            background: #e5e5e5 none repeat scroll 0 0;
            bottom: 0;
            content: "";
            display: block;
            height: 4px;
            margin: 0 auto;
            position: absolute;
            right: 20%;
            top: 33px;
            width: 66%;
            z-index: -1;
        }
        .process-model li.visited::after {
            background: #57b87b;
        }
        .process-model li:last-child::after {
            width: 0;
        }
        .process-model li {
            display: inline-block;
            width: 47%;
            text-align: center;
            float: none;
        }
        .nav-tabs.process-model > li.active > a, .nav-tabs.process-model > li.active > a:hover, .nav-tabs.process-model > li.active > a:focus, .process-model li a:hover, .process-model li a:focus {
            border: none;
            background: transparent;

        }
        .process-model li a {
            padding: 0;
            border: none;
            color: #606060;
        }
        .process-model li.active,
        .process-model li.visited {
            color: #57b87b;
        }
        .process-model li.active a,
        .process-model li.active a:hover,
        .process-model li.active a:focus,
        .process-model li.visited a,
        .process-model li.visited a:hover,
        .process-model li.visited a:focus {
            color: #57b87b;
        }
        .process-model li.active p,
        .process-model li.visited p {
            font-weight: 600;
        }
        .process-model li i {
            display: block;
            height: 68px;
            width: 68px;
            text-align: center;
            margin: 0 auto;
            background: #f5f6f7;
            border: 2px solid #e5e5e5;
            line-height: 65px;
            font-size: 30px;
            border-radius: 50%;
        }
        .process-model li.active i, .process-model li.visited i  {
            background: #fff;
            border-color: #57b87b;
        }
        .process-model li p {
            font-size: 14px;
            margin-top: 11px;
        }
        .process-model.contact-us-tab li.visited a, .process-model.contact-us-tab li.visited p {
            color: #606060!important;
            font-weight: normal
        }
        .process-model.contact-us-tab li::after  {
            display: none;
        }
        .process-model.contact-us-tab li.visited i {
            border-color: #e5e5e5;
        }



        @media screen and (max-width: 560px) {
        .more-icon-preocess.process-model li span {
                font-size: 23px;
                height: 50px;
                line-height: 46px;
                width: 50px;
            }
            .more-icon-preocess.process-model li::after {
                /* top: 24px; */
            }
        }
        @media screen and (max-width: 380px) {
            .process-model.more-icon-preocess li {
                /* width: 16%; */
            }
            .more-icon-preocess.process-model li span {
                font-size: 16px;
                height: 35px;
                line-height: 32px;
                width: 35px;
            }
            .more-icon-preocess.process-model li p {
                font-size: 15px;
            }
            .more-icon-preocess.process-model li::after {
                /* top: 18px; */
            }
            .process-model.more-icon-preocess {
                text-align: center;
            }
        }
    </style>

    <style>

        #checkout #pricing .padd-section {
            padding-top: 50px;
            padding-bottom: 50px
        }

        #checkout #pricing .section-title {
            margin-bottom: 0px
        }

        #checkout #pricing .block-pricing {
            /* background: rgb(235, 235, 235); */
            border:rgb(78, 76, 72) 1px solid;
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.2), 0 0 4px 0 rgba(0, 0, 0, 0.19);
            display: inline-block;
            position: relative;
            border-radius: 8px;
            width: 100%;
        }

        #checkout #pricing .block-pricing:hover {

            border:rgb(207, 157, 55) 1px solid;
            background: rgba(255, 184, 41, 0.596);
        }

        .dark-mode
        #checkout #pricing .block-pricing, .dark-mode  #checkout #pricing h4, .dark-mode  #checkout #pricing h2, .dark-mode
        #checkout #pricing li  {
            color: white;
        }

        #checkout #pricing .block-pricing .table {
            margin-bottom: 0;
            padding: 30px 15px;
            max-width: 100%;
            width: 100%;
        }

        #checkout #pricing .block-pricing .table h4 {
            padding-bottom: 10px
        }

        #checkout #pricing h4 {
            color: #000;
            /* font-size: 13px; */
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            line-height: 2
        }

        #checkout #pricing .block-pricing h2 {
            margin-bottom: 10px
        }

        #checkout #pricing h2 {
            color: #000;
            font-weight: 600
        }

        #checkout #pricing .block-pricing ul {
            list-style: outside none none;
            margin: 10px auto;
            max-width: 240px;
            padding: 0
        }

        #checkout #pricing .block-pricing ul li {
            border-bottom: 1px solid rgba(153, 153, 153, 0.3);
            padding: 12px 0 20px;
            text-align: center
        }

        #checkout #pricing li {
            color: #626262;
            /* font-size: 13px; */
            font-weight: 400;
            letter-spacing: 2px;
            line-height: 20px;
            text-transform: capitalize
        }

        #checkout #pricing .block-pricing .table .table_btn a {
            background: #222222;
            color: #fff;
            margin-top: 20px;
            display: inline-block
        }

        #checkout #pricing .btn {
            border: 1px solid #fff;
            border-radius: 50px;
            color: #fff;
            /* font-size: 11px; */
            font-weight: 600;
            padding: 15px 2 0px;
            text-transform: uppercase;
            -moz-transition: all 0.5s ease-in-out 0s;
            -ms-transition: all 0.5s ease-in-out 0s;
            -o-transition: all 0.5s ease-in-out 0s;
            -webkit-transition: all 0.5s ease-in-out 0s;
            transition: all 0.5s ease-in-out 0s
        }
        .pricing-card {
            max-width: 45%;
        }
        @media (max-width: 978px) {
            .pricing-card {
                max-width: 100%;
            }
        }

        .slow-spin {
            -webkit-animation: fa-spin 10s infinite linear;
        }

        .fa-refresh {
            transform: scaleX(-1);
            animation: spin-reverse 10s infinite linear;
        }

        @keyframes spin-reverse {
            0% {
                transform: scaleX(-1) rotate(-360deg);
            }

            100% {
                transform: scaleX(-1) rotate(0deg);
            }
        }

        .spin-8 svg {
            margin: 15px 20px;
            opacity: 0.3;
            width: 70px;
            display: inline;
        }

    </style>

@endsection

@section('navbar')
    @include('website.navbar')
@endsection




@section('content')
    <div class="banner-section-wrapper">
        <section style=" width: 100%; padding:0;
                margin-top: -1px;
                background-color: #faebd72e;
                background-image: linear-gradient(to bottom, #0000, #fff0, #000000b5), url({{ asset('storage/images/fh_bg.jpg') }});
                height: 230px;
                /* background-attachment: fixed; */
                background-position: center center;
                background-size: cover;
                border-radius: 0;" class=" mb-3 pb-0 w:100 jumbotron text-center channel-banner">
            <div style=" ">

                <div class="d-flex align-items-center flex-column bd-highlight ">
                    <div class="mb-auto text-white p-2 bd-highlight">
                        <h3 class="channel-title my-auto mt-sm-3">
                            {{ app()->getLocale() == 'am' ? $gize_channel->name : $gize_channel->name_en }}</h3>

                        <p class="channel-description lead">@if ($gize_channel->producer != null || $gize_channel->producer != ''){{ __('Producer') }} - {{ $gize_channel->producer }}@endif</p>

                    </div>
                </div>

                <div class="d-flex align-items-center flex-column bd-highlight ">
                    <div class="pb-0 mb-n3 bd-highlight">
                        {{-- <div class="channel-logo"></div> --}}
                        <a  href="{{ route('channel.landing', 'Addmes') }}" class="btn-lg btn-dark btn"><i class="fa fa-arrow-left"></i> Back to Channel</a>
                        {{-- <a href="{{ route('channel.landing', ['slug' => '$gize_channel->slug']) }}" class="btn-lg btn-dark btn"><i class="fa fa-arrow-left"></i> Back to Channel</a> --}}
                    </div>
                </div>
            </div>
            <div style=" ">



            </div>
        </section>
    </div>

    <div id="scrollcontainer" style="position:relative;">


        <div class="chapters ">

            <div class="row">
                <div class="col-sm-3">
                    <center>
                        <img class="book-image" src="{{ isset($collection->poster_image_url) && $collection->poster_image_url!=null && $collection->poster_image_url!=null ? asset('storage/'.$collection->poster_image_url) : asset('storage/images/c/channelvideo.png') }}"/>
                    </center>
                    <h4>
                        {{ $collection->title }}
                    </h4>
                    <h5> {{  $collection->collection_type->singular_name }} {{ $collection->seriesable ? $collection->series_no : '' }}</h5>
                    <div class="form-group mt-4">
                        <label for="collection_id">{{ __('Filter Videos by Book Chapters') }}:</label>

                            <select id="select-section" class="custom-select custom-select mb-3" name="select-section">
                            <option selected="selected">-- Select --</option>
                            <option disabled="disabled" value="{{ $collection->id }}">{{  $collection->title . ($collection->seriesable ? ' - ' . $collection->collection_type->singular_name . ' ' . $collection->series_no.'' : '')}}</option>
                            @foreach($collection->childCollections()->get() as $childCollection)
                                <option value="{{ $childCollection->id }}" >-- {{ $childCollection->collection_type->singular_name  . ($childCollection->seriesable ? ' '.$childCollection->series_no : '') . ($childCollection->title !='' ? ': '.$childCollection->title : '') }}</option>
                            @endforeach
                        </select>
                      </div>



                </div>

                <div class="col-sm-9">
                    <div data-spy="scroll" data-target="#navbar-chapters" data-offset="0" id="chapter-content"
                    class="chapter-content row row-cols-1 row-cols-md-3">

                    </div>
                </div>

                <a href="#" data-toggle="modal" data-target="#cartModal" style="bottom: 0" class="ml-2 cart-button  position-sticky">

                    <div style="background: #f7bf15;
                    border: 2px solid #ad9e70;
                    "  class=" cart_info  py-3 bg-brown text-dark">
                        <center><span class="text-bold">{{ __('Videos in Cart') }}:</span></center>
                        <span class="total"></span>
                        <div class="d-flex justify-content-between">
                            <h3 style="text-align: center; width: 100%;">
                                <span class="item-in-cart-count">0</span>
                                <i class="fas fa-shopping-cart text-dark"></i>
                            </h3>

                        </div>

                    </div>
                </a>
            </div>

        </div>

    </div>
    <div class="row px-2">
        <div class="col-sm-3">

        </div>
    </div>




    @endsection


    @section('js')
        <!-- Video JS -->

        <script src="https://vjs.zencdn.net/7.14.3/video.min.js"></script>
        <script src="{{ asset('assets/js/dist/Youtube.min.js') }}"></script>


        <script src="https://unpkg.com/@videojs/http-streaming@2.8.0/dist/videojs-http-streaming.min.js"></script>

        <script
                src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-quality-levels/2.1.0/videojs-contrib-quality-levels.min.js">
        </script>

        <script src="https://unpkg.com/videojs-hls-quality-selector@1.0.5/dist/videojs-hls-quality-selector.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/videojs-landscape-fullscreen@11.1.0/dist/videojs-landscape-fullscreen.min.js">
        </script>

        <script>
            // script for tab steps
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

            var href = $(e.target).attr('href');
            var $curr = $(".process-model  a[href='" + href + "']").parent();

            $('.process-model li').removeClass();

            $curr.addClass("active");
            $curr.prevAll().addClass("visited");
            });
            // end  script for tab steps
        </script>

        <script>

            $(function() {




                $('div').scrollspy({
                    target: '#navbar-chapters'
                });

                // $('.select-section').select2({
                //     theme: 'bootstrap4',
                //     // data: list,
                //     // templateResult: formatVideosResult,
                //     // dropdownParent: $('#scheduleModal')
                // });


            });
            $(document).ready(function() {
                // $('.select-section').select2({
                //     theme: 'bootstrap4',
                // });

                initdatetimePicker()

                // $("#starts_on_date").on("change.datetimepicker", function (e) {
                $('#starts_on_date').datetimepicker('minDate', moment().subtract(2,'days'));
                $('#starts_on_date').datetimepicker('maxDate', moment().add(5,'days'));
                // });
                // $("#datetimepicker8").on("change.datetimepicker", function (e) {
                //     $('#datetimepicker7').datetimepicker('maxDate', e.date);
                // });
                $('.package-list').hide();

            });

            function initdatetimePicker() {
                $('#starts_on_date').datetimepicker({
                    //  format: "m/d/Y LT"
                    // inline: true,
                    // format: 'YYYY-MM-DD HH:mm:ss',
                    defaultDate: moment().format(),
                    sideBySide: true
                });
            }



            const animateCSS = (element, animation, prefix = 'animate__') =>
                // We create a Promise and return it
                new Promise((resolve, reject) => {
                    const animationName = `${prefix}${animation}`;
                    const node = document.querySelector(element);

                    node.classList.add(`${prefix}animated`, animationName);

                    // When the animation ends, we clean the classes and resolve the Promise
                    function handleAnimationEnd(event) {
                    event.stopPropagation();
                    node.classList.remove(`${prefix}animated`, animationName);
                    resolve('Animation ended');
                    }

                    node.addEventListener('animationend', handleAnimationEnd, {once: true});
                });

            let products = [];

            let asset_path = "{{ asset('storage') }}";


            function toShort(str, max = 50) {

                if (str.length > max) {
                    return str.substring(0, max) + "....."
                }

                return str;

            }

            function toShow(x) {

                $("#chapter-content").empty();

                x.map(product => {
                    /*
                    $("#chapter-content").append(`
                        <div class="card product pt-12" style="">
                            <h5 id="item-${product.id}"><strong>{{ __('Chapter') }} ${product.chapter_number} </strong></h5>
                            <h6><strong>${product.title}</strong></h6>
                            <div class="d-flex justify-content-sm-start">

                                <div >
                                    <img src="${product.image}" class="pb-2  rounded" width="200px" style="width:250px;" alt="">



                                    <dl class="row">
                                        <dt class="col">Videos</dt>
                                        <dd class="col-sm-9">${product.title}</dd>

                                        <dt class="col">Duration</dt>
                                        <dd class="col-sm-9">${product.title}</dd>

                                        <dt class="col">Price</dt>
                                        <dd class="col-sm-9">${product.price}
                                        </dd>
                                    </dl>
                                    <button class="btn btn-sm btn-outline-primary add-to-cart" data-id="${product.id}">
                                        Add <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>



                            <div class="card-body border rounded">
                                <h6>{{ __('Description') }}</h6>

                                <small class="text-black-50">
                                ${product.description}

                                </small>

                            </div>

                        </div>
                    `);
                    */

                    $("#chapter-content").append(`
                        <div class="col mb-4 channelvideo" collection="${ product.collection_id }">
                            <button style="position: absolute;
                                right: 15px;
                                z-index: 50;
                                margin-top: 5px;" class="btn btn-sm btn-warning float-right add-to-cart" data-id="${product.id}">
                                        Add <i class="fas fa-cart-plus"></i>
                            </button>
                            <div class="card">
                                <img class="card-img-top" src="${ asset_path }/${ product.poster_image_url }"
                                    alt="${ product.title==null?'':product.title }">
                                <div class="card-img-overlay d-flex flex-column justify-content-end" style="padding:0.2rem; ">


                                </div>
                                <div style="position: absolute; top: 32px; left: 5px; ">
                                    ${ product.days_elapsed < 15  ?
                                    '<span class="card-date text-white align-self-end " style="border: solid 1px white; background-color: #f71515; padding: 1px 2px; margin-top-30px; margin-right:5px; border-radius: 4px;"> <strong> {{ __("New") }} </strong> </span>' :'' }
                                </div>

                                <div style="position: absolute; top: 5px; left: 5px; ">
                                        <span class="card-date text-white align-self-end "
                                            style="border: solid 1px white; background-color: #323232; padding: 1px 2px; margin-top-30px; margin-right:5px; border-radius: 4px;">
                                            ${ product.duration==null?'':product.duration }</span>


                                </div>

                                <div class="card-body" style="padding:4px 15px 15px 15px;">
                                    <strong style=" font-size: 1.1em;">${ product.title==null?'':product.title }</strong>
                                    <span>${ product.trainer == null ? '' : product.trainer }</span>
                                    <p class="card-text">${ product.description==null ? '' : product.description }</p>
                                </div>
                            </div>
                        </div>

                    `);
                })
            }

            function cartTotal() {

                let count = $(".item-in-cart-cost").length;

                $(".item-in-cart-count").html(count);


                if (count > 0) {
                    let totalCost = $(".item-in-cart-cost").toArray().map(el => el.innerHTML).reduce((x, y) => Number(x) +
                        Number(y));
                    // console.log(typeof totalCost);
                    // $(".total").html(`

                    //     <div class="d-flex justify-content-between font-weight-bold px-3">
                    //         <h4>Total</h4>
                    //         <h4>ETB <span class="cart-cost-total">${Number(totalCost).toFixed(2)}</span></h4>
                    //     </div>

                    // `);

                    $(".total").html(`

                        <div class="d-flex justify-content-between font-weight-bold px-3">


                        </div>

                    `)

                    // $('#my-cart-grand-total').html(`ETB ${Number(totalCost).toFixed(2)}`);

                    $('#my-cart-grand-total').html(`${ totalCost }`);

                } else {
                    $(".total").html("")
                }

            }

            let data = [];



            data = {!! json_encode($channelvideos) !!};
            // data = @json($channelvideos);
            // data = Object.assign({}, data);

            // console.log(data[1]);
            // $.get("https://fakestoreapi.com/products/",function (data) {

            products = data;

            toShow(products);
            // })

            $("#select-section").on('change', function(e){
                var optionSelected = $("option:selected", this);
                var selected = optionSelected.val();
                // alert(selected);

                $('.channelvideo').hide();
                $('.channelvideo[collection="'+selected+'"]').show();



            });

            // let first_collection_value = $("#select-section option:eq(1)").val();
            // $("#select-section").val(first_collection_value);
            // $('.channelvideo').hide();
            // $('.channelvideo[collection="'+first_collection_value+'"]').show();



            $("#search").on("keyup", function() {
                let keyword = $(this).val().toLowerCase();
                // $(".product").filter(function () {
                //
                //     $(this).toggle($(this).text().toLowerCase().indexOf(keyword) > -1);
                //
                // });

                console.log();

                if (keyword.trim().length) {

                    let filterProducts = products.filter(product => {
                        if (product.title.toLowerCase().indexOf(keyword) > -1 || product.description
                            .toLowerCase().indexOf(keyword) > -1 || product.price == keyword) {
                            return product;
                        }
                    })

                    toShow(filterProducts);
                }

            });

            // $.get("https://fakestoreapi.com/products/categories",function (data) {
            // data.map(cat => $("#category").append(`<option value="${cat}">${cat}</option>`))
            // })

            // $("#category").on("change",function () {

            //     let selectedCategory = $(this).val();
            //     console.log(typeof selectedCategory);

            //     if(selectedCategory != 0){
            //         let filterProducts = products.filter(product=>{
            //             if(product.category === selecteadd-toCategory){
            //                 return product;
            //             }
            //         })

            //         toShow(filterProducts);
            //     }else{
            //         toShow(products);
            //     }
            // })


            $('#checkout-tab').on('click', function(){
                // alert('checkout clicked');
                $('.package-list').hide();
                $('.package-list').html('');
                $('.spin-8').show();


                var spinnerTimer = setTimeout(function() {
                    $('.spin-8').hide();
                    $('.package-list').show();
                    clearTimeout(spinnerTimer);

                }, 1000);

                let url = "{{ route('user.packages') }}";

                let display_text = '';

                $.get(url, function(packages) {

                    if(packages.length){
                        display_text += 'You have ' + packages.length + ' ' + (packages.length==1? 'package':'packages') + ' available.';
                        display_text += `
                        <section id="pricing" class="padd-section text-center wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                            <center><div class="container ">`;

                        packages.forEach(package => {

                            display_text += `<div class="pricing-card my-2 grow" >
                                <div class="block-pricing">
                                    <div class="table">
                                        <h5><strong> ${ package.gize_package.months } </strong>Mon.</h5>
                                        <ul class="list-unstyled">
                                            <li>Package: <b><br/>${ package.gize_package.for_unit_values } </b> {{ _('Videos') }}</li>
                                            <li>Balance: <b><br/>${ package.unit_values_balance } </b> {{ _('Videos') }}</li>

                                            <li>Expires: <b><br/>${ package.expires_at } </b> <br/>
                                                <span>${ package.expires_at_formated }</span><br/>
                                                <span style="color: #57b87b">${ package.extended_days != 0 ? '** This package is extended for ' + package.extended_days + ((package.extended_days != 1)?' more days. **': ' day. **'): '' }</span></li>
                                            </ul>
                                        <div class="table_btn"> <button class="btn btn-order btn-dark"
                                            data-months = "${ package.months}"
                                            data-balance ="${ package.unit_values_balance }"
                                            data-price = "${ package.price}"
                                            data-currency-code = "{{ auth()->user()->currency_code }}"
                                            data-package-id = "${ package.id}"
                                            data-unit-values = "${ package.for_unit_values}"
                                            data-package-code = "${ package.gize_package.code }"><i class="fa fa-shopping-cart mr-1"></i> Pay Now </button> </div>
                                        </div>
                                    </div>
                                </div>`;

                                // display_text += `<div><strong>Code:</strong> ${ package.gize_package.code}</div>`;
                                // display_text += `<div><strong>Expires At:</strong>  ${ package.expires_at }</div>`;
                                // display_text += `<div><strong>Available Balance:</strong>  ${ package.unit_values_balance }</div>`;
                                // display_text += `<div><strong></strong>  ${ package.expires_at }</div>`;

                        });

                        display_text += `
                            </div>
                            </center>
                        </section>`;

                    }
                    else {
                        display_text = `<p>{{ __("You don't have active Gize Packages available on your account.") }} </p>`;
                    }
                    $('#package-list').html(display_text);



                    $('.btn-order').on('click', function(e){
                        let formData = new FormData($('#channelvideoForm').get(0));

                        let el = $(this);
                        let price = $(this).attr('data-price');
                        let month = $(this).attr('data-months');
                        let unit_values = $(this).attr('data-unit-values');
                        let package_code = $(this).attr('data-package-code');
                        let package_id = $(this).attr('data-package-id');

                        let available_amount = $(this).attr('data-balance');

                        let videos_in_cart = $(".item-in-cart").toArray().map(el => parseInt(el.getAttribute("data-id")));
                        // $(".item-in-cart").toArray().map(el => el.getAttribute("data-id")).each(function(){
						// 	videos_in_cart.push(this);
						// });

                        // console.log(videos_in_cart);

                        let total_videos = videos_in_cart.length;
                        let currency = "{{ auth()->user()->currency_code == 'ETB' ? 'ETB' : 'USD' }}";

                        let _token = '{{ csrf_token() }}';
                        let publish_date = $('#starts_on_date').datetimepicker('date').format('YYYY-MM-DD HH:mm:ss');

                        formData.append("videos_in_cart", videos_in_cart);
                        formData.append("package_id", package_id);
                        formData.append("published_at", publish_date);
                        formData.append("_token", _token);

                        if(total_videos == 0) {
                            alert("Your cart is empty.");

                        }
                        else if (total_videos > available_amount) {
                            alert("Sorry, your balance is insufficient.");
                        }
                        else {
                            let url = "{{ route('gizepackages.order') }}";

                            $.ajax({
                                url: url,
                                type: "POST",
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(response) {

                                    if (response.success) {

                                        $('#cartModal').modal('hide');


                                        Swal.fire({
                                            position: 'center',
                                            icon: 'success',
                                            title: 'Your videos are now available for you.',
                                            html: `Go to <a href="{{ route('myvideos.index') }}">My Videos</a> page now.`,
                                            showConfirmButton: false,
                                        });

                                        //Empty Cart
                                        $('#cart').empty();
                                        cartTotal();
                                    }
                                    else {
                                        // $('#cartModal').modal('hide');


                                        Swal.fire({
                                            position: 'center',
                                            icon: 'warning',
                                            title: 'Sorry, videos are not added.',
                                            html: `Please make sure you have sufficient balance or your package has not expired.`,
                                            showConfirmButton: false,
                                        });
                                    }
                                },
                                error: function(xhr) {
                                    $('#validation-errors').html('');
                                    let errMsgs = "";
                                    $.each(xhr.responseJSON.errors, function(key, value) {
                                        // $('#validation-errors').append('<div class="alert alert-danger">' +
                                        //     value + '</div');
                                        errMsgs += '' + value + '<br/>';


                                    });
                                    Swal.fire({
                                        icon: 'error',
                                        title: xhr.responseJSON.message,
                                        html: errMsgs,
                                        toast: true,
                                        position: 'bottom',
                                        showConfirmButton: false,
                                        timer: 4000
                                    });
                                }
                            });

                        }






                    });

                });
            });




            $('#cartModal').on('hide.bs.modal', function (event) {
                $('.nav-tabs a[href="#cartlist"]').tab('show');
                $('.spin-8').show();
                $('.package-list').hide();

            });


            $("#chapter-content").delegate(".add-to-cart", "click", function() {

                let currentItemId = $(this).attr("data-id");

                let productInfo = products.filter(el => el.id == currentItemId)[0];

                if ($(".item-in-cart").toArray().map(el => el.getAttribute("data-id")).includes(currentItemId)) {

                    // alert("{{ __('Video Already Added') }}");


                    // $('.cart-button').addClass('animate__animated animate__rubberBand');

                    animateCSS('.cart-button', 'bounce').then((message) => {
                        Swal.fire({
                            position: 'bottom',
                            toast: true,
                            icon: 'warning',
                            title: 'Video Already Added.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    });

                } else {

                //     $("#cart").append(`
                //     <div class="card border-0 item-in-cart" data-id="${productInfo.id}">
                //         <div class="card-body">
                //             <div class="d-flex justify-content-start align-items-end">
                //                 <img src="${productInfo.image}" class="img-in-cart m-1" alt="${productInfo.title}" style="border-radius: 4px;">

                //                 <strong class="ml-3">
                //                     ${productInfo.title} titlt el sleifsefjsl jfse
                //                 </strong>
                //             </div>
                //             <div class="d-flex justify-content-end align-items-end">

                //                 <button class="btn btn-outline-danger remove-from-cart">
                //                     <i class="fas fa-trash-alt"></i>
                //                 </button>
                //             </div>
                //             <div class="d-flex justify-content-end align-items-end">

                //                 <p class="mb-0">ETB <span class="item-in-cart-cost">${productInfo.price}</span></p>
                //             </div>
                //         </div>
                //     </div>
                // `);



                // <td class="text-center" style="width: 200px;"><img src="${productInfo.image}" style="width: 130px;
                //                 height: auto;
                //                 border-radius: 4px;">
                //             </td>

                // <td title="Remove from Cart" class="text-center" style="width: 30px;"><a href="javascript:void(0);"
                //                     class="btn btn-xs btn-danger my-product-remove remove-from-cart"><i class="fa fa-trash"></i></a></td>

                    $("#cart").prepend(`
                        <tr class="item-in-cart" title="${productInfo.title}" data-id="${productInfo.id}" data-price="${productInfo.price}">


                            <td>${productInfo.title}</td>
                            <td title="Videos">${productInfo.trainer}</td>
                            <td title="Duration" class="my-product-total ">${productInfo.duration}</td>
                            <td style="display:none;" title="Unit Price" class="item-in-cart-cost"  style="text-align: right;">1</td>
                            <td title="Remove from Cart" class="text-center" style="width: 30px;"><a href="javascript:void(0);"
                                     class="btn btn-xs btn-danger my-product-remove remove-from-cart"><i class="fa fa-trash"></i></a></td>


                        </tr>
                    `);

                    animateCSS('.cart-button', 'bounce').then((message) => {
                        Swal.fire({
                            position: 'bottom',
                            toast: true,
                            icon: 'success',
                            title: 'Video Added to Cart.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    });







                }

                cartTotal();
            })

            $("#cart").delegate(".remove-from-cart", "click", function() {

                $(this).parentsUntil("#cart").remove();
                cartTotal();
                Swal.fire({
                    position: 'bottom',
                    toast: true,
                    icon: 'warning',
                    title: 'Video Removed from Cart.',
                    showConfirmButton: false,
                    timer: 1500
                });

            })

            $("#cart").delegate(".quantity-plus", "click", function() {

                let q = $(this).siblings(".quantity").val();
                let p = $(this).siblings(".quantity").attr("unitPrice");
                let newQ = Number(q) + 1;
                let newCost = p * newQ;
                // console.log(p);
                $(this).siblings(".quantity").val(newQ);
                $(this).parent().siblings("p").find(".item-in-cart-cost").html(newCost.toFixed(2));
                cartTotal();
            })

            $("#cart").delegate(".quantity-minus", "click", function() {

                let q = $(this).siblings(".quantity").val();
                let p = $(this).siblings(".quantity").attr("unitPrice");
                if (q > 1) {

                    let newQ = Number(q) - 1;
                    let newCost = p * newQ;
                    // console.log(p);
                    $(this).siblings(".quantity").val(newQ);
                    $(this).parent().siblings("p").find(".item-in-cart-cost").html(newCost.toFixed(2));
                    cartTotal();

                }

            })

            $("#cart").delegate(".quantity", "keyup change", function() {

                let q = $(this).val();
                let p = $(this).attr("unitPrice");
                if (q > 1) {

                    let newQ = Number(q);
                    let newCost = p * newQ;
                    // console.log(p);
                    $(this).val(newQ);
                    $(this).parent().siblings("p").find(".item-in-cart-cost").html(newCost.toFixed(2));
                    cartTotal();

                } else {
                    alert("more than one");
                }

            })
        </script>
    @endsection

    @section('modals')
        @include('website.channel.collection.cart-modal')
    @endsection