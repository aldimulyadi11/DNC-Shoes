<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{url("/asset/vendors/iconfonts/mdi/css/materialdesignicons.min.css")}}">
  <link rel="stylesheet" href="{{url("/asset/vendors/iconfonts/puse-icons-feather/feather.css")}}">
  <link rel="stylesheet" href="{{url("/asset/vendors/css/vendor.bundle.base.css")}}">
  <link rel="stylesheet" href="{{url("/asset/vendors/css/vendor.bundle.addons.css")}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{url("/asset/css/style.css")}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{url("/asset/images/favicon.png")}}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth theme-one">
        <div class="row w-100">
          <div class="col-lg-5 mx-auto">
            <h2 class="text-center mb-4">Register</h2>
            <div class="auto-form-wrapper">
               @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{url("/registerPost")}}" method="POST" enctype="multipart/form-data">          
                  {{ csrf_field() }}

                <div class="form-group">
                  <label class="label">Nama</label>
                  <div class="input-group">
                    <input autocomplete="off" type="text" class="form-control" name="nama" placeholder="Nama">
                    <div class="input-group-append">                      
                  </div>
                </div>

                <div class="form-group">
                  <label class="label">Username</label>
                  <div class="input-group">
                    <input autocomplete="off" type="text" class="form-control" name="username" placeholder="Username">
                    <div class="input-group-append">
                      
                  </div>
                </div>


                <div class="form-group">
                  <label class="label">Alamat</label>
                  <div class="input-group">
                    <input autocomplete="off" type="text" class="form-control" name="alamat" placeholder="alamat">
                    <div class="input-group-append">
                      
                  </div>
                </div>

                <div class="form-group">
                  <label class="label">No. Telepon</label>
                  <div class="input-group">
                    <input autocomplete="off" type="text" class="form-control" name="telp" placeholder="telp">
                    <div class="input-group-append">
                      
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Password</label>
                  <div class="input-group">
                    <input autocomplete="off" type="password" class="form-control" name="password" placeholder="Password">
                    <div class="input-group-append">
                      
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Confirm Password</label>
                  <div class="input-group">
                    <input autocomplete="off" type="password" class="form-control" name="confir" placeholder="Confirm Password">
                    <div class="input-group-append">
                      
                  </div>
                </div>
                <div class="form-group">   
                <label class="label">Bagian</label>               
                  <select class="form-control form-control-lg" id="exampleFormControlSelect1" name="bagian">
                    <option value="Owner">Owner</option>
                    <option value="Admin Toko">Admin Toko</option>
                    <option value="Admin Gudang">Admin Gudang</option>
                    <option value="Admin Web">Admin Web</option>
                    <option value="Admin Marketplace">Admin Marketplace</option>
                    <option value="Admin Instagram">Admin Instagram</option>
                  </select>
                </div>

                <div class="form-group d-flex justify-content-center">
                  <div class="form-check form-check-flat mt-0">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" checked> I agree to the terms
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary submit-btn btn-block">Register</button>
                </div>
               
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="/asset/vendors/js/vendor.bundle.base.js"></script>
  <script src="/asset/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="/asset/js/off-canvas.js"></script>
  <script src="/asset/js/hoverable-collapse.js"></script>
  <script src="/asset/js/misc.js"></script>
  <script src="/asset/js/settings.js"></script>
  <script src="/asset/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>