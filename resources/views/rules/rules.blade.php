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
                <a href="/rules/add"><button class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Rules</button></a>
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
                  <th>Nama Rules</th>
                  <th>Kategori</th>
                  <th>Jarak (/meter)</th>
                  <th>Jumlah Seri</th>
                  <th>Jumlah Panah</th>
                  
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>      
                @foreach ($rules as $r)
                <tr>
                @if ($r->jk == 'L')
                  <td>{{$r->nama}} <button class="btn bg-gradient-primary btn-xs">Putra</button></td>
                @else
                  <td>{{$r->nama}} <button class="btn bg-gradient-success btn-xs">Putri</button></td>
                @endif
                
               <td>{{$r->nama_kategori}}</td>
                  <td>{{$r->jarak}}</td>
                  <td>{{$r->jml_seri}}</td>
                  <td>{{$r->jml_panah}}</td>
              
                <td><a href="/rules/edit/{{$r->uuid}}"><button class="btn btn-warning mr-2"><i class="fas fa-edit"></i></button></a><a href="/rules/del/{{$r->uuid}}"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a></td>
                  
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