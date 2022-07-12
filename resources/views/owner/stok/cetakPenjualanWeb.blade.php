
<!DOCTYPE html>
<html>
<head>
  <title>Cetak Penjualan Web</title>
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
          font-size: 9px;
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
        font-size: 9pt;

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
    <p>DATA PENJUALAN WEB <br> www.dnc-shoes.com </p>
    <br>
  </center>
 
  <table class="table1">
    <thead>
        <tr>                                            
            <th>Tanggal Penjualan</th>
            <th>Pembeli</th>                                            
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Quantiy</th>
            <th>Diskon</th>                            
            <th>Diskon Rp</th>
            <th>Total</th>
            
        </tr>
    </thead>
    
    <tbody> 
    @foreach($tamp as $data)                                       
        <tr>
            <td id="tengah">{{ $data->tanggal_penjualan }}</td>
            <td >{{ $data->nama_pembeli }}</td>
            <td >{{ $data->nama_produk }}</td>
            <td id="tengah">Rp. {{number_format($data->harga_barang,0, ".", ".")}}</td>
            <td id="tengah">{{ $data->jumlah_barang}}</td>
            <td id="tengah">{{ $data->diskon }}</td>
            <td id="tengah">Rp. {{number_format($data->diskon_rp,0, ".", ".")}}</td>
            <td id="tengah">Rp. {{number_format($data->total_barang,0, ".", ".")}}</td>
        </tr>
    @endforeach
    </tbody>
  </table>
</body>
</html> 
