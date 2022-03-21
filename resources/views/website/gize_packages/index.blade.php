@extends('layouts.website.index')

@section('title', 'Channels')

@section('styles')
    <style>
        .grow {
            transition: all .2s ease-in-out;
        }

        .grow:hover, .grow:focus  {
            transform: scale(1.02);
        }

         #pricing .padd-section {
            padding-top: 50px;
            padding-bottom: 50px
        }

        #pricing .section-title {
            margin-bottom: 0px
        }

        #pricing .block-pricing {
            /* background: rgb(235, 235, 235); */
            border:rgb(78, 76, 72) 1px solid;
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.2), 0 0 4px 0 rgba(0, 0, 0, 0.19);
            display: inline-block;
            position: relative;
            border-radius: 8px;
            width: 100%;
        }

        #pricing .block-pricing:hover {

            border:rgb(207, 157, 55) 1px solid;
            background: rgba(255, 184, 41, 0.596);
        }

        .dark-mode
        #pricing .block-pricing, .dark-mode  #pricing h4, .dark-mode  #pricing h2, .dark-mode
        #pricing li  {
            color: white;
        }

        #pricing .block-pricing .table {
            margin-bottom: 0;
            padding: 30px 15px;
            max-width: 100%;
            width: 100%;
        }

        #pricing .block-pricing .table h4 {
            padding-bottom: 10px
        }

        #pricing h4 {
            color: #000;
            /* font-size: 13px; */
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            line-height: 2
        }

        #pricing .block-pricing h2 {
            margin-bottom: 10px
        }

        #pricing h2 {
            color: #000;
            font-weight: 600
        }

        #pricing .block-pricing ul {
            list-style: outside none none;
            margin: 10px auto;
            max-width: 240px;
            padding: 0
        }

        #pricing .block-pricing ul li {
            border-bottom: 1px solid rgba(153, 153, 153, 0.3);
            padding: 12px 0 20px;
            text-align: center
        }

        #pricing li {
            color: #626262;
            /* font-size: 13px; */
            font-weight: 400;
            letter-spacing: 2px;
            line-height: 20px;
            text-transform: capitalize
        }

        #pricing .block-pricing .table .table_btn a {
            background: #222222;
            color: #fff;
            margin-top: 20px;
            display: inline-block
        }

        #pricing .btn {
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
                <h2 class="mb-4">{{ __('Gize Packages') }}</h2>
                <h6 class=" text-muted mb-0">
                    {{ __('Please Choose a Gize Package to top-up your account.') }}

                </h6>
                <hr />
            </div>
        </div>
        <section id="pricing" class="padd-section text-center wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
            {{-- <div class="container">
                <div class="section-title text-center">
                    <h2>Our Pricing</h2>
                    <p class="separator">Detailed pricing of our packages.</p>
                </div>
            </div> --}}
            <div class="container">
                <div class="row">

                    @php

                        $currency_code =   auth()->user() != null ? (auth()->user()->currency_code == 'ETB'? 'ETB' : 'USD'): 'ETB';
                        // $currency_code = 'ETB';

                    @endphp
                    @foreach ($gize_packages as $package)
                        <div class="col-md-6 col-lg-3 my-2 grow">
                            <div class="block-pricing">
                                <div class="table">
                                    <h4>{{ $package->months }} {{ __('month') }}</h4>
                                    <h2>{{ $currency_code == 'ETB' ? $package->etb_amount : $package->usd_amount }} {{ $currency_code }}</h2>
                                    <ul class="list-unstyled">
                                        <li><b>{{ $package->for_unit_values }}</b> {{ _('Videos') }}</li>
                                        </ul>
                                    <div class="table_btn"> <button class="btn btn-buy btn-dark"
                                        data-months = "{{ $package->months }}"
                                        data-price = "{{ $currency_code == 'ETB' ? $package->etb_amount : $package->usd_amount }}"
                                        data-currency-code = "{{ $currency_code }}"
                                        data-unit-values = "{{ $package->for_unit_values }}"
                                        data-package-code = "{{ $package->code }}"><i class="fa "></i> Details </button> </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    </div>

    {{-- </div> --}}
    {{-- </div> --}}


