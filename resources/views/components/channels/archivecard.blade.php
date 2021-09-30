

  <div title="{{ $archivevid->title }}"  class="card mx-2 p-1 my-2  bg-gradient-dark" style="">
    <img class="card-img-top"  src="{{ asset('storage/'. $archivevid->poster_image_url) }}" alt="{{ $archivevid->title }}">

    @if($archivevid->is_free)
      <div class="ribbon-wrapper ribbon-sm">
        <div class="ribbon text-sm">
          {{ __('Free') }}
        </div>
      </div>
    @endif
    <div class="card-img-overlay d-flex flex-column justify-content-end"
      style="padding:0.2rem; ">

      <div class="d-flex flex-column bd-highlight ml-2">
         <span class="card-date text-sm align-self-end "
         style="background-color: #323232; padding: 1px 3px; margin:3px; border-radius: 4px;">
             {{ $archivevid->duration }}</span>
      </div>
    </div>

  </div>
  <div class="d-flex align-content-start flex-wrap mx-3 mb-3"
        style="
        ">
        <div class="  align-self-center">
          {{-- <a href="{{ route('channel.landing', ['slug' => $archivevid->gizeChannel->slug]) }}"> --}}
            <img title="{{ $archivevid->gizeChannel->name }}" alt="{{ $archivevid->gizeChannel->name }}" class="border:1px solid gray;" src="{{ asset('storage/'.$archivevid->gizeChannel->logo_image_url) }}" width="40"/>
          {{-- </a> --}}
        </div>
        <div class="d-flex flex-column bd-highlight ml-2">
          <h5 class="card-title text-dark ">{{ mb_strimwidth($archivevid->trainer, 0, 20, "..."); }} - {{ mb_strimwidth($archivevid->title, 0, 10, "..."); }}</h5>
          {{-- <p class="card-text text-white pb-2 d-sm-none dpt-1">{{ mb_strimwidth($archivevid->title, 0, 10, "..."); }}</p> --}}
          <span class="card-date text-secondary text-sm">
                {{ Jenssegers\Date\Date::createFromFormat('Y-m-d H:i:s', $archivevid->created_at)->format('M d, Y'); }}</span>
        </div>
      </div>