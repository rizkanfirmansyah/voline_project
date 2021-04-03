<div class="col-md-8 offset-md-2 col-10">
    <div class="card card-profile">
      {{-- <img src="../assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top"> --}}
      <div class="row justify-content-center">
        <div class="col-lg-3 order-lg-2">
          <div class="card-profile-image">
            {{-- <a href="#">
              <img src="../assets/img/theme/team-4.jpg" class="rounded-circle">
            </a> --}}
          </div>
        </div>
      </div>
      <div class="card-body pt-0">
        <div class="text-center mt-4">
            <h2 >
              {{$profile[0]->name}}

            </h2>
            <div class="h5 font-weight-300 text-capitalize">
                {{$profile[0]->address}}, {{full_address($profile[0]->area_code)}}
            </div>
        <div class="row">
          <div class="col">
            <div class="card-profile-stats d-flex justify-content-center">
              <div>
                <span class="heading"><i class="fas fa-envelope"></i></span>
                <span class="description">{{$profile[0]->email}}</span>
              </div>
              <div>
                <span class="heading"><i class="fas fa-phone"></i></span>
                <span class="description">{{$profile[0]->telepon}}</span>
              </div>
              <div>
                <span class="heading"><i class="fas fa-user-edit"></i></span>
                <span class="description">{{$profile[0]->identity}}</span>
              </div>
            </div>
          </div>
        </div>
          <div class="h5 mt-4">
            Terdaftar pada tanggal - {{date('d-M-Y H:i', strtotime($profile[0]->created_at) )}}
          </div>
          <div>
            {{-- <i class="ni education_hat mr-2"></i>University of Computer Science --}}
          </div>
        </div>
      </div>
    </div>
  </div>
