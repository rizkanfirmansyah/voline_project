@extends('templates.dashboard')

@section('main')

<div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(https://placeimg.com/640/500/tech); background-size: cover; background-position: center top;">
    <!-- Mask -->
    <span class="mask bg-gradient-default opacity-8"></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
      <div class="row">
        <div class="col-lg-7 col-md-10">
          <h1 class="display-2 text-white">Hello {{auth()->user()->name}}</h1>
          <p class="text-white mt-0 mb-5">Ini adalah dashboard profile mu, ketik <i> Buat Biodata</i> untuk membuat pengajuan Voline (Vaksin Online)</p>
          @if ($profile->count() <1)
          <a href="/user/register" class="btn btn-neutral">Buat Biodata</a>
          @endif
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid mt--7">
    <div class="row">

        @if ($profile->count() > 0)
            @include('assets.user.profile')
        @endif

    </div>

@endsection
