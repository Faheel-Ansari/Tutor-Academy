<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherArea extends Model
{
    use HasFactory;
    protected $table = 'teacher_areas';
    protected $guarded = ['id','created_at','updated_at'];
}
