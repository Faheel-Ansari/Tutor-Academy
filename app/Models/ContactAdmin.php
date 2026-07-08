<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactAdmin extends Model
{
    use HasFactory;
    protected $table = 'contact_admin';
    protected $guarded = ['id','created_at','updated_at'];
}
