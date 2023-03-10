@extends('front.channel.master.channel')

@if ($channel->videos->count() > 0)   
  @section('videos')
  <main>
      <section class="video_content grid">
        @foreach ($paginatedVideos as $video)
        <div class="video_items">
          <a href="{{ route('show-current-video', $video->slug) }}">
            <div class="video-thumbnail">
              <img src="/images/thumbnails/{{ $video->thumbnail }}" alt=""> 
              <h6 class="video-duration"><span class="badge bottom-right">{{ $video->duration != null ? $video->duration : '00:00' }}</span></h6>
            </div>
          </a>
          
          <div class="details flex">
            <div class="heading">
              <p>{{ $video->title }}</p>
              <span>{{ $video->views }} vizualizări | {{ $video->created_at->format('d.m.Y') }}</span>
            </div>
          </div>
        </div>
        @endforeach
      </section>
      {{ $paginatedVideos->links() }}
    </main>
  @endsection
@else
  @section('videos')
    @include('front.channel.parts.empty-channel-message')
  @endsection
@endif