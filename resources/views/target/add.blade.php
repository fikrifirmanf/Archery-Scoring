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
                        <li class="breadcrumb-item"><a href="/peserta">Target</a></li>
                        <li class="breadcrumb-item active">{{$title_page}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!--form-controller select2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Form</h3>
                    
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                class="fas fa-times"></i></button>
                    </div>
                </div>
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
                  <form action="add/proses" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            
                            <div class="form-group">
                                <label>Inisial Target</label>
                                <input type="text" name="kat_target" class="form-control"
                                    placeholder="A,B,C,...">
                            </div>
                            <div class="form-group">
                                <label>Jumlah Papan</label>
                                <input type="text" name="jml_papan" class="form-control"
                                    placeholder="5">
                            </div>
                            
                            <div class="form-group">
                                <button type="reset" class="btn btn-danger ml-2 float-lg-right">Reset</button><button
                                    type="submit" class="btn btn-success float-right">Simpan</button>
                            </div>
                        </div>
                        <!-- /.card -->
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                  </form>
                </div>
            </div>
    </section>
</div>
<!-- Main content -->
<!-- /.content-wrapper -->
@endsection