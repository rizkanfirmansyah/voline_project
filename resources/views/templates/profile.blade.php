@include('includes.header')

<body class="bg-default">
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="/dashboard/index">
        VOLINE
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="/dashboard/index">
                VOLINE
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a href="/dashboard/index" class="nav-link">
              <span class="nav-link-inner--text">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="/user/profile" class="nav-link">
              <span class="nav-link-inner--text">Profile</span>
            </a>
          </li>
        </ul>
        <hr class="d-lg-none" />
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">

    <!-- Page content -->
    <div class="container mt-8 pb-5">
      <div class="row justify-content-center">
        <div class="col-xl-8 order-xl-1">
            <div class="card">
              <div class="card-header">
                <div class="row align-items-center">
                  <div class="col-8">
                    <h3 class="mb-0">Isi biodata dengan benar</h3>
                  </div>
                </div>
              </div>
              <div class="card-body">
                  @if ($profile > 0)
                    <h1 class="text-center">Anda Telah Terdaftar</h1>
                  @else

                <form id="register">
                  <h6 class="heading-small text-muted mb-4">Informasi Pribadi</h6>
                  <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">Email address</label>
                                <input type="email" class="form-control" required name="email" disabled value="{{auth()->user()->email}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
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
                            @foreach ($data as $provinsi)
                                <option value="{{$provinsi->id}}">{{$provinsi->name}}</option>
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
                  <hr class="my-4">
                  <!-- Description -->
                  <h6 class="heading-small text-muted mb-4">Informasi Tambahan</h6>
                  <div class="pl-lg-4">
                    <div class="form-group">
                      <label class="form-control-label">Riwayat Penyakit</label>
                      <textarea rows="4" class="form-control" name="hospital_sheet" placeholder="Magh, Asam Lambung, Jantung dan lain lain"></textarea>
                    </div>
                  </div>
                  <div class="text-right">
                      <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>

                @endif

              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  <!-- Footer -->
  <footer class="" id="footer-main">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; 2020 VOLINE
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <script src="/assets/vendor/sweetalert/dist/sweetalert.min.js"></script>
  <!-- Argon JS -->
  <script src="/assets/js/argon.js?v=1.2.0"></script>
  <script src="/vendor/js/register/script.js"></script>
  <script src="/vendor/js/variable/script.js"></script>
</body>

</html>
