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
              <form action="{{url("/updateAkunPengeluaran/".$data->kode_akun)}}" method="POST">          
                {{ csrf_field() }}

              <div class="form-group">
                <label class="label">Kode Akun</label>
                <div class="input-group">
                  <input autocomplete="off" type="text" readonly="" class="form-control" name="kode_akun" value="{{$data->kode_akun}}">                  
                </div>
              </div>
              <div class="form-group">
                <label class="label">Nama Akun</label>
                <div class="input-group">
                  <input autocomplete="off" type="text" class="form-control" name="nama_akun_pengeluaran" value="{{$data->nama_akun_pengeluaran}}">                  
                </div>
              </div>

              <div class="form-group">
                <label class="label">Deskripsi</label>
                <div class="input-group">
                  <input autocomplete="off" type="text" class="form-control" name="deskripsi_akun_pengeluaran" value="{{$data->deskripsi_akun_pengeluaran}}">                  
                </div>
              </div>

              <div class="form-group">
                <button class="btn btn-success submit-btn btn-block">Submit</button>
                <a href="{{url("dataAkunPengeluaran")}}" class="btn btn-info submit-btn btn-block">Cancel</a>
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