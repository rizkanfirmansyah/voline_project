@extends('templates.dashboard')

@section('main')

<div class="header bg-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">Rujukan</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Rujukan</li>
              </ol>
            </nav>
          </div>
          <div class="col-lg-6 col-5 text-right" id="buttonFormModal">
            @if ($patient->count() < 1)
                 {{-- <a href="#" class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#modalForm"><i class="ni ni-badge"></i> Daftar Rujukan</a> --}}
              @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid mt--7">
    <div class="row" id="cardHtml">
        <div class="card">
            <div class="card card-profile">
                <div class="card-body">
                    Info belum tersedia, tunggu info selanjutnya di Whatsapp atau Email anda
                    <br>
                    <div class="text-center">
                        <i class="fa-3x text-center mt-3 text-dark fa fa-info"></i>
                    </div>
                </div>
            </div>
        </div>
    @if ($patient->count() > 0)
        <div class="card col-12 col-md-8 col-sm-10 col-lg-6">
            <div class="card card-profile">

                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col">
                      <div class="card-profile-stats d-flex justify-content-center">
                        <div>
                          <span class="heading"><i class="fas fa-hospital"></i></span>
                          <span class="description">{{$patient[0]->hospital->name}}</span>
                        </div>
                        <div>
                          <span class="heading"><i class="fas fa-user-edit"></i></span>
                          <span class="description">Menunggu</span>
                        </div>
                        <div>
                          <span class="heading"><i class="fas fa-syringe"></i></span>
                          <span class="description">{{$patient[0]->vaccination->name}}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                    <h5 class="h3">
                      {{$patient[0]->profile->name}}
                    </h5>
                    <div class="h5 font-weight-300 text-capitalize">
                      <i class="ni location_pin mr-2"></i>{{$patient[0]->profile->address}}
                    </div>
                    <div class="h5 mt-4">
                      <i class="fa fa-user  mr-2"></i>No.Reg - {{$patient[0]->no_reg}}
                    </div>
                    <div class="h5">
                      <i class="fa fa-calendar  mr-2"></i>Tanggal - {{date('d M Y', strtotime($patient[0]->date))}}
                    </div>
                    <div class="h5 text-capitalize">
                      tahap {{$patient[0]->step}}
                    </div>
                    {{QrCode::size(150)->generate($patient[0]->no_reg)}}
                  </div>
                </div>
              </div>
        </div>
        @endif
    </div>


        <!-- Modal -->
<div class="modal fade" id="modalForm" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalFormLabel">Daftar Rujukan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="insert">
              <div class="form-group">
                  <label for="">Nama Pasien</label>
                  <input type="text" disabled value="{{$profile->name}}" name="name" id="name" class="form-control" required>
                  {{-- <input type="hidden" name="id" class="form-control" > --}}
              </div>
              <div class="form-group">
                  <label for="">Rumah Sakit</label>
                  <select name="hospital_id" id="hospital_id" class="form-control" required>
                      <option value selected disabled>==Pilih Rumah Sakit ==</option>
                      @foreach ($hospital as $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                      @endforeach
                  </select>
              </div>
              <div class="form-group">
                  <label for="">Jenis Vaksin</label>
                  <select name="type_id" id="type_id" class="form-control" required>
                      <option value selected disabled>==Pilih Jenis Vaksin ==</option>
                      @foreach ($type as $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                      @endforeach
                  </select>
              </div>
              <div class="form-group">
                  <label for="">Tanggal</label>
                  <input type="date" name="date" id="date" class="form-control" required>
              </div>
              <div class="form-group">
                  <label for="">Jadwal Vaksinasi</label>
                  <select name="step" id="step" class="form-control" required>
                    <option value selected disabled>==Pilih Tahap Vaksin ==</option>
                    <option value="1">Tahap 1</option>
                    <option value="2">Tahap 2</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>

@endsection
