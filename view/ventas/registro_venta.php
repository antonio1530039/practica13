<?php

  //instancia de la clase controlador
  $controller_ventas = new MVC();
  //verificar si el usuario inicio sesion antes
  $controller_ventas->verificarLoginController();
  //registro de tienda al presionar el boton de registrar
  $controller_ventas->registroVentaController();

?>

  <head>
    <title>Registro de venta</title>
  </head>
  <body class="hold-transition login-page">
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Registro de venta</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="index.php?action=ventas"> Gestión de Ventas</a></li>
              <li class="breadcrumb-item active">Registro de venta</li>
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
            <div class="col-12">
            <div class="card card-primary">
               <div class="card-header">
                        <h3 class="card-title"></h3>
                </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body login-card-body">
                   <div class="col-12">

                        <div class="row">

                        <div class="col-5">
                        <div class="form-group">
                          <label>Seleccione un producto:</label>
                            <select class="form-control select2" name="producto" required="" id="selectProductos">
                              <?php $controller_ventas->getSelectForProductos("ventas"); ?>
                            </select>
                        </div>
                        </div>

                        <div class="col-2">
                        <div class="form-group">
                          <label>Cantidad: </label>
                            <input class="form-control" type="number" step="1" min="1" id="cant" value="1" name="cantidad" placeholder="Cantidad">
                        </div>
                        </div>

                        <div class="col-5">
                          <label>Operacion:</label><br>
                             <button type="button" onclick="agregarProducto();" name="btn" class="btn btn-info">Agregar producto</button>
                             <button type="button" onclick="borrarUltimoProducto();" name="btn" class="btn btn-danger">Quitar ultimo producto</button>
                        </div>

                        </div>

                    </div>
                  <div class="row">
                  <div class="col-3">
                    <h3 style="color:green">Total de venta: $ </h3>
                  </div>
                  <div class="col-9">
                  <input type="text" name="total" id="total" value="0.0"  class="form-control" style="text-align: center;">
                  </div>
                  </div>
                  <br><label>Productos en venta</label>
                  <div class="form-group">
                   <div class="table-responsive">
                    <table width="100%" id="tablaProductos" class="table table-bordered table-striped">
                      <thead>
                        <th>Id Producto</th>
                        <th>Producto</th>
                        <th>Precio unitario</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    </div>
                  </div>
                  <div style="float:right">
                    
                   <input type="submit" name="x" value="Cancelar" class="btn btn-danger">
                   <input type="submit" name="btn_registrar" value="Registrar venta" onclick="verifyVenta();" class="btn btn-success">
                  </div>
                   
            
            </div>   
            </div>
            </div>
            <!-- -->
              </div>
</div>
</div>
  </form>
</div>
</section>

