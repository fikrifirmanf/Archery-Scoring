<?php 
foreach($admin as $a){
    $uuid = $a->id;
    $nama = $a->name;
    $username = $a->username;
   
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
                
                <form role="form" method="post" action="edit/proses">
                    {{ csrf_field() }}
                <input type="text" name="uuid" value="{{$uuid}}" hidden id="">
                   <!-- Profile Image -->
                   <div class="row">
                     <div class="col col-md-6">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                src="{{asset('dist/img/user2-160x160.jpg')}}"
                       alt="User profile picture">
                </div>

              <h3 class="profile-username text-center">{{$nama}}</h3>

                <p class="text-muted text-center">{{$username}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <div class="form-group">
                    <label>Nama</label>
                  <input type="text" name="nama" class="form-control" value="{{$nama}}" placeholder="Judul artikel ...">
                  </div>
                  <div class="form-group">
                    <label>Username</label>
                  <input type="text" name="username" class="form-control" value="{{$username}}" placeholder="Judul artikel ...">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" autocomplete="off"   class="form-control"
                        placeholder="********">
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="confirmation"  class="form-control"
                        placeholder="********">
                </div>
                </ul>

                <div class="form-group">
                  <button type="reset" class="btn btn-danger ml-2 float-lg-right">Reset</button><button type="submit" class="btn btn-success float-right">Simpan</button>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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