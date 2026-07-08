<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StdPricing extends Model
{
    use HasFactory;
    protected $table = 'admin_std_pkg';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
