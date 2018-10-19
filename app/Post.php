<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Get the User that wrote the Post.
     * @return [type] [description]
     */
    public function user()
    {
      return $this->belongsTo('App\User', 'author_id');
    }

    /**
     * Here is fillable items, Mass Assignment.
     *
     * @var array
     */
    protected $fillable = [
      'title', 'slug', 'author_id', 'excerpt', 'content'
    ];
}
