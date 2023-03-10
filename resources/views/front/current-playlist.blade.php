@extends('front.master.master-page')

@section('playlist-page-style')
<link rel="stylesheet" href="\css\playlist-page.css">
@endsection

@section('content')
@if ($playlist->published == 1 || (auth()->check() && $playlist->user_id == auth()->id())) 
<div class="container">
  @if ($playlist->videos->count() > 0)
    <div class="main-video">
        <div class="video">
            <video src="\videos\{{ $currentVideo->slug ? $currentVideo->file_path : $videosFromCurrentPlaylist[0]->file_path }}" controls muted autoplay></video>
            <h3 class="title">{{ $currentVideo->slug ? $currentVideo->title : $videosFromCurrentPlaylist[0]->title }}</h3>
        </div>
    </div>
    <div>
      <h3 class="playlistRightTitle">{{ $playlist->title }}</h3>
    <div class="video-list">
      
        @foreach ($videosFromCurrentPlaylist as $video)
        <a href="{{ route('show-current-playlist', [$playlist->slug, $video->slug]) }}">
          <div class="vid {{ $currentVideo->slug == $video->slug || ($videosFromCurrentPlaylist[0]->slug == $video->slug && empty($currentVideo->slug)) ? 'active' : '' }}">
              <img src="\images\thumbnails\{{ $video->thumbnail }}" class="imageOfVideo" alt="">
              <h3 class="title">{{ $video->title }}</h3>
          </div>
        </a>
        @endforeach
    </div> 
    </div>
  @else
      <h2>Nu există nici un video adăugat în acest playlist!</h2>
  @endif
</div>   
@else
  @php
      abort(404);
  @endphp
@endif

@endsection

@section('image-preview-script')
  @include('front.scripts.image-preview-script')
@endsection