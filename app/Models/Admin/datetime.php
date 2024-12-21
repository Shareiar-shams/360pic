<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class datetime extends Model
{
    use HasFactory;
    protected $fillable = ['date','time','strdatetime'];
}
