<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\AuthMail;
use App\Models\Hospital;
use App\Models\ReferralPatient;
use App\Models\TypeOfVaccination;
use App\Models\User;
use App\Models\UsersProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Mockery\Matcher\Type;
use Yajra\DataTables\DataTables;

class MasterController extends Controller
{
    //
    public function get_type($id = FALSE)
    {
        if ($id == FALSE) {
            return DataTables::of(TypeOfVaccination::get())
                ->editColumn('created_at', function ($type) {
                    return date('d-M-Y H:i', strtotime($type->created_at));
                })
                ->editColumn('created_by', function ($type) {
                    return $type->user->name;
                })
                ->editColumn('btn', function ($type) {
                    return '<div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#" data-id="' . $type->id . '" id="Edit">Edit</a>
                            <a class="dropdown-item" href="#" data-id="' . $type->id . '" id="Hapus">Hapus</a>
                            </div>
                        </div>';
                })
                ->RawColumns(['btn'])
                ->make(true);
        }

        $data = TypeOfVaccination::find($id);
        return response()->json(['message' => 'query berhasil', 'status' => 'success', 'values' => $data], 200);
    }

    public function insert_type(Request $request)
    {
        TypeOfVaccination::create(['name' => $request->name, 'created_by' => auth()->user()->id]);
        return  response()->json(['message' => 'Jenis Vaksin berhasil ditambahkan', 'status' => 'success'], 200);
    }

    public function update_type(Request $request)
    {
        $type = TypeOfVaccination::find($request->id);
        $type->update(['name' => $request->name]);
        return  response()->json(['message' => 'Jenis Vaksin berhasil diperbaharui', 'status' => 'success'], 200);
    }

    public function delete_type(Request $request)
    {
        $type = TypeOfVaccination::find($request->id);
        $type->delete();
        return  response()->json(['message' => 'Jenis Vaksin berhasil dihapus', 'status' => 'success'], 200);
    }
    //

    public function get_hospital($id = FALSE)
    {
        if ($id == FALSE) {
            return DataTables::of(Hospital::get())
                ->editColumn('created_at', function ($type) {
                    return date('d-M-Y H:i', strtotime($type->created_at));
                })
                ->editColumn('created_by', function ($type) {
                    return $type->user->name;
                })
                ->editColumn('area_code', function ($type) {
                    $data['table'] = 'provincies';
                    $data['id'] = $type->area_code;
                    $data['foreign_key'] = 'id';

                    $res = get_area($data);
                    return $res->name;
                })
                ->editColumn('btn', function ($type) {
                    return '<div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#" data-id="' . $type->id . '" id="Edit">Edit</a>
                            <a class="dropdown-item" href="#" data-id="' . $type->id . '" id="Hapus">Hapus</a>
                            </div>
                        </div>';
                })
                ->RawColumns(['btn'])
                ->make(true);
        }

        $data = Hospital::find($id);
        return response()->json(['message' => 'query berhasil', 'status' => 'success', 'values' => $data], 200);
    }

    public function insert_hospital(Request $request)
    {
        $request->request->add(['created_by' => auth()->user()->id]);
        Hospital::create($request->all());
        return  response()->json(['message' => 'Rumah Sakit berhasil ditambahkan', 'status' => 'success'], 200);
    }

    public function update_hospital(Request $request)
    {
        $type = Hospital::find($request->id);
        $type->update($request->all());
        return  response()->json(['message' => 'Rumah Sakit berhasil diperbaharui', 'status' => 'success'], 200);
    }

    public function delete_hospital(Request $request)
    {
        $type = Hospital::find($request->id);
        $type->delete();
        return  response()->json(['message' => 'Rumah Sakit berhasil dihapus', 'status' => 'success'], 200);
    }


    public function insert_refferal(Request $request)
    {
        $ref = ReferralPatient::all()->count() + 1;
        $noreg = auth()->user()->id . $ref . date('dmYH') . rand(10, 100);
        if (empty($request->user_id)) {
            $request->request->add(['user_id' => auth()->user()->id, 'no_reg' => $noreg]);
        }
        $request->request->add(['no_reg' => $noreg]);
        ReferralPatient::create($request->all());
        return  response()->json(['message' => 'Rujukan berhasil dibuat', 'status' => 'success'], 200);
    }

