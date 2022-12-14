<?php

namespace App\Http\Resources;


use App\Models\Post;
use Illuminate\Http\Resources\Json\JsonResource;

class PostipResource extends JsonResource
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
                'author_ip' => $this->author_ip,
                'login' => $this->client->login
            ];
    }
}
