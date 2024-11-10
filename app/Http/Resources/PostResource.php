<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'identification' => $this->getId(),
            'contenu_categorie' => new CategorieResource($this->categorie),
            'contenu_post' => $this->getContent(),
            'date_ajout' => $this->getCreatedAt(),
            'date_modification' => $this->getUpdatedAt(),
        ];
    }
}


