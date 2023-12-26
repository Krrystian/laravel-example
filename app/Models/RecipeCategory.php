<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeCategory extends Model
{
    use HasFactory;
    protected $table = 'category_recipe'; //add custom table name

    protected $fillable = [
        'recipe_id',
        'category_id',
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
