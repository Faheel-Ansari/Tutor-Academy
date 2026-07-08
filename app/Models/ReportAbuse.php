<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportAbuse extends Model
{
    use HasFactory;
    protected $table = 'report_abuse';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
