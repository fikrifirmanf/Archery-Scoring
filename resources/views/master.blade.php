<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  @if (isset($title_page) || isset($title))
<title>{{$title_page}} - {{$title}}</title>
  @else 
  <title>Admin</title>
  @endif
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href={{asset("plugins/fontawesome-free/css/all.min.css")}}>
  
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href={{asset("plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css")}}>
  <!-- iCheck -->
  <link rel="stylesheet" href={{asset("plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}>
  <!-- JQVMap -->
  {{-- <link rel="stylesheet" href={{asset("plugins/jqvmap/jqvmap.min.css")}}> --}}
  <!-- Theme style -->
  <link rel="stylesheet" href={{asset("dist/css/adminlte.min.css")}}>
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href={{asset("plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}>
  <!-- Daterange picker -->
  <link rel="stylesheet" href={{asset("plugins/daterangepicker/daterangepicker.css")}}>
  <!-- summernote -->
  <link rel="stylesheet" href={{asset("plugins/summernote/summernote-bs4.css")}}>
  <!-- Select2 -->
  <link rel="stylesheet" href={{asset("plugins/select2/css/select2.min.css")}}>
  <link rel="stylesheet" href={{asset("plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}>
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href={{asset("plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css")}}>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-user"> {{Session::get('name')}}</i> 
        <i class="fas fa-angle-down right"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="/admin/{{Session::get('uuid')}}"> <span class="dropdown-item dropdown-header">Ubah Profil</span></a>
         <a href="/logout"> <span class="dropdown-item dropdown-header">Logout</span></a>
          
        </div>
      </li>
   
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src={{asset("dist/img/AdminLTELogo.png")}} alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Archery Scoring</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src={{asset("dist/img/user2-160x160.jpg")}} class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Session::get('name')}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview ">
            <a href="/" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard 
              </p>
            </a>
          </li>
          <li class="nav-header">DATA PESERTA</li>
          <li class="nav-item has-treeview ">
            <a href="/peserta/add" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
              <p>
                Tambah Peserta
              </p>
            </a>

          </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Peserta Nasional
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/peserta/nasional/woman" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Putri</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/peserta/nasional/men" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Putra</p>
                </a>
              </li>
              
              
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Peserta Recurve
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/peserta/recurve/woman" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Putri</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/peserta/recurve/men" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Putra</p>
                </a>
              </li>
              
              
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Peserta Compound
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/peserta/compound/woman" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Putri</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/peserta/compound/men" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Putra</p>
                </a>
              </li>
              
            </ul>
          </li>
         
          <li class="nav-item has-treeview ">
            <a href="/kompetisi" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
              <p>
                Hasil Skor
              </p>
            </a>

          </li>
          <li class="nav-header">PENGATURAN</li>
          <li class="nav-item has-treeview ">
            <a href="/artikel" class="nav-link ">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                Artikel 
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview ">
            <a href="/kelas" class="nav-link ">
              <i class="nav-icon fas fa-list-ol"></i>
              <p>
                Kelas 
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview ">
            <a href="/panitia" class="nav-link ">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Panitia 
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview ">
            <a href="/ronde" class="nav-link ">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Ronde 
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview ">
            <a href="/rules" class="nav-link ">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Rules 
              </p>
            </a>
          </li>
          {{-- <li class="nav-item has-treeview ">
            <a href="/target" class="nav-link ">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Target 
              </p>
            </a>
          </li> --}}
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  @yield('konten')
  <footer class="main-footer">
  <strong>Copyright &copy; 2020 <a href="{{url('/')}}">Mahsus Afandi</a>.</strong>
    All rights reserved.
    {{-- <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.4
    </div> --}}
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src={{asset("plugins/jquery/jquery.min.js")}}></script>
<!-- jQuery UI 1.11.4 -->
<script src={{asset("plugins/jquery-ui/jquery-ui.min.js")}}></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap4 Duallistbox -->
<script src={{asset("plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js")}}></script>
<!-- Select2 -->
<script src={{asset("plugins/select2/js/select2.full.min.js")}}></script>
<!-- Bootstrap 4 -->
<script src={{asset("plugins/bootstrap/js/bootstrap.bundle.min.js")}}></script>
<!-- InputMask -->
<script src={{asset("plugins/moment/moment.min.js")}}></script>
<script src={{asset("plugins/inputmask/min/jquery.inputmask.bundle.min.js")}}></script>
<!-- ChartJS -->
{{-- <script src={{asset("plugins/chart.js/Chart.min.js")}}></script> --}}
<!-- Sparkline -->
<script src={{asset("plugins/sparklines/sparkline.js")}}></script>
<!-- JQVMap -->
{{-- <script src={{asset("plugins/jqvmap/jquery.vmap.min.js")}}></script>
<script src={{asset("plugins/jqvmap/maps/jquery.vmap.usa.js")}}></script> --}}
<!-- jQuery Knob Chart -->
{{-- <script src={{asset("plugins/jquery-knob/jquery.knob.min.js")}}></script> --}}
<!-- daterangepicker -->
<script src={{asset("plugins/moment/moment.min.js")}}></script>
<script src={{asset("plugins/daterangepicker/daterangepicker.js")}}></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src={{asset("plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js")}}></script>
<!-- Summernote -->
<script src={{asset("plugins/summernote/summernote-bs4.min.js")}}></script>
<!-- overlayScrollbars -->
<script src={{asset("plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}></script>
<!-- AdminLTE App -->
<script src={{asset("dist/js/adminlte.js")}}></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src={{asset("dist/js/pages/dashboard.js")}}></script> --}}

<!-- DataTables -->
<script src={{asset("plugins/datatables/jquery.dataTables.min.js")}}></script>
<script src={{asset("plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}></script>
<script src={{asset("plugins/datatables-responsive/js/dataTables.responsive.min.js")}}></script>
<script src={{asset("plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}></script>
<!-- bs-custom-file-input -->
<script src={{asset("plugins/bs-custom-file-input/bs-custom-file-input.min.js")}}></script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
    
  $(function () {
    // Summernote
    $('.textarea').summernote({
      height: 500,
    })
  })
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    // //Colorpicker
    // $('.my-colorpicker1').colorpicker()
    // //color picker with addon
    // $('.my-colorpicker2').colorpicker()

    // $('.my-colorpicker2').on('colorpickerChange', function(event) {
    //   $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    // });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })

  </script>
</body>
</html>
