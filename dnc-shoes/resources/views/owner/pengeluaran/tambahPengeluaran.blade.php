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

                <form action="{{url("/registerTambahPengeluaran")}}" method="POST">          
                  {{ csrf_field() }}

                <div class="form-group">           
                <label class="label">Nama Akun</label>        
                  <select class="form-control form-control-lg" id="exampleFormControlSelect1" name="kode_akun">
                    <option disabled="" selected="">- Nama Akun -</option>
                    @foreach($tamp as $data)
                      <option value="{{$data->kode_akun}}">{{$data->nama_akun_pengeluaran}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">    
                <label class="label">Tanggal Pengeluaran</label>              
                  <div class="input-group">
                    <input autocomplete="off" required="" type="date" class="form-control" name="tgl_pengeluaran">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>

                <div class="form-group">                
                <label class="label">Jumlah</label>  
                  <div class="input-group">
                    <input autocomplete="off" required="" type="number" class="form-control" name="jumlah" placeholder="Jumlah Pengeluaran">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>

                <div class="form-group"> 
                <label class="label">Deskripsi</label>                 
                  <textarea autocomplete="off" class="form-control" id="exampleTextarea1" rows="4" name="deskripsi" placeholder="Deskripsi"></textarea>
                </div>

                <div class="form-group">   
                <label class="label">Keterangan</label>               
                  <textarea autocomplete="off" class="form-control" id="exampleTextarea1" rows="4" name="keterangan" placeholder="Keterangan"></textarea>
                </div>

                <div class="form-group">
                  <button class="btn btn-success submit-btn btn-block">Submit</button>
                  <a href="{{url("dataPengeluaran")}}" class="btn btn-info submit-btn btn-block">Cancel</a>
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