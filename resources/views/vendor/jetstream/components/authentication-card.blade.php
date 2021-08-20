<div class="container">
    <div class="row justify-content-center my-2">
        {{-- <div class="col-sm-12 col-md-8 col-lg-5 my-2"> --}}
            <div>
                {{ $logo }}
            </div>

            <div class="card " style="border-radius: 0.94rem; background-color: #f5f5f5; border:1px solid rgba(120, 115, 115, 0.34); box-shadow: 0.1rem 0.3rem 1.2rem rgba(0, 0, 0, 0.87) !important;">
                {{ $slot }}
            </div>
        {{-- </div> --}}
    </div>
</div>