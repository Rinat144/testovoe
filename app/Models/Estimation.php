<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimation extends Model
{
    use HasFactory;

    protected $table = 'estimations';
    protected $fillable = ['like', 'post_id'];

    public function posts()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

}
