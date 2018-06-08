<?php
  //instancia de la clase controlador
  $controller_categoria = new MVC();

  //se verifica que se haya iniciado sesion
  
  $controller_categoria->verificarLoginController();
  //se ejecuta el metodo actualizarProductoControler para actualizar el producto seleccionado

  $controller_categoria->actualizarCategoriaController();

?>


<head>
    <title>Modificación de categoria</title>
  </head>
  <body class="hold-transition login-page">
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Modificación de categoria</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="index.php?action=categorias"> Gestión de Categorias</a></li>
              <li class="breadcrumb-item active">Modificación de categoria</li>
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
          <div class="col-sm-12">
            <!-- general form elements -->
            <div class="card card-primary">
               <div class="card-header">
                        <h3 class="card-title">Realice los cambios correspondientes y de clic en guardar</h3>
                </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body login-card-body">
                    <?php $controller_categoria->getCategoriaController() ?>
                   <input type="submit" name="btn_actualizar" value="Guardar cambios" class="btn btn-success" style="float: right;">
            
               
              </div>   
            </div>
            </div> 
                
              </div>
</div>
</section>
  </body>
  <script>

      </script>
  
  </html>
