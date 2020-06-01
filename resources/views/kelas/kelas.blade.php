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
                <div class="row">
                  <div class="col col-md-3">
                    <a href="/kelas/add"><button class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Kelas</button></a>
                  </div>
                  {{-- <div class="col col-md-3">
                    <a href="/panitia/delall"><button class="btn btn-danger"><i class="fas fa-trash"></i> Hapus Semua</button></a></div>   --}}
                   
                  </div>
                    
                  
                </div>
              
              
            <!-- /.card-header -->
            <div class="card-body">
             
                @if(Session::has('message'))
                <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>{{Session::get('alert-slogan')}} </strong>{{ Session::get('message') }}</div>
                  @endif
                  
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Kelas</>
                  <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                 
                @foreach ($kelas as $p)
                <tr>
                
                <td>{{$p->nama_kelas}}</td> 
                    
                <td><a href="/kelas/edit/{{$p->uuid}}"><button class="btn btn-warning mr-2"><i class="fas fa-edit"></i></button></a><a href="/kelas/del/{{$p->uuid}}"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a></td>
                  
                </tr>
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