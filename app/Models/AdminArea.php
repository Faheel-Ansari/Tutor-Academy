<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminArea extends Model
{
    use HasFactory;
    protected $table = 'admin_areas';
    protected $guarded = ['id','created_at','updated_at'];
}
