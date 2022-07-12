@extends("layout.masterOwner")

@section("content")
	<div class="data-table-area mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sparkline13-list shadow-reset">
                        <div class="sparkline13-hd">
                            <div class="main-sparkline13-hd">
                                <h1>Laporan Aset<span class="table-project-n"></span></h1>

                                <div class="sparkline13-outline-icon">

                                    <span class="sparkline13-collapse-link"><i class="fa fa-chevron-up"></i></span>
                                    <span><i class="fa fa-wrench"></i></span>
                                    <span class="sparkline13-collapse-close"><i class="fa fa-times"></i></span>
                                </div>
                            </div>
                        </div>
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
                        <div class="sparkline13-graph">
                            <div class="datatable-dashv1-list custom-datatable-overright">                                

                                <form action="{{url("/registerLaporanAsset")}}" method="post">
                                {{ csrf_field() }}
                                <h4><strong>Filter</strong></h4>
                                <div class="sparkline12-graph">
                                    <div class="input-knob-dial-wrap">                                        
                                        <div class="form-group">   
                                          <label class="label">Kategori</label>
                                          <div class="input-group">                                            
                                            <br>
                                            <select class="form-control form-control-lg" name="kategori_asset" id="kategori_asset" >
                                              <option value="0" > - Pilih Kategori - </option>                    @foreach($kategori as $data)                   
                      <option  value="{{$data->kode_kategori}}">{{$data->nama_kategori}}</option>
                    @endforeach
                  </select>
                                          </div>
                                        </div>

                                        <div class="form-group">                                          
                                          <label class="label">Posisi</label>
                                          <div class="input-group">
                                            <br>
                                            <select class="form-control form-control-lg" name="posisi_asset" id="posisi_asset" >
                                              <option value="0" > - Pilih Posisi - </option>                  
                      <option  value="Gudang">Gudang</option>
                      <option  value="Toko">Toko</option>
                  </select>
                                          </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                              <button type="submit" class="btn btn-custon-four btn-success">Filter</button>
                                              <a href="{{url("laporanAsset")}}" class="btn btn-custon-four btn-info">Refresh</a>
                                        </div>
                                </form>
                                <br>
                                <h4><strong>Laporan Asset</strong></h4>
                                <br>
                                <a href="{{url("cetakLaporanAsset/")}}" target="_blank" class="btn btn-custon-four btn-info"><i class="fa fa-print"></i> Cetak Laporan</a>
                                <br><br>
                                <div class="table-responsive">
                                <table id="table" data-toggle="table" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Stok Gudang</th>
                                        <th>Stok Toko </th>
                                        <th>Harga Produk</th>
                                        <th>Jumlah Asset</th>
                                    </tr>
                                </thead>
                                
                                <tbody>  
                                @php $total = 0; @endphp
                                @php $no = 1; @endphp   
                                @foreach($tamp as $data)                         
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$data->nama_produk}}</td>
                                        <td>{{$data->stok_gudang}}</td>
                                        <td>{{$data->stok_toko}}</td>
                                        <td>Rp. {{number_format($data->harga_jual)}}</td>
                                        <td>Rp. {{number_format(($data->stok_gudang + $data->stok_toko) *$data->harga_jual)}} </td>

                                    </tr>
                                   @php $total += ($data->stok_gudang + $data->stok_toko) *$data->harga_jual
                                    @endphp
                                @endforeach

                              </tbody>
                              <tfoot>
                                  <tr>
                                    <td style="text-align: center;" colspan="2"><strong>Total Asset</strong></td>
                                    <td style="text-align: center;" ><strong>{{$gudang}}</strong></td>
                                    <td style="text-align: center;" ><strong>{{$toko}}</strong></td>
                                    <td style="text-align: center;" ><strong></strong></td>
                                    <td style="text-align: center;" ><strong>Rp. {{number_format($total)}}</strong></td>
                                    
                                  </tr>
                              </tfoot>
                                        
                            </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection