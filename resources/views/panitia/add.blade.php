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
                        <li class="breadcrumb-item"><a href="/panitia">Panitia</a></li>
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
 
		<button type="button" class="btn btn-primary mr-5 mb-3" data-toggle="modal" data-target="#importExcel">
			<i class="fa fa-upload"></i> IMPORT EXCEL
		</button>
 
		<!-- Import Excel -->
		<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="/peserta/import_excel" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
						</div>
						<div class="modal-body">
 
							{{ csrf_field() }}
 
							<label>Pilih file data peserta</label>
							<div class="form-group">
								<input type="file" name="file" required="required">
							</div>
 
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-primary">Import</button>
						</div>
					</div>
				</form>
			</div>
		</div>
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
                                <label>Nama Panitia</label>
                                <span class="required"> * </span>
                                <input type="text" name="nama_panitia" required class="form-control"
                                    placeholder="Contoh : Dakir">
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <span class="required"> * </span>
                                <input type="text" name="username" required class="form-control"
                                    placeholder="Contoh : dakirun">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <span class="required"> * </span>
                                <input type="password" name="password"  class="form-control"
                                    placeholder="********">
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <span class="required"> * </span>
                                <input type="password" name="confirmation"  class="form-control"
                                    placeholder="********">
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