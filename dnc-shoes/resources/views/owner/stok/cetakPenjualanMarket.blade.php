<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cetak Penjualan Market</title>

    <style>
        body{
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color:#333;
            text-align:left;
            font-size:9px;
            margin:-35;
        }

        h3{
            margin-top: 2px;
            text-align: right;
            font-size:8px;

        }
        h4{
            margin-top: -10px;
            font-size: 10px;
        }
        h5{
            margin-top: -10px;
            margin-left: 110px;
            font-size: 10px;
        }


        h1{
            margin:0px;
            font-style: 'Brush Script MT';
            text-align: center;
            font-size:18px;
        }
    </style>
</head>
<body>
    <center>
        <p><strong>DNC -Shoes</strong> <br> www.dnc-shoes.com </p>
    </center>
    <hr>
    
    @foreach($tamp as $data)
    <h4>Tanggal :{{ $data->tanggal_penjualan }}</h4>
    <h4>Pelanggan:{{ $data->nama_pembeli }}</h4>
    @endforeach
    
    <table width="100%">         
        @php $no = 1; @endphp
        <tr>
            <th style="text-align: center">Harga</th>
            <th style="text-align: center">Qty</th>
            <th style="text-align: center">Dis(%)</th>
            <th style="text-align: center">Dis(Rp)</th>
            <th style="text-align: center">Subtotal</th>
        </tr>
        @foreach($tamp as $data)
        <tr>
            <td{{ $no++ }}</td>
            <td colspan="4">{{ $data->nama_produk }}</td>
        </tr>

        <tr>
            <td >Rp. {{number_format($data->harga_barang,0, ".", ".")}}</td>
            <td >{{ $data->jumlah_barang}}</td>
            <td >{{ $data->diskon }}</td>
            <td>Rp. {{number_format($data->diskon_rp,0, ".", ".")}}</td>
            <td >Rp. {{number_format($data->total_barang,0, ".", ".")}}</td>
        </tr>     
        @endforeach
    </table>
    
</body>
</html>
