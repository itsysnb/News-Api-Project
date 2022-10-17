<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'subject' => $this->subject,
            'body' => $this->body,
            'user_id' => UserResource::collection($this->whenLoaded('user')),
            'post_id' => PostResource::collection($this->whenLoaded('post')),
        ];
    }
}
