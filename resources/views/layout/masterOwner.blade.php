<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DNC -Shoes</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{url("/asset/vendors/iconfonts/mdi/css/materialdesignicons.min.css")}}">
    <link rel="stylesheet" href="{{url("/asset/vendors/iconfonts/puse-icons-feather/feather.css")}}">
    <link rel="stylesheet" href="{{url("/asset/vendors/css/vendor.bundle.base.css")}}">
    <link rel="stylesheet" href="{{url("/asset/vendors/css/vendor.bundle.addons.css")}}">
    <link rel="stylesheet" href="{{url("/asset/css/style.css")}}">
    <link rel="stylesheet" href="{{url("/asset/css/select2.min.css")}}">
    <link rel="stylesheet" href="{{url("/asset/css/datapicker/datepicker3.css")}}">

    <!-- favicon
        ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="{{url("/asset/img/logo/logo.png")}}">
    <!-- Google Fonts
        ============================================ -->
    <link href="{{url("https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800")}}" rel="stylesheet">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="{{url("/asset/css/bootstrap.min.css")}}">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="{{url("/asset/css/font-awesome.min.css")}}">
    <!-- adminpro icon CSS
        ============================================ -->
    <link rel="stylesheet" href="{{url("/asset/css/adminpro-custon-icon.css")}}">
    <!-- meanmenu icon CSS
        ============================================ -->
    <link rel="stylesheet" href="{{url("/asset/css/meanmenu.min.css")}}">
    <!-- mCustomScrollbar CSS
        ============================================ -->
    <link rel="stylesheet" href="{{url("/asset/css/jquery.mCustomScrollbar.min.css")}}">
    <!-- animate CSS
        ============================================ -->
    <link rel="stylesheet" href="{{url("/asset/css/animate.css")}}">
    <!-- jvectormap CSS
        ============================================ -->
    <link rel="stylesheet" href="{{url("/asset/css/jvectormap/jquery-jvectormap-2.0.3.css")}}">
    <!-- normalize CSS
        ============================================ -->
    <link rel="stylesheet" href="{{url("/asset/css/data-table/bootstrap-table.css")}}">
    <link rel="stylesheet" href="{{url("/asset/css/data-table/bootstrap-editable.css")}}">
    <!-- normalize CSS
        ============================================ -->
    <link rel="stylesheet" href="{{url("/asset/css/normalize.css")}}">
    <!-- charts CSS
        ============================================ -->
    <link rel="stylesheet" href="{{url("/asset/css/c3.min.css")}}">
    <!-- datapicker CSS
        ============================================ -->
    <link rel="stylesheet" href="{{url("/asset/css/datapicker/datepicker3.css")}}">
    <!-- style CSS
        ============================================ -->
    <link rel="stylesheet" href="{{url("/asset/style.css")}}">
    <!-- responsive CSS
        ============================================ -->
    <link rel="stylesheet" href="{{url("/asset/css/responsive.css")}}">
    <!-- modernizr JS
        ============================================ -->
    <script src="{{url("/asset/js/vendor/modernizr-2.8.3.min.js")}}"></script>
</head>


