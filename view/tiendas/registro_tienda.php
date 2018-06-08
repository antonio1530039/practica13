<?php

  //instancia de la clase controlador
  $controller_tiendas = new MVC();
  //verificar si el usuario inicio sesion antes
  $controller_tiendas->verificarLoginController("tiendas");
  //registro de tienda al presionar el boton de registrar
  $controller_tiendas->registroTiendaController();

?>

  <head>
    <title>Registro de tienda</title>
  </head>
  <body class="hold-transition login-page">
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Registro de tienda</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="index.php?action=tiendas"> Gestión de Tiendas</a></li>
              <li class="breadcrumb-item active">Registro de tienda</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <form role="form" method="post">
        <div class="row">
          <!-- left column -->
            <!-- general form elements -->
            <div class="col-4"></div>
            <div class="card card-primary">
               <div class="card-header">
                        <h3 class="card-title">Por favor, Ingresa la información de la tienda</h3>
                </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body login-card-body">
                  <div class="form-group">
                    <p>
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Ingresa el nombre de la tienda" required="">
                  </p>
                  </div>
                  <div class="form-group">
                    <p>
                    <label>Direccion</label>
                    <input type="text" class="form-control" name="direccion" placeholder="Ingresa la direccion de la tienda" required="">
                  </p>
                  </div>

                   <input type="submit" name="btn_agregar" value="Registrar" class="btn btn-success" style="float: right;">
            
            </div>   
            </div>
            <!-- -->
              </div>
</div>
</div>
  </form>
</div>
</section>
  </body>

  </html>
