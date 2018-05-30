<?php
  //instancia de la clase controlador
  $controller_dashboard = new MVC();
  //se verifica que se haya iniciado sesion
  $controller_dashboard->verificarLoginController();

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>
    <div class="row">
 
      <div>
        <h3>Dashboard</h3>
      </div>
        <div>
            <br>
        
              <?php 
              //listado de productos
              $controller_dashboard->showDashboard(); 
               ?>
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
