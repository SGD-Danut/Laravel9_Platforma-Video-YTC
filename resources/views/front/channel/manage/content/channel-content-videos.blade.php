@extends('front.channel.manage.content.channel-content')

@section('videos')
@if (auth()->user()->channel->videos->count() > 0) 
<table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">@sortablelink('title', 'Video')</th>
        <th scope="col">Vizibilitate</th>
        <th scope="col">@sortablelink('created_at', 'Dată încărcare')</th>
        <th scope="col">@sortablelink('views', 'Vizualizări')</th>
        <th scope="col">Aprecieri / Dezaprecieri</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
      @foreach ($videos as $video)
      <tr>
        <td style="display: flex;">
          <img src="/images/thumbnails/{{ $video->thumbnail }}" width="120" alt="Lipsa imagine de tip thumbnail">
          <h6 style="padding-left: inherit;">{{ $video->title }}</h6>
        </td>
        <td class="text-center">{{ $video->published == 1 ? 'Publicat' : 'Nepublicat' }}</td>
        <td class="text-center">{{ $video->created_at->format('d.m.Y') }}</td>
        <td class="text-center">{{ $video->views }}</td>
        <td class="text-center"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i> {{ $video->likes->count() }} &nbsp; &nbsp; <i class="fas fa-thumbs-down fa-lg"></i> {{ $video->dislikes->count() }}</td>
      </tr>
      @endforeach
    </tbody>
</table>
{{ $videos->links() }}   
@else
  @include('front.channel.parts.empty-channel-message')
@endif

@endsection

@section('image-preview-script')
  @include('front.scripts.image-preview-script')
@endsection