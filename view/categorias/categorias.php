<?php
  //instancia de la clase controlador
  $controller_categorias = new MVC();
  //se verifica que se haya iniciado sesion
  $controller_categorias->verificarLoginController();

?>
  <head>
    <title>Gestion de Categorias</title>
  </head>
  <body>
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Gestión de Categorias</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active">Gestión de Categorias</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <input type="button" class="btn btn-primary" name="btn_back" value="Registrar categoria" onclick="window.location = 'index.php?action=registro_categoria'" style="float: right;">
                    <br><br>
                  </div>
                  <div class="form-group">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Listado de categorias</h3>
                      </div>
                    <div class="card-body p-0">
                      <br>
                    <div class="table-responsive">
                    <table width="100%" id="example1" class="table table-bordered table-striped">
                      <thead>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th></th>
                        <th></th>
                      </thead>
                      <tbody>
                        <?php 
                        //listado de productos
                        $controller_categorias->getCategoriasController(); 
                         ?>
                      </tbody>
                    </table>
                    </div>
                  </div>
                  </div>
                </div>
              </form>
            </div>    
      <script>
      	
        //funcion de confirmacion en js para confimar el borrado de un registro
        function confirmar(){
          var x = confirm("Seguro que deseas borrar el registro?");
          if(!x)
            event.preventDefault();
        }

      </script>
    </div>
  </body>

