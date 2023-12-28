<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'ingredients',
        'instructions',
        'prep_time',
        'cook_time',
        'servings',
        'public',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
