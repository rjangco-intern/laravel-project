<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'brand', 'category_id', 'description', 'quantity', 'price', 'image'];
    protected $table = 'products';
    protected $primaryKey = 'id';

    public function orders(){
    	return $this->hasMany(Order::class);
    }

    public function categories(){
    	return $this->hasOne('App\Category', 'category_id', 'category_id');
    }
}
