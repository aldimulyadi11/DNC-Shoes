@extends("layout.masterAdminInstagram")
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

                <form action="{{url("/registerProduksiAdminInstagram")}}" method="POST">          
                  {{ csrf_field() }}

                <div class="form-group">
                  <label class="label">Tanggal Produksi</label>
                  <div class="input-group">
                    <input required="" type="date" class="form-control" name="tanggal_produksi">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>


                <div class="form-group">   
                <label class="label">Nama Produk</label>               
                  <select class="form-control form-control-lg" id="exampleFormControlSelect1" name="nama_produk">
                    @foreach($tamp as $data)
                      <option value="{{$data->kode_produk}}">{{$data->nama_produk}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label class="label">Jumlah</label>
                  <div class="input-group">
                    <input required="" type="number" class="form-control" name="jumlah" placeholder="Jumlah">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="exampleTextarea1">Keterangan</label>
                  <textarea class="form-control" id="exampleTextarea1" rows="4" name="keterangan"></textarea>
                </div>

                <div class="form-group">
                  <button class="btn btn-success submit-btn btn-block">Submit</button>
                  <a href="{{url("dataProduksiAdminInstagram")}}" class="btn btn-info submit-btn btn-block">Cancel</a>
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