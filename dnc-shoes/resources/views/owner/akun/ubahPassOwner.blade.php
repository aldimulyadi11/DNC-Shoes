@extends("layout.masterOwner")
@section("content")
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-7 mx-auto">
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

                @if(\Session::has("alert"))
                                      <div class="alert alert-danger">
                                          <div>{{Session::get("alert")}}</div>
                                      </div>
                                  @endif

                @foreach($tamp as $data)
                <form action="{{url("/updatePassOwner/".$data->kode_pegawai)}}" method="POST">          
                  {{ csrf_field() }}

                <div class="form-group">
                  <label class="label">Old Password</label>
                  <div class="input-group">
                    <input required="" autocomplete="off" type="password" class="form-control" name="old_password" placeholder="Old Password">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">New Password</label>
                  <div class="input-group">
                    <input required="" autocomplete="off" type="password" class="form-control" name="new_password" placeholder="New Password">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Confirm Password</label>
                  <div class="input-group">
                    <input required="" autocomplete="off" type="password" class="form-control" name="confir" placeholder="Confirmation Password">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>
              
                <div class="form-group d-flex justify-content-center">
                  <div class="form-check form-check-flat mt-0">
                    <label class="form-check-label">
                      <input autocomplete="off" type="checkbox" class="form-check-input" checked> I agree to the terms
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-success submit-btn btn-block">Submit</button>
                  <a href="{{url("dashboardOwner")}}" class="btn btn-info submit-btn btn-block">Cancel</a>
                </div>
              </form>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>        
@endsection