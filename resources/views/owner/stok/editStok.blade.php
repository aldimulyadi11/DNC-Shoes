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
               @if(\Session::has("alert"))
                      <div class="alert alert-danger">
                          <div>{{Session::get("alert")}}</div>
                      </div>
                  @endif
               @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @foreach($tamp as $data)
                <form action="{{url("/updateStok/".$data->id)}}" method="POST" enctype="multipart/form-data">          
                  {{ csrf_field() }}

                <div class="form-group">     
                <label class="label">Kode Produk</label>
                  <div class="input-group">
                    <input autocomplete="off" readonly="" type="text" class="form-control" name="kode_produk" value="{{$data->kode_produk}}">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>               

                <div class="form-group">          
                <label class="label">Nama Produk</label>        
                  <div class="input-group">
                    <input autocomplete="off" readonly="" type="text" class="form-control" name="nama_produk" value="{{$data->nama_produk}}">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>

                <div class="form-group">     
                <label class="label">Stok Gudang</label>
                  <div class="input-group">
                    <input autocomplete="off" type="text" class="form-control" name="stok_gudang" id="stok_gudang" value="{{$data->stok_gudang}}">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>

                <div class="form-group">     
                <label class="label">Stok Toko</label>
                  <div class="input-group">
                    <input autocomplete="off" type="text" class="form-control" name="stok_toko" id="stok_toko" value="{{$data->stok_toko}}">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>

                <div class="form-group">     
                <label class="label">Total Stok</label>
                  <div class="input-group">
                    <input autocomplete="off" readonly="" type="text" class="form-control" name="total_stok" id="total_stok" value="{{$data->stok_gudang + $data->stok_toko}}">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <button class="btn btn-success submit-btn btn-block">Submit</button>
                  <a href="{{url("stokProduk")}}" class="btn btn-info submit-btn btn-block">Cancel</a>
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