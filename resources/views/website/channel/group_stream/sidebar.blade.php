<div style="position:relative ;">
    <ul class="list-group ">
        <a href="#allvideos"
            class="list-group-item list-group-item-action {{ request()->is('user/author') ? 'list-group-item-secondary' : '' }}">
            All Videos
            <span class="badge badge-info badge-pill">4</span>
        </a>
        <a href="{{ route('user.author.book') }}"
            class="list-group-item list-group-item-action {{ request()->is('user/author/books*') ? 'list-group-item-secondary' : '' }}">
            Videos Streamed for me
            <span class="badge badge-info badge-pill">4</span>
        </a>
        <a href="{{ route('user.author.bookprice') }}"
            class="list-group-item list-group-item-action {{ request()->is('user/author/book-prices*') ? 'list-group-item-secondary' : '' }}">
            Groups
            {{-- <span class="badge badge-dinfo badge-pill">1</span> --}}
        </a>
        <a href="{{ route('user.author.linkshop') }}"
            class="list-group-item list-group-item-action {{ request()->is('user/author/link-shops*') ? 'list-group-item-secondary' : '' }}">
            Calendar
            <span class="badge badge-info badge-pill">1</span>
        </a>
    </ul>
</div>
<h4>My Subscription</h4>
