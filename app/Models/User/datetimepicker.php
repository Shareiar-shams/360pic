<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class datetimepicker extends Model
{
    use HasFactory;
    protected $fillable = ['date','time'];
    public function order()
    {
        return $this->belongsTo('App\Models\User\order');
    }
}
