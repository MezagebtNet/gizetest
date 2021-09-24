

  <div class="card mx-2 p-1 my-2  bg-gradient-dark" style="">
    <img class="card-img-top" src="{{ asset('storage/'. $archivevid->thumb_image_url) }}" alt="Dist Photo 1">

    @if($archivevid->is_free)
      <div class="ribbon-wrapper ribbon-lg">
        <div class="ribbon bg-success text-lg">
          {{ __('Free') }}
        </div>
      </div>
    @endif
    <div class="card-img-overlay d-flex flex-column justify-content-end">
      <h5 class="card-title text-primary text-white">{{ mb_strimwidth($archivevid->title, 0, 30, "..."); }}</h5>
      {{-- <p class="card-text text-white pb-2 pt-1">{{ mb_strimwidth($archivevid->description, 0, 10, "..."); }}</p> --}}
      <span class="text-white text-sm">
            {{ Jenssegers\Date\Date::createFromFormat('Y-m-d H:i:s', $archivevid->created_at)->format('M d, Y'); }}</span>

    </div>
  </div>