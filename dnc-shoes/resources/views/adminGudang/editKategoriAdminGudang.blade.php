@extends("layout.masterAdminGudang")
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
                  
                  @if(\Session::has("alert-success"))
                      <div class="alert alert-success">
                          <div>{{Session::get("alert-success")}}</div>
                      </div>
                  @endif

                @foreach($tamp as $data)
                <form action="{{"/updateKategoriAdminGudang/".$data->kode_kategori}}" method="POST">          
                  {{ csrf_field() }}

                <div class="form-group">
                  <label class="label">Kode Kategori</label>
                  <div class="input-group">
                    <input type="text" class="form-control" readonly="" name="kode_kategori" value="{{$data->kode_kategori}}">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="label">Nama Kategori</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="nama_kategori" value="{{$data->nama_kategori}}">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>

                <div class="form-group">     
                <label class="label">Keterangan</label>             
                  <textarea autocomplete="off" class="form-control" id="exampleTextarea1" rows="4" name="keterangan">{{$data->keterangan}}</textarea>
                </div>

                <div class="form-group">
                  <button class="btn btn-success submit-btn btn-block">Submit</button>
                  <a href="{{url("dataKategoriAdminGudang")}}" class="btn btn-info submit-btn btn-block">Cancel</a>
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