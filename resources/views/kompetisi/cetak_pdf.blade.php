<!DOCTYPE html>
<html>
<head>
	<title>Cetak Laporan</title>
     {{-- <link href={{asset('assets/bootstrap/css/bootstrap.min.css')}} rel="stylesheet" type="text/css" /> --}}
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
	<p style="font-size: 8">Tanggal cetak : {{date('d-m-Y')}}</p>
	<center>
			{{-- <img src={{asset('assets/img/iconjaski.png')}} alt="logo" class="logo-default" /> --}}
			<h4>Archery Scoring</h4>
				{{-- <p>
					JL. JATISARI 77 PAKEMBARAN, Kabupaten Banyumas, Jawa Tengah
				</p> --}}
				<hr>
				<br>
            <h5>{{$title}}<h5>
				
	</center>
	<div class="float-right">

	</div>
	<br>
<div class="table-responsive-md">
	<table class='table table-bordered'>
		<thead>
			<tr>
                <th style="text-align: center">No Target</th>
                <th style="text-align: center">Nama Peserta</th>
                <th style="text-align: center">Seri 1</th>
                <th style="text-align: center">Seri 2</th>
                <th style="text-align: center">Seri 3</th>
                <th style="text-align: center">Seri 4</th>
                <th style="text-align: center">Seri 5</th>
                <th style="text-align: center">Seri 6</th>
                <th style="text-align: center">Total</th>
                <th style="text-align: center">Peringkat</th>
                  {{-- <th>Aksi</th> --}}
                </tr>
		</thead>
	
                <tbody>
                  
                  @php
                     $i =1; 
                  @endphp
                @foreach ($skor as $p)
                <tr>
                <td style="text-align: center">{{$p->no_target}}</td>
                <td >{{$p->nama_peserta}}</td>
                <td style="text-align: center">{{$p->seri_1}}</td>
                <td style="text-align: center">{{$p->seri_2}}</td>
                <td style="text-align: center">{{$p->seri_3}}</td>
                <td style="text-align: center">{{$p->seri_4}}</td>
                <td style="text-align: center">{{$p->seri_5}}</td>
                <td style="text-align: center">{{$p->seri_6}}</td>
                <td style="text-align: center">{{$p->total}}</td>
                <td style="text-align: center">{{$i++}}</td>
           
                @endforeach
		</tbody>
    </table>
</div>
	

</body>
</html>