<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherBoard extends Model
{
    use HasFactory;
    protected $table = 'teacher_boards';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
