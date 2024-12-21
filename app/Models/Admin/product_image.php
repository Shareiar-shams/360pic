<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_image extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'image_path'];
    public function product()
    {
        return $this->belongsTo('App\Models\Admin\product');
    }
}