    public function get_pattient($id = FALSE)
    {
        if ($id == FALSE) {
            return DataTables::of(User::get())
                ->editColumn('created_at', function ($user) {
                    return date('d-M-Y H:i', strtotime($user->created_at));
                })
                ->editColumn('address', function ($user) {
                    // $data['table'] = 'provincies';
                    // $data['id'] = $user->area_code;
                    // $data['foreign_key'] = 'id';

                    // $res = get_area($data);
                    return $user->profile != null ? $user->profile->address : 'Profile belum lengkap';
                })
                ->editColumn('status', function ($user) {
                    return $user->status == 1 ? '<a class="text-success">Active</a>' : '<a class="danger">Tidak Aktif</a>';
                })
                ->editColumn('btn', function ($user) {
                    return '<div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#" data-id="' . $user->id . '" id="Edit">Edit</a>
                            <a class="dropdown-item" href="#" data-id="' . $user->id . '" id="Hapus">Hapus</a>
                            </div>
                        </div>';
                })
                ->RawColumns(['btn', 'status'])
                ->make(true);
        }
        $res = UsersProfile::where('user_id', $id);
        $data = [
            'user' => User::find($id),
            'profile' => $res->count() < 1 ? 'Not Found' : $res->first(),
            'province' => $res->count() < 1 ? 'Not Found' : get_area(['provinsi' => true, 'id' => UsersProfile::where('user_id', $id)->first()->area_code]),
        ];
        return response()->json(['message' => 'query berhasil', 'status' => 'success', 'values' => $data], 200);
    }

    public function insert_pattient(Request $request)
    {
        $user = [
            'email' => $request->email,
            'password' => bcrypt('voline123'),
            'name' => $request->username,
            'role_id' => 2,
            'email_verified_at' => date('Y-m-d H:i:s')
        ];

        $res = User::create($user);

        $profile = [
            'user_id' => $res->id,
            'email' => $request->email,
            'name' => $request->name,
            'address' => $request->address,
            'area_code' => $request->area_code,
            'telepon' => $request->telepon,
            'identity' => $request->identity,
            'hospital_sheet' => $request->hospital_sheet,
        ];

        UsersProfile::create($profile);

        return response()->json(['message' => 'Pengguna baru berhasil ditambahkan', 'status' => 'success'], 200);
    }

    public function update_pattient(Request $request)
    {
        $user = [
            'email' => $request->email,
            'name' => $request->username,
        ];

        $res = User::find($request->id);
        $res->update($user);

        $profile = [
            'user_id' => $res->id,
            'email' => $request->email,
            'name' => $request->name,
            'address' => $request->address,
            'area_code' => $request->area_code,
            'telepon' => $request->telepon,
            'identity' => $request->identity,
            'hospital_sheet' => $request->hospital_sheet,
        ];

        if (UsersProfile::where('user_id', $request->id)->count() < 1) {
            UsersProfile::create($profile);
        } else {
            UsersProfile::where('user_id', $request->id)->update($request->except(['id', 'username']));
        }
        return response()->json(['message' => 'Pengguna berhasil diperbaharui', 'status' => 'success'], 200);
    }

    public function delete_pattient(Request $request)
    {
        $res = User::find($request->id);
        $res->delete();

        if (UsersProfile::where('user_id', $request->id)->count() > 0) {
            UsersProfile::where('user_id', $request->id)->delete();
        }
        return response()->json(['message' => 'Pengguna berhasil dihapus', 'status' => 'success'], 200);
    }

    public function get_refferal($id = FALSE)
    {
        if ($id == FALSE) {
            return DataTables::of(ReferralPatient::get())
                ->editColumn('created_at', function ($refferal) {
                    return date('d-M-Y H:i', strtotime($refferal->created_at));
                })
                ->editColumn('status', function ($refferal) {
                    return $refferal->status == 1 ? '<a class="text-success">Dikonfirmasi</a>' : '<a class="text-warning">Menunggu</a>';
                })
                ->editColumn('hospital', function ($refferal) {
                    return $refferal->hospital->name;
                })
                ->editColumn('vaccination', function ($refferal) {
                    return $refferal->vaccination->name;
                })
                ->editColumn('name', function ($refferal) {
                    return $refferal->profile->name;
                })
                ->editColumn('address', function ($refferal) {
                    return $refferal->profile->address;
                })
                ->editColumn('step', function ($refferal) {
                    return 'Tahap ' . $refferal->step;
                })
                ->editColumn('btn', function ($refferal) {
                    return '<div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#" data-id="' . $refferal->id . '" id="Konfirmasi">Konfirmasi</a>
                        <a class="dropdown-item" href="#" data-id="' . $refferal->id . '" id="Edit">Edit</a>
                        </div>
                    </div>';
                })
                ->RawColumns(['btn', 'status'])
                ->make(true);
        }
        // $res = refferalsProfile::where('refferal_id', $id);
        // $data = [
        //     'user' => User::find($id),
        //     'profile' => $res->count() < 1 ? 'Not Found' : $res->first(),
        //     'province' => $res->count() < 1 ? 'Not Found' : get_area(['provinsi' => true, 'id' => UsersProfile::where('user_id', $id)->first()->area_code]),
        // ];
        // return response()->json(['message' => 'query berhasil', 'status' => 'success', 'values' => $data], 200);
    }

