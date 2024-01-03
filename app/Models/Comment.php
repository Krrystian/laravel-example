<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'user_id',
        'comment'
    ];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
