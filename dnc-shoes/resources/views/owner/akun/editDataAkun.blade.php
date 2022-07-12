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
              <form action="{{url("/updateAkunBaru/".$data->kode_pegawai)}}" method="POST">          
                {{ csrf_field() }}

              <div class="form-group">
                <label class="label">Kode Pegawai</label>
                <div class="input-group">
                  <input autocomplete="off" type="text" readonly="" class="form-control" name="kode_pegawai" value="{{$data->kode_pegawai}}">                  
                </div>
              </div>
              <div class="form-group">
                <label class="label">Nama</label>
                <div class="input-group">
                  <input autocomplete="off" type="text" class="form-control" name="nama" value="{{$data->nama}}">                  
                </div>
              </div>

              <div class="form-group">
                <label class="label">Username</label>
                <div class="input-group">
                  <input autocomplete="off" type="text" class="form-control" name="username" value="{{$data->username}}">                  
                </div>
              </div>


              <div class="form-group">
                <label class="label">Alamat</label>
                <div class="input-group">
                  <input autocomplete="off" type="text" class="form-control" name="alamat" value="{{$data->alamat}}">                  
                </div>
              </div>

              <div class="form-group">
                <label class="label">No. Telepon</label>
                <div class="input-group">
                  <input autocomplete="off" type="text" class="form-control" name="telp" value="{{$data->telp}}">                  
                </div>
              </div>
              <!-- <div class="form-group">
                <label class="label">Password</label>
                <div class="input-group">
                  <input autocomplete="off" type="password" class="form-control" name="password">                  
                </div>
              </div>
              <div class="form-group">
                <label class="label">Confirm Password</label>
                <div class="input-group">
                  <input autocomplete="off" type="password" class ="form-control" name="confir">                  
                </div>
              </div> -->
              <div class="form-group">   
              <label class="label">Bagian</label>               
                <select class="form-control form-control-lg" id="exampleFormControlSelect1" name="bagian">
                  <option @if($data->bagian=="Owner") selected @endif value="Owner">Owner</option>
                  <option @if($data->bagian=="Admin Toko") selected @endif value="Admin Toko">Admin Toko</option>
                  <option @if($data->bagian=="Admin Gudang") selected @endif value="Admin Gudang">Admin Gudang</option>
                  <option @if($data->bagian=="Admin Web") selected @endif value="Admin Web">Admin Web</option>
                  <option @if($data->bagian=="Admin Marketplace") selected @endif value="Admin Marketplace">Admin Marketplace</option>
                  <option @if($data->bagian=="Admin Instagram") selected @endif value="Admin Instagram">Admin Instagram</option>
                </select>
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
                <a href="{{url("dataAkun")}}" class="btn btn-info submit-btn btn-block">Cancel</a>
              </div>
              <!-- <div class="text-block text-center my-3">
                <span class="text-small font-weight-semibold">Already have and account ?</span>
                <a href="login.html" class="text-black text-small">Login</a>
              </div> -->
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