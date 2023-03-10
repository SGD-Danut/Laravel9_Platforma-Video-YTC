  <!--    header      -->
  <header class="header">
    <div class="header_container">
      <div class="none"> </div>
      
      <div class="user">
        <div class="icon">
          <a href="{{ route('show-new-video-form') }}"><i class="fa-solid fa-video"></i></a>
        </div>

        @if (Auth::check() && auth()->user()->channel_id != NULL)
          <a href="{{ route('dashboard') }}">
            <div class="img">
              <img src="/images/avatars/{{ Auth::check() ? auth()->user()->channel->avatar : 'default-avatar.png' }}" alt="" class="avatar-image small-avatar">
            </div>
          </a>
        @else
          <a href="{{ route('dashboard') }}">
            <div class="img">
              <img src="/images/avatars/default-avatar.png" alt="" class="avatar-image">
            </div>
          </a>
        @endif
        
      </div>

      <div class="toggle">
        <i class="fa-solid fa-bars" id="header-toggle"></i>
      </div>
    </div>
  </header>
  <!--    header      -->