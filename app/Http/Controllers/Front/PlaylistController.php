<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Video;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function showCurrentPlaylist(Playlist $playlist, Video $video) {
        $videosFromCurrentPlaylist = $playlist->videos;
        return view('front.current-playlist')
        ->with('playlist', $playlist)
        ->with('videosFromCurrentPlaylist', $videosFromCurrentPlaylist)
        ->with('currentVideo', $video);
    }
}
