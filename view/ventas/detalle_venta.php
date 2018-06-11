<?php

  //instancia de la clase controlador
  $controller_ventas = new MVC();
  //verificar si el usuario inicio sesion antes
  $controller_ventas->verificarLoginController();


?>

  <head>
    <title>Detalle de venta</title>
  </head>
  <body class="hold-transition login-page">
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Detalle de venta</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="index.php?action=ventas"> Gestión de Ventas</a></li>
              <li class="breadcrumb-item active">Detalle de venta</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
            <!-- general form elements -->
           <div class="col-md-12">
            <!-- general form elements -->
              <form role="form">
                            <div class="card card-primary">
                <div class="card-body">
                    <?php $controller_ventas->getVentaController(); ?>
              </div>
              </form>

    </div>
</div>
</div>
  </form>
</div>
</section>
  </body>

  </html>
