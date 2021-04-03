<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfVaccination extends Model
{
    use HasFactory;

    protected $table = 'type_of_vaccination';
    protected $fillable = ['name', 'created_by'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
