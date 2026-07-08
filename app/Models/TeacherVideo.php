<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherVideo extends Model
{
    use HasFactory;
    protected $table = 'teacher_videos';
    protected $guarded = ['id','created_at','updated_at'];
}
