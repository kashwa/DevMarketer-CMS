<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PostResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'key' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'header' => str_limit($this->content, 50),
            'post_body' => $this->content,
            'author' => $this->author_id,
            'profile'=> /*route('users.show', $this->id),*/ 
                        url('/users/'.$this->id.'/'),
            'Current-user-name'  => \Auth::user()->name,
            'user' => [
                'key' => $this->user->id,
                'name'=> $this->user->name,
                'email'=> $this->user->email
            ]

        ];
    }
}
