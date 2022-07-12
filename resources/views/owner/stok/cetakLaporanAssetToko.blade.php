
<!DOCTYPE html>
<html>
<head>
  <title>Laporan Asset Toko</title>
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
    <p><strong>LAPORAN ASSET TOKO DNC-SHOES<br><br> </strong><br><br> www.dnc-shoes.com </p>
    <br>

  </center>
 
  <table class="table1">
    <thead>
        <tr>
          <th>No</th>
          <th>Nama Produk</th>
          <th>Stok Toko</th>
          <th>Harga </th>
          <th>Jumlah Asset</th>

        </tr>
      </thead>
      <tbody> 
      @php $total = 0; @endphp
      @php $no = 1; @endphp
      @foreach($tamp as $data)                             
          <tr>
              <td id="tengah">{{$no++}}</td>
              <td id="tengah">{{$data ->nama_produk}}</td>
              <td id="tengah">{{$data ->stok_toko}}</td>
              <td>Rp. {{number_format($data->harga_jual,0, ".", ".")}}</td>
              <td>Rp. {{number_format($data->stok_toko*$data->harga_jual)}}</td>
          </tr>
          @php 
            $total += $data->stok_toko*$data->harga_jual;
          @endphp
      @endforeach    
      </tbody>
      <tfoot>
      <tr >
          <td style="text-align: center;" colspan="2"><strong>Total Asset</strong></td>
          <td style="text-align: center;"><strong>{{$toko}}</strong></td>
          <td style="text-align: center;"><strong></strong></td>
          <td style="text-align: center;"><strong>Rp. {{number_format($total)}}</strong></td>
      </tr>
  </tfoot>  
  </table>
</body>
</html> 
