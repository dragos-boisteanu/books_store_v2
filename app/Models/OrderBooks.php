<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderBooks extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'isbn',
        'pages',
        'description',
        'price',
        'discount',
        'published_at',
        'publisher',
        'category',
        'cover',
        'language'
    ];

    public function order() 
    {
        return $this->belongsTo('App\Models\Order');
    }
}
