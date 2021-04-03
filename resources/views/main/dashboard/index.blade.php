@extends('templates.dashboard')


@section('main')

    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
              <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Admin</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">Dashboards </a></li>
                    <li class="breadcrumb-item active" aria-current="page">Admin</li>
                  </ol>
                </nav>
              </div>
              <div class="col-lg-6 col-5 text-right">
                {{-- <a href="#" class="btn btn-sm btn-neutral">New</a>
                <a href="#" class="btn btn-sm btn-neutral">Filters</a> --}}
              </div>
            </div>
            <!-- Card stats -->
            <div class="row">
              <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total Pendaftar</h5>
                        <span class="h2 font-weight-bold mb-0">{{$data['pendaftar']}}</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                          <i class="ni ni-active-40"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Rumah Sakit</h5>
                        <span class="h2 font-weight-bold mb-0">{{$data['rumah_sakit']}}</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                          <i class="fas fa-hospital"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total Vaksin</h5>
                        <span class="h2 font-weight-bold mb-0">{{$data['vaksin']}}</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                          <i class="fas fa-syringe"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total Rujukan</h5>
                        <span class="h2 font-weight-bold mb-0">{{$data['rujukan']}}</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                          <i class="ni ni-ambulance"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Page content -->
      <div class="container-fluid mt--6">
        <div class="row">
          <div class="col-xl-8">
            <div class="card bg-default">
              <div class="card-header bg-transparent">
                <div class="row align-items-center">
                  <div class="col">
                    <h6 class="text-light text-uppercase ls-1 mb-1">Data Live</h6>
                    <h5 class="h3 text-white mb-0">Pendaftar Vaksinasi</h5>
                  </div>
                  <div class="col">
                    <ul class="nav nav-pills justify-content-end">
                      <li class="nav-item mr-2 mr-md-0">
                        <a href="#" class="nav-link py-2 px-3 active" onclick="vaksinasi('DAY')" data-toggle="tab">
                          <span class="d-none d-md-block">Day</span>
                          <span class="d-md-none">D</span>
                        </a>
                      </li>
                      <li class="nav-item" >
                        <a href="#" class="nav-link py-2 px-3" onclick="vaksinasi('MONTH')"  data-toggle="tab">
                          <span class="d-none d-md-block">Month</span>
                          <span class="d-md-none">M</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <!-- Chart -->
                <div class="chart">
                  <!-- Chart wrapper -->
                  <canvas id="chart-sales-dark" class="chart-canvas"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4">
            <div class="card">
              <div class="card-header bg-transparent">
                <div class="row align-items-center">
                  <div class="col">
                    <h6 class="text-uppercase text-muted ls-1 mb-1">Data Live</h6>
                    <h5 class="h3 mb-0">Status Pendaftar</h5>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <!-- Chart -->
                <div class="chart">
                  <canvas id="chart-bars" class="chart-canvas"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-7">
            <div class="card">
              <div class="card-header border-0">
                <div class="row align-items-center">
                  <div class="col">
                    <h3 class="mb-0">Data Rumah Sakit</h3>
                  </div>
                  <div class="col text-right">
                    <a href="/master/hospital" class="btn btn-sm btn-primary">See all</a>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Rumah Sakit</th>
                      <th scope="col" class="text-center">Pasien</th>
                      <th scope="col">Presentase</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($data['refHospital'] as $value)
                        <tr>
                          <th scope="row">
                              {{$value->hospital->name}}
                            </th>
                            <td class="text-center">
                                {{$value->data}}
                            </td>
                            <td>
                                <span class="mr-2">{{number_format(($value->data * 100 )/$data['rujukan'], 2)}}%</span>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-xl-5">
            <div class="card">
              <div class="card-header border-0">
                <div class="row align-items-center">
                  <div class="col">
                    <h3 class="mb-0">Tipe Vaksin</h3>
                  </div>
                  <div class="col text-right">
                    <a href="/master/type_of_vaccination" class="btn btn-sm btn-primary">See all</a>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Nama Vaksin</th>
                      <th scope="col">Pasien</th>
                      <th scope="col">Presentase</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($data['refType'] as $value)
                        <tr>
                            <th scope="row">
                                {{$value->vaccination->name}}
                        </th>
                        <td class="text-center">
                            {{$value->data}}
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="mr-2">{{number_format(($value->data * 100 )/$data['rujukan'], 2)}}%</span>
                            <div>
                        </td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>




@endsection
