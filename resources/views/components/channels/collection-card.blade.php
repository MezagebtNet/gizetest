<a class="collection-card channel-card-link" href="{{ route('channel.col.details.index', ['slug'=>$channel->slug, 'col_slug'=>$collection->slug]) }}">
    <div class="">
        <!-- Widget: user widget style 2 -->
        <div class="card  widget-user-2 shadow-sm" style="border: solid 1px gray;">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header">
              <div class="widget-user-image">
                <img class="" src="{{ isset($collection->thumb_image_url) && $collection->thumb_image_url!=null && $collection->thumb_image_url!=null ? asset('storage/'.$collection->poster_image_url) : asset('storage/images/c/channelvideo.png') }}" alt="">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username collection-text">{{ $collection->title }}</h3>
              <h5 class="widget-user-desc collection-text">{{ $collection->collection_type->singular_name . ' ' . ($collection->seriesable ?  $collection->series_no : '')}} </h5>
              <h6 class="widget-user-desc collection-text">
                {{ $collection->description }}
              </h6>
            </div>

          </div>
          <!-- /.widget-user -->

        </div>

</a>
