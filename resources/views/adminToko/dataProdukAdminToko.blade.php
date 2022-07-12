@extends("layout.masterAdminToko")

@section("content")
	
	<div class="data-table-area mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sparkline13-list shadow-reset">
                        <div class="sparkline13-hd">
                            <div class="main-sparkline13-hd">
                                <h1>Data Produk<span class="table-project-n"></span></h1>

                                <div class="sparkline13-outline-icon">

                                    <span class="sparkline13-collapse-link"><i class="fa fa-chevron-up"></i></span>
                                    <span><i class="fa fa-wrench"></i></span>
                                    <span class="sparkline13-collapse-close"><i class="fa fa-times"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="sparkline13-graph">
                            <div class="datatable-dashv1-list custom-datatable-overright">
                                <div id="toolbar">
                                                                        
                                </div>
                                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                    <thead>
                                        <tr>
                                            <th>Kode Produk</th>
                                            <th>Nama Kategori</th>
                                            <th>Nama Produk</th>
                                            <th>Foto</th>
                                            <th>Harga Jual</th>
                                            <th>Stok Minimum</th>
                                            <th>Keterangan</th>                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody> 
                                    @foreach($tamp as $data)                                       
                                        <tr>
                                            <td>{{ $data->kode_produk }}</td>
                                            <td>{{ $data->nama_kategori }}</td>         
                                            <td>{{ $data->nama_produk }}</td>
                                            <td> <img src="{{url("imgs")}}/{{($data->foto) }}" width="60" height="60"></td>
                                            <td>{{ $data->harga_jual }}</td>
                                            <td>{{ $data->stok_minimum }}</td>
                                            <td>{{ $data->ket }}</td>                                            
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