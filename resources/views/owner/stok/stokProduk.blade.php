@extends("layout.masterOwner")

@section("content")
<style type="text/css">
    #tengah{
        text-align:center;
    }
    #cek{
        margin: 0px auto;
        text-align:center;
        width:50px;
        border-radius:5px;
        border-color:red;
        background-color: red;
        color:#fff;
    }

</style>	
	<div class="data-table-area mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sparkline13-list shadow-reset">
                        <div class="sparkline13-hd">
                            <div class="main-sparkline13-hd">
                                <h1>Data Stok Produk<span class="table-project-n"></span></h1>

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
                                    <a href="{{url("cetakStok")}}" target="_blank" class="btn btn-custon-four btn-primary" style="margin-left:-200px;"><i class="fa fa-print"></i> Cetak Stok</a>

                                          <select class="form-control form-control-lg" onChange="document.location.href = this.options[this.selectedIndex].value;" style="margin-left:150px;margin-top:-40px;width:200px;">
                                              <option value="{{url("stokProduk")}}">-- Filter --</option>
                                              <option value="{{url("stokProdukAlfabet")}}">Alfabet</option>
                                              <option value="{{url("stokProdukTerbanyak")}}">Stok Terbanyak</option>
                                          </select>
                                            
                                </div>
                                
                                
                                
                                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" >
                                    <thead id="tengah">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Produk</th>
                                            <th>Stok Gudang</th>
                                            <th>Stok Toko</th>     
                                            <th>Total Stok</th>
                                            <th>Action</th>            
                                        </tr>
                                    </thead>
                                    
                                    <tbody id="hasilFilter"> 
                                    @php $no=1; @endphp
                                    @foreach($tamp as $data)                                       
                                        <tr >
                                            <td id="tengah"><p @if($data->tot_stok < $data->stok_minimum) id="cek" @endif>{{ $no++ }}</p></td>
                                            <td id="tengah"><p @if($data->tot_stok < $data->stok_minimum) id="cek" @endif>{{ $data->nama_produk }}</p></td>
                                            <td id="tengah"><p @if($data->stok_gudang < $data->stok_minimum) id="cek" @endif>{{ $data->stok_gudang }}</p></td>         
                                            <td id="tengah"><p @if($data->stok_toko < $data->stok_minimum) id="cek" @endif>{{ $data->stok_toko }}</p></td>
                                            <td id="tengah"><p @if(($data->stok_gudang + $data->stok_toko) < $data->stok_minimum) id="cek" @endif>{{ $data->stok_gudang + $data->stok_toko }}</p></td>                      <td>
                                                <a href="{{url("editStok/".$data->id)}}" class="btn btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                            </td>                     
                                        </tr>
                                    @endforeach
                                    </tbody>                                    
                                </table>
                                <label>* Jika ada produk yang berwarna merah adalah produk yang kurang dari stok minimum *</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection