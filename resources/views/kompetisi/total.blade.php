@extends('master')
@section('konten')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$title}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12"> 
        <div class="card">
          
            <div class="card-header">
              
              </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if(Session::has('message'))
                <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>{{Session::get('alert-slogan')}} </strong>{{ Session::get('message') }}</div>
                  @endif
                  {{-- <div class="alert alert-danger">
                    <strong>Danger!</strong> This alert box could indicate a dangerous or potentially negative action.
                  </div> --}}
              <table id="example"  class="table table-bordered">
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
                  <th style="text-align: center">X</th>
                  <th style="text-align: center">10</th>
                  <td style="text-align: center"><b>Rank</b></td>
                
                </tr>   
                @else
                <tr>
                  <th style="text-align: center">No Target</th>
                  <th style="text-align: center">Nama Peserta</th>
                  <th style="text-align: center">Team</th>
                  <th style="text-align: center">Sesi 1</th>
                  <th style="text-align: center">Sesi 2</th>
                  <th style="text-align: center">Total</th>
                  <th style="text-align: center">X</th>
                  <th style="text-align: center">10</th>
                  <td style="text-align: center"><b>Rank</b></td>
                
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
                  <td>{{$p['total_x_all']}}</td>
                  <td>{{$p['total_10_all']}}</td>
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
                  <td>{{$p['total_x_all']}}</td>
                  <td>{{$p['total_10_all']}}</td>
                  <td style="text-align: center">{{$i++}}</td>
                </tr>
                @endif
                @endforeach
                @endif
                
              </tbody>
              </table>
            </div>
            
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>  
  <!-- /.content-wrapper -->
  <script>
    window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);
// $(document).ready(function() {
//     $('#example').DataTable( {
//         "order": [[ 6, "desc" ],[7,"asc"]]
//     } );
// } );
</script>
@endsection