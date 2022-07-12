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
                <form action="{{url("/updateProdukAdminGudang/".$data->kode_produk)}}" method="POST" enctype="multipart/form-data">          
                  {{ csrf_field() }}

                <div class="form-group">     
                <label class="label">Kode Produk</label>
                  <div class="input-group">
                    <input autocomplete="off" required="" readonly="" type="text" class="form-control" name="kode_produk" value="{{$data->kode_produk}}">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>

                <div class="form-group">   
                <label class="label">Nama Kategori</label>                
                  <select class="form-control form-control-lg" id="exampleFormControlSelect1" name="nama_kategori">
                    @foreach($tamp2 as $data2)                 
                      <option @if($data2->kode_kategori == $data->fk_kode_kat) selected @endif value="{{$data2->kode_kategori}}">{{$data2->nama_kategori}}</option>
                    @endforeach
                  </select>
                </div>

                

                <div class="form-group">          
                <label class="label">Nama Produk</label>        
                  <div class="input-group">
                    <input autocomplete="off" required="" type="text" class="form-control" name="nama_produk" value="{{$data->nama_produk}}">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>

                <div class="form-group">   
                <label class="label">Harga</label>               
                  <div class="input-group">
                    <input autocomplete="off" required="" type="number" class="form-control" name="harga_jual" value="{{$data->harga_jual}}">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>
                <div class="form-group">  
                <label class="label">Stok Minimum</label>                
                  <div class="input-group">
                    <input autocomplete="off" required="" type="number" class="form-control" name="stok_minimum" value="{{$data->stok_minimum}}">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>

                <div class="form-group">          
                <label class="label">Keterangan</label>        
                  <textarea class="form-control" id="exampleTextarea1" rows="4" name="keterangan">{{$data->ket}}</textarea>
                </div>


                <div class="form-group">       
                <label class="label">Foto</label>           
                  <div class="input-group">        
                    <img src="{{url("/imgs/".$data->foto) }}" width="60" height="60">            
                    <input autocomplete="off" type="file" class="form-control" name="file" >
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>


                <div class="form-group">
                  <button class="btn btn-success submit-btn btn-block">Submit</button>
                  <a href="{{url("dataProdukAdminGudang")}}" class="btn btn-info submit-btn btn-block">Cancel</a>
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