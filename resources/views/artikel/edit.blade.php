<?php 
foreach($artikel as $k){
    $judul = $k->judul;
    $isi = $k->isi;
    $uuid = $k->uuid;
    $kat = $k->kategori_artikel;
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
                
                <form role="form" method="post" action="proses">
                    {{ csrf_field() }}
                <input type="text" name="uuid" value="{{$uuid}}" hidden id="">
                    <div class="col">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Judul</label>
                        <input type="text" name="judul" value="{{$judul}}" class="form-control" placeholder="Judul notifikasi ...">
                        </div>
                        <div class="form-group">
                          <label>Kategori</label>
                         <select class="form-control" name="kategori_artikel">
                            @if ($kat == 'Umum')
                            <option value="Petunjuk">Petunjuk</option>
                            <option value="Umum" selected>Umum</option>
                            @else
                            <option value="Petunjuk">Petunjuk</option>
                            <option value="Umum">Umum</option>   
                            @endif
                         </select>
                        </div>
                      </div>
                    <div class="col">
                        <!-- text input -->
                        
                      </div>
                      <div class="col">
                          <div class="form-group">
                            <label>Editor Konten</label>
                          <!-- /.card-header -->
                          
                              <textarea class="textarea" name="isi" placeholder="Place some text here"
                                        style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$isi}}</textarea>
                        
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