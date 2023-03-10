<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $table = 'replies';
    protected $fillable = [
        'comment_id',
        'user_id',
        'channel_id',
        'reply_content'
    ];

    public function channel() {
        return $this->belongsTo(Channel::class, 'channel_id');
    }
}
