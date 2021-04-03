@extends('templates.auth')

@section('main')

    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
          <div class="card bg-secondary border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <h1>Daftar</h1>
                <div id="Alert"></div>
              </div>
              <form role="form" id="register">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="input-group input-group-merge input-group-alternative mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                          </div>
                          <input class="form-control" placeholder="Username" type="text" autocomplete required name="username">
                        </div>
                      </div>
                      <div class="form-group col-md-6">
                        <div class="input-group input-group-merge input-group-alternative mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                          </div>
                          <input class="form-control" placeholder="Email" type="email" autocomplete required name="email">
                        </div>
                      </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="input-group input-group-merge input-group-alternative">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                          </div>
                          <input class="form-control" placeholder="Password" type="password" name="password" autocomplete required id="password">
                        </div>
                      </div>
                      <div class="form-group col-md-6">
                        <div class="input-group input-group-merge input-group-alternative">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                          </div>
                          <input class="form-control" placeholder="Konfirmasi Password" type="password" autocomplete required id="password2">
                        </div>
                      </div>
                </div>
                <h6 class="heading-small text-muted mb-4">Informasi Pribadi</h6>
                  <div class="pl-lg-4">
                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">Nama Lengkap</label>
                          <input type="text" name="name" class="form-control" required placeholder="Nama Lengkap" >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-first-name">Nomor Identitas/Kependudukan</label>
                          <input type="text" name="identity" class="form-control" required placeholder="Nomor Kependudukan">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-last-name">Telepon</label>
                          <input type="text" name="telepon" class="form-control" required placeholder="Nomor Telepon">
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr class="my-4">
                  <!-- Address -->
                  <h6 class="heading-small text-muted mb-4">Informasi Detail</h6>
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="form-control-label" >Alamat Rumah</label>
                          <input class="form-control" required placeholder="Jl. Neptunus Raya, Bandung" name="address" required type="text">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label text-capitalize" for="input-country">Provinsi</label>
                          <select name="provinsi" class="text-capitalize form-control">
                              <option value disabled selected>==Pilih Provinsi==</option>
                            @foreach ($provinsi as $data)
                                <option value="{{$data->id}}">{{$data->name}}</option>
                            @endforeach
                        </select>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label text-capitalize" for="input-country">kota</label>
                          <select name="kota" class="text-capitalize form-control">

                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label text-capitalize" for="input-country">kecamatan</label>
                          <select name="kecamatan" class="text-capitalize form-control">

                          </select>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label text-capitalize" for="input-country">kelurahan/desa</label>
                          <select name="area_code" class="text-capitalize form-control" required>

                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                <div class="row my-4">
                  <div class="col-12">
                    <div class="custom-control custom-control-alternative custom-checkbox">
                      <input class="custom-control-input" id="customCheckRegister" type="checkbox">
                      <label class="custom-control-label" for="customCheckRegister">
                        <span class="text-muted">I agree with the <a href="#!">Privacy Policy</a></span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary mt-4">Daftar</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
              <div class="col-6">
                <a href="#" class="text-light"><small>Forgot password?</small></a>
              </div>
              <div class="col-6 text-right">
                <a href="/auth/login" class="text-light"><small>Sudah punya akun? Login</small></a>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

@endsection
