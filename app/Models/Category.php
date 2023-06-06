<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'created_at' => 'datetime:d M Y',
        'updated_at' => 'date: d M Y',
    ];
}
