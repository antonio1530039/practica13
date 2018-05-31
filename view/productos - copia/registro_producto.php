<?php

  //instancia de la clase controlador
  $controller_productos = new MVC();
  //verificar si el usuario inicio sesion antes
  $controller_productos->verificarLoginController();
  //registro de producto al presionar el boton de registrar
  $controller_productos->registroProductoController();

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro de producto</title>

  </head>
  <body>
    <form method="post">
    <div class="row">
      <div>
        <h3>Registro de producto</h3>
        <p>
          Por favor, ingrese la información que se pide a continuación
        </p>
        <input type="button" name="btn_back" value="Regresar" onclick="window.location = 'index.php?action=productos'" class="button tiny success" style="float: right;">
        <hr>
      </div>
        <div>
            <p>
              <label>Nombre</label>
              <input type="text" name="nombre" placeholder="Nombre del producto" required="">
            </p>

            <p>
              <label>Descripcion</label>
              <input type="text" name="descripcion" placeholder="Descripcion" required="">
            </p>
            <p>
              <label>Precio unitario</label>
              <input type="number" step="0.0000001" name="precio" placeholder="Precio unitario" required="">
            </p>
            <p>
              <label>Stock disponible</label>
              <input type="number" step="1" name="stock" placeholder="Unidades en stock" required="">
            </p>
               <input type="submit" name="btn_agregar" value="Registrar" class="button tiny success" style="float: right;">
            
        </div>
      </div>
    </div>
    </form>
  </body>
  </html>
