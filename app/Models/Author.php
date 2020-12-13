<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'first_name',
        'created_by',
        'updated_by'
    ];

    public function books() {
        return $this->belongsToMany('App\Models\Book');
    }
}
