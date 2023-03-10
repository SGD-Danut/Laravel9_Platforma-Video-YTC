<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Like;
use App\Models\Dislike;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LikeDislikeVideoComponent extends Component
{
    public $video;
    public $video_id;
    public $user_id;
    public $currentVideo;

    public function render()
    {
        $this->currentVideo = Video::find($this->video->id);
        return view('livewire.like-dislike-video-component', ['video' => $this->video])->with('currentVideo', $this->currentVideo);
    }

    protected $rules = [
        'video_id' => 'required',
        'user_id' => 'required',
    ];
    
    public function likeVideo() {
        if (Auth::check()) {
            $this->video_id = $this->video->id;
            $this->user_id = auth()->user()->id;

            $this->validate();

            $userLiked = DB::select('SELECT * FROM likes where video_id = ? AND user_id = ?', [$this->video_id, $this->user_id]);
            
            if (!$userLiked) {
                // Execution doesn't reach here if validation fails.
                Like::create([
                    'video_id' => $this->video_id,
                    'user_id' => $this->user_id,
                ]);
                $userDisliked = DB::select('SELECT * FROM dislikes where video_id = ? AND user_id = ?', [$this->video_id, $this->user_id]);
                if ($userDisliked) {
                    DB::delete('DELETE FROM dislikes WHERE video_id = ? AND user_id = ?', [$this->video_id, $this->user_id]);
                }
            }

            if ($userLiked) {
                DB::delete('DELETE FROM likes WHERE video_id = ? AND user_id = ?', [$this->video_id, $this->user_id]);
            }
        } else {
            return redirect(route('login'));
        }
    }

    public function dislikeVideo() {
        if (Auth::check()) {
            $this->video_id = $this->video->id;
            $this->user_id = auth()->user()->id;

            $this->validate();

            $userDisliked = DB::select('SELECT * FROM dislikes where video_id = ? AND user_id = ?', [$this->video_id, $this->user_id]);
            
            if (!$userDisliked) {
                // Execution doesn't reach here if validation fails.
                Dislike::create([
                    'video_id' => $this->video_id,
                    'user_id' => $this->user_id,
                ]);
                $userLiked = DB::select('SELECT * FROM likes where video_id = ? AND user_id = ?', [$this->video_id, $this->user_id]);
                if ($userLiked) {
                    DB::delete('DELETE FROM likes WHERE video_id = ? AND user_id = ?', [$this->video_id, $this->user_id]);
                }
            }

            if ($userDisliked) {
                DB::delete('DELETE FROM dislikes WHERE video_id = ? AND user_id = ?', [$this->video_id, $this->user_id]);
            }
        } else {
            return redirect(route('login'));
        }
    }
}
