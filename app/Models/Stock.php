<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    public function book() 
    {
        return $this->belongsTo('App\Models\Book', 'book_id');
    }

    public function created_by()
    {
        return $this->hasOne('App\Models\User', 'created_by');
    }

    public function updated_by()
    {
        return $this->hasOne('App\Models\User', 'updated_by');
    }
}

