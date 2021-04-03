@extends('templates.dashboard')

@section('main')

<div class="header bg-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">Jenis Vaksin</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Master</a></li>
                <li class="breadcrumb-item active" aria-current="page">Jenis Vaksin</li>
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
            <h3 class="mb-0">Light table</h3>
          </div>
          <!-- Light table -->
          <div class="table-responsive mb-3">
            <table class="table align-items-center table-flush" id="table">
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="sort" data-sort="name">No</th>
                  <th scope="col" class="sort" data-sort="budget">Jenis Vaksin</th>
                  <th scope="col" class="sort" data-sort="status">Dibuat oleh</th>
                  <th scope="col">Tanggal Dibuat</th>
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
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalFormLabel">.....</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
              <div class="form-group">
                  <input type="text" name="name" id="name" class="form-control" required>
                  <input type="hidden" name="id" class="form-control" >
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
