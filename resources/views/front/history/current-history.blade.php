@extends('front.master.master-page')

@section('history-page-style')
    <link rel="stylesheet" href="/css/history-page.css">
@endsection

@section('content')
    @inject('video', 'App\Models\Video')
    @foreach ($historyFromCurrentUser as $history)
        <div class="image-container">
            <a href="{{ route('show-current-video', $video::find($history->video_id)->slug) }}">
                <img src="\images\thumbnails\{{ $video::find($history->video_id)->thumbnail }}" alt="Video image" width="246" height="auto">
            </a>
            <div class="caption">
              <h2>{{ $video::find($history->video_id)->title }}
                    <form action="{{ route('delete-video-from-history', $history->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="delete-video-from-history-button">X</button>
                    </form>        
                </h2>
              <p>{{ $video::find($history->video_id)->description }}</p>
              <p class="viewed-on"><h3>Accesat:</h3> {{ $history->created_at->diffForHumans() }}</p>
            </div>
        </div> 
    @endforeach
    {{ $historyFromCurrentUser->links() }}
@endsection