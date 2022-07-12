@extends("layout.masterAdminWeb")
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
                  
                  @if(\Session::has("alert-success"))
                      <div class="alert alert-success">
                          <div>{{Session::get("alert-success")}}</div>
                      </div>
                  @endif

                @foreach($tamps as $datas)
                <form action="{{url("/registerPembelianWeb/".$datas->kode_penjualan)}}" method="POST">          
                  {{ csrf_field() }}

                <div class="form-group">   
                <label class="label">Nama Produk</label>               
                  <select class="form-control form-control-lg" name="nama_produk" id="nama_produk" >
                  <option value="0" > - Nama Produk - </option>
                    @foreach($tamp as $data)                   
                      <option  value="{{$data->kode_produk}}">{{$data->nama_produk}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label class="label">Harga Jual</label>
                  <div class="input-group">
                    <input required=""  type="text" class="form-control" readonly name="harga_jual" id="harga_jual">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>   

                <div class="form-group">
                  <label class="label">Jumlah</label>
                  <div class="input-group">
                    <input required="" autocomplete="off" type="number" class="form-control"  name="jumlah" id="jumlah">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>


                <div class="form-group">
                  <label class="label">Diskon</label>
                  <div class="input-group">
                    <input type="radio"  name="dis" id="radio_1"  checked=""> Persen
                    <input type="radio" name="dis" id="radio_2"> Rupiah
                  </div>
                    
                  <div class="input-group">
                    <input required="" autocomplete="off" required="" type="number" class="form-control" value="0" name="diskon" id="diskon">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>             

                <div class="form-group">
                  <label class="label">Total Harga</label>
                  <div class="input-group">
                    <input required="" readonly="" type="text" class="form-control" name="total" id="total">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="label">Ongkir</label>
                  <div class="input-group">
                    <input required="" type="text" class="form-control" name="ongkir" value="0" id="ongkir" >
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div> 

                <div class="form-group">
                  <button class="btn btn-success submit-btn btn-block">Submit</button>
                  <a href="{{url("detailPembelianWeb/".$datas->kode_penjualan)}}" class="btn btn-info submit-btn btn-block">Cancel</a>
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