<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Playlist extends Model
{
    use HasFactory, Sortable;
    protected $table = 'playlists';
    public $sortable = ['created_at', 'title'];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnail',
        'published',
        'user_id'
    ];

    public function videos() {
        return $this->belongsToMany(Video::class, 'playlist_video', 'playlist_id', 'video_id');
    }
}
