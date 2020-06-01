<?php 
foreach($konten as $k){
    $title_notif = $k->title_notif;
    $body_notif = $k->body_notif;
    $isi_konten = $k->isi_konten;
    $durasi = $k->durasi;
    $uuid = $k->uuid;
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
          <h1>{{$title}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="/konten">Konten</a></li>
            <li class="breadcrumb-item active">{{$title}}</li>
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
                
                <form role="form" method="post" action="proses">
                    {{ csrf_field() }}
                <input type="text" name="uuid" value="{{$uuid}}" hidden id="">
                    <div class="col">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Judul Notifikasi</label>
                        <input type="text" name="title_notif" value="{{$title_notif}}" class="form-control" placeholder="Judul notifikasi ...">
                        </div>
                      </div>
                    <div class="col">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Deskripsi Notifikasi</label>
                          <input type="text" name="body_notif" value="{{$body_notif}}" class="form-control" placeholder="Deskripsi notifikasi ...">
                        </div>
                      </div>
                      <div class="col">
                          <div class="form-group">
                            <label>Editor Konten</label>
                          <!-- /.card-header -->
                          
                              <textarea class="textarea" name="isi_konten" placeholder="Place some text here"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$isi_konten}}</textarea>
                        
                    </div>
                      </div>
                      <div class="col">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Durasi (/jam)</label>
                          <input type="text" value="{{$durasi}}" name="durasi" class="form-control" placeholder="Durasi ...">
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