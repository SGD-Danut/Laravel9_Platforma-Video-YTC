  <!--    nav      -->
  <section class="left-nav" id="navbar">
    <nav class="nav_container">
      <div>
        <a href="{{ route('home') }}" class="nav_link nav_logo ">
          <i class="fa-solid fa-bars nav_icon"></i>
          <span class="logo_name">
            <i class="fab fa-youtube"></i>
            YouTube
          </span>
        </a>

        <div class="nav_list">
          <div class="nav_items navtop">
            <a href="{{ route('home') }}" class="nav_link navtop {{ request()->routeIs('home') ? 'active' : '' }}">
              <i class="fa fa-house nav_icon"></i>
              <span class="nav_name">Home</span>
            </a>
            @auth
            @if (auth()->user()->channel_id != null)
            <a href="{{ route('show-channel-home', auth()->user()->channel->slug) }}" class="nav_link navtop {{ request()->routeIs('show-channel-home') ? 'active' : '' }}">
              <i class="fa-solid fa-users nav_icon"></i>
              <span class="nav_name">Channel</span>
            </a>
            @endif
            @endauth
            <a href="{{ route('history') }}" class="nav_link navtop {{ request()->routeIs('history') ? 'active' : '' }}">
              <i class="fa-solid fa-clock-rotate-left nav_icon"></i>
              <span class="nav_name">History</span>
            </a>
          </div>

        </div>
      </div>
    </nav>
  </section>
  <!--    nav      -->