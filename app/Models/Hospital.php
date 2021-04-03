<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospital extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'hospital';
    protected $fillable = ['name', 'area_code', 'address', 'type', 'created_by', 'deleted_at'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
