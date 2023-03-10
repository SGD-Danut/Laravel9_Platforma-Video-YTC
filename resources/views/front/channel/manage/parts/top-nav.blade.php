<div class="container fixed-top">
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('home') }}"><img src="/images/youtube-logo.png" width="100" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('show-channel-home', auth()->user()->channel->slug) }}">{{ __('Your channel') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('customize-channel-layout') }}">{{ __('Customization') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('channel-content') }}">{{ __('Content') }}</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>