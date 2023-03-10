@extends('front.channel.manage.master.master-page')

@section('head-title', 'Conținut canal')

@section('content')
    <div class="px-4 py-4 my-5 text-center">
        <h2>Conținut canal <span><img src="/images/youtube-content.png" width="100" alt=""></span></h2>
        <div class="col-lg-8 mx-auto">
          <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
              <a class="nav-link {{ isset($channelVideos) ? 'active' : '' }}" aria-current="page" href="{{ route('channel-content-videos') }}">Videoclipuri</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ isset($channelPlaylists) ? 'active' : '' }}" aria-current="page" href="{{ route('channel-content-playlists') }}">Playlisturi</a>
            </li>
          </ul>
          
        </div>
    </div>
    <div class="col-lg-8 mx-auto">
      @if (isset($channelContentPage))
        <h5>Bine ați venit la conținutul canalului! Alegeți o obțiune de mai sus pentru a începe.</h5>
      @endif
      
      @yield('videos')
      @yield('playlists')
      @yield('current-user-playlist')
      
    </div>
@endsection
