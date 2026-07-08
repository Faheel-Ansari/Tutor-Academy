<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherPay extends Model
{
    use HasFactory;
    protected $table = 'teacher_pay';
    protected $guarded = ['id','created_at','updated_at'];
}
