{{-- <div class="channel-card card-deck h-100" >
    <div class="card mx-sm-0 mx-md-1 mx-lg-2 mx-2 my-2">
        <img src="{{ asset('assets/image/background.jpg') }}" class="card-img-top" alt="...">
        <div class="card-body">

            <h5 class="card-title">የመጽሐፈ አድሜስ ማብራሪያ ቪድዮዎች - በጤንነት ሰጠኝ (ወ/ሩፋኤል)</h5>

            <p class="card-text"></p>
            <p>
                <div class="text-center">
                    <a class="btn btn-lg btn-dark align-center" href="{{ route('channel.landing', 'xxx') }}">
                        <i class="fa fa-play"> </i> <span class="ml-2"> Start Watching</span></a>

                </div>
            </p>
        </div>
    </div>
</div> --}}

<div class="col-md-4">
  <div class="card mb-4 shadow-sm">
    {{-- <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg> --}}
    <img src="{{ asset('assets/image/background.jpg') }}" class="card-img-top" alt="...">

    <div class="card-body">
      <p><strong>የመጽሐፈ አድሜስ የማብራሪያ ቪድዮዎች</strong></p>
      <p class="card-text">በጤንነት ሰጠኝ (ወ/ሩፋኤል)</p>
      <div class="d-flex justify-content-between align-items-center">
        <div class="btn-group">
          <a href="{{ route('channel.landing', 'addmes ') }}" class="btn  btn-outline-secondary">
            <i class="fa fa-bullhorn"></i>
            Goto Channel</a>
          {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
        </div>
        {{-- <small class="text-muted">9 mins</small> --}}
      </div>
    </div>
  </div>
</div>

{{-- <div class="card mb-3" style="max-width: 540px;">
    <div class="row no-gutters">
      <div class="col-md-4">
          <img src="{{ asset('assets/image/background.jpg') }}" class="card-img-top" alt="...">

      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
      </div>
    </div>
  </div> --}}