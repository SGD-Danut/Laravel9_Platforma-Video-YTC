@extends('front.channel.manage.master.master-page')

@section('head-title', 'Personalizare canal')

@section('content')
    <div class="px-4 py-4 my-5 text-center">
        <h2>Personalizare canal <span><img src="/images/youtube-customize.png" width="100" alt=""></span></h2>
        <div class="col-lg-8 mx-auto">
          <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
              <a class="nav-link {{ isset($layout) ? 'active' : '' }}" aria-current="page" href="{{ route('customize-channel-layout') }}">Aspect</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ isset($branding) ? 'active' : '' }}" href="{{ route('customize-channel-branding') }}">Branding</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ isset($details) ? 'active' : '' }}" href="{{ route('customize-channel-details') }}">Informații de bază</a>
            </li>
          </ul>
          
        </div>
    </div>
    <div class="col-lg-8 mx-auto">
      @if (isset($channelCustomizationPage))
        <h5>Bine ați venit la personalizarea canalului! Alegeți o obțiune de mai sus pentru a începe.</h5>
      @endif
      
      @yield('branding')
      @yield('details')
      @yield('layout')
    </div>
@endsection
