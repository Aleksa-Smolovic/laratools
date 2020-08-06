<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostCategory extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];  

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function posts(){
        return $this->hasMany(Post::class, 'category_id', 'id');
    }

}
