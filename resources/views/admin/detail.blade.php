<?php 

foreach ($artikel as $k) {
    # code...
    $judul = $k->judul;
    $tanggal = $k->tanggal;
    $isi = $k->isi;
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="/artikel">Artikel</a></li>
              <li class="breadcrumb-item active">{{$title_page}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
        <h3 >{{$judul}}</h3>
        <p style="font-size: 14px"><i class="fas fa-calendar-alt"></i>  {{date('d-m-Y',strtotime($tanggal))}}</p>

          
        </div>
        <div class="card-body">
          {!!$isi!!}
        </div>
        <!-- /.card-body -->
        
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection