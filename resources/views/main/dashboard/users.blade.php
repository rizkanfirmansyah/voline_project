@extends('templates.dashboard')

@section('main')

<div class="header bg-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">Pendaftar</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pendaftar</li>
              </ol>
            </nav>
          </div>
          <div class="col-lg-6 col-5 text-right">
            <a href="#" class="btn btn-sm btn-neutral" id="buttonNew"><i class="fas fa-plus"></i> New</a>
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
            <h3 class="mb-0">Data Pendaftar</h3>
          </div>
          <!-- Light table -->
          <div class="table-responsive mb-3">
            <table class="table align-items-center table-flush table-sm" id="table">
              <thead class="thead-light">
                <tr>
                    <th scope="col" class="sort" data-sort="name">No</th>
                    <th scope="col" class="sort" data-sort="budget">Nama Lengkap</th>
                    <th scope="col" class="sort" data-sort="email">Email</th>
                    <th scope="col" class="sort" data-sort="alamat">Alamat</th>
                    <th scope="col" class="sort" data-sort="status">Status</th>
                    <th scope="col">Bergabung</th>
                    <th scope="col"></th>
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
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content modal-lg">
        <div class="modal-header">
          <h5 class="modal-title" id="modalFormLabel">.....</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
              <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Username</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="">Email</label>
                  <input type="email" name="email" id="email" class="form-control" required>
              </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="">NIK</label>
                    <input type="text" name="identity" id="identity" class="form-control" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Telepon</label>
                    <input type="text" name="telepon" id="telepon" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Alamat</label>
                    <input type="text" name="address" id="address" class="form-control">
                </div>
              </div>
              <div class="form-group">
                  <label for="">Riwayat Penyakit</label>
                  <input type="text" name="hospital_sheet" id="hospital_sheet" class="form-control">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Provinsi</label>
                    <select name="provinsi" class="form-control">
                        <option value="000" selected disabled>==Pilih Provinsi ==</option>
                        @foreach ($provinsi as $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="">Kota</label>
                  <select name="kota" class="form-control">
                      <option value selected disabled>==Pilih Kota ==</option>
                  </select>
              </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Kecamatan</label>
                    <select name="kecamatan" class="form-control">
                        <option value selected disabled>==Pilih Kecamatan ==</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Kelurahan</label>
                    <select name="area_code" id="area_code" class="form-control">
                        <option value selected disabled>==Pilih Kelurahan ==</option>
                    </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  class="close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>




@endsection
