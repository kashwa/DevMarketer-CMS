<?php
/**
 * Try that didn't work with Resource Collection
 */
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'key' => $this->id,
            'header' => str_limit($this->content, 50),
            'author' => $this->author_id,
            'profile'=> /*route('users.show', $this->id),*/ 
                        url('/users/'.$this->id.'/'),
            'Current-user-name'  => \Auth::user()->name

        ];
    }
}
