@extends("layout.masterOwner")

@section("content")
	
	<div class="data-table-area mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sparkline13-list shadow-reset">
                        <div class="sparkline13-hd">
                            <div class="main-sparkline13-hd">
                                <h1>Data Penjualan Toko<span class="table-project-n"></span></h1>

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
                                <div id="toolbar">
                                    
                                    <a href="{{url("cetakPenjualanToko")}}" target="_blank" class="btn btn-custon-four btn-primary"><i class="fa fa-print"></i>Cetak</a>
                                </div>
                                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                    <thead>
                                        <tr>                                            
                                            <th>Tanggal Penjualan</th>
                                            <th>Pembeli</th>                                            
                                            <th>Nama Produk</th>
                                            <th>Harga</th>
                                            <th>Quantity</th>
                                            <th>Diskon</th>                            
                                            <th>Diskon Rp</th>
                                            <th>Total</th>
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody> 
                                    @foreach($tamp as $data)                                       
                                        <tr>
                                            <td>{{ $data->tanggal_penjualan }}</td>
                                            <td>{{ $data->nama_pembeli }}</td>
                                            <td>{{ $data->nama_produk }}</td>
                                            <td>Rp. {{number_format($data->harga_barang,0, ".", ".")}}</td>
                                            <td>{{ $data->jumlah_barang}}</td>
                                            <td>{{ $data->diskon }}</td>
                                            <td>Rp. {{number_format($data->diskon_rp,0, ".", ".")}}</td>
                                            <td>Rp. {{number_format($data->total_barang,0, ".", ".")}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection