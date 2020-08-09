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
                    {{-- notifikasi form validasi --}}
		@if ($errors->has('file'))
		<span class="invalid-feedback" role="alert">
			<strong>{{ $errors->first('file') }}</strong>
		</span>
		@endif
 
		{{-- notifikasi sukses --}}
		@if ($sukses = Session::get('sukses'))
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button> 
			<strong>{{ $sukses }}</strong>
		</div>
		@endif
 
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
                  <form action="/kompetisi/add/proses" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-5">
                        <input type="text" name="uuid_rules" hidden value="{{$uuid_rules}}">
                            <div class="form-group">
                                <label>Peserta 1</label>
                                <select class="form-control select2bs4" name="uuid_peserta1" style="width: 100%;">

                                    @foreach ($peserta as $p)
                                <option value="{{$p->uuid}}">{{$p->no_target.'-'. $p->nama_peserta}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            
                      
                        <!-- /.card -->
                        <!-- /.row -->
                    </div>
                    <div class="col-md-2">
                        <center>
                            <h3 class="pt-4">vs</h3><br>
                            <div class="form-group">
                                <label>Panitia</label>
                                <select class="form-control select2bs4" name="uuid_panitia" style="width: 100%;">

                                    @foreach ($panitia as $p)
                                <option value="{{$p->id}}">{{$p->nama_panitia}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="reset" class="btn btn-danger ml-2 float-lg-right">Reset</button><button
                                    type="submit" class="btn btn-success float-right">Simpan</button>
                            </div>
                        </center>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Peserta 2</label>
                            <select class="form-control select2bs4" name="uuid_peserta2" style="width: 100%;">
                                @foreach ($peserta as $p)
                            <option value="{{$p->uuid}}">{{$p->no_target.'-'. $p->nama_peserta}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                  
                </div>
            </form>
            </div>
    </section>
</div>
<!-- Main content -->
<!-- /.content-wrapper -->
@endsection