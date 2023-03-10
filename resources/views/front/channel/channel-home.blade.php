@extends('front.channel.master.channel')

@section('details')
@if ($channel->special_video != null)
<br>
  <div class="col-lg-11 mx-auto">
    <div class="flex">
        <div class="">
          <video width="424" height="238" controls autoplay>
            <source src="/videos/{{ $specialVideo[0]->file_path }}" type="video/mp4">
            Your browser does not support the video tag.
          </video>
        </div>
      <div class="container video_items">
      <a href="{{ route('show-current-video', $specialVideo[0]->slug) }}">
        <p>{{ $specialVideo[0]->title }}</p>
      </a>
        <span>{{ $specialVideo[0]->views }} vizualizări</span><br>
        <span>Adăgat la data de:</span>
        <span>{{ $specialVideo[0]->created_at->format('d.m.Y') }}</span><br>
        <span>{{ $specialVideo[0]->description }}</span>
      </div>
    </div>
  </div>
@endif

@endsection