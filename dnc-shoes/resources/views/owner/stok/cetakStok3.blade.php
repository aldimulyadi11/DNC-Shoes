
<!DOCTYPE html>
<html>
<head>
  <title>Stok Produk</title>
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
    <p>DATA STOK PRODUK <br> www.dnc-shoes.com </p>
    <br>
  </center>
 
  <table class="table1">
    <thead>
        <tr>
          <th>No</th>          
          <th>Stok Toko</th>
        </tr>
      </thead>
      <tbody> 
      @php $i = 1 @endphp
      @foreach($stok as $data)                       
        <tr>  
          <td id="tengah">{{$i++}}</td>
          <td id="tengah">{{ $data -> stok_toko }}</td>
        </tr>

      @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="1" style="text-align: center;font-weight: bold;">Total</td>
          <td style="text-align: center;font-weight: bold;">{{$total_stok}}</td>

        </tr>
      </tfoot>
  </table>
</body>
</html> 
