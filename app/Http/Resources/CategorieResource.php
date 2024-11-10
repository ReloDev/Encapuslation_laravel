<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategorieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        // return $this;
        return [
            'identification' => $this->getId(),
            'nom_categorie' => $this->getName(),
            'date_ajout' => $this->getCreatedAt(),
            'date_modification' => $this->getUpdatedAt(),
        ];
    }
}
