<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'created_by',
        'updated_by'
    ];

    public function books() {
        return $this->belongsToMany('App\Models\Book');

    }
}
