<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersActivation extends Model
{
    use HasFactory;

    protected $table = 'users_activation';
    protected $fillable = ['email', 'token', 'type', 'status'];

    public $timestamps = false;
}
