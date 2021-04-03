<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Barcode</title>
    @include('includes.css')
</head>
<body class="bg-white">

    <div class="container">
        <img src="/assets/img/brand/blue.png" alt="" class="img-fluid mt-5" style="max-width: 300px">
        <div class="row text-center">
            <div class="col text-center">
                <h1 class="text-center mt-5">PRINT BARCODE</h1>
                <h2 class="mb-5">Scan barcode dibawah ini untuk masuk dan daftar aplikasi Vaksin Online</h2>
                {{QrCode::size(300)->generate(urldecode($_GET['url']))}}
            </div>
        </div>
    </div>

</body>
    @include('includes.js')
    <script>
         $(document).ready(function() {
    window.print();
    window.onafterprint = function(){
      window.close()
    }
  })
    </script>
    </html>
