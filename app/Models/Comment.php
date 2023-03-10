<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = [
        'video_id',
        'user_id',
        'channel_id',
        'comment_content'
    ];

    public function video() {
        return $this->belongsTo(Video::class, 'video_id');
    }

    public function replies() {
        return $this->hasMany(Reply::class, 'comment_id');
    }

    public function channel() {
        return $this->belongsTo(Channel::class, 'channel_id');
    }
}
