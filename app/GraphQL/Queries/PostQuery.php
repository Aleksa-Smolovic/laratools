<?php

namespace App\GraphQL\Queries;
use App\Post;

class PostQuery
{

    public function reverse(){
        return Post::orderBy('id', 'desc')->get();
    }

    public function titleLike($title){
        return Post::where('title', 'like', '%' . $title . '%')->get();
    }
}
