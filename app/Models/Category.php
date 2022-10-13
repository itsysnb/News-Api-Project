<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $with = ['subCategory'];

    protected $fillable = [
        'name',
        'description',
        'parent_id'
    ];

    public function subCategory()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
