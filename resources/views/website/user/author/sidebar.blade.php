<ul class="list-group">
  <a href="{{ route('user.author.home') }}" class="list-group-item list-group-item-action {{ request()->is('user/author') ? 'list-group-item-secondary' : '' }}">
    Overview
    <span class="badge badge-info badge-pill">4</span>
  </a>
  <a href="{{ route('user.author.book') }}" class="list-group-item list-group-item-action {{ request()->is('user/author/books*') ? 'list-group-item-secondary' : '' }}">
    Books
    <span class="badge badge-info badge-pill">4</span>
  </a>
  <a href="{{ route('user.author.bookprice') }}" class="list-group-item list-group-item-action {{ request()->is('user/author/book-prices*') ? 'list-group-item-secondary' : '' }}">
    Book Price
    {{-- <span class="badge badge-dinfo badge-pill">1</span> --}}
  </a>
  <a href="{{ route('user.author.linkshop') }}" class="list-group-item list-group-item-action {{ request()->is('user/author/link-shops*') ? 'list-group-item-secondary' : '' }}">
    Link Shops
    <span class="badge badge-info badge-pill">1</span>
  </a>
</ul>