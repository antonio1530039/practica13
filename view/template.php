<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="view/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="view/dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="view/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="view/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="view/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="view/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="view/plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="view/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="view/plugins/datatables/dataTables.bootstrap4.css">
    <!-- Select2 -->
  <link rel="stylesheet" href="view/plugins/select2/select2.min.css">
</head>
<body>

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php?action=logout" class="nav-link">Logout</a>
      </li>
    </ul>
    
  </nav>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="view/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Inventarios</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="view/dist/img/boxed-bg.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php $control = new MVC(); $control->mostrarInicioController(); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
           <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php" class="nav-link">
                  <i class="nav-icon fa fa-dashboard"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?action=productos" class="nav-link">
                  <i class="nav-icon fa fa-edit"></i>
                  <p>Gestion de Categorias</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?action=productos" class="nav-link">
                  <i class="nav-icon fa fa-tree"></i>
                  <p>Gestion de Productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?action=usuarios" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Gestion de Usuarios</p>
                </a>
              </li>
            </ul>
          </li>
          
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Ejecutar funcion -->
    <?php
    //se crea una instancia de la clase controlador
    $controllerT = new MVC();
    //se ejecuta el metodo enlaces paginas controler que en base al valor de la variable action tomada por el metodo post, se redirecciona a una pagina especificada
    $controllerT->enlacePaginasController();
  ?>
  
  </div>
<!-- ./wrapper -->


</body>

<footer class="main-footer">
    <strong>Copyright &copy; 2018 <a href="http://adminlte.io">UPV</a>.</strong>
    All rights reserved.
    
  </footer>

<!-- jQuery -->
<script src="view/plugins/jquery/jquery.min.js"></script>

<!-- DataTables -->
<script src="view/plugins/datatables/jquery.dataTables.js"></script>
<script src="view/plugins/datatables/dataTables.bootstrap4.js"></script>

<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="view/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="view/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="view/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="view/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="view/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="view/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="view/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="view/dist/js/demo.js"></script>
<!-- Select2 -->
<script src="view/plugins/select2/select2.full.min.js"></script>

<script type="text/javascript">

      //necesario para mostrar dataTables
          $(function () {
            $('.select2').select2();
            $("#example1").DataTable();
            $('#example2').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false
            });
          });
      </script> 

</html>
