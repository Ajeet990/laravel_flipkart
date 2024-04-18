<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class product extends Model
{
    use HasFactory;
    // Assuming you have a 'category_id' column in your 'products' table
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // public function user()
    // {
    //     return $this->belongTo(User::class);
    // }
}
