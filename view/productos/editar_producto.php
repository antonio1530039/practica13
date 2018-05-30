<?php
  //instancia de la clase controlador
  $controller_productos = new MVC();

  //se verifica que se haya iniciado sesion
  
  $controller_productos->verificarLoginController();
  //se ejecuta el metodo actualizarProductoControler para actualizar el producto seleccionado

  $controller_productos->actualizarProductoController();

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modificacion de Producto</title>
  </head>
  <body>
    <form method="post">
    <div class="row">
      <div>
        <h3>Modificacion de Producto</h3>
        <p>
          Realice los cambios correspondientes y presione Guardar
        </p>
        <input type="button" name="btn_back" value="Regresar" onclick="window.location = 'index.php?action=productos'" class="button tiny success" style="float: right;">
        <hr>
      </div>
        <div>
              <?php
                  //se muestran los datos del producto en os controles
                  $controller_productos->getProductoController();
              ?>
               <input type='submit' name='btn_actualizar' value='Guardar' class='button tiny success' style='float: right;' onclick="confirmar();">
            
            <!--content !-->
        </div>
      </div>
    </div>
    </form>
  </body>
  <script>
      //funcion de confirmacion en caso de guardar los datos
        function confirmar(){
          var x = confirm("Seguro que deseas guardar los datos?");
          if(!x)
            event.preventDefault();
        }


      </script>
  </html>
