@include('includes.header')


<body class="bg-default">

    <div class="main-content">
      <!-- Header -->
      <div class="header bg-gradient-primary py-7">
        <div class="container">
          <div class="header-body text-center mb-5">
            <div class="row justify-content-center">
              <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                <h1 class="text-white">Welcome!</h1>
                <p class="text-lead text-white">Use these awesome forms to login or create new account in your project for free.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
          <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
          </svg>
        </div>
      </div>

      @yield('main')

  <!-- Footer -->
  <footer class="py-3">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; 2020 Voline
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
  <!-- Argon JS -->
  <script src="/assets/js/argon.js?v=1.2.0"></script>

<script src="/vendor/js/variable/script.js"></script>
<script src="/vendor/js/function/script.js"></script>
  <script src="/vendor/js/{{request()->segment(1)}}/{{request()->segment(2)}}.js"></script>
</body>

</html>
