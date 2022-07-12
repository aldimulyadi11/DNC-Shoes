@extends("layout.masterForm")
@section("form")
          <div class="col-lg-5 mx-auto">
            <h2 class="text-center mb-4">Tambah Delivery</h2>
            <div class="auto-form-wrapper">
              
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

                <form action="{{url("/registerDeliveryAdminToko")}}" method="POST">          
                  {{ csrf_field() }}

                <div class="form-group">
                  <label class="label">Tanggal Delivery</label>
                  <div class="input-group">
                    <input required="" type="date" class="form-control" name="tanggal_delivery">
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
                  <button class="btn btn-primary submit-btn btn-block">Submit</button>
                </div>
              </form>
            </div>
          </div>
@endsection