<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_id',
        'user_id'
    ];

    public function video() {
        return $this->hasOne(Video::class, 'user_id');
    }
}
