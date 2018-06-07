<?php

class MVC{
  //metodo que muestra la plantilla base
	public function showTemplate(){
		session_start();
		include "view/template.php";
	}

  //metodo encargado de capturar la variable action mediante el metodo get y hace la peticion al modelo para que redireccione a las vistas correspondientes
	public function enlacePaginasController(){
		if(isset($_GET['action'])){
			$enlace = $_GET['action'];
		}else{
			$enlace = 'index';
		}

		//peticion al modelo
		$peticion = Enlaces::enlacesPaginasModel($enlace);
    //mostrar peticion
		include $peticion;
	}

    //metodo que verifica si usuario ha iniciado sesion, si no es asi, redireccion al login
	public function verificarLoginController(){
		//session_start();
		if(isset($_SESSION)){
			if(isset($_SESSION['login'])){
            	if(!$_SESSION['login']){
          			echo "<script>window.location='index.php?action=login';</script>";  
          			//header("Location: index.php?")
          			return false;
            	}else{
            		return true;
            	}
      }else{
        echo "<script>window.location='index.php?action=login';</script>"; 
        return false;
      }
		}else{
			echo "<script>window.location='index.php?action=login';</script>";
			return false;
		}
	}
  
  //metodo especifico para el archivo header.php o navegacion, el cual verifica si el usuario esta logueado, entonces muestra el menu
 public function showNav(){
    if(isset($_SESSION)){
      if(isset($_SESSION['login'])){
         if($_SESSION['login']){
            //verificar si el usurio esta logueado se imprime el menu
            echo "
		   <!-- Navbar -->
		  <nav class='main-header navbar navbar-expand bg-white navbar-light border-bottom'>
		    <!-- Left navbar links -->
		    <ul class='navbar-nav'>
		      <li class='nav-item'>
		        <a class='nav-link' data-widget='pushmenu'><i class='fa fa-bars'></i></a>
		      </li>
		      <li class='nav-item d-none d-sm-inline-block'>
		        <a href='index.php' class='nav-link'>Home</a>
		      </li>
		    </ul>
		    
		  </nav>
		  <!-- Main Sidebar Container -->
		  <aside class='main-sidebar sidebar-dark-primary elevation-4'>
		    <!-- Brand Logo -->
		    <a href='index.php' class='brand-link'>
		      <img src='view/dist/img/AdminLTELogo.png' alt='Logo' class='brand-image img-circle elevation-3'
		           style='opacity: .8'>
		      <span class='brand-text font-weight-light'>Inventarios</span>
		    </a>

		    <!-- Sidebar -->
		    <div class='sidebar'>
		      <!-- Sidebar user panel (optional) -->
		      <div class='user-panel mt-3 pb-3 mb-3 d-flex'>
		        <div class='image'>
		          <img src='view/dist/img/boxed-bg.jpg' class='img-circle elevation-2' alt='User'>
		        </div>
		        <div class='info'>
		          <a href='#' class='d-block'>"; $control = new MVC(); $control->mostrarInicioController(); echo "</a>
		        </div>
		      </div>

		      <!-- Sidebar Menu -->
		      <nav class='mt-2'>
		        <ul class='nav nav-pills nav-sidebar flex-column' data-widget='treeview' role='menu' data-accordion='false'>
		          <!-- Add icons to the links using the .nav-icon class
		               with font-awesome or any other icon font library -->
		          <li class='nav-item has-treeview menu-open'>
		           <ul class='nav nav-treeview'>
		              <li class='nav-item'>
		                <a href='index.php' class='nav-link'>
		                  <i class='nav-icon fa fa-dashboard'></i>
		                  <p>Dashboard</p>
		                </a>
		              </li>
		              <li class='nav-item'>
		                <a href='index.php?action=movimiento_inventario' class='nav-link'>
		                  <i class='nav-icon fa fa-exchange'></i>
		                  <p>Realizar movimiento</p>
		                </a>
		              </li>
		              <li class='nav-item'>
		                <a href='index.php?action=categorias' class='nav-link'>
		                  <i class='nav-icon fa fa-tags'></i>
		                  <p>Gestion de Categorias</p>
		                </a>
		              </li>
		              <li class='nav-item'>
		                <a href='index.php?action=productos' class='nav-link'>
		                  <i class='nav-icon fa fa-cube'></i>
		                  <p>Gestion de Productos</p>
		                </a>
		              </li>
		              <li class='nav-item'>
		                <a href='index.php?action=usuarios' class='nav-link'>
		                  <i class='nav-icon fa fa-users'></i>
		                  <p>Gestion de Usuarios</p>
		                </a>
		              </li>

		              <li class='nav-item'>
		                <a href='index.php?action=logout' class='nav-link' onclick='confirmLogout();'>
		                  <i class='nav-icon fa fa-sign-out'></i>
		                  <p>Logout</p>
		                </a>
		              </li>
		            </ul>
		          </li>
		          
		      </nav>
		      <!-- /.sidebar-menu -->
		    </div>
		    <!-- /.sidebar -->
		  </aside>
		    <!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
            ";
        }else{
        	echo "<div>";
        }
      }
	}
  }

