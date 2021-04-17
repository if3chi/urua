<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'name', 'image', 'price', 'description', 'category_id'
    ];

    public function category(){
        return $this->BelongsTo(Category::class);
    }
}