    public function confirm_refferal()
    {
        $res = ReferralPatient::find($_GET['id']);
        $res->update(['status' => 1]);
        $mail = [
            'title' => 'Konfirmasi Rujukan!',
            'email' => $res->profile->email,
            'name' => $res->profile->name,
            'created_at' => date('d M Y, H:i'),
            'type' => 'confirm',
            'no_reg' => $res->no_reg,
        ];
        // Mail::to($res->profile->email)->send(new AuthMail($mail));
        return response()->json(['message' => 'Status rujukan dikonfirmasi', 'status' => 'success'], 200);
    }

    public function message_refferal(Request $request)
    {
        $res = getDataReferral($request);
        $this->_sendMessage($res);
        $this->_sendEmail($res);
        return response()->json(['message' => 'Status rujukan dikonfirmasi', 'status' => 'success'], 200);
    }

    public function dashboard_get_pattient()
    {
        $res = DB::select('select created_at, COUNT(id) as data from refferal_patient GROUP BY ' . $_GET['id'] . '(created_at)');

        $value = [];
        $parm = [];
        foreach ($res as $val) {
            array_push($value, $val->data);
            if ($_GET['id'] == 'DAY') {
                array_push($parm, date('d M', strtotime($val->created_at)));
            } elseif ($_GET['id'] == 'MONTH') {
                array_push($parm, date('M', strtotime($val->created_at)));
            }
        }

        $data = [
            'value' => $value,
            'parm' => $parm,
        ];
        return response()->json(['message' => 'query berhasil', 'status' => 'success', 'values' => $data], 200);
    }

    public function dashboard_get_status()
    {
        $res = ReferralPatient::selectRaw('status,COUNT(status) AS data')->groupBy('status')->get();

        $value = [];
        $parm = [];
        foreach ($res as $val) {
            array_push($value, $val->data);
            array_push($parm, $val->status == 1 ? 'Konfirmasi' : 'Menunggu');
        }

        $data = [
            'value' => $value,
            'parm' => $parm,
        ];
        return response()->json(['message' => 'query berhasil', 'status' => 'success', 'values' => $data], 200);
    }


    public function _sendMessage($res)
    {
        foreach ($res as $value) {
            $phone = substr($value->profile->telepon, 0, 1) == 0 ? substr($value->profile->telepon, 1) : $value->profile->telepon;
            $day =  getDay(date('D', strtotime($value->date)));
            $place = $value->hospital->name;
            $location = $value->hospital->address;
            $date =  date('d/m/y', strtotime($value->date));
            $data = [
                'phone' => '62' . $phone,
                'body' => 'Puskesmas Kecamatan Palmerah menginformasikan waktu pelaksanaan Vaksinasi Covid19 untuk Bapak/Ibu yang akan dilaksanakan pada :

Hari : ' . $day . ', $date
Pukul : 11.00 - 12.00
Lokasi : ' . $place . '
' . $location . '

 *Wajib pastikan :
 1. Ber-KTP Kecamatan Palmerah atau berdomisili di Kecamatan Palmerah, jika KTP luar Kecamatan Palmerah namun berdomisili di Kecamatan Palmerah wajib melampirkan surat keterangan domisili dari RT/RW tempat tinggalnya.
 2. Mohon datang tepat pada waktu yang telah kami tentukan. Gunakan masker dan membawa kartu identitas.
                ',

            ];

            $json = json_encode($data);
            $url = 'https://api.chat-api.com/instance247805/sendMessage?token=20wwza2wpfdilg2g';


            //https://chat-api.com
            $options = stream_context_create([
                'http' => [
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/json',
                    'content' => $json
                ]
            ]);

            // Send a request
            $result = file_get_contents($url, false, $options);
        }

        // return 0;
    }

    public function _sendEmail($res)
    {
        foreach ($res as $value) {
            $value->update(['status' => 1]);
            $mail = [
                'title' => 'Konfirmasi Rujukan!',
                'email' => $value->profile->email,
                'name' => $value->profile->name,
                'date' => $value->date,
                'place' => $value->hospital->name,
                'address' => $value->hospital->address,
                'day' => getDay(date('D', strtotime($value->date))),
                'date' => date('d/m/y', strtotime($value->date)),
                'created_at' => date('d M Y, H:i'),
                'type' => 'confirm',
                'no_reg' => $value->no_reg,
            ];
            Mail::to($value->profile->email)->send(new AuthMail($mail));
        }

        // return 0;
    }
}
