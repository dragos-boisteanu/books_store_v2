<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

// implements MustVerifyEmail 
class User extends Authenticatable 
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'name',
        'phone_number',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['role'];

    public function stock() 
    {
        $this->belongsTo('App\Models\Stock');
    }

    public function cart() {
        return $this->hasOne('App\Models\Cart');
    }
    
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function addresses() 
    {
        return $this->hasMany('App\Models\Address');
    }
    
    public function orders() 
    {
        return $this->hasMany('App\Models\Order');
    }

    public function orderOperatator() 
    {
        return $this->hasMany('App\Models\Order', 'operator_id');
    }

    public function addedBooks() 
    {
        return $this->hasMany('App\Models\Book', 'created_by');
    }

    public function updatedBooks() 
    {
        return $this->hasMany('App\Models\Book', 'updated_by');
    }

    public function operatorForOrders() {
        $orders = DB::select('select * from orders where operator_id = :id', ['id'=>$this->id]);

        return $orders;
    }

}