@endsection

@section('js')


    <script>

        $(function() {
            $('.btn-buy').on('click', function(e){
                let el = $(this);
                let price = $(this).attr('data-price');
                let month = $(this).attr('data-months');
                let unit_values = $(this).attr('data-unit-values');
                let package_code = $(this).attr('data-package-code');

                let currency = "{{ $currency_code == 'ETB' ? 'ETB' : 'USD' }}";

                // let lv_id = $(this).attr('lv_id');
                let payment_methods = "";
                if(currency == 'ETB'){
                    payment_methods = `<h4><strong>{{ __("Top Up Gize Package Now") }}</strong></h4>
                        <div>
                                    <p>{{ __('Please use one of the payment methods listed:') }}</p>
                                    <hr/>

                                    <ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="pills-cbe-tab" data-toggle="pill" href="#pills-cbe" role="tab" aria-controls="pills-cbe" aria-selected="true">CBE</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="pills-dashen-tab" data-toggle="pill" href="#pills-dashen" role="tab" aria-controls="pills-dashen" aria-selected="false">Dashen</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="pills-boa-tab" data-toggle="pill" href="#pills-boa" role="tab" aria-controls="pills-boa" aria-selected="false">BOA</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="pills-cbebirr-tab" data-toggle="pill" href="#pills-cbebirr" role="tab" aria-controls="pills-cbebirr" aria-selected="false">CBE Birr</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="pills-telebirr-tab" data-toggle="pill" href="#pills-telebirr" role="tab" aria-controls="pills-telebirr" aria-selected="false">Telebirr</a>
                                    </li>
                                    </ul>
                                    <hr/>
                                    <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-cbe" role="tabpanel" aria-labelledby="pills-cbe-tab">
                                        <h4 class="attachment-heading">Commercial Bank of Ethiopia</h4>
                                        <img class="attachment-img mb-3" style="max-width: 150px;border: 1px solid gray;
                                    border-radius: 15px;" src="{{ asset('storage/' . 'images/commercialbank.jpg') }}" alt="Attachment Image">


                                        <div class="attachment-text">
                                        <dl>
                                        <dt>Deposit Amount</dt>
                                        <dd>${ price } ${ currency }</dd>
                                        <dt>A/C No</dt>
                                        <dd>1000179785947</dd>
                                        <dt>Name</dt>
                                        <dd>ግሩም ስብስቤ</dd>

                                        <dt>ክፍያ ልክ እንደፈፀሙ</dt>
                                        <dd>እባክዎን ደረሰኙን እና የፓኬጁን ኮድ በቴሌግራም ላይ በ 0911616155 ይላኩልን፡፡</dd>
                                        <dd>የፓኬጁ ኮድ፡ <strong>${ package_code }</strong></dd>
                                        </dl>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="pills-dashen" role="tabpanel" aria-labelledby="pills-dashen-tab">
                                        <h4 class="attachment-heading">Dashen Bank</h4>

                                        <img class="attachment-img mb-3" style="max-width: 150px;border: 1px solid gray;
                                    border-radius: 15px;" src="{{ asset('storage/' . 'images/dashenbank.jpg') }}" alt="Attachment Image">


                                        <div class="attachment-text">
                                        <dl>
                                        <dt>Deposit Amount</dt>
                                        <dd>${ price } ${ currency }</dd>
                                        <dt>A/C No</dt>
                                        <dd>5063781757007</dd>
                                        <dt>Name</dt>
                                        <dd>ግሩም ስብስቤ</dd>

                                        <dt>ክፍያ ልክ እንደፈፀሙ</dt>
                                        <dd>እባክዎን ደረሰኙን እና የፓኬጁን ኮድ በቴሌግራም ላይ በ 0911616155 ይላኩልን፡፡</dd>
                                        <dd>የፓኬጁ ኮድ፡ <strong>${ package_code }</strong></dd>
                                        </dl>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="pills-boa" role="tabpanel" aria-labelledby="pills-boa-tab">
                                        <h4 class="attachment-heading">Bank of Abyssinia</h4>

                                        <img class="attachment-img mb-3" style="max-width: 150px;border: 1px solid gray;
                                    border-radius: 15px;" src="{{ asset('storage/' . 'images/abyssiniabank.jpg') }}" alt="Attachment Image">


                                        <div class="attachment-text">
                                        <dl>
                                        <dt>Deposit Amount</dt>
                                        <dd>${ price } ${ currency }</dd>
                                        <dt>A/C No</dt>
                                        <dd>670685</dd>
                                        <dt>Name</dt>
                                        <dd>ግሩም ስብስቤ</dd>

                                        <dt>ክፍያ ልክ እንደፈፀሙ</dt>
                                        <dd>እባክዎን ደረሰኙን እና የፓኬጁን ኮድ በቴሌግራም ላይ በ 0911616155 ይላኩልን፡፡</dd>
                                        <dd>የፓኬጁ ኮድ፡ <strong>${ package_code }</strong></dd>
                                        </dl>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="pills-cbebirr" role="tabpanel" aria-labelledby="pills-cbebirr-tab">

                                        <h4 class="attachment-heading">CBE Birr</h4>

                                        <img class="attachment-img mb-3" style="max-width: 150px;border: 1px solid gray;
                                    border-radius: 15px;" src="{{ asset('storage/' . 'images/cbebirr.jpg') }}" alt="Attachment Image">


                                        <div class="attachment-text">
                                        <dl>
                                        <dt>Deposit Amount</dt>
                                        <dd>${ price } ${ currency }</dd>
                                        <dt>Phone No</dt>
                                        <dd>0911616155</dd>
                                        <dt>Name</dt>
                                        <dd>ግሩም ስብስቤ</dd>

                                        <dt>ክፍያ ልክ እንደፈፀሙ</dt>
                                        <dd>እባክዎን ደረሰኙን እና የፓኬጁን ኮድ በቴሌግራም ላይ በ 0911616155 ይላኩልን፡፡</dd>
                                        <dd>የፓኬጁ ኮድ፡ <strong>${ package_code }</strong></dd>
                                        </dl>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-telebirr" role="tabpanel" aria-labelledby="pills-telebirr-tab">

                                        <h4 class="attachment-heading">Telebirr</h4>


                                        <img class="attachment-img mb-3" style="max-width: 150px;border: 1px solid gray;
                                    border-radius: 15px;" src="{{ asset('storage/' . 'images/telebirr.jpg') }}" alt="Attachment Image">


                                        <div class="attachment-text">
                                        <dl>
                                        <dt>Deposit Amount</dt>
                                        <dd>${ price } ${ currency }</dd>
                                        <dt>Phone No</dt>
                                        <dd>0911616155</dd>
                                        <dt>Name</dt>
                                        <dd>ግሩም ስብስቤ</dd>

                                        <dt>ክፍያ ልክ እንደፈፀሙ</dt>
                                        <dd>እባክዎን ደረሰኙን እና የፓኬጁን ኮድ በቴሌግራም ላይ በ 0911616155 ይላኩልን፡፡</dd>
                                        <dd>የፓኬጁ ኮድ፡ <strong>${ package_code }</strong></dd>
                                        </dl>
                                        </div>
                                    </div>
                                    </div>






                                </div>`;
                }
                else {
                    payment_methods = `<p>Please send us your <strong>Billing Address</strong> and <strong>Package Code</strong> on Telegram so that we'll provide you our international bank details.</p>
                    <dl>
                        <dt>Phone Number</dt>
                        <dd>+251 911 616155</dd>
                        <dt>Deposit Amount</dt>
                        <dd>${ price } ${ currency }</dd>
                        <dt>Package Code</dt>
                        <dd>${ package_code }</dd>
                    </dl>`;
                }


                // alert(unit_values);
                Swal.fire({
                    position: 'bottom-middle',
                    icon: 'warning',
                    title: '',
                    confirmButtonText: "{{ __('OK') }}",

                    // toast: true,
                    icon: 'warning',
                    html: payment_methods,
                    // title: 'Video Already Added.',
                    showConfirmButton: true,
                    // timer: 1500
                });
            });
        });

    </script>
@endsection