<script type="text/javascript">

  //tomar el elemento select que tiene los productos
  var select = document.getElementById("selectProductos");
      //tomar la variable de sesion que contiene los productos
  var raw_productos = <?php echo json_encode($_SESSION['temp_productos']); ?>;
  //asignar la tabla a un elemento para manipularla
  var tablaProductos = document.getElementById("tablaProductos");
  var label_total = document.getElementById("total");
  var cont = 0;
  var totalVenta = 0.0;



  //funcion que dado un id de producto - calcula la cantidad que hay en la tabla de productos (de la venta)
  function calcCant(idProducto){
    var c = 0;
    for(var i = 0; i<cont; i++){
      if( parseInt(document.getElementById("id"+i).value) == parseInt(idProducto) ){
        c = c + parseInt(document.getElementById("cantidad"+i).value)
      }
    }
    return c;
  }





  //funcion que agrega el producto  seleccionado en el select2

  function agregarProducto(){
    //tomar la cantidad del control
    var cant = document.getElementById("cant").value;
    //crear una fila

    if(cant != "" && parseInt(cant) > 0){
      if( (parseInt(cant) + calcCant(raw_productos[parseInt(select.value)]['id'])) <= raw_productos[parseInt(select.value)]['stock'] ){

       if(!agroup(raw_productos[select.value]['id'])){//si no existe ya en la tabla, se agrega el producto
          //crear columnas
            var fila = document.createElement("tr");
           var cId = document.createElement("td");
          var cNombre = document.createElement("td");
          var cPrecio = document.createElement("td");
          var cCantidad = document.createElement("td");
          var cSubtotal = document.createElement("td");

          //crear una caja de texto para cada columna y asignarle su correspondiente valor
          //select.value contiene el id del producto
          var tId = document.createElement("input");
          tId.setAttribute("readonly", "true");
          tId.setAttribute("name", "id"+cont);
          tId.setAttribute("id", "id"+cont);
          tId.setAttribute("value", raw_productos[select.value]['id']);

          var tNombre = document.createElement("input");
          tNombre.setAttribute("readonly", "true");
          tNombre.setAttribute("name", "nombre"+cont);
          tNombre.setAttribute("id", "nombre"+cont);
          tNombre.setAttribute("value", raw_productos[select.value]['nombre']);

          var tPrecio = document.createElement("input");
          tPrecio.setAttribute("readonly", "true");
          tPrecio.setAttribute("name", "precio"+cont);
          tPrecio.setAttribute("id", "precio"+cont);
          tPrecio.setAttribute("value", raw_productos[select.value]['precio_unitario']);


        var tCantidad = document.createElement("input");
          tCantidad.setAttribute("readonly", "true");
          tCantidad.setAttribute("name", "cantidad"+cont);
          tCantidad.setAttribute("id", "cantidad"+cont);
          tCantidad.setAttribute("value", cant);

           var tsubtotal = document.createElement("input");
          tsubtotal.setAttribute("readonly", "true");
          tsubtotal.setAttribute("name", "subtotal"+cont);
          tsubtotal.setAttribute("id", "subtotal"+cont);

          tsubtotal.setAttribute("value", Number(cant) * Number(raw_productos[select.value]['precio_unitario']));

          cId.appendChild(tId);
          cNombre.appendChild(tNombre);
          cPrecio.appendChild(tPrecio);
          cCantidad.appendChild(tCantidad);
          cSubtotal.appendChild(tsubtotal);

          fila.appendChild(cId);
          fila.appendChild(cNombre);
          fila.appendChild(cPrecio);
          fila.appendChild(cCantidad);
          fila.appendChild(cSubtotal);

          tablaProductos.appendChild(fila);
          cont++;
         calcularTotal();
       }
     }else{
        swal("Stock insuficiente","Producto agotado","warning");
       }
    
    

    }else{
      swal("Ingresa la cantidad del producto","Asegurate de que la cantidad sea un valor mayor a 0","info");
    }
   
    //swal("",raw_productos[0]["nombre"],"info");
  }

  //funcion que calcula el total de la venta
  function calcularTotal(){
    var sum = 0.0
    if(cont == 0){
       totalVenta = 0.0;
        document.getElementById("total").value = totalVenta;
       return false;
    }else{
      for(var i = 0; i<cont ; i++){
        sum += Number(document.getElementById("subtotal"+i).value);
      }
      totalVenta = sum;
    }
           document.getElementById("total").value = totalVenta;
    
  }

  //funcion que elimina la ultima fila de la tabla de productos
  function borrarUltimoProducto(){
    if(cont != 0 ){
      tablaProductos.removeChild(tablaProductos.lastChild);
      cont--;
      calcularTotal();
    }else{
      calcularTotal();
      swal("No hay productos agregados a la venta","","info");
    
    }
    
  }

  //funcion que agrupa los productos
  function agroup(idProd){

    for(var i = 0; i<cont; i++){
      if(parseInt(document.getElementById("id"+i).value) == parseInt(idProd)){
         //if( ( parseInt(document.getElementById("cant").value) + calcCant(parseInt(idProd) ) ) <= raw_productos[parseInt(idProd)]['stock'] ){
         document.getElementById("cantidad"+i).value = Number(document.getElementById("cantidad"+i).value) + Number(document.getElementById("cant").value);
         document.getElementById("subtotal"+i).value = Number(document.getElementById("subtotal"+i).value) + Number(document.getElementById("precio"+i).value * Number(document.getElementById("cant").value));
                   //cont++;
          calcularTotal();
         return true;
      // }else{
        //  swal("Stock insuficiente","Producto agotado","warning");
          //return true;
        //}
       }

    }
    return false;
  }
  //funcion que verifica que al menos se haya agregado un producto a al venta
  function verifyVenta(){
    if(cont == 0){
      event.preventDefault();
      swal("Ingresa al menos un producto a la venta","","warning");
    }
  }





</script>
  </body>

  </html>
