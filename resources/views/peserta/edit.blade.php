<?php 
foreach ($peserta as $p) {
  $uuid = $p->uuid;
  $uuid_target = $p->uuid_target;
  $nama_peserta = $p->nama_peserta;
  $jk = $p->jk;
  $kelasnya = $p->kelas;
  $kategorinya = $p->kategori;
  $team = $p->team;

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
                        <li class="breadcrumb-item"><a href="#">Peserta</a></li>
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
                    {{-- <div class="form-group">
                        <label>No Target</label>
                        <select class="form-controller select2" name="uuid_target" style="width: 100%;">
                          @foreach ($target as $t)
                        <option value="{{$t->uuid}}">{{$t->nama_target}}</option>
                          @endforeach
                            
                            
                        </select>
                    </div> --}}
                <input type="text" name="uuid" value="{{$uuid}}" hidden id="">
                    <div class="form-group">
                        <label>No Target</label>
                    <input type="text" name="no_target" value="{{$uuid_target}}" readonly class="form-control"
                            placeholder="Contoh : 1A">
                    </div>
                    <div class="form-group">
                        <label>Nama Peserta</label>
                    <input type="text" name="nama_peserta" value="{{$nama_peserta}}" class="form-control"
                            placeholder="Contoh : Fikri">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control" name="jk" style="width: 100%;">
                            @if ($jk == 'P')
                            <option value="L">Laki-laki</option>
                            <option value="P" selected>Perempuan</option>
                            @else
                            <option value="L" selected>Laki-laki</option>
                            <option value="P">Perempuan</option>   
                            @endif
                            
                        </select>
                    </div>

                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kelas</label>
                        <select class="form-control" name="kelas" style="width: 100%;">

                            @foreach ($kelas as $k)
                            @if ($k->nama_kelas == $kelasnya)
                            <option value="{{$k->nama_kelas}}" selected> {{$k->nama_kelas}}</option>
                            @else
                            <option value="{{$k->nama_kelas}}"> {{$k->nama_kelas}}</option>
                            @endif
                        @endforeach
                    
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Team</label>
                    <input type="text" name="team" value="{{$team}}" class="form-control"
                            placeholder="Contoh : MAJUMUNDUR">
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select class="form-control" name="kategori" style="width: 100%;">
                            @foreach ($kategori as $k)
                            @if ($k->nama_kategori == $kategorinya)
                            <option value="{{$k->nama_kategori}}" selected> {{$k->nama_kategori}}</option>
                            @else
                            <option value="{{$k->nama_kategori}}"> {{$k->nama_kategori}}</option>
                            @endif
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