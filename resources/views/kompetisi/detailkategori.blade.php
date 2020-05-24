@extends('master')
@section('konten')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$title_page}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="/kompetisi">Kompetisi</a></li>
            <li class="breadcrumb-item active">{{$title_page}}</li>
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
                  <th>Babak</th>
                  <th>Jumlah Peserta</th>
                  <th>Generate Peserta</th>
                </tr>
                </thead>
                <tbody>
                  
                  
                @foreach ($rules as $p)
                <tr>
                <td><a href="/kompetisi/detail/{{$p->nama.' '.$p->nama_kategori}}/{{$p->uuid}}">{{$p->nama.' '.$p->nama_kategori}}</a></td>
                <td>{{$p->jml_peserta}}</td>
                <td><a href="/kompetisi/add/{{$p->nama_kelas}}/{{$p->jk}}/{{$p->nama_kategori}}/{{$p->uuid}}"><button class="btn btn-warning mr-2"><i class="fas fa-plus"></i></button></a><a href="/kompetisi/del/{{$p->nama_kelas}}/{{$p->jk}}/{{$p->uuid_ronde}}"><button class="btn btn-danger mr-2"><i class="fas fa-trash"></i></button></a></td>
                  
                </tr>
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