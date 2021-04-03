<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersProfile extends Model
{
    use HasFactory;

    protected $table = 'users_profile';
    protected $fillable = ['user_id', 'email', 'name', 'identity', 'address', 'area_code', 'hospital_sheet', 'telepon'];
}
