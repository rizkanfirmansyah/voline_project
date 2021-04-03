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
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Rujukan</li>
              </ol>
            </nav>
          </div>
          <div class="col-lg-6 col-5 text-right">
            <a href="#" class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#modalForm"><i class="fas fa-plus"></i> New</a>
            <a href="#" class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#modalPesan"><i class="fas fa-envelope-open"></i> Pesan</a>
            {{-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> --}}
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col">
        <div class="card">
          <!-- Card header -->
          <div class="card-header border-0">
            <h3 class="mb-0">Data Rujukan</h3>

          </div>
          <!-- Light table -->
          <div class="table-responsive mb-3">
            <table class="table align-items-center table-flush" id="table">
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="sort" data-sort="name">No Reg</th>
                  <th scope="col" class="sort" data-sort="budget">Nama Lengkap</th>
                  <th scope="col" class="sort" data-sort="alamat">Alamat</th>
                  <th scope="col" class="sort" data-sort="konfirmasi">Rumah Sakit</th>
                  <th scope="col" class="sort" data-sort="konfirmasi">Vaksinasi</th>
                  <th scope="col" class="sort" data-sort="status">Status</th>
                  <th scope="col" class="sort" data-sort="status">Tahapan</th>
                  <th scope="col">..</th>
                </tr>
              </thead>
              <tbody class="list">

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="modalForm" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalFormLabel">Tambah Pasien</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="insert">
            <div class="form-group">
                <label for="">Pasien</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value selected disabled>==Pilih Pasien ==</option>
                    @foreach ($users as $value)
                      <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
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

    <!-- Modal -->
<div class="modal fade" id="modalPesan" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalPesanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalPesanLabel">Kirim Pesan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="message">
            <div class="form-group">
                <label for="">Pasien</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="all" selected>Semua</option>
                    @foreach ($user as $value)
                    <option value="{{$value->profile->user_id}}">{{$value->profile->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Rumah Sakit</label>
                <select name="hospital_id" id="hospital_id" class="form-control" required>
                    <option value="all" selected>Semua</option>
                    @foreach ($hospital as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Jenis Vaksin</label>
                <select name="type_id" id="type_id" class="form-control" required>
                    <option value="all" selected>Semua</option>
                    @foreach ($type as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Tanggal</label>
                <input type="date" name="date" id="date" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Jadwal Vaksinasi</label>
                <select name="step" id="step" class="form-control">
                    <option value="all" selected>Semua</option>
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
