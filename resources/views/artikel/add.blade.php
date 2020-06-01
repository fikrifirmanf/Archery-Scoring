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
              <li class="breadcrumb-item"><a href="/artikel">Artikel</a></li>
            <li class="breadcrumb-item active">{{$title_page}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- right column -->
          <div class="col">
            <!-- general form elements disabled -->
            <div class="card ">
              
              <!-- /.card-header -->
              <div class="card-body">
                @if(Session::has('message'))
                <div class="alert {{ Session::get('alert-class', 'alert-info') }}"><strong>{{Session::get('alert-slogan')}} </strong>{{ Session::get('message') }}</div>
                  @endif
                  @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
                  {{-- <div class="alert alert-danger">
                    <strong>Danger!</strong> This alert box could indicate a dangerous or potentially negative action.
                  </div> --}}
                <form role="form" method="post" action="add/proses">
                    {{ csrf_field() }}
                    <div class="col">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Judul Notifikasi</label>
                          <input type="text" name="judul" class="form-control" placeholder="Judul artikel ...">
                        </div>
                      </div>
                    <div class="col">
                        <!-- text input -->
                        
                      <div class="col">
                          <div class="form-group">
                            <label>Editor Konten</label>
                          <!-- /.card-header -->
                          
                              <textarea class="textarea" name="isi" placeholder="Place some text here"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        
                    </div>
                      </div>
                     
                      <div class="col">
                      <div class="form-group">
                        <button type="reset" class="btn btn-danger ml-2 float-lg-right">Reset</button><button type="submit" class="btn btn-success float-right">Simpan</button>
                      </div>
                    </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection