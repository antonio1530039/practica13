<?php
  //instancia de la clase controlador
  $controller_productos = new MVC();
  //se verifica que se haya iniciado sesion
  $controller_productos->verificarLoginController();

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion de Productos</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>
    <div class="row">
 
      <div>
        <h3>Gestión de Productos</h3>
        <input type="button" name="btn_back" value="Registrar producto" onclick="window.location = 'index.php?action=registro_producto'" class="button tiny success" style="float: right;">
      </div>
        <div>
          <table width="100%">
            <thead>
              <td>Id</td>
              <td>Nombre</td>
              <td>Descripcion</td>
              <td>Precio unitario</td>
              <td>Stock</td>
              <td></td>
              <td></td>
            </thead>
            <tbody>
              <?php 
              //listado de productos
              $controller_productos->getProductosController(); 
               ?>
            </tbody>
          </table>
          
        </div>
      </div>
      <script>
        //funcion de confirmacion en js para confimar el borrado de un registro
        function confirmar(){
          var x = confirm("Seguro que deseas borrrar el registro?");
          if(!x)
            event.preventDefault();
        }

      </script>
    </div>
