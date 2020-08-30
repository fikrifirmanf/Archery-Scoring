<?php 

foreach($skor as $r){
    $uuid = $r->uuid;
    $nama_peserta = $r->nama_peserta;
    $no_target = $r->no_target;
    $seri_1 = $r->seri_1;
    $seri_2 = $r->seri_2;
    $seri_3 = $r->seri_3;
    $seri_4 = $r->seri_4;
    $seri_5 = $r->seri_5;
    $seri_6 = $r->seri_6;
    $team = $r->team;
    
}

?>

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
                  <form action="proses" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                        <input type="text" name="uuid" hidden value="{{$uuid}}">
                            <div class="form-group">
                                <label>No Target</label>
                            <input type="text" name="no_target" value="{{$no_target}}" readonly class="form-control"
                                    placeholder="0">
                            </div>
                            <div class="form-group">
                                <label>Nama Peserta</label>
                            <input type="text" name="nama_peserta" value="{{$nama_peserta}}" readonly class="form-control"
                                    placeholder="0">
                            </div>
                            
                            

                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Team</label>
                            <input type="text" name="team" value="{{$team}}" readonly class="form-control"
                                    placeholder="0">
                            </div>
                            
                            
                            
                        </div>
                        <!-- /.card -->
                        <!-- /.row -->
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Seri 1</label>
                            <input type="number" name="seri_1" value="{{$seri_1}}" class="form-control"
                                    placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Seri 2</label>
                            <input type="number" name="seri_2" value="{{$seri_2}}" class="form-control"
                                    placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Seri 3</label>
                            <input type="number" name="seri_3" value="{{$seri_3}}" class="form-control"
                                    placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Seri 4</label>
                            <input type="number" name="seri_4" value="{{$seri_4}}" class="form-control"
                                    placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Seri 5</label>
                            <input type="number" name="seri_5" value="{{$seri_5}}" class="form-control"
                                    placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Seri 6</label>
                            <input type="number" name="seri_6" value="{{$seri_6}}" class="form-control"
                                    placeholder="0">
                            </div>
                        </div>   
                        <div class="form-group">
                            <button type="reset" class="btn btn-danger ml-2 float-lg-right">Reset</button><button
                                type="submit" class="btn btn-success float-right">Simpan</button>
                        </div> 
                    </div><!-- /.container-fluid -->
                  </form>
                </div>
            </div>
    </section>
</div>
<!-- Main content -->
<!-- /.content-wrapper -->
@endsection