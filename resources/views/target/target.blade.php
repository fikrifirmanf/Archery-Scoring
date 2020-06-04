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
            <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12"> 
        <div class="card">
          
            <div class="card-header">
                <div class="row">
                  <div class="col col-md-3">
                    <a href="/target/add"><button class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Target</button></a>
                  </div>
                  <div class="col col-md-3">
                    <a href="/target/delall"><button class="btn btn-danger"><i class="fas fa-trash"></i> Hapus Semua</button></a></div>  
                   
                  </div>
                    
                  
                </div>
              
              
            <!-- /.card-header -->
            <div class="card-body">
              @php

        $players = array('fikri','firman','f','k');
    $count = count($players);
    $numberOfRounds = log($count / 2, 2);

    // Order players.
    for ($i = 0; $i < $numberOfRounds; $i++) {
        $out = array();
        $splice = pow(2, $i); 

        while (count($players) > 0) {

            $out = array_merge($out, array_splice($players, 0, $splice));
            $out = array_merge($out, array_splice($players, -$splice));

        }            

        $players = $out;
    }

    // Print match list.
    for ($i = 0; $i < $count; $i++) {
        
     
         $p1[] = $players[$i];
         $p2[] = $players[++$i];

    }
    // var_dump( $p1);
    // var_dump($p2);
              @endphp
                @if(Session::has('message'))
                <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>{{Session::get('alert-slogan')}} </strong>{{ Session::get('message') }}</div>
                  @endif
                  
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No Papan</th>
                  <th>Panitia</th>
                  
                </tr>
                </thead>
                <tbody>
                @foreach ($target as $t)
                <tr>
                <td>{{$t->nama_papan}}</td> 
                <td>{{$t->nama_panitia}}</td>            
                
                  
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
    window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);
</script>
@endsection