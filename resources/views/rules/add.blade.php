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
                        <li class="breadcrumb-item"><a href="/rules">Rules</a></li>
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
                                <label>Jumlah Seri</label>
                                <input type="text" name="jml_seri" class="form-control"
                                    placeholder="0">
                            </div>
                            <div class="form-group">
                                <label>Jumlah panah</label>
                                <input type="text" name="jml_panah" class="form-control"
                                    placeholder="0">
                            </div>
                            <div class="form-group">
                                <label>Jarak (/m)</label>
                                <input type="text" name="jarak" class="form-control"
                                    placeholder="0">
                            </div>
                            <div class="form-group">
                                <label>Jumlah peserta</label>
                                <input type="text" name="jml_peserta" class="form-control"
                                    placeholder="0">
                            </div>
                            

                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kelas</label>
                                <select class="form-controllerform-controller select2" name="uuid_kelas" style="width: 100%;">

                                    @foreach ($kelas as $k)
                                <option value="{{$k->uuid}}">{{$k->nama_kelas}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ronde</label>
                                <select class="form-controller select2" name="uuid_ronde" style="width: 100%;">

                                  @foreach ($ronde as $t)
                                  <option value="{{$t->uuid}}">{{$t->nama_ronde}}</option>
                                      @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kategori</label>
                                <select class="form-controller select2" name="uuid_kategori" style="width: 100%;">
                                  @foreach ($kategori as $k)
                                  <option value="{{$k->uuid}}">{{$k->nama_kategori}}</option>
                                      @endforeach
                                </select>
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