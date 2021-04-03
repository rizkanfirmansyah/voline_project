@include('includes.header')


<body class="bg-default">

    <div class="main-content">


      @yield('main')

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
