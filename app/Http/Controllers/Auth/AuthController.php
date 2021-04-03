<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\TypeOfVaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // !NOTE Auth views not API or Query

    public function register()
    {
        $vaksinasi = TypeOfVaccination::all();
        $hospital = Hospital::all();
        $provinsi = DB::table('provincies')->get();
        return view('main.auth.register', ['provinsi' => $provinsi, 'vaksinasi' => $vaksinasi, 'hospital' => $hospital]);
    }

    public function login()
    {
        return view('main.auth.login');
    }

    public function forgotpassword()
    {
        return view('main.auth.forgotpassword');
    }

    public function resetpassword()
    {
        return view('main.auth.resetpassword');
    }
}
