
<!DOCTYPE html>
<html>
<head>
  <title>Laporan Penjualan</title>
  <style type="text/css">
    .table1 {
          font-family: sans-serif;
          color: #232323;
          border-collapse: collapse;
          width: 100%;
    
      }
       
     /* .table1 tr td{
          Z

      }
       */
      .table1, th, td {
          border:1px solid #999;
          padding: 8px 20px;
          font-size: 11px;
      }
       
      th {
          text-align: center;
      }

      .table1 tr:hover {
          background-color: #f5f5f5;
      }
       
      .table1 th(even) {
          background-color: #f2f2f2;
      }
      p{
        font-size: 10pt;

      }
      #tengah{
        text-align: center;
      }
      .pos{
        text-align: right;
        padding-right: 25px;
      }
      .rek{
        text-align: right;
        padding-top: 30px;
        padding-right: 25px;
      }
  </style>
</head>
<body>
    
  <center>
    <p><strong>LAPORAN PENJUALAN DNC-SHOES<br><br> PERIODE {{$start}} - {{$end}} </strong><br><br> www.dnc-shoes.com </p>
    <br>

  </center>
 
  <table class="table1">
    <thead>
        <tr>
          <th>No</th>
          <th>Kode Penjualan</th>
          <th>Tanggal Penjualan</th>
          <th>Pembeli</th>
          <th>Total</th>
          <th>Jenis  Penjualan</th>

        </tr>
      </thead>
      <tbody> 
      @php $no = 1; @endphp
      @foreach($tamp as $data)                             
          <tr>
              <td id="tengah">{{$no++}}</td>
              <td id="tengah">{{$data ->kode_penjualan}}</td>
              <td id="tengah">{{$data ->tanggal_penjualan}}</td>
              <td>{{$data ->nama_pembeli}}</td>
              <td id="tengah">Rp. {{number_format($data->total_barang,0, ".", ".")}}</td>
              <td>{{$data ->jenis_penjualan}}</td>
          </tr>

      @endforeach    
      </tbody>
      <tfoot>
      <tr >
          <td style="text-align: center;" colspan="4"><strong>Total Penjualan</strong></td>
          <td style="text-align: center;" colspan="2"><strong>Rp. {{number_format($total,0, ".", ".")}}</strong></td>
      </tr>
  </tfoot>  
  </table>
</body>
</html> 
