<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReferralPatient extends Model
{
    use HasFactory;

    protected $table = 'refferal_patient';
    protected $fillable = ['type_id', 'user_id', 'date', 'hospital_id', 'status', 'no_reg', 'step'];

    public function profile()
    {
        return $this->hasOne(UsersProfile::class, 'user_id', 'user_id');
    }

    public function hospital()
    {
        return $this->hasOne(Hospital::class, 'id', 'hospital_id');
    }

    public function vaccination()
    {
        return $this->hasOne(TypeOfVaccination::class, 'id', 'type_id');
    }
}
