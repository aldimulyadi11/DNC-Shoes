@extends("layout.masterOwner")

@section("content")
	<div class="data-table-area mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sparkline13-list shadow-reset">
                        <div class="sparkline13-hd">
                            <div class="main-sparkline13-hd">
                                <h1>Laporan Pengeluaran<span class="table-project-n"></span></h1>

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

                                <form action="{{url("/registerLaporanPengeluaran")}}" method="post">
                                {{ csrf_field() }}
                                <h4><strong>Periode</strong></h4>
                                <div class="sparkline12-graph">
                                    <div class="input-knob-dial-wrap">                                        
                                        <div class="form-group">   
                                          <label class="label">Start</label>
                                          <div class="input-group">                                            
                                            <br>
                                            <input required="" type="date" class="form-control" name="start">
                                            <div class="input-group-append" >                                              
                                            </div>
                                          </div>
                                        </div>

                                        <div class="form-group">                                          
                                          <label class="label">End</label>
                                          <div class="input-group">
                                            <br>
                                            <input required="" type="date" class="form-control" name="end">
                                            <div class="input-group-append">                                              
                                            </div>
                                          </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                              <button type="submit" class="btn btn-custon-four btn-success">Filter</button>
                                              <a href="{{url("laporanPengeluaran")}}" class="btn btn-custon-four btn-info">Refresh</a>
                                        </div>
                                </form>
                                <br>
                                <h4><strong>Laporan Pengeluaran</strong></h4>
                                <br>
                                <a href="{{url("cetakLaporanPengeluaran/")}}" target="_blank" class="btn btn-custon-four btn-info"><i class="fa fa-print"></i> Cetak Laporan</a>
                                <br><br>
                                <table id="table" data-toggle="table" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Pengeluaran</th>
                                        <th>Tanggal Pengeluaran</th>
                                        <th>Deskrispi</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah</th>                                           
                                    </tr>
                                </thead>
                                
                                <tbody>  
                                @php $no = 1; @endphp
                                @foreach($tamp as $data)                             
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$data ->id}}</td>
                                        <td>{{$data ->tgl_pengeluaran}}</td>
                                        <td>{{$data ->deskripsi_pengeluaran}}</td>
                                        <td>{{$data ->keterangan_pengeluaran}}</td>
                                        <td>Rp. {{number_format($data->jumlah_pengeluaran,0, ".", ".")}}</td>
                                    </tr>
                                @endforeach                                
                              </tbody>
                              <tfoot>
                                  <tr >
                                      <th style="text-align: center;" colspan="4">Total Pengeluaran</th>
                                      <td colspan="2"><strong>Rp. {{number_format($total,0, ".", ".")}}</strong></td>
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
@endsection