  	//funcion encargada de ingresar los valores del login e iniciar sesion
	public function ingresoUsuarioController(){
		if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['btn_add'])){
			$resultado = Crud::ingresoUsuarioModel($_POST['username'], $_POST['password']); //se ejecuta la funcion del modelo
			//se verifica que lo retornado por el modelo no este vacio
			if(!empty($resultado)){
				$_SESSION['login']=true; //iniciar la variable de sesion login
				$_SESSION['user_info']= $resultado; //guardar los datos del maestro en una sesion
				echo "<script>window.location='index.php';</script>";
			}else{
				//mostrar mensaje en caso de no existir el usuario
				echo "<script>alert('Username o password incorrectos');</script>";
			}
		}
	}
	//funcion que imprime un mensaje en el inicio con el nombre del maestro tomado de la variable sesion
	public function mostrarInicioController(){
		if(isset($_SESSION['user_info'])){
			echo "<center>".$_SESSION['user_info']['user']."</center>";
		}
	}

	//funcion encargada de crear una tabla con los productos registrados en la base de datos
	public function getProductosController(){
		$informacion = Crud::vistaXTablaModel("productos");//ejecucion del metodo del modelo
		if(!empty($informacion)){
			//si el resultado no esta vacio, imprimir los datos de los productos
			foreach ($informacion as $row => $item) {
				$categoria = Crud::getRegModel($item['id_categoria'], "categorias");
				echo "<tr>";
				echo "<td>".$item['id']."</td>";
				echo "<td>".$item['codigo']."</td>";
				echo "<td>".$item['nombre']."</td>";
				echo "<td>".$item['descripcion']."</td>";
				echo "<td>".$item['precio_unitario']."</td>";
				echo "<td>".$item['stock']."</td>";
				echo "<td>".$categoria['nombre']."</td>";
				echo "<td>".$item['fecha_registro']."</td>";
          		echo "<td>"."<a class='btn btn-secondary fa fa-edit' href=index.php?action=editar_producto&id=".$item['id']."></a></td>";
				//echo "<td>"."<a class='btn btn-danger fa fa-trash' href=index.php?action=borrar&tipo=productos&id=".$item['id']."  class='button radius tiny warning' onclick='confirmar();'></a></td>";
        echo "<td>"."<a class='btn btn-danger fa fa-trash' data-href='index.php?action=borrar&tipo=productos&id=".$item['id']."' href='#' class='button radius tiny warning' data-toggle='modal' data-target='#confirm-delete' ></a></td>";  
           
        echo "</tr>";
				
			}
		}
		
	}

	//funcion encargada de crear una tabla con los productos registrados en la base de datos
	public function getHistorialProductos(){
		$informacion = Crud::vistaXTablaModel("transaccion");//ejecucion del metodo del modelo
		//	id	id_producto	id_usuario	cantidad	tipo	fecha	deleted
		if(!empty($informacion)){
			//si el resultado no esta vacio, imprimir los datos de los productos
			foreach ($informacion as $row => $item) {
				$producto = Crud::getRegModel($item['id_producto'], "productos");
				$usuario = Crud::getRegModel($item['id_usuario'], "usuarios");
				echo "<tr>";
				echo "<td>".$item['serie']."</td>";
				echo "<td>".$producto['nombre']."</td>";
				echo "<td>".$usuario['user']."</td>";
				echo "<td>".$item['fecha']."</td>";
				echo "<td>".$item['cantidad']."</td>";
				echo "<td>".$item['tipo']."</td>";


			}
		}
		
	}


	//funcion encargada de crear una tabla con las categorias registrados en la base de datos
	public function getCategoriasController(){
		$informacion = Crud::vistaXTablaModel("categorias");//ejecucion del metodo del modelo
		if(!empty($informacion)){
			//si el resultado no esta vacio, imprimir los datos de las categorias
			foreach ($informacion as $row => $item) {
				echo "<tr>";
				echo "<td>".$item['id']."</td>";
				echo "<td>".$item['nombre']."</td>";
          		echo "<td>"."<a class='btn btn-secondary fa fa-edit' href=index.php?action=editar_categoria&id=".$item['id']."></a></td>";
				//echo "<td>"."<a class='btn btn-danger fa fa-trash' href=index.php?action=borrar&tipo=categorias&id=".$item['id']." class='button radius tiny warning' onclick='confirmar();'></a></td>";
       echo "<td>"."<a class='btn btn-danger fa fa-trash' data-href='index.php?action=borrar&tipo=categorias&id=".$item['id']."' href='#' class='button radius tiny warning' data-toggle='modal' data-target='#confirm-delete' ></a></td>";  
           
        echo "</tr>";
				
			}
		}
		
	}

	//funcion encargada de crear una tabla con los usuarios registrados en la base de datos
	public function getUsuariosController($idUser){
		$informacion = Crud::vistaXTablaModel("usuarios");//ejecucion del metodo del modelo
		if(!empty($informacion)){
			//si el resultado no esta vacio, imprimir los datos de los usuarios
      if(empty($idUser)){
          foreach ($informacion as $row => $item) {
          echo "<tr>";
          echo "<td>".$item['id']."</td>";
          echo "<td>".$item['user']."</td>";
          //para no mostrar la contraseña en texto plano, utilizamos un metodo de encriptacion md5
          echo "<td>".md5($item['password'])."</td>";
          echo "<td>".$item['fecha_registro']."</td>";
                echo "<td>"."<a class='btn btn-secondary fa fa-edit' href=index.php?action=editar_usuario&id=".$item['id']."></a></td>";
          echo "<td>"."<a class='btn btn-danger fa fa-trash' href=index.php?action=borrar&tipo=usuarios&id=".$item['id']." class='button radius tiny warning' onclick='confirmar();'></a></td>";

            echo "</tr>";

        }
      }else{
        foreach ($informacion as $row => $item) {
          if($item['id']!=$idUser){
            echo "<tr>";
          echo "<td>".$item['id']."</td>";
          echo "<td>".$item['user']."</td>";
          //para no mostrar la contraseña en texto plano, utilizamos un metodo de encriptacion md5
          echo "<td>".md5($item['password'])."</td>";
          echo "<td>".$item['fecha_registro']."</td>";
               echo "<td>"."<a class='btn btn-secondary fa fa-edit' href='index.php?action=editar_usuario&id=".$item['id']."'></a></td>";
           
            //echo "<td>"."<a class='btn btn-danger fa fa-trash' href=index.php?action=borrar&tipo=usuarios&id=".$item['id']." class='button radius tiny warning' onclick='confirmar();'></a></td>";
            echo "<td>"."<a class='btn btn-danger fa fa-trash' data-href='index.php?action=borrar&tipo=usuarios&id=".$item['id']."' href='#' class='button radius tiny warning' data-toggle='modal' data-target='#confirm-delete' ></a></td>";  
            echo "</tr>";
          }
          

			}
      }
			
		}
		
	}


 
	//funcion que crea un select con las categorias registradas
	public function getSelectForCategorias($firstID){
		$informacion = Crud::vistaXTablaModel("categorias"); //se obtienen todos las categorias de la bd mediante la conexion al modelo
		if(!empty($informacion)){
			if($firstID==""){
				foreach ($informacion as $row => $item) {
					echo "<option value='".$item['id']."'>".$item['nombre']."</option>";
				}
			}else{
				//se obtiene la informacion del maestro en base al parametro firstID
				$categoria = Crud::getRegModel($firstID, "categorias");
				//se coloca primero la opcion del select del maestro
				echo "<option value='".$categoria['id']."'>".$categoria['nombre']."</option>";
				foreach ($informacion as $row => $item) { //se imprimen los maestros restantes
					if($item['id']!=$firstID)
						echo "<option value='".$item['id']."'>".$item['nombre']."</option>";
				}
			}
			
			
		}
	}

	//funcion que crea un select con los productos registrados
	public function getSelectForProductos(){
		$informacion = Crud::vistaXTablaModel("productos"); //se obtienen todos las categorias de la bd mediante la conexion al modelo
		if(!empty($informacion)){ 
				foreach ($informacion as $row => $item) { //se imprimen los valores
					echo "<option value='".$item['id']."'>".$item['codigo']. " | ".$item['nombre'] ." | " . $item['stock'] . "</option>";
				}
		}
	}



	//funcion encargada de verificar si se presiono un boton de registro, de ser asi, se toman los datos de los controles y se ejecuta la funcion que registra en el modelo
	public function registroProductoController(){
		if(isset($_POST['btn_agregar'])){//verificar clic en el boton
			//crear array con los datos a registrar tomados de los controles
			$data = array('nombre'=> $_POST['nombre'],
						'descripcion'=> $_POST['descripcion'],
						'precio_unitario'=> $_POST['precio'],
						'stock'=> $_POST['stock'],
						'codigo'=> $_POST['codigo'],
						'fecha'=> date("Y-m-d"),
						'categoria'=> $_POST['categoria'],
					);
			//peticion al modelo del reigstro del producto mandando como param la informacion de este
			$registro = Crud::registroProductoModel($data);
			if($registro == "success"){ //verificar la respuesta del modelo
				echo "<script>window.location='index.php?action=productos';</script>";
			}else{
				echo "<script>alert('Error al registrar el producto')</script>";
			}
		}
	}


	//funcion encargada de verificar si se presiono un boton de registro, de ser asi, se toman los datos de los controles y se ejecuta la funcion que registra en el modelo
	public function registroHistorialController(){
		if(isset($_POST['btn_movimiento_entrada']) || isset($_POST['btn_movimiento_salida'])   ){//verificar clic en el boton
			
			//verificar de que tipo fue el movimiento
			if(isset($_POST['btn_movimiento_entrada'])){
				$tipo = "Entrada";
			}else if(isset($_POST['btn_movimiento_salida'])){
				$tipo = "Salida";
			}
			//crear array con los datos a registrar tomados de los controles
			$data = array('id_producto'=> $_POST['producto'],
						'cantidad'=> $_POST['cantidad'],
						'id_usuario'=> $_SESSION['user_info']['id'],
						'fecha'=> date("Y-m-d"),
						'tipo'=> $tipo,
						'serie'=> $_POST['codigo_control'],
					);
			//peticion al modelo del reigstro del producto mandando como param la informacion de este
			$registro = Crud::registroHistorialModel($data);
			if($registro == "success"){ //verificar la respuesta del modelo
				echo "<script>window.location='index.php?action=movimiento_inventario';</script>";
			}else if($registro == "nostock"){
				echo "<script>alert('La transaccion no se realizo, stock insuficiente')</script>";
			}else{
				echo "<script>alert('Error al registrar el movimiento')</script>";
			}
		}
	}



	//funcion encargada de verificar si se presiono un boton de registro, de ser asi, se toman los datos de los controles y se ejecuta la funcion que registra en el modelo
	public function registroCategoriaController(){
		if(isset($_POST['btn_agregar'])){//verificar clic en el boton
			//crear array con los datos a registrar tomados de los controles
			$data = array('nombre'=> $_POST['nombre']
					);
			//peticion al modelo del reigstro del producto mandando como param la informacion de este
			$registro = Crud::registroCategoriaModel($data);
			if($registro == "success"){ //verificar la respuesta del modelo
				echo "<script>window.location='index.php?action=categorias';</script>";
			}else{
				echo "<script>alert('Error al registrar la categoria')</script>";
			}
		}
	}

	//funcion encargada de verificar si se presiono un boton de registro, de ser asi, se toman los datos de los controles y se ejecuta la funcion que registra en el modelo
	public function registroUsuarioController(){
		if(isset($_POST['btn_agregar'])){//verificar clic en el boton
			//crear array con los datos a registrar tomados de los controles
			$data = array('username'=> $_POST['username'],
				'password'=> $_POST['password'],
				'fecha_registro'=> date("Y-m-d")
					);
			//peticion al modelo del reigstro del producto mandando como param la informacion de este
			$registro = Crud::registroUsuarioModel($data);
			if($registro == "success"){ //verificar la respuesta del modelo
				echo "<script>window.location='index.php?action=usuarios';</script>";
			}else{
				echo "<script>alert('Error al registrar el usuario')</script>";
			}
		}
	}


 

	//funcion encargada de, dado un id de un producto, se obtienen los datos de la base de datos y se imprimen los controles con los datos en los valores para editarlos posteriormente
	public function getProductoController(){
		$id = (isset($_GET['id'])) ? $_GET['id'] : ""; //verificacion del id
		$peticion = Crud::getRegModel($id, 'productos'); //peticion al modelo del registro especificado por el id
		if(!empty($peticion)){
			echo "
			<div class='col-sm-6'>
            <!-- general form elements -->
			 <div class='card card-primary'>
               <div class='card-header'>
                        <h3 class='card-title'>Realice los cambios correspondientes y de clic en guardar</h3>
                </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class='card-body login-card-body'>

				<div class='form-group'>
                    <p>
                    <label>Id</label>
                    <input type='text' class='form-control' name='id' value='".$peticion['id']."' placeholder='Ingresa el codigo del producto' required='' readonly='true'>
                  </p>
                  </div>
				<div class='form-group'>
                    <p>
                    <label>Codigo</label>
                    <input type='text' class='form-control' name='codigo' value='".$peticion['codigo']."' placeholder='Ingresa el codigo del producto' required=''>
                  </p>
                  </div>
                  <div class='form-group'>
                    <p>
                    <label>Nombre</label>
                    <input type='text' class='form-control' name='nombre' value='".$peticion['nombre']."' placeholder='Ingresa el nombre del producto' required=''>
                  </p>
                  </div>
                  <div class='form-group'>
                    <p>
                    <label>Descripcion</label>
                    <input type='text' class='form-control' name='descripcion' value='".$peticion['descripcion']."'  placeholder='Ingresa la descripcion del producto' required=''>
                  </p>
                  </div>
                  </div>
                  </div>
                  </div>
			<div class='col-sm-6'>
                  <div class='card card-primary'>
              <!-- /.card-header -->
              <!-- form start -->
                <div class='card-body login-card-body'>
                  <div class='form-group'>
                    <p>
                    <label>Categoria</label>
                    <select class='form-control select2' name='categoria'>";
                      $this->getSelectForCategorias($peticion['id_categoria']);
                    echo "</select>
                  </p>
                  </div>
                  <div class='form-group'>
                    <label>Precio unitario</label>
                        <div class='input-group'>
                      <div class='input-group-prepend'>
                        <span class='input-group-text'>$</span>
                      </div>
                      <input type='number' value='".$peticion['precio_unitario']."'  step='0.0000001'  class='form-control' name='precio' required=''>
                      <div class='input-group-append'>
                        <span class='input-group-text'></span>
                      </div>
                    </div>
                  </div>
                  <div class='form-group'>
                    <label>Stock</label>
                        <div class='input-group'>
                      <div class='input-group-prepend'>
                        <span class='input-group-text'>Unidades</span>
                      </div>
                      <input type='number' step='1' value='".$peticion['stock']."' class='form-control' name='stock' required=''>
                      <div class='input-group-append'>
                        <span class='input-group-text'></span>
                      </div>
                    </div>
                  </div>
                  <input type='submit' name='btn_actualizar' value='Guardar cambios' class='btn btn-success' onclick='confirmar();' style='float: right;'>
                  </div>
                  ";
		}
	}


	//funcion encargada de, dado un id de una categoria, se obtienen los datos de la base de datos y se imprimen los controles con los datos en los valores para editarlos posteriormente
	public function getCategoriaController(){
		$id = (isset($_GET['id'])) ? $_GET['id'] : ""; //verificacion del id
		$peticion = Crud::getRegModel($id, 'categorias'); //peticion al modelo del registro especificado por el id
		if(!empty($peticion)){
			echo "
				<div class='form-group'>
                    <p>
                    <label>Id</label>
                    <input type='text' class='form-control' name='id' value='".$peticion['id']."' placeholder='' required='' readonly='true'>
                  </p>
                  </div>
                  <div class='form-group'>
                    <p>
                    <label>Nombre</label>
                    <input type='text' class='form-control' name='nombre' value='".$peticion['nombre']."' placeholder='Ingresa el nombre de la categoria' required=''>
                  </p>
                  </div>
                  ";
		}
	}

	//funcion encargada de, dado un id de un usuario, se obtienen los datos de la base de datos y se imprimen los controles con los datos en los valores para editarlos posteriormente
	public function getUsuarioController(){
		$id = (isset($_GET['id'])) ? $_GET['id'] : ""; //verificacion del id
		$peticion = Crud::getRegModel($id, 'usuarios'); //peticion al modelo del registro especificado por el id
		if(!empty($peticion)){
			echo "
					<div class='form-group'>
                    <label>Id</label>
                    <input type='text' class='form-control' name='id' value='".$peticion["id"]."' placeholder='Ingresa el username del usuario' required='' readonly='true'>
                  </div>
				<div class='form-group'>
                    <label>Username</label>
                    <input type='text' class='form-control' name='username' value='".$peticion["user"]."' placeholder='Ingresa el username del usuario' required=''>
                  </div>
                  <div class='form-group'>
                    <label>Password</label>
                    <input type='text' class='form-control' name='password' value='".$peticion["password"]."' placeholder='Ingresa la contraseña del usuario' required=''>
                  </div>
                  ";
		}
	}




	//funcion que verifica si se dio clic en el boton de actualizacion y realiza la actualizacon mediante la ejecucion del metodo del modelo
	public function actualizarProductoController(){
		if(isset($_POST['btn_actualizar'])){ //verificacion de clic en el boton
			//se toman los valores de los controles y se guardan en un array
			$data = array(
				"id"=>$_POST['id'],
				"codigo"=>$_POST['codigo'],
				"nombre"=>$_POST['nombre'],
				"descripcion"=>$_POST['descripcion'],
				"precio_unitario"=>$_POST['precio'],
				"stock"=>$_POST['stock'],
				"categoria"=>$_POST['categoria'],
			);

			//se realiza la ejecucion del metodo que actualiza un alumno en el modelo, mandando los parametros correspondientes, datos y matricula
			$peticion = Crud::actualizarProductoModel($data, $_POST['id']);
			if($peticion == "success"){ //verificacion de la respuesta por el modelo
       echo "<script>window.location='index.php?action=productos';</script>";
        
			}else{
				echo "<script>alert('Error al actualizar')</script>";
			}
		}
	}

	//funcion que verifica si se dio clic en el boton de actualizacion y realiza la actualizacon mediante la ejecucion del metodo del modelo
	public function actualizarUsuarioController(){
		if(isset($_POST['btn_actualizar'])){ //verificacion de clic en el boton
			//se toman los valores de los controles y se guardan en un array
			$data = array(
				"username"=>$_POST['username'],
				"password"=>$_POST['password']
			);

			//se realiza la ejecucion del metodo que actualiza un alumno en el modelo, mandando los parametros correspondientes, datos y matricula
			$peticion = Crud::actualizarUsuarioModel($data, $_POST['id']);
			if($peticion == "success"){ //verificacion de la respuesta por el modelo
       echo "<script>window.location='index.php?action=usuarios';</script>";
        
			}else{
				echo "<script>alert('Error al actualizar')</script>";
			}
		}
	}

	//funcion que verifica si se dio clic en el boton de actualizacion y realiza la actualizacon mediante la ejecucion del metodo del modelo
	public function actualizarCategoriaController(){
		if(isset($_POST['btn_actualizar'])){ //verificacion de clic en el boton
			//se toman los valores de los controles y se guardan en un array
			$data = array(
				"nombre"=>$_POST['nombre']
			);

			//se realiza la ejecucion del metodo que actualiza un alumno en el modelo, mandando los parametros correspondientes, datos y matricula
			$peticion = Crud::actualizarCategoriaModel($data, $_POST['id']);
			if($peticion == "success"){ //verificacion de la respuesta por el modelo
       echo "<script>window.location='index.php?action=categorias';</script>";
        
			}else{
				echo "<script>alert('Error al actualizar')</script>";
			}
		}
	}


	//funcion que muestra el dashboard del sistema
	function showDashboard(){
		//mostrar productos sin stock
		$this->setQueryController("productos","Productos sin stock", "stock", "=",0);

		$this->setQueryController("transaccion","Transacciones realizadas hoy", "fecha", "=", date('Y-m-d'));
		
	}


	//funcion setQueryControllerGetNumber, dado un nombre de tabla, un titulo, un campo, un operador y un valor, se ejecuta un metodo de la clase modelo (Crud) el cual, pasando como parametro los valores mencionados, obtiene los registos que cumplan con estas coincidencias en la tabla seleccionada y retorna el numero de registros de la coincidencia
	function setQueryControllerGetNumber($table, $field, $operator, $equals){
		$peticion = Crud::getQueryFromX($table, $field, $operator,$equals); //peticion al modelo
		//se imprime la tabla con informacion
		if(!empty($peticion)){ //se verifica que la variable peticion no este vacia
			return count($peticion);
		}else{
			return 0;
		}
	}



	//funcion setQueryController, dado un nombre de tabla, un titulo, un campo, un operador y un valor, se ejecuta un metodo de la clase modelo (Crud) el cual, pasando como parametro los valores mencionados, obtiene los registos que cumplan con estas coincidencias en la tabla seleccionada y crea una tabla con esta informacion
	function setQueryController($table, $title, $field, $operator, $equals){
		$peticion = Crud::getQueryFromX($table, $field, $operator,$equals); //peticion al modelo
		//se imprime la tabla con informacion
		echo "<div class='form-group'>
					<div class='card-header'>
                        <h3 class='card-title'>$title (".count($peticion).")</h3>
                      </div>
                    <div class='card'>";
		echo "<table width='100%' class='table table-bordered table-striped'>";
			echo "<thead>";
				echo "<tr>";
					if($table=="transaccion"){
						echo "<th>Productos</th>";
						echo "<th>Cantidad</th>";
						echo "<th>Tipo de transaccion</th>";
						echo "<th>Fecha</th>";
						echo "<th>Realizada por</th>";
					}else{
						echo "<th>$title: ".count($peticion)."</th>";
						echo "<th>$field</th>";
					}
					
				echo "</tr>";
			echo "</thead>";
		echo "<tbody>";
		if(!empty($peticion)){ //se verifica que la variable peticion no este vacia
			echo "<tbody>";
			foreach ($peticion as $row => $item) {
				echo "<tr>";
				if($table == "transaccion"){
					$producto = Crud::getRegModel($item['id_producto'],"productos");
					echo "<td>".$producto['nombre']."</td>";
					echo "<td>".$item["cantidad"]."</td>";
					echo "<td>".$item["tipo"]."</td>";
					echo "<td>".$item["fecha"]."</td>";
					$usuario = Crud::getRegModel($item['id_usuario'],"usuarios");
					echo "<td>".$usuario["user"]."</td>";
				}else{
					echo "<td>".$item['nombre']."</td>";
					echo "<td>".$item[$field]."</td>";
				}
				
				echo "</tr>";
      		}
      		
		}
		echo "</tbody>";
      		echo "</table>";
      		echo "</div>";
      		echo "</div>";
	}


	//Funcion que dado un id y nombre de tabla, ejecuta el metodo del modelo y borra el registro especificado en base a la tabla
	public function borrarController($id, $tabla){
		//se ejecuta el metodo borrar del modelo mandando como paremtros los explicados anteriormente
		$peticion = Crud::borrarXModel($id, $tabla);
		if($peticion == "success"){ //verificar respuesta
			echo "<script>window.location='index.php?action=".$tabla."';</script>";
		}else{
			echo "<script>alert('Error al borrar')</script>";
		}
	}



}





?>