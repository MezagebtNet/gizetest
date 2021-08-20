<li class="nav-item dropdown">
    <a class="nav-link bg-secondary rounded text-sm" data-toggle="dropdown" href="#" aria-expanded="false">
      {{-- <i class="flag-icon
        {{ (app()->currentLocale() == 'en') ? 'flag-icon-us': '' }}
        {{ (app()->currentLocale() == 'am') ? 'flag-icon-et': '' }}
        "></i> --}}


        {{ (LaravelLocalization::getCurrentLocale() == 'en') ? 'EN': '' }}
        {{ (LaravelLocalization::getCurrentLocale() == 'am') ? 'አማ': '' }}
    </a>
    <div class="dropdown-menu dropdown-menu-right p-0" style="left: inherit; right: 0px;">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                    class="dropdown-item {{ (LaravelLocalization::getCurrentLocale() == $localeCode) ? 'active': '' }}">
                    <i class="flag-icon flag-icon-{{ $localeCode == 'en' ? 'us' : 'et' }} mr-2"></i> {{ $properties['native'] }}
                </a>
        @endforeach


    </div>
  </li>