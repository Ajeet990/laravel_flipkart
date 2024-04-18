<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    // Assuming you have a 'id' primary key column in your 'categories' table
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
