<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = ['name'];
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    public function products (){
    	return $this->hasMany('App\Product', 'category_id', 'category_id');
    }
}
