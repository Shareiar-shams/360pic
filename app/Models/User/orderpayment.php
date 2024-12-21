<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderpayment extends Model
{
    use HasFactory;

    //Table Name

    protected $table = 'orderpayments';

    //Primary Key

    public $primaryKey = 'id';

    public function order()
    {
        return $this->belongsTo('App\Models\User\order');
    }
}
