{{-- Menghubungkan dengan template master --}}
@extends('master')

{{-- Bagian konten --}}
@section('konten')
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <h3>{{$jml_peserta}}</h3>

                <p>Total Peserta</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <h3>{{$peserta_nasional}}</h3>

                <p>Peserta Nasional</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$peserta_compound}}</h3>

                <p>Peserta Compound</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$peserta_recurve}}</h3>

                <p>Peserta Recurve</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        @foreach ($artikel as $a)
      <a href="/artikel/detail/{{$a->uuid}}" target="_blank" data-isi="dasdasd" id="petunjuk"><div style="height: 50px" class="alert alert-info alert-dismissible">
          <button type="button" class="close"  data-dismiss="alert" aria-hidden="true">&times;</button>
        <p><i class="icon fas fa-info"></i> Info! {{$a->judul}}</p>
      </div></a>
       
        @endforeach
       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
    //on delete button click this function call
    $(document).on("click", "#petunjuk", function () {  
      var isi = $(this).attr('data-isi');   //data-id of delete button
      $(".modal-body #isinya").val(isi);
      console.log(isi); //set to model field
    })
    </script> 
  <div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p id="isinya"></p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->  
  
  @endsection