<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserActivation;
use App\Models\UsersActivation;
use Illuminate\Http\Request;

class MailController extends Controller
{
    //
    public function activation()
    {
        $user = UsersActivation::where('email', $_GET['email'])->where('token', $_GET['token'])->get()[0];
        if ($user) {
            if ($user->status == null) {
                if (time() - strtotime($user->created_at) < 60 * 60) {
                    $user->update(['status' => 'activated']);
                    User::where('email', $_GET['email'])->update(['email_verified_at' => date('Y-m-d H:i:s')]);
                    return redirect('/auth/login');
                }
                return redirect('/error/exception/409');
            }
            return redirect('/error/exception/409');
        } else {
            return redirect('/error/exception/405');
        }
    }
}
