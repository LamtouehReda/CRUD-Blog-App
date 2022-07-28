<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'slug',
        'image',
        'body',
        'user_id'
    ];

    #this function tells that every post is belonging to some user
    public function user(){
        return $this->belongsTo(User::class);
    }

}
