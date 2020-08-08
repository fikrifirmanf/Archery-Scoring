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
                    <a href="/panitia/add"><button class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Panitia</button></a>
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
                  <th>No. </th>
                  <th>Nama Panitia</th>
                  <th>Username</th>
                  <th>Kategori</th>
                  <th>Kategori JK</th>
                  <th>Aksi</th>
                  
                </tr>
                </thead>
                <tbody>
                  @php
                      $i=1;
                  @endphp
                @foreach ($panitia as $p)
                <tr>
                <td>{{$i++}}</td>
                <td>{{$p->nama_panitia}}</td> 
                <td>{{$p->username}}</td>
                <td>{{$p->kategori}}</td>
                <td>{{$p->jk_peserta}}</td>            
                <td><a href="/panitia/edit/{{$p->id}}"><button class="btn btn-warning mr-2"><i class="fas fa-edit"></i></button></a><a href="/panitia/del/{{$p->id}}"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a></td>
                  
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