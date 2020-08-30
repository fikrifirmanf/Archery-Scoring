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
              <table  class="table table-bordered">
                <thead>
                  @if (strpos($title, 'Kualifikasi') != false)
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
                  <th style="text-align: center">Total</th>
                  <th style="text-align: center">Peringkat</th>
                  <th style="text-align: center">Aksi</th>
                </tr>
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
                  <th style="text-align: center">Total</th>
                  <th style="text-align: center">Aksi</th>
                </tr>
                @endif
                </thead>
                <tbody>
                  
                  @php
                     $i =1; 
                  @endphp
                @foreach ($skor as $key => $p)
                @if (strpos($title, 'Kualifikasi') != false)
                <tr>
                  <td style="text-align: center">{{$p->no_target}}</td>
                  <td>{{$p->nama_peserta}}</td>
                  <td>{{$p->team}}</td>
                  <td style="text-align: center">{{$p->seri_1}}</td>
                  <td style="text-align: center">{{$p->seri_2}}</td>
                  <td style="text-align: center">{{$p->seri_3}}</td>
                  <td style="text-align: center">{{$p->seri_4}}</td>
                  <td style="text-align: center">{{$p->seri_5}}</td>
                  <td style="text-align: center">{{$p->seri_6}}</td>
                  <td style="text-align: center">{{$p->total}}</td>
                  <td style="text-align: center">{{$i++}}</td>
                <td style="text-align: center"><a href="/kompetisi/update/{{$p->uuid}}"><button class="btn btn-warning"><i class="fa fa-edit"></i></button></a></td>
      
                </tr>
                @else
                <tr>
                  <td style="text-align: center">{{$p->no_target}}</td>
                  <td>{{$p->nama_peserta}}</td>
                  <td>{{$p->team}}</td>
                  <td style="text-align: center">{{$p->seri_1}}</td>
                  <td style="text-align: center">{{$p->seri_2}}</td>
                  <td style="text-align: center">{{$p->seri_3}}</td>
                  <td style="text-align: center">{{$p->seri_4}}</td>
                  <td style="text-align: center">{{$p->seri_5}}</td>
                  <td style="text-align: center">{{$p->seri_6}}</td>
                  <td style="text-align: center">{{$p->total}}</td>
                  <td style="text-align: center"><a href="/kompetisi/update/{{$p->uuid}}"><button class="btn btn-warning"><i class="fa fa-edit"></i></button></a></td>
                </tr>
                  @if ($key % 2 != 0)
                  
                  <tr>
                    <td colspan="9" style="text-align: center"><b>{{$i++}}</b></td>
        
                  </tr>
                  @endif
                @endif
                @endforeach
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
</script>
@endsection