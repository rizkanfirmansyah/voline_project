<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    //
    public function regencies()
    {
        if (!empty($_GET['parm'])) {
            $data = DB::table('regencies')->where('id', $_GET['id'])->first();
        } elseif ($_GET['province_id']) {

            $data = DB::table('regencies')->where('province_id', $_GET['province_id'])->get();
        } else {
            $data = DB::table('regencies')->get();
        }
        return response()->json(['status' => 'success', 'values' => $data], 200);
    }

    public function districts()
    {
        if (!empty($_GET['parm'])) {
            $data = DB::table('districts')->where('id', $_GET['id'])->first();
        } elseif ($_GET['regency_id']) {
            $data = DB::table('districts')->where('regency_id', $_GET['regency_id'])->get();
        } else {
            $data = DB::table('districts')->get();
        }
        return response()->json(['status' => 'success', 'values' => $data], 200);
    }

    public function villages()
    {
        if (!empty($_GET['parm'])) {
            $data = DB::table('villages')->where('id', $_GET['id'])->first();
        } elseif ($_GET['district_id']) {
            $data = DB::table('villages')->where('district_id', $_GET['district_id'])->get();
        } else {
            $data = DB::table('villages')->get();
        }
        return response()->json(['status' => 'success', 'values' => $data], 200);
    }
}
