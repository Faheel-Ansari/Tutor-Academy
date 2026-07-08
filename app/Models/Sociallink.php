<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sociallink extends Model
{
    use HasFactory;
    protected $table = 'sociallinks';
    protected $guarded = ['id','created_at','updated_at'];
}
