@extends('templates.error')

@section('main')


    <!-- Page content -->
    <div class="container mt-9 pb-5">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary border-0 mb-0">
              <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                    <h1>ERROR!!! INVALID TOKEN</h1>
                </div>
                <div class="text-center">
                    <a href="/auth/login">Kembali</a>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>


@endsection