<body class="materialdesign">
    <div class="wrapper-pro">
        <div class="left-sidebar-pro">
            <nav id="sidebar">
                <div class="sidebar-header">
                    <img src="{{url("/imgs/poto.png")}}" width="10px" height="10px">
                    <h3>{{Session::get("nama")}}</h3>
                    <p>{{Session::get("bagian")}}</p>
                    <strong>DNC</strong>
                </div>
                <div class="left-custom-menu-adp-wrap">
                    <ul class="nav navbar-nav left-sidebar-menu-pro">
                        <li class="nav-item"><a href="{{url("dashboardOwner")}}"><i class="fa big-icon fa-table"></i> <span class="mini-dn">Dashboard</span></a>
                        </li>
                        
                        <li class="nav-item"><a href="{{url("dataKategori")}}"><i class="fa big-icon fa-table"></i> <span class="mini-dn">Kategori Produk</span></a>
                        </li>
                        
                        <li class="nav-item"><a href="{{url("dataProduk")}}"><i class="fa big-icon fa-table"></i> <span class="mini-dn">Produk</span></a>
                        </li>

                        <li class="nav-item"><a href="{{url("stokProduk")}}"><i class="fa big-icon fa-table"></i> <span class="mini-dn">Stok Produk</span></a>
                        </li>

                        <li class="nav-item"><a href="{{url("dataProduksi")}}"><i class="fa big-icon fa-table"></i> <span class="mini-dn">Produksi</span></a>
                        </li>
                        <li class="nav-item"><a href="{{url("dataDelivery")}}"><i class="fa big-icon fa-table"></i> <span class="mini-dn">Delivery Produk</span></a>
                        </li>
                        <li class="nav-item"><a href="{{url("dataReturn")}}"><i class="fa big-icon fa-table"></i> <span class="mini-dn">Return Produk</span></a>
                        </li>
                        <li class="nav-item"><a href="{{url("#")}}" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-files-o"></i> <span class="mini-dn">Penjualan</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-right"></i></span></a>
                            <div role="menu" class="dropdown-menu left-menu-dropdown chart-left-menu-std animated flipInX" style="background-color: white;">
                                <a href="{{url("dataPenjualanTokoOwner")}}" class="dropdown-item">Penjualan Toko</a>
                                <a href="{{url("dataPenjualanWebOwner")}}" class="dropdown-item">Penjualan Web</a>
                                <a href="{{url("dataPenjualanMarketplaceOwner")}}" class="dropdown-item">Penjualan Marketplace</a>
                                <a href="{{url("dataPenjualanInstagramOwner")}}" class="dropdown-item">Penjualan Instagram</a>
                                <a href="{{url("dataPenjualanEventOwner")}}" class="dropdown-item">Penjualan Event</a>
                            </div>
                        </li>
                        <li class="nav-item"><a href="{{url("dataAkunPengeluaran")}}"><i class="fa big-icon fa-table"></i> <span class="mini-dn">Data Akun</span></a>
                        </li>

                        <li class="nav-item"><a href="{{url("#")}}" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-files-o"></i> <span class="mini-dn">Pengeluaran</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-right"></i></span></a>
                            <div role="menu" class="dropdown-menu left-menu-dropdown chart-left-menu-std animated flipInX" style="background-color: white;">
                                <a href="{{url("dataPengeluaran")}}" class="dropdown-item">Pengeluaran Produksi</a>
                                <a href="{{url("dataPengeluaranLainnya")}}" class="dropdown-item">Pengeluaran Lain</a>
                            </div>
                        </li>

                        <li class="nav-item"><a href="{{url("#")}}" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-files-o"></i> <span class="mini-dn">Laporan Perusahaan</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-right"></i></span></a>
                            <div role="menu" class="dropdown-menu left-menu-dropdown form-left-menu-std animated flipInX" style="background-color: white;">    
                                <a href="{{url("laporanAsset")}}" class="dropdown-item">Laporan Asset</a>                       
                                <a href="{{url("laporanPenjualan")}}" class="dropdown-item">Laporan Penjualan</a>
                                <a href="{{url("laporanPengeluaran")}}" class="dropdown-item">Laporan Pengeluaran</a>
                                <a href="{{url("laporanPengeluaranLainnya")}}" class="dropdown-item">Laporan Pengeluaran Lain</a>
                                <a href="{{url("laporanLaba")}}" class="dropdown-item">Laporan Laba</a>
                            </div>
                        </li>

                        <li class="nav-item"><a href="{{url("dataAkun")}}"><i class="fa big-icon fa-table"></i> <span class="mini-dn">Manajemen User</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- Header top area start-->
        <div class="content-inner-all">
            <div class="header-top-area">
                <div class="fixed-header-top">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-1 col-md-6 col-sm-6 col-xs-12">
                                <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <div class="admin-logo logo-wrap-pro">
                                    <a href="{{url("#")}}"><img src="{{url("/asset/img/logo/logo.png")}}"  width="50%" height="50%" />
                                    </a>
                                </div>
                            </div>
                            
                            <div class="col-lg-10 col-md-5 col-sm-6 col-xs-12">
                                <div class="header-right-info">
                                    <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                        <li class="nav-item">
                                            <a href="{{url("#")}}" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                <span class="adminpro-icon adminpro-user-rounded header-riht-inf"></span>
                                                <span class="admin-name">{{Session::get("nama")}}</span>
                                                <span class="author-project-icon adminpro-icon adminpro-down-arrow"></span>
                                            </a>
                                            <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated flipInX">
                                                <li><a href="{{url("changePassOwner/".Session::get("id_owner"))}}"><span class="adminpro-icon adminpro-home-admin author-log-ic"></span>Change Password</a>
                                                </li>                                                
                                                <li><a href="{{url("logout")}}"><span class="adminpro-icon adminpro-locked author-log-ic"></span>Log Out</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul class="mobile-menu-nav">
                                        <li class="nav-item"><a href="{{url("dashboardOwner")}}"><i class="fa big-icon fa-table"></i> <span class="mini-dn">Dashboard</span></a>
                                        </li>
                                        
                                        <li class="nav-item"><a href="{{url("dataKategori")}}"><i class="fa big-icon fa-table"></i> <span class="mini-dn">Kategori Produk</span></a>
                                        </li>
                                        
                                        <li class="nav-item"><a href="{{url("dataProduk")}}"><i class="fa big-icon fa-table"></i> <span class="mini-dn">Produk</span></a>
                                        </li>

                                        <li class="nav-item"><a href="{{url("stokProduk")}}"><i class="fa big-icon fa-table"></i> <span class="mini-dn">Stok Produk</span></a>
                                        </li>

                                        <li class="nav-item"><a href="{{url("dataProduksi")}}"><i class="fa big-icon fa-table"></i> <span class="mini-dn">Produksi</span></a>
                                        </li>
                                        <li class="nav-item"><a href="{{url("dataDelivery")}}"><i class="fa big-icon fa-table"></i> <span class="mini-dn">Delivery Produk</span></a>
                                        </li>
                                        <li class="nav-item"><a href="{{url("dataReturn")}}"><i class="fa big-icon fa-table"></i> <span class="mini-dn">Return Produk</span></a>
                                        </li>
                                        <li class="nav-item"><a href="{{url("#")}}" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-files-o"></i> <span class="mini-dn">Penjualan</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-right"></i></span></a>
                                            <div role="menu" class="dropdown-menu left-menu-dropdown chart-left-menu-std animated flipInX" style="background-color: white;">
                                                <a href="{{url("dataPenjualanTokoOwner")}}" class="dropdown-item">Penjualan Toko</a>
                                                <a href="{{url("dataPenjualanWebOwner")}}" class="dropdown-item">Penjualan Web</a>
                                                <a href="{{url("dataPenjualanMarketplaceOwner")}}" class="dropdown-item">Penjualan Marketplace</a>
                                                <a href="{{url("dataPenjualanInstagramOwner")}}" class="dropdown-item">Penjualan Instagram</a>
                                                <a href="{{url("dataPenjualanEventOwner")}}" class="dropdown-item">Penjualan Event</a>
                                            </div>
                                        </li>
                                        <li class="nav-item"><a href="{{url("dataAkunPengeluaran")}}"><i class="fa big-icon fa-table"></i> <span class="mini-dn">Data Akun</span></a>
                                        </li>
                                        <li class="nav-item"><a href="{{url("#")}}" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-files-o"></i> <span class="mini-dn">Pengeluaran</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-right"></i></span></a>
                                            <div role="menu" class="dropdown-menu left-menu-dropdown form-left-menu-std animated flipInX" style="background-color: white;">                                
                                                <a href="{{url("dataPengeluaran")}}" class="dropdown-item">Pengeluaran Produksi</a>
                                                <a href="{{url("dataPengeluaranLainnya")}}" class="dropdown-item">Pengeluaran NonProduksi</a>
                                            </div>
                                        </li>                        
                                        <li class="nav-item"><a href="{{url("#")}}" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-files-o"></i> <span class="mini-dn">Laporan Perusahaan</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-right"></i></span></a>
                                            <div role="menu" class="dropdown-menu left-menu-dropdown form-left-menu-std animated flipInX" style="background-color: white;">                      
                                                <a href="{{url("laporanAsset")}}" class="dropdown-item">Laporan Asset</a>
                                                <a href="{{url("laporanPenjualan")}}" class="dropdown-item">Laporan Penjualan</a>
                                                <a href="{{url("laporanPengeluaran")}}" class="dropdown-item">Laporan Pengeluaran</a>
                                                <a href="{{url("laporanPengeluaranLainnya")}}" class="dropdown-item">Laporan Pengeluaran Lain</a>
                                                <a href="{{url("laporanLaba")}}" class="dropdown-item">Laporan Laba</a>
                                            </div>
                                        </li>

                                        <li class="nav-item"><a href="{{url("dataAkun")}}"><i class="fa big-icon fa-table"></i> <span class="mini-dn">Manajemen User</span></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <br><br><br><br>
            @yield("content")
            
            
        </div>
    </div>

    <footer>
      <div class="pull-right">
        <p>Copyright &#169; 2019 DNC - Shoes</p>
      </div>
      <div class="clearfix"></div>
    </footer>
    <!-- Chat Box End-->
    <!-- jquery
        ============================================ -->
    <script src="{{url("/asset/js/vendor/jquery-1.11.3.min.js")}}"></script>
    <!-- bootstrap JS
        ============================================ -->
    <script src="{{url("/asset/js/bootstrap.min.js")}}"></script>
    <!-- meanmenu JS
        ============================================ -->
    <script src="{{url("/asset/js/jquery.meanmenu.js")}}"></script>
    <!-- mCustomScrollbar JS
        ============================================ -->
    <script src="{{url("/asset/js/jquery.mCustomScrollbar.concat.min.js")}}"></script>
    <!-- sticky JS
        ============================================ -->
    <script src="{{url("/asset/js/jquery.sticky.js")}}"></script>
    <!-- scrollUp JS
        ============================================ -->
    <script src="{{url("/asset/js/jquery.scrollUp.min.js")}}"></script>
    <!-- scrollUp JS
        ============================================ -->
    <script src="{{url("/asset/js/wow/wow.min.js")}}"></script>
    <!-- counterup JS
        ============================================ -->
    <script src="{{url("/asset/js/counterup/jquery.counterup.min.js")}}"></script>
    <script src="{{url("/asset/js/counterup/waypoints.min.js")}}"></script>
    <script src="{{url("/asset/js/counterup/counterup-active.js")}}"></script>
    <!-- jvectormap JS
        ============================================ -->
    <script src="{{url("/asset/js/jvectormap/jquery-jvectormap-2.0.2.min.js")}}"></script>
    <script src="{{url("/asset/js/jvectormap/jquery-jvectormap-world-mill-en.js")}}"></script>
    <script src="{{url("/asset/js/jvectormap/jvectormap-active.js")}}"></script>
    <!-- peity JS
        ============================================ -->
    <script src="{{url("/asset/js/peity/jquery.peity.min.js")}}"></script>
    <script src="{{url("/asset/js/peity/peity-active.js")}}"></script>
    <!-- sparkline JS
        ============================================ -->
    <script src="{{url("/asset/js/sparkline/jquery.sparkline.min.js")}}"></script>
    <script src="{{url("/asset/js/sparkline/sparkline-active.js")}}"></script>
    <!-- datapicker JS
        ============================================ -->
    <script src="{{url("/asset/js/datapicker/bootstrap-datepicker.js")}}"></script>
    <script src="{{url("/asset/js/datapicker/datepicker-active.js")}}"></script>
    <!-- flot JS
        ============================================ -->
    <script src="{{url("/asset/js/flot/Chart.min.js")}}"></script>
    <script src="{{url("/asset/js/flot/dashtwo-flot-active.js")}}"></script>
    <!-- data table JS
        ============================================ -->
    <script src="{{url("/asset/js/data-table/bootstrap-table.js")}}"></script>
    <script src="{{url("/asset/js/data-table/tableExport.js")}}"></script>
    <script src="{{url("/asset/js/data-table/data-table-active.js")}}"></script>
    <script src="{{url("/asset/js/data-table/bootstrap-table-editable.js")}}"></script>
    <script src="{{url("/asset/js/data-table/bootstrap-editable.js")}}"></script>
    <script src="{{url("/asset/js/data-table/bootstrap-table-resizable.js")}}"></script>
    <script src="{{url("/asset/js/data-table/colResizable-1.5.source.js")}}"></script>
    <script src="{{url("/asset/js/data-table/bootstrap-table-export.js")}}"></script>
    <!-- main JS
        ============================================ -->
    <script src="{{url("/asset/js/main.js")}}"></script>

    <script src="{{url("/asset/vendors/js/vendor.bundle.base.js")}}"></script>
  <script src="{{url("/asset/vendors/js/vendor.bundle.addons.js")}}"></script>
  <!-- endinject -->
  <!-- datapicker JS
        ============================================ -->
  <script src="{{url("/asset/js/datapicker/bootstrap-datepicker.js")}}"></script>
  <script src="{{url("/asset/js/datapicker/datepicker-active.js")}}"></script>
  <!-- inject:js -->
  <script src="{{url("/asset/js/off-canvas.js")}}"></script>
  <script src="{{url("/asset/js/misc.js")}}"></script>
  <script src="{{url("/asset/js/select2.min.js")}}"></script>

  <!-- endinject -->
  
