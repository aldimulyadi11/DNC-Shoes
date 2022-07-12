@extends("layout.masterAdminEvent")
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
                  
                  @if(\Session::has("alert-success"))
                      <div class="alert alert-success">
                          <div>{{Session::get("alert-success")}}</div>
                      </div>
                  @endif

                <form action="{{url("/registerPenjualanEvent")}}" method="POST">          
                  {{ csrf_field() }}

                <div class="form-group">
                  <label class="label">Tanggal Penjualan</label>
                  <div class="input-group">
                    <input autocomplete="off" required="" type="date" class="form-control" name="tanggal_penjualan">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>


                <div class="form-group">
                  <label class="label">Nama Pembeli</label>
                  <div class="input-group">
                    <input autocomplete="off" required="" type="text" class="form-control" name="nama_pembeli" placeholder="Nama Pembeli">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="label">Keterangan</label>
                  <div class="input-group">
                    <textarea class="form-control" rows="3" name="keterangan_pembeli" placeholder="Keterangan"  required></textarea>
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <button class="btn btn-success submit-btn btn-block">Submit</button>
                  <a href="{{url("dataPenjualanEvent")}}" class="btn btn-info submit-btn btn-block">Cancel</a>
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
@endsection