<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>DNC -Shoes</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{url("/asset/vendors/iconfonts/mdi/css/materialdesignicons.min.css")}}">
  <link rel="stylesheet" href="{{url("/asset/vendors/iconfonts/puse-icons-feather/feather.css")}}">
  <link rel="stylesheet" href="{{url("/asset/vendors/css/vendor.bundle.base.css")}}">
  <link rel="stylesheet" href="{{url("/asset/vendors/css/vendor.bundle.addons.css")}}">


  <!-- datapicker CSS
        ============================================ -->
  
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{url("/asset/css/style.css")}}">
  <link rel="stylesheet" href="{{url("/asset/css/select2.min.css")}}">
  <link rel="stylesheet" href="{{url("/asset/css/datapicker/datepicker3.css")}}">

  <!-- endinject -->
  <link rel="shortcut icon" type="image/x-icon" href="{{url("/asset/img/logo/logo.png")}}">
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth theme-one">
        <div class="row w-100">
        @yield("form")
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{url("/asset/vendors/js/vendor.bundle.base.js")}}"></script>
  <script src="{{url("/asset/vendors/js/vendor.bundle.addons.js")}}"></script>

  <script src="{{url("/asset/js/datapicker/bootstrap-datepicker.js")}}"></script>
  <script src="{{url("/asset/js/datapicker/datepicker-active.js")}}"></script>
  <script src="{{url("/asset/js/off-canvas.js")}}"></script>
  <script src="{{url("/asset/js/misc.js")}}"></script>
  
  <!-- endinject -->
  <!-- datapicker JS
        ============================================ -->

  <!-- <script src="/asset/js/select2.min.js"></script> -->

  <!-- endinject -->
  <!-- <script type="text/javascript">
        $("#nama_produk").on("change", function(e){
            var nama_produk = e.target.value;
            $.get("{{url("tambahPembelianInstagram")}}/add/ajax-state?nama_produk=" +nama_produk, function(data){
                // $("#harga_jual").html(data[0].harga_jual);
                // alert(data[0].harga_jual);
                document.getElementById("harga_jual").value=data[0].harga_jual;
            });
        });
    </script>

    <script type="text/javascript">
        $("#nama_produk").on("change", function(e){
            var nama_produk = e.target.value;
            $.get("{{url("tambahPembelianToko")}}/add/ajax-state?nama_produk=" +nama_produk, function(data){
                // $("#harga_jual").html(data[0].harga_jual);
                // alert(data[0].harga_jual);
                document.getElementById("harga_jual").value=data[0].harga_jual;
            });
        });
    </script>

    <script type="text/javascript">
        $("#nama_produk").on("change", function(e){
            var nama_produk = e.target.value;
            $.get("{{url("tambahPembelianWeb")}}/add/ajax-state?nama_produk=" +nama_produk, function(data){
                // $("#harga_jual").html(data[0].harga_jual);
                // alert(data[0].harga_jual);
                document.getElementById("harga_jual").value=data[0].harga_jual;
            });
        });
    </script>
    
    <script type="text/javascript">
        $("#nama_produk").on("change", function(e){
            var nama_produk = e.target.value;
            $.get("{{url("tambahPembelianMarketplace")}}/add/ajax-state?nama_produk=" +nama_produk, function(data){
                // $("#harga_jual").html(data[0].harga_jual);
                // alert(data[0].harga_jual);
                document.getElementById("harga_jual").value=data[0].harga_jual;
            });
        });
    </script>

    <script type="text/javascript">
      window.onload = function(){
        document.getElementById("jumlah").addEventListener("keyup",jumlah,false);
        document.getElementById("diskon").addEventListener("keyup",diskon,false);
      }
     function jumlah() {
        var harga = document.getElementById("harga_jual").value;
        var jumlah = parseInt(document.getElementById("jumlah").value);
        var total = harga * jumlah;
        document.getElementById("total").value=total;
      }
      function diskon() {
        var harga = document.getElementById("harga_jual").value;
        var jumlah = parseInt(document.getElementById("jumlah").value);
        var disk = parseInt(document.getElementById("diskon").value);
        var diskon = (harga * disk) /100;
        var total = (harga-diskon) * jumlah;
        document.getElementById("total").value=total;
      }
  </script> -->


</body>

</html>