<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug','SKU','display_image','desc','price','status'];
    public function getRouteKeyName()
    {
        return 'slug';
    }

    //Primary Key

    public $primaryKey = 'id';


    //Timestamps

    public $timestamps =true;

    public function orderproduct(){        
        return $this->belongsTo('App\Models\User\orderproduct');
    }

    public function category() {
        return $this->belongsTo('App\Models\Admin\category');
    }


    public function images()
    {
        return $this->hasMany('App\Models\Admin\product_image');
    }
}
