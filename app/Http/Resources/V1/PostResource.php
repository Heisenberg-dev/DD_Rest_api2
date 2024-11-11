<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Route;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        "id" => $this-> id,
        "title"=> $this-> title, 
        "categoryName"=> $this -> category ->title,
        "categoryId" => $this -> category_id,
        "content" => $this -> when(Route::currentRouteName()== 'posts.show', $this-> content) ,
        'created'=> Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
        'updated'=> Carbon::parse($this->updated_at)->format('Y-m-d H:i:s'),
      
        ];

    }
}
