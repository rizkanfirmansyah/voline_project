<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VaccinationController extends Controller
{
    //
    public function type()
    {
        return view('main.master.type_of_vacination');
    }

    public function hospital()
    {
        $provinsi = DB::table('provincies')->get();
        return view('main.master.hospital', ['provinsi' => $provinsi]);
    }

    public function barcode()
    {
        return view('main.master.barcode');
    }

    public function barcode_print()
    {
        return view('main.master.barcode_print');
    }
}
