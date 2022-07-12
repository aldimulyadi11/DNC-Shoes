@extends("layout.masterOwner")
@section("content")
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
        <div class="row w-100">


          <div class="col-lg-9 mx-auto">
            <div>
            <img style="max-height: 190px; display: block; margin: auto; width: 50%;" src="{{url("/asset/img/logo/logo.png")}}">
          </div>
            <h4 class="text-center mb-4">Sales And Inventory System</h4>
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

                <form action="{{url("/registerPostBaru")}}" method="POST">          
                  {{ csrf_field() }}

                <div class="form-group">
                  <label class="label">Nama</label>
                  <div class="input-group">
                    <input autocomplete="off" type="text" class="form-control" name="nama" placeholder="Nama">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="label">Username</label>
                  <div class="input-group">
                    <input autocomplete="off" type="text" class="form-control" name="username" placeholder="Username">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>


                <div class="form-group">
                  <label class="label">Alamat</label>
                  <div class="input-group">
                    <input autocomplete="off" type="text" class="form-control" name="alamat" placeholder="alamat">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="label">No Telp</label>
                  <div class="input-group">
                    <input autocomplete="off" type="text" class="form-control" name="telp" placeholder="telp">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Password</label>
                  <div class="input-group">
                    <input autocomplete="off" type="password" class="form-control" name="password" placeholder="Password">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Confirm Password</label>
                  <div class="input-group">
                    <input autocomplete="off" type="password" class="form-control" name="confir" placeholder="Confirm Password">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>
                <div class="form-group">   
                
                  <select class="form-control form-control-lg" id="exampleFormControlSelect1" name="bagian">
                    <option value="Owner">Owner</option>
                    <option value="Admin Toko">Admin Toko</option>
                    <option value="Admin Gudang">Admin Gudang</option>
                    <option value="Admin Web">Admin Web</option>
                    <option value="Admin Marketplace">Admin Marketplace</option>
                    <option value="Admin Instagram">Admin Instagram</option>
                    <option value="Admin Event">Admin Event</option>
                    <option value="Admin Keuangan">Admin Keuangan</option>
                  </select>
                </div>

                <div class="form-group d-flex justify-content-center">
                  <div class="form-check form-check-flat mt-0">
                    <label class="form-check-label">
                      <input autocomplete="off" type="checkbox" class="form-check-input" checked> I agree to the terms
                    </label>
                  </div>
                </div>
                
                  <button class="btn btn-success submit-btn btn-block">Register</button>
                  <a href="{{"dataAkun"}}" class="btn btn-info submit-btn btn-block">Cancel</a>
                
                <!-- <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Already have and account ?</span>
                  <a href="login.html" class="text-black text-small">Login</a>
                </div> -->
              </form>
            </div>
          </div>          
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
@endsection