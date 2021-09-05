<a class="channel-card-link" href={{ route('channel.landing', $slug) }}>
    <div class="mx-2 mx-xs-2">

        <article class="position-relative card card-body channel-card grow" style="">
            {{-- <div class="ribbon-wrapper ribbon-lg">
                <div class="ribbon bg-succondary text-lg">
                  አዲስ ተጭኗል
                </div>
              </div> --}}
            <figure class="text-center">
                {{-- <span class="rounded-circle icon-md bg-danger"><i class="fa fa-play white"></i></span> --}}
                <img style="border-radius: 0px; width:64px;" class="img-circle bg-black"
                    src="{{ asset('assets/image/Addmes Logo.png') }}" alt="Addmes Channel">

                <figcaption class="pt-4">
                    <h5 class="title text-bold">{{ $name }}</h5>
                    <p class="text-sm">{{ $producer }}</p>
                </figcaption>
            {{-- <span class="position-relative badge badge-danger">3</span> --}}

            </figure> <!-- iconbox // -->
        </article>
    </div>
</a>
