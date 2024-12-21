<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany('App\Models\Admin\product');
    }
    public function getRouteKeyName()
    {
        return 'name';
    }
}
