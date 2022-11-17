<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $timestamps  = false;
    protected $table = 'comment';

    public function post() {
        return $this->belongsTo('App\Models\Post', 'id_post');
    }

    public function likes() {
        return $this->hasMany('App\Models\CommentLike', 'id_comment');
    }
}