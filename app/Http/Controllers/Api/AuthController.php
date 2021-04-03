<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\AuthMail;
use App\Models\ReferralPatient;
use App\Models\User;
use App\Models\UsersActivation;
use App\Models\UsersProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $user = User::where('name', $request->username)->orWhere('email', $request->email)->count();
        if ($request->username != null && $request->email != null && $request->password != null) {
            if ($user < 1) {
                $data = [
                    'role_id' => 2,
                    'name' => $request->username,
                    'email' => $request->email,
                    'email_verified_at' => date('d-M-Y H:i:s'),
                    'password' => bcrypt($request->password),
                    'remember_token' => base64_encode($request->name . $request->email),
                    'token' => base64_encode($request->name . $request->email),
                ];


                $users = User::create($data);

                $profile = [
                    'user_id' => $users->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'telepon' => substr($request->telepon, 0, 1) == 0 ? substr($request->telepon, 1) : $request->telepon,
                    'identity' => $request->identity,
                    'address' => $request->address,
                    'hospital_sheet' => $request->hospital_sheet,
                    'area_code' => $request->area_code,
                ];
                UsersProfile::create($profile);
                $data = $this->_sendMail($request);
                if ($data) {
                    return response()->json($data, 403);
                }
                $response = ['status' => 'success', 'message' => 'User berhasil ditambahkan, <a href="/auth/login">Login Sekarang</a>'];
                $status = 200;
            } else {
                $response = ['status' => 'error', 'message' => 'User gagal ditambahkan, Username atau email telah digunakan'];
                $status = 500;
            }
        } else {
            $response = ['status' => 'error', 'message' => 'User gagal ditambahkan, mohon lengkapi dulu data diri anda'];
            $status = 404;
        }
        return response()->json($response, $status);
    }

    public function login(Request $request)
    {
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $user = User::all()->where($fieldType, $request->username)->count();
        if ($user > 0) {
            $verified = User::all()->where($fieldType, $request->username)->where('email_verified_at', '!=', null);
            if ($verified->count() > 0) {
                $active = User::all()->where($fieldType, $request->username)->where('status', 1);
                if ($active->count() > 0) {
                    if (Auth::attempt([$fieldType => $request->username, 'password' => $request->password])) {
                        return response()->json(['message' => 'Login berhasil', 'status' => 'success'], 200);
                    } else {
                        return response()->json(['message' => 'Username atau Password Salah!', 'status' => 'error'], 500);
                    }
                } else {
                    return response()->json(['message' => 'Username belum aktif, atau hubungi admin!', 'status' => 'error'], 500);
                }
            } else {
                return response()->json(['message' => 'Username belum melakukan aktivasi email, mohon lakukan aktivasi terlebih dahulu atau hubungi admin!', 'status' => 'error'], 500);
            }
        } else {
            return response()->json(['message' => 'Username/email belum terdaftar!', 'status' => 'error'], 500);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/auth/login');
    }

    // public function forgotpassword(Request $request)
    // {
    //     $user = User::where('email', $request->email);
    //     if ($user->count() < 1) {
    //         return response()->json(['message' => 'Request gagal, Email anda belum terdaftar di situs kami', 'status' => 'error'], 404);
    //     }

    //     $request->request->add(['name' => $user->get()[0]->name]);
    //     $data = $this->_sendMail($request, 'forgotpassword');
    //     if ($data) {
    //         return response()->json($data, 403);
    //     }
    //     return response()->json(['message' => 'Request berhasil, Link telah terkirim ke email anda!', 'status' => 'success'], 200);
    // }

    public function resetpassword(Request $request)
    {
        $user = User::where('email', $request->email);
        if ($user->count() < 1) {
            return response()->json(['message' => 'Request gagal, Email anda belum terdaftar di situs kami', 'status' => 'error'], 404);
        }
        $user->update(['password' => bcrypt($request->password)]);
        return response()->json(['message' => 'Selamat!, Password anda berhasil dirubah <a href="/auth/login">Login Sekarang</a>', 'status' => 'success'], 200);
    }

    private function _sendMail($request)
    {
        $token = base64_encode($request->email . 'itclubsmkn5bandung' . rand(10, 100));
        $data = [
            'email' => $request->email,
            'token' => $token
        ];
        $mail = [
            'title' => 'Account Verify!',
            'email' => $request->email,
            'name' => $request->name,
            'created_at' => date('d M Y, H:i'),
            'token' => $token,
            'type' => 'verify',
        ];
        $activate = UsersActivation::where('email', $request->email)->count();
        if ($activate >= 3) {
            return ['message' => 'Gagal memuat request, Email telah melebihi batas request', 'status' => 'error'];
        }
        UsersActivation::create($data);
        Mail::to($request->email)->send(new AuthMail($mail));
    }
}
