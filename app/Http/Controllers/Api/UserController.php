<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UsersProfile;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function profile_user(Request $request)
    {
        if (UsersProfile::where('identity', $request->identity)->count() > 0) {
            return response()->json(['message' => 'Identitas/Kependudukan telah terdaftar', 'status' => 'error'], 500);
        }
        if (UsersProfile::where('telepon', $request->telepon)->count() > 0) {
            return response()->json(['message' => 'Nomor telepon telah terdaftar', 'status' => 'error'], 500);
        }
        $request->request->add(['user_id' => auth()->user()->id, 'email' => auth()->user()->email]);
        UsersProfile::create($request->all());
        return response()->json(['message' => 'Selamat anda telah terdaftar', 'status' => 'success'], 200);
    }
}
