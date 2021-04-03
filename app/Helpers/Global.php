<?php

use App\Models\ReferralPatient;
use Illuminate\Support\Facades\DB;

function hello()
{
    return 'admin';
}

function full_address($opt)
{
    $desa = DB::table('villages')->where('id', $opt)->get()[0];
    $kecamatan = DB::table('districts')->where('id', $desa->district_id)->get()[0];
    $kota = DB::table('regencies')->where('id', $kecamatan->regency_id)->get()[0];
    $provinsi = DB::table('provincies')->where('id', $kota->province_id)->get()[0];

    $data =  $desa->name . ' ' . $kecamatan->name . ' ' . $kota->name . ', ' . $provinsi->name;

    return strtolower($data);
}

function get_area($data)
{
    if (!empty($data['provinsi'])) {
        $area = DB::table('villages')->where('id', $data['id'])->first();
        $kec = DB::table('districts')->where('id', $area->district_id)->first();
        $kota = DB::table('regencies')->where('id', $kec->regency_id)->first();
        $data = $kota->province_id;
    } else {
        $data = DB::table($data['table'])->where($data['foreign_key'], $data['id'])->get()[0];
    }

    return $data;
}

function getDataReferral($data)
{
    $res = ReferralPatient::where('status', 0);
    if ($data->user_id != 'all') {
        $res->where('user_id', $data->user_id);
    }
    if ($data->type_id != 'all') {
        $res->where('type_id', $data->type_id);
    }
    if ($data->hospital_id != 'all') {
        $res->where('hospital_id', $data->hospital_id);
    }
    if ($data->date != null) {
        $res->where('date', $data->date);
    }
    if ($data->step != 'all') {
        $res->where('step', $data->step);
    }
    // dd($res->get());
    return $res->get();
}

function getMonth($data)
{
    $month = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    ];

    return $month[$data];
}

function getDay($data)
{
    $day = [
        'Sat' => 'Sabtu',
        'Sun' => 'Minggu',
        'Mon' => 'Senin',
        'Tue' => 'Selasa',
        'Wed' => 'Rabu',
        'Thu' => 'Kamis',
        'Fri' => 'Jumat',
    ];

    return $day[$data];
}
