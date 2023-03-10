@extends('front.channel.manage.content.channel-content')

@section('playlists')
@if (auth()->user()->playlists->count() > 0) 
<table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">@sortablelink('title', 'Playlist')</th>
        <th scope="col">Vizibilitate</th>
        <th scope="col">@sortablelink('created_at', 'Dată creare')</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
      @foreach ($playlists as $playlist)
      <tr>
        <td style="display: flex;">
          <a href="{{ route('show-current-playlist', $playlist->slug) }}">
            <img src="/images/playlists/{{ $playlist->thumbnail }}" width="100" alt="Lipsa imagine de tip thumbnail">
          </a>
          <h6 style="padding-left: inherit;">{{ $playlist->title }}</h6>
        </td>
        <td class="text-center">{{ $playlist->published == 1 ? 'Publicat' : 'Nepublicat' }}</td>
        <td class="text-center">{{ $playlist->created_at->format('d.m.Y') }}</td>
      </tr>
      @endforeach
    </tbody>
</table>
{{ $playlists->links() }}    
@else
  <h3>Nu ai nici un playlist creat.</h3>
@endif

@endsection

@section('image-preview-script')
  @include('front.scripts.image-preview-script')
@endsection