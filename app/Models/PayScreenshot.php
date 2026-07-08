<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayScreenshot extends Model
{
    use HasFactory;
    protected $table = 'pay_screenshots';
    protected $guarded = ['id','created_at','updated_at'];
}
