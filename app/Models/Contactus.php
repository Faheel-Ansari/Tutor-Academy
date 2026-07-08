<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    use HasFactory;
    protected $table = 'contactus';
    protected $guarded = ['id','created_at','updated_at'];
}
