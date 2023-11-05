<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','type','is_shared','category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class , 'category_id');
    }
}
