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
            border-radius: 8px 8px 0 0 ;
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
                overflow-y: scroll;
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
            <div class="bd-highlight ">
                <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            {{-- <img src="..." class="d-block w-100" alt="..."> --}}
                            <div class="mt-4 mt-sm-5  bd-highlight">
                                <h5 class="px-5 channel-title   text-white">{{ __('banner_text_1') }}</h5>

                                {{-- <p class="channel-description lead text-white"></p> --}}

                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="mt-4 mt-sm-5  bd-highlight">
                                <h5 class="px-5 channel-title   text-white">{{ __('banner_text_2') }}</h5>

                                {{-- <p class="channel-description lead text-white"></p> --}}

                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="mt-4 mt-sm-5  bd-highlight">
                                <h5 class="px-5 channel-title   text-white">{{ __('banner_text_3') }}</h5>

                                {{-- <p class="channel-description lead text-white"></p> --}}

                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
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
                        <img class="book-image" src="{{ asset('storage/images/Fitrete_Hebuat_1 _sm.png') }}"/>
                    </center>
                    <h4>
                        መጽሐፈ ፍጥረተ ህቡአት
                    </h4>
                    <h5>/መጽሐፍ 1/</h5>
                    <h6 class="text-gray">
                        በጤንነት ሰጠኝ (ወልደ ሩፋኤል)
                    </h6>
                    <nav id="navbar-chapters" class="navbar navbar-light bg-light chapter-outline">
                        <nav class="nav nav-pills flex-column">
                            <h4>{{ __('Book Chapters') }}</h4>
                            <a class="nav-link" href="#item-1">{{ __('Chapter') }} 1</a>
                            <nav class="nav nav-pills flex-column">
                                <a class="nav-link ml-3 my-1" href="#item-1-1">{{ __('Chapter') }} 1-1</a>
                                <a class="nav-link ml-3 my-1" href="#item-1-2">{{ __('Chapter') }} 1-2</a>
                            </nav>
                            <a class="nav-link" href="#item-2">{{ __('Chapter') }} 2</a>
                            <a class="nav-link" href="#item-3">{{ __('Chapter') }} 3</a>
                            <nav class="nav nav-pills flex-column">
                                <a class="nav-link ml-3 my-1" href="#item-3-1">{{ __('Chapter') }} 3-1</a>
                                <a class="nav-link ml-3 my-1" href="#item-3-2">{{ __('Chapter') }} 3-2</a>
                            </nav>
                        </nav>
                    </nav>
                </div>

                <div class="col-sm-9">

                    <div data-spy="scroll" data-target="#navbar-chapters" data-offset="0" id="chapter-content"
                        class="chapter-content">
                        <h4 id="item-1">Item 1</h4>

                        <img src="https://gize.mezagebtnet.com/storage/images/c/thumb/1629275445.jpg" width="200" />
                        <div class="mt-3">
                            <span class="font-weight-bold">${product.price}</span>
                            <div class="d-flex justify-content-between align-items-end mt-2 mx-4 ">
                                <button class="btn btn-sm btn-outline-primary add-to-cart" data-id="${product.id}">
                                    Add <i class="fas fa-cart-plus"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-primary chapter-info" data-id="${product.id}">
                                    Details <i class="fas "></i>
                                </button>
                            </div>
                        </div>
                        <p> ሃሳበ አድሜስም ሆነ መጸሐፈ አድሜስ በዚህ ዘመን ለሚገኝ ትውልድ ተገልጦ የመጣ ጥበብ ነው፡፡ ይኽ ሃሳብ ለትውልዱ የመጣ ቢሆንም፤ ከእዚህ ከመጣ
                            ሃሳብ በመጀመሪያ
                            የደረሰውና የገለጠው የመጸሐፈ አድሜስ አዘጋጅና ደራሲ የሆነው ጤንነት ሰጠኝ /ወልደ ሩፋኤል/ ነው፡፡ ይኽም ጥበብ በመጸሐፍትና በተለያዩ የትንታኔ
                            መስጫ መንገዶች ከሰው
                            ልጆች ዘንድ እንዲደርስ እየሰራ የሚገኘው ደግሞ አድሜሽ መጸሐፍት ንግድ ሥራ ነው፡፡ በመጸሐፈ አድሜስ ስር ተካትተው በአማረኛ እንዲሁም በእንግሊዘኛ
                            ቋንቋ ተትርጉመው
                            ወደ ሰው ልጆች የደረሱት እና ወደ ፊት ለኅትመት የሚበቁት መጸሐፍት በአራት ዋና ዋና ክፍል ተቀምጠዋል፡፡ እነዚህም፡-

                            1. መጸሐፈ ፍጥረተ-ህቡአት፣
                            2. መጸሐፈ ምልአ ውህደት፣
                            3. መጸሐፈ ንግርተ ካህዝን እና
                            4. መጸሐፈ ጥበብ፣

                            የተሰኙ ታላላቅ መጸሐፍት ናቸው፡፡
                            በዚህ የመግቢያ ትንታኔ ቪዲዮ የፍጥረታትን አፈጣጠር የሚያክል ሰፊና ጥልቅ ጉዳይ አነስተኛ መጠን ባለው የፍጥረተ-ህቡአት መጸሐፍ ውስጥ ተካትቶ
                            የመቅረቡ ነገር እንዴት እንደሆነ ትንታኔ ቀርቦበታል፡፡
                            በተጨማሪም ፍጥረተ ህቡዓት ከዚህ በፊት ከጥበብ ሰዎች ያልተሰሙ ወይም ተፅፈው ያልተገኙ ታላላቅ ምስጢራት፣ እንዲሁም እንደ መጸሐፍ ሔኖክ የመሳሰሉ
                            የጥበብ መጽሐፍት ያነሷቸውን እና
                            ሳያነሱ የተዋቸውን የጥበብ ሃሳቦች በዚህ ዘመን የሚገኝ ትውልድ ሊረዳው በሚችል መንገድ የቀረበበት መጸሐፍ መሆኑን ያስረዳል።
                        </p>

                        <h5 id="item-1-1">Item 1-1</h5>
                        <p>ፍጥረተ ህቡአት ፍጥረታት ከተፈጠሩበት ጊዜ አንስቶ ዳግም ተመልሰው እስከሚጠቃለሉበት ጊዜ ድረስ ያለውን ሂደት በጊዜ ስር ገብቶ የሚተርክ መጸሐፈ
                            ነው፡፡
                            ይኽንን የፍጠረታትን ነገር በጊዜ ሂደት ውስጥ ለመመልከት እንደ መለኪያ የሚጠቀምባቸው የጊዜ መስፈሪያዎች ደግሞ ዓለማት፣አውዶች፣ ሳምንታት እና
                            ቀናት ናቸው፡፡
                            በዚሁ መሠረት ፍጥረታት በጥቅሉ በሶስት ዓለማት የሚገኙ ሲሆን፣ እነዚህም ፡- ሰማያተ ዓለም፣ ምድራዊ ዓለም እና ስውሩ ምድራዊ ዓለማት ናቸው፡፡

                            ምድራዊ ዓለም በሰማያተ ዓለም የሚገኙ ፍጥረታት እውን ሆነው የታዩበት ዓለም ሲሆን፤ በስሩ አራት ምድሮችን አካትቶ ይዟል፡፡ እነዚህም ምድረ ዛዲክ፣
                            ምድረ ባርቲና፣ ምድረ ታምሉክ እና ምድረ ካህዝን ይሰኛሉ፡፡

                            በዚህ ቪዲዮ የፍጥረታት ነገር ጥቅል የጊዜ መሰፈሪያ መለኪያ በሆነው ዓለማት ስር ትንታኔ ቀርቦበታል፡፡ ጊዜ ከግዝፈት ወይም ህልውና ጋር የሚነጣጠል
                            ባለመሆኑም
                            በሰማያተ ዓለም ህልው ሆነው የሚገኙትን አስር ታላላቅ ፍጥረታት እንዲሁም ከእነዚህ ስለተገኙት እና በምድራዊ ሰማያት ላይ ስላሉ ፍጥረታት ትንታኔ
                            ተሰጥቶበታል፡፡
                        </p>
                        <div class="mt-3">
                            <span class="font-weight-bold">${product.price}</span>
                            <div class="d-flex justify-content-between align-items-end mt-2 mx-4 ">
                                <button class="btn btn-sm btn-outline-primary add-to-cart" data-id="${product.id}">
                                    Add <i class="fas fa-cart-plus"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-primary chapter-info" data-id="${product.id}">
                                    Details <i class="fas "></i>
                                </button>
                            </div>
                        </div>
                        <h5 id="item-1-2">Item 1-2</h5>
                        <p>Placeholder content for the scrollspy example. This one relates to the item 1-2. Her love is
                            like a drug. All my girls vintage Chanel baby. Got a motel and built a fort out of sheets.
                            'Cause she's the muse and the artist. (This is how we do) So you wanna play with magic. So
                            just be sure before you give it all to me. I'm walking, I'm walking on air (tonight). Skip
                            the talk, heard it all, time to walk the walk. Catch her if you can. Stinging like a bee I
                            earned my stripes.</p>
                    </div>
                </div>
                <a href="#" data-toggle="modal" data-target="#cartModal" style="bottom: 0" class="ml-2  position-sticky">

                    <div class=" cart_info  py-3 bg-black text-white">

                        <span class="total"></span>
                        <div class="d-flex justify-content-between">
                            <h4 style="text-align: center; width: 100%;">
                                <span class="item-in-cart-count">0</span>
                                <i class="fas fa-shopping-cart text-primary"></i>
                            </h4>

                        </div>

                    </div>
                </a>

            </div>
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
            $(function() {
                $('div').scrollspy({
                    target: '#navbar-chapters'
                })

            });
        </script>
        <script>
            let products = [];

            function toShort(str, max = 50) {

                if (str.length > max) {
                    return str.substring(0, max) + "....."
                }

                return str;

            }

            function toShow(x) {
                $("#chapter-content").empty();
                x.map(product => {
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

                    `)
                })
            }

            function cartTotal() {

                let count = $(".item-in-cart-cost").length;

                $(".item-in-cart-count").html(count);


                if (count > 0) {
                    let totalCost = $(".item-in-cart-cost").toArray().map(el => el.innerHTML).reduce((x, y) => Number(x) +
                        Number(y));
                    // console.log(typeof totalCost);
                    $(".total").html(`

                        <div class="d-flex justify-content-between font-weight-bold px-3">
                            <h4>Total</h4>
                            <h4>ETB <span class="cart-cost-total">${Number(totalCost).toFixed(2)}</span></h4>
                        </div>

                    `)

                    $('#my-cart-grand-total').html(`ETB ${Number(totalCost).toFixed(2)}`);


                } else {
                    $(".total").html("")
                }

            }

            let data = [{
                    "id": 1,
                    "image": "https://gize.mezagebtnet.com/storage/images/c/thumb/1629275445.jpg",
                    "title": "title 1",
                    "description": `ሃሳበ አድሜስም ሆነ መጸሐፈ አድሜስ በዚህ ዘመን ለሚገኝ ትውልድ ተገልጦ የመጣ ጥበብ ነው፡፡ ይኽ ሃሳብ ለትውልዱ የመጣ ቢሆንም፤ ከእዚህ ከመጣ ሃሳብ በመጀመሪያ
                        የደረሰውና የገለጠው የመጸሐፈ አድሜስ አዘጋጅና ደራሲ የሆነው ጤንነት ሰጠኝ /ወልደ ሩፋኤል/ ነው፡፡ ይኽም ጥበብ በመጸሐፍትና በተለያዩ የትንታኔ መስጫ መንገዶች ከሰው
                        ልጆች ዘንድ እንዲደርስ እየሰራ የሚገኘው ደግሞ አድሜሽ መጸሐፍት ንግድ ሥራ ነው፡፡ በመጸሐፈ አድሜስ ስር ተካትተው በአማረኛ እንዲሁም በእንግሊዘኛ ቋንቋ ተትርጉመው
                        ወደ ሰው ልጆች የደረሱት እና ወደ ፊት ለኅትመት የሚበቁት መጸሐፍት በአራት ዋና ዋና ክፍል ተቀምጠዋል፡፡ እነዚህም፡-

                        1.	መጸሐፈ ፍጥረተ-ህቡአት፣
                        2.	መጸሐፈ ምልአ ውህደት፣
                        3.	መጸሐፈ ንግርተ ካህዝን እና
                        4.	መጸሐፈ ጥበብ፣

                        የተሰኙ ታላላቅ መጸሐፍት ናቸው፡፡
                        በዚህ የመግቢያ ትንታኔ ቪዲዮ የፍጥረታትን አፈጣጠር የሚያክል ሰፊና ጥልቅ ጉዳይ  አነስተኛ መጠን ባለው የፍጥረተ-ህቡአት መጸሐፍ ውስጥ ተካትቶ የመቅረቡ ነገር እንዴት እንደሆነ ትንታኔ ቀርቦበታል፡፡
                        በተጨማሪም ፍጥረተ ህቡዓት ከዚህ በፊት ከጥበብ ሰዎች ያልተሰሙ ወይም ተፅፈው ያልተገኙ ታላላቅ ምስጢራት፣ እንዲሁም እንደ መጸሐፍ ሔኖክ የመሳሰሉ የጥበብ መጽሐፍት ያነሷቸውን እና
                        ሳያነሱ የተዋቸውን የጥበብ ሃሳቦች በዚህ ዘመን የሚገኝ ትውልድ ሊረዳው በሚችል መንገድ የቀረበበት መጸሐፍ መሆኑን ያስረዳል።
                        `,
                    "price": 10,
                    "duration": "00:45:12",
                    "video_count": 3,
                    "chapter_number": "1",

                },
                {
                    "id": 2,
                    "image": "https://gize.mezagebtnet.com/storage/images/c/thumb/1629275445.jpg",
                    "title": "title 2",
                    "description": "desc 2",
                    "price": 10,
                    "duration": "00:45:12",
                    "video_count": 3,
                    "chapter_number": "2",

                },
                {
                    "id": 3,
                    "image": "https://gize.mezagebtnet.com/storage/images/c/thumb/1629275445.jpg",
                    "title": "title 3",
                    "description": "desc 3",
                    "price": 10,
                    "duration": "00:45:12",
                    "video_count": 3,
                    "chapter_number": "2 - 1",

                },
            ];




            // $.get("https://fakestoreapi.com/products/",function (data) {
            products = data;
            toShow(products);
            // })


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
            //             if(product.category === selectedCategory){
            //                 return product;
            //             }
            //         })

            //         toShow(filterProducts);
            //     }else{
            //         toShow(products);
            //     }
            // })



            $("#chapter-content").delegate(".add-to-cart", "click", function() {
                let currentItemId = $(this).attr("data-id");

                let productInfo = products.filter(el => el.id == currentItemId)[0];

                if ($(".item-in-cart").toArray().map(el => el.getAttribute("data-id")).includes(currentItemId)) {

                    alert("{{ __('Video Already Added') }}")

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

                    $("#cart").prepend(`
                        <tr class="item-in-cart" title="${productInfo.title}" data-id="${productInfo.id}" data-price="${productInfo.price}">

                            <td class="text-center" style="width: 200px;"><img src="${productInfo.image}" style="width: 130px;
                                height: auto;
                                border-radius: 4px;">
                            </td>
                            <td>Chapter ${productInfo.chapter_number} "${productInfo.title}"</td>
                            <td title="Videos">${productInfo.video_count}</td>
                            <td title="Duration" class="my-product-total ">${productInfo.duration}</td>
                            <td title="Unit Price" class="item-in-cart-cost"  style="text-align: right;">${productInfo.price}</td>
                            <td title="Remove from Cart" class="text-center" style="width: 30px;"><a href="javascript:void(0);"
                                    class="btn btn-xs btn-danger my-product-remove remove-from-cart"><i class="fa fa-trash"></i></a></td>
                        </tr>
                    `);

                }

                cartTotal();
            })

            $("#cart").delegate(".remove-from-cart", "click", function() {

                $(this).parentsUntil("#cart").remove();
                cartTotal();

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
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="cartModalLabel">My Cart</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <center>
                <table width="100%" class="table table-hover table-responsive" id="my-cart-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th style="text-align: left;">Title</th>
                            <th>Videos</th>
                            <th>Duration</th>
                            <th style="text-align: right;">Price</th>
                            <th style="width: 100px;"></th>
                        </tr>
                    </thead>
                    <tbody id="cart">

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total Sum</strong></td>
                            <td><strong id="my-cart-grand-total" class="total"></strong></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                </center>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Send message</button>
            </div>
          </div>
        </div>
      </div>
      @endsection