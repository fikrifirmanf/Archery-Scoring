<!DOCTYPE html>
<html>
<head>
	<title>Cetak Laporan</title>
     {{-- <link href={{asset('assets/bootstrap/css/bootstrap.min.css')}} rel="stylesheet" type="text/css" /> --}}
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
  
     <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <style>
    html {
      margin: 1cm
    }
    th,td {
      font-size: 11px
    }
  </style>
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
<div id="example" class="table-responsive-md">
	<table class='table table-bordered'>
		<thead>
      @if (strpos($nama_babak,'Total'))
      <thead>
                
        @if ($totalall[0]['nama_kategori'] == 'Nasional')
                <tr>
                  <th style="text-align: center">No Target</th>
                  <th style="text-align: center">Nama Peserta</th>
                  <th style="text-align: center">Team</th>
                  <th style="text-align: center">Jarak 30</th>
                  <th style="text-align: center">Jarak 40</th>
                  <th style="text-align: center">Jarak 50</th>
                  <th style="text-align: center">Total</th>
                  <td style="text-align: center"><b>Peringkat</b></td>
                
                </tr>   
                @else
                <tr>
                  <th style="text-align: center">No Target</th>
                  <th style="text-align: center">Nama Peserta</th>
                  <th style="text-align: center">Team</th>
                  <th style="text-align: center">Sesi 1</th>
                  <th style="text-align: center">Sesi 2</th>
                  <th style="text-align: center">Total</th>
                  <td style="text-align: center"><b>Peringkat</b></td>
                
                </tr>    
                @endif         
        </thead>
        <tbody>                
          @php
                     $i =1; 
                  @endphp 
        @if (isset($totalall))
        @foreach ($totalall as $p)              
        @if ($p['nama_kategori'] == 'Nasional')     
                <tr>
                  <td style="text-align: center">{{$p['no_target']}}</td>
                  <td>{{$p['nama_peserta']}}</td>
                  <td>{{$p['team']}}</td>
                  <td>{{$p['sesi1']}}</td>
                  <td>{{$p['sesi2']}}</td>
                  <td>{{$p['sesi3']}}</td>
                  <td style="text-align: center">{{$p['total_all']}}</td>
                  <td style="text-align: center">{{$i++}}</td>
                </tr>
                @else
                <tr>
                  <td style="text-align: center">{{$p['no_target']}}</td>
                  <td>{{$p['nama_peserta']}}</td>
                  <td>{{$p['team']}}</td>
                  <td>{{$p['sesi1']}}</td>
                  <td>{{$p['sesi2']}}</td>
                  <td style="text-align: center">{{$p['total_all']}}</td>
                  <td style="text-align: center">{{$i++}}</td>
                </tr>
                @endif
        @endforeach
        @endif
        
      </tbody>  
      @else
      <tr>
        <th style="text-align: center">No Target</th>
        <th style="text-align: center">Nama Peserta</th>
        <th style="text-align: center">Team</th>
        <th style="text-align: center">Seri 1</th>
        <th style="text-align: center">Seri 2</th>
        <th style="text-align: center">Seri 3</th>
        <th style="text-align: center">Seri 4</th>
        <th style="text-align: center">Seri 5</th>
        <th style="text-align: center">Seri 6</th>
        <th style="text-align: center">Total X</th>
        <th style="text-align: center">Total 10</th>
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
        <td >{{$p->team}}</td>
        <td style="text-align: center">{{$p->seri_1}}</td>
        <td style="text-align: center">{{$p->seri_2}}</td>
        <td style="text-align: center">{{$p->seri_3}}</td>
        <td style="text-align: center">{{$p->seri_4}}</td>
        <td style="text-align: center">{{$p->seri_5}}</td>
        <td style="text-align: center">{{$p->seri_6}}</td>
        <td style="text-align: center">{{$p->total_x}}</td>
        <td style="text-align: center">{{$p->total_10}}</td>
        <td style="text-align: center">{{$p->total}}</td>
        <td style="text-align: center">{{$i++}}</td>
   
        @endforeach
</tbody>  
      @endif
		
    </table>
</div>
	
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
</body>
</html>