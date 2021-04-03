@extends('templates.dashboard')

@section('main')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Barcode</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Master</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Barcode</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        {{-- <a href="#" class="btn btn-sm btn-neutral" id="buttonNew"><i class="fas fa-plus"></i> New</a> --}}
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
                        <h3 class="mb-0">Data Barcode</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive mb-3">
                        <table class="table align-items-center table-flush table-sm" id="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">No</th>
                                    <th scope="col" class="sort" data-sort="budget">Halaman</th>
                                    <th scope="col" class="sort" data-sort="status">URL</th>
                                    <th scope="col" class="sort text-center" data-sort="status">Barcode</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <tr>
                                    <td>1</td>
                                    <td>Form Register</td>
                                    <td><a href="#">http://{{ $_SERVER['HTTP_HOST'] }}/auth/register</a></td>
                                    <td class="text-center">
                                        {{ QrCode::size(25)->generate('https://' . $_SERVER['HTTP_HOST'] . '/auth/register') }}
                                    </td>
                                    <td><a href="/master/barcode/print/dataqr?url={{ urlencode('https://' . $_SERVER['HTTP_HOST'] . '/auth/login') }}"
                                            target="_blank" class="badge badge-primary"><i class="fas fa-print"></i>
                                            Cetak</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Form Login</td>
                                    <td><a href="#">http://{{ $_SERVER['HTTP_HOST'] }}/auth/login</a></td>
                                    <td class="text-center">
                                        {{ QrCode::size(25)->generate('https://' . $_SERVER['HTTP_HOST'] . '/auth/login') }}
                                    </td>
                                    <td><a href="/master/barcode/print/dataqr?url={{ urlencode('https://' . $_SERVER['HTTP_HOST'] . '/auth/login') }}"
                                            target="_blank" class="badge badge-primary"><i class="fas fa-print"></i>
                                            Cetak</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    @endsection