//   <script type="text/javascript">
//     $(document).ready(function(){
//         $("#filter").on("change", function(e){
//             var idk = e.target.value;
//             $.get("{{url("stokProdukFilter")}}/" +idk, function(data){
//                 console.log(id);
//                 console.log(data);
//                 $('#hasilFilter').empty();
//                 $.each(data, function(index, element){
//                     $('#hasilFilter').append("<tr><td>"+element.nama_produk+"<tr><td>"+element.stok_gudang+"<tr><td>"+element.stok_toko)
//                 });
//             });
//         });
//     });
//     </script>
    
    
  <script type="text/javascript">
        $("#nama_produk").on("change", function(e){
            var nama_produk = e.target.value;
            $.get("{{url("tambahPembelianEvent")}}/add/ajax-state?nama_produk=" +nama_produk, function(data){
                // $("#harga_jual").html(data[0].harga_jual);
                // alert(data[0].harga_jual);
                document.getElementById("harga_jual").value=data[0].harga_jual;
            });
        });
    </script>
  <script type="text/javascript">
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
        var harga = parseInt(document.getElementById("harga_jual").value);
        var jumlah = parseInt(document.getElementById("jumlah").value);
        var total = harga * jumlah;
        // total = total || 0;
        document.getElementById("total").value=total;
      }
      function diskon() {
        var harga = parseInt(document.getElementById("harga_jual").value);
        var jumlah = parseInt(document.getElementById("jumlah").value);
        var disk = parseInt(document.getElementById("diskon").value);
        var diskon = (harga * disk) /100;
        var total = (harga-diskon) * jumlah;
        document.getElementById("total").value=total;
      }
  </script>

  <script type="text/javascript">
      window.onload = function(){
        document.getElementById("stok_gudang").addEventListener("keyup",total,false);
        document.getElementById("stok_toko").addEventListener("keyup",total,false);
      }
     function total() {
        var gudang = parseInt(document.getElementById("stok_gudang").value);
        var toko = parseInt(document.getElementById("stok_toko").value);
        var total = gudang + toko;
        // total = total || 0;
        document.getElementById("total_stok").value=total;
      }
  </script>
  <script>
      
      function hapusPro($del){
        if(confirm("Are You Sure")){
            window.location=("hapusProduk/" +$del+ "");
        }
      }
      function hapusKat($del){
        if(confirm("Are You Sure")){
            window.location=("hapusKategori/" +$del+ "");
        }
      }
      function hapusPen($del){
        if(confirm("Are You Sure")){
            window.location=("hapusPengeluaran/" +$del+ "");
        }
      }
      function hapusPeg($del){
        if(confirm("Are You Sure")){
            window.location=("hapusAkunBaru/" +$del+ "");
        }
      }
      function hapusAkunPengeluaran($del){
        if(confirm("Are You Sure")){
            window.location=("hapusAkunPengeluaran/" +$del+ "");
        }
      }
      function hapusPengeluaranLain($del){
        if(confirm("Are You Sure")){
            window.location=("hapusPengeluaranLain/" +$del+ "");
        }
      }
      function hapusPengeluaranLainnya($del){
        if(confirm("Are You Sure")){
            window.location=("hapusPengeluaranLainnya/" +$del+ "");
        }
      }
  </script>
  
</body>

</html>
