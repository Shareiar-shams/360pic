<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    //Table Name

    protected $table = 'orders';

    //Primary Key

    public $primaryKey = 'id';

    //Timestamps

    public $timestamps =true;

    public function user(){        
        return $this->belongsTo('App\Models\User');   
    }

    public function orderproduct(){
        return $this->hasMany('App\Models\User\orderproduct');
    }

    public function orderpayment()
    {
        return $this->hasOne('App\Models\User\orderpayment');
    }

    public function datetimepicker()
    {
        return $this->hasOne('App\Models\User\datetimepicker');
    }
}
