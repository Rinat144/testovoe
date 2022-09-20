<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = ['heading', 'content', 'author_ip', 'client_id'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
    public function estimations()
    {
        return $this->hasMany(Estimation::class, 'post_id', 'id');
    }
}
