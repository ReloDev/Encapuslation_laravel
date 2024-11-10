<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = ['content', 'category_id'];
    public function getId()
    {
        return $this->attributes['id'];
    }

    public function getContent()
    {
        return $this->attributes['content'];
    }

    public function setContent($value)
    {
        $this->attributes['content'] = $value;
    }

    public function getCategorieId()
    {
        return $this->attributes['category_id'];
    }

    public function setCategorieId($value)
    {
        $this->attributes['categorie_id'] = $value;
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'] ? $this->attributes['created_at'] : null;
    }

    public function setCreatedAt($value)
    {
        $this->attributes['created_at'] = $value;
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'] ? $this->attributes['updated_at'] : null;
    }

    public function setUpdatedAt($value)
    {
        $this->attributes['updated_at'] = $value;
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
