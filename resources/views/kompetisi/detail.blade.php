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
              <table  class="table table-bordered table-striped">
                <thead>
                <tr>
                  
                <th>No Target</th>
                <th>Nama Peserta</th>
                <th>Seri 1</th>
                <th>Seri 2</th>
                <th>Seri 3</th>
                <th>Seri 4</th>
                <th>Seri 5</th>
                <th>Seri 6</th>
                <th>Total</th>
                <th>Peringkat</th>
                  {{-- <th>Aksi</th> --}}
                </tr>
                </thead>
                <tbody>
                  
                  @php
                     $i =1; 
                  @endphp
                @foreach ($skor as $p)
                <tr>
                <td>{{$p->no_target}}</td>
                <td>{{$p->nama_peserta}}</td>
                <td>{{$p->seri_1}}</td>
                <td>{{$p->seri_2}}</td>
                <td>{{$p->seri_3}}</td>
                <td>{{$p->seri_4}}</td>
                <td>{{$p->seri_5}}</td>
                <td>{{$p->seri_6}}</td>
                <td>{{$p->total}}</td>
                <td>{{$i++}}</td>
                
                {{-- <td><a href="/kompetisi/add/{{$p->nama_kelas}}/{{$p->jk}}/{{$p->uuid_ronde}}"><button class="btn btn-warning mr-2"><i class="fas fa-plus"></i></button></a><a href="/kompetisi/del/{{$p->nama_kelas}}/{{$p->jk}}/{{$p->uuid_ronde}}"><button class="btn btn-danger mr-2"><i class="fas fa-trash"></i></button></a></td>
                  
                </tr> --}}
                @endforeach
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