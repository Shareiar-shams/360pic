<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderproduct extends Model
{
    use HasFactory;

    //Table Name

    protected $table = 'orderproducts';

    //Primary Key

    public $primaryKey = 'id';


    //Timestamps

    public $timestamps =true;

    public function order(){         
        return $this->belongsTo('App\Models\User\order');   

    }
    public function product(){
        return $this->hasMany('App\Models\Admin\product');   

    }
}
