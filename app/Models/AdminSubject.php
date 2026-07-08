<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSubject extends Model
{
    use HasFactory;
    protected $table = 'admin_subjects';
    protected $guarded = ['id','created_at','updated_at'];
}
