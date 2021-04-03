<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\ReferralPatient;
use App\Models\TypeOfVaccination;
use App\Models\User;
use App\Models\UsersProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    public function index()
    {
        $data = [
            'pendaftar' => User::all()->count(),
            'vaksin' => TypeOfVaccination::all()->count(),
            'rumah_sakit' => Hospital::all()->count(),
            'rujukan' => ReferralPatient::all()->count(),
            'refType' => ReferralPatient::selectRaw('type_id,COUNT(type_id) AS data')->groupBy('type_id')->get(),
            'refHospital' => ReferralPatient::selectRaw('hospital_id,COUNT(hospital_id) AS data')->groupBy('hospital_id')->get(),
        ];
        return view('main.dashboard.index', ['data' => $data]);
    }

    public function users()
    {
        $provinsi = DB::table('provincies')->get();
        return view('main.dashboard.users', ['provinsi' => $provinsi]);
    }

    public function pattient()
    {
        $hospital = Hospital::all();
        $type = TypeOfVaccination::all();
        $key = ReferralPatient::all();
        $data = [];
        foreach ($key as $value) {
            array_push($data, $value->user_id);
        }
        $users = UsersProfile::all();
        $user = ReferralPatient::all()->where('status', '!=', 1);
        return view('main.dashboard.pattient', ['hospital' => $hospital, 'user' => $user, 'users' => $users, 'type' => $type]);
    }

    public function profile()
    {
        $profile = UsersProfile::where('user_id', auth()->user()->id)->get();
        return view('main.user.profile', ['profile' => $profile]);
    }

    public function register()
    {
        $provinsi = DB::table('provincies')->get();
        $profile = UsersProfile::where('user_id', auth()->user()->id)->count();
        return view('templates.profile', ['data' => $provinsi, 'profile' => $profile]);
    }

    public function refferal_patient()
    {
        $res = ReferralPatient::where('user_id', auth()->user()->id)->get();
        $res2 = UsersProfile::where('user_id', auth()->user()->id)->get();
        $hospital = Hospital::all();
        $type = TypeOfVaccination::all();
        if (empty($res2[0])) {
            return view('main.user.redirect');
        }
        $profile = UsersProfile::where('user_id', auth()->user()->id)->get()[0];
        $patient = ReferralPatient::where('user_id', auth()->user()->id)->get();
        return view('main.user.referral_patient', ['hospital' => $hospital, 'type' => $type, 'profile' => $profile, 'patient' => $patient]);
    }
}
