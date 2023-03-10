<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Video extends Model
{
    use HasFactory, Sortable;

    public $sortable = ['created_at', 'title', 'views'];
    
    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel() {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function dislikes() {
        return $this->hasMany(Dislike::class);
    }

    public function playlists() {
        return $this->belongsToMany(Playlist::class, 'playlist_video', 'video_id', 'playlist_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'video_id');
    }
}
