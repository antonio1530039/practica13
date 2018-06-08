<?php

  //instancia de la clase controlador
  $controller_usuarios = new MVC();
  //verificar si el usuario inicio sesion antes
  $controller_usuarios->verificarLoginController();
  //registro de producto al presionar el boton de registrar
  $controller_usuarios->registroUsuarioController();

?>

  <head>
    <title>Registro de usuario</title>
  </head>
  <body class="hold-transition login-page">
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Registro de usuario</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="index.php?action=usuarios"> Gestión de Usuarios</a></li>
              <li class="breadcrumb-item active">Registro de usuario</li>
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
                        <h3 class="card-title">Por favor, Ingresa la información del usuario</h3>
                </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body login-card-body">
                  <div class="form-group">
                    <p>
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Ingresa el username del usuario" required="">
                  </p>
                  </div>
                  <div class="form-group">
                    <p>
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Ingresa la contraseña del usuario" required="">
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
