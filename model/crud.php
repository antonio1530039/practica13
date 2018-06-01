<?php
//se incluye el archivo de conexion
require_once "conexion.php";
//clase modelo llamada Crud que hereda las propiedades y metodos de la clase Conexion
class Crud extends Conexion{
	
	//metodo ingresoUsuarioModel: dado un email y una contrasena, se realiza un select en la base de datos de maestros y reotrna el resultado, esto para verificar si coincide con una cuenta de un maestro registrada
	public function ingresoUsuarioModel($user, $password){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE user = :user and password = :password and deleted=0"); //se prepara la conexion
		//definicion de parametros
		$stmt->bindParam(":user", $user);
		$stmt->bindParam(":password",$password);
		$stmt->execute(); //ejecucion mediante pdo
		return $stmt->fetch(); //se retorna lo asociado a la consulta
		$stmt->close();
	}

	//metodo vistaXTablaModel: dado un nombre de tabla realiza un select y retorna el contenido de la tabla, considerando solamente registros no borrados.
	public function vistaXTablaModel($table){
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE deleted=0"); //preparacion de la consulta SQL 
		$stmt->execute(); //ejecucion de la consulta
		return $stmt->fetchAll(); //se retorna en un array asociativo el resultado de la consulta
		$stmt->close();

	}

	//metodo registroProductoModel: dado un arreglo asociativo de datos, se inserta en la tabla productos los datos especificados
	public function registroProductoModel($data){
		$stmt = Conexion::conectar()->prepare("INSERT INTO productos(codigo, nombre, descripcion, precio_unitario, stock, fecha_registro, id_categoria) VALUES(:codigo, :nombre, :descripcion, :precio_unitario, :stock, :fecha, :categoria)");
		//preparacion de parametros
		$stmt->bindParam(":codigo", $data['codigo']);
		$stmt->bindParam(":nombre", $data['nombre']);
		$stmt->bindParam(":descripcion", $data['descripcion']);
		$stmt->bindParam(":precio_unitario", $data['precio_unitario']);
		$stmt->bindParam(":stock", $data['stock']);
		$stmt->bindParam(":fecha", $data['fecha']);
		$stmt->bindParam(":categoria", $data['categoria']);
		if($stmt->execute()) //ejecucion
			return "success"; //respuesta
		else
			return "error";
		$stmt->close();
	}

	//metodo registroCategoriaModel: dado un arreglo asociativo de datos, se inserta en la tabla categorias los datos especificados
	public function registroCategoriaModel($data){
		$stmt = Conexion::conectar()->prepare("INSERT INTO categorias(nombre) VALUES(:nombre)");
		//preparacion de parametros
		$stmt->bindParam(":nombre", $data['nombre']);
		if($stmt->execute()) //ejecucion
			return "success"; //respuesta
		else
			return "error";
		$stmt->close();
	}

	//metodo registroTutoriaModel: dado un arreglo asociativo de datos de una tutoria, se inserta en la tabla sesion_tutoria los datos mandados
  public function registroTutoriaModel($data){
		$stmt = Conexion::conectar()->prepare("INSERT INTO sesion_tutoria(maestro, fecha, hora, tipo_tutoria, tutoria_informacion) VALUES(:maestro, :fecha, :hora, :tipo_tutoria, :tutoria_informacion)"); //se prepara la conexion con la sentencia SQL a ejecutar
		//preparacion de los parametros
		$stmt->bindParam(":maestro", $data['maestro']);
		$stmt->bindParam(":fecha", $data['fecha']);
		$stmt->bindParam(":hora", $data['hora']);
    $stmt->bindParam(":tipo_tutoria", $data['tipo']);
    $stmt->bindParam(":tutoria_informacion", $data['info']);
		if($stmt->execute()) //ejecucion de la consulta
			return "success";
		else
			return "error";
		$stmt->close();
	}
  //metodo que inserta un alumno en la tabla tutoria_alumnos
   public function registroAlumnoTutoria($data){
		$stmt = Conexion::conectar()->prepare("INSERT INTO tutoria_alumnos(tutoria, matricula) VALUES(:id_tutoria, :matricula_alumno)"); //se prepara la conexion
		//preparacion de parametros
		$stmt->bindParam(":id_tutoria", $data['id_tutoria']);
		$stmt->bindParam(":matricula_alumno", $data['matricula_alumno']);
		return $stmt->execute(); //ejecucion de la consulta
		$stmt->close();
	}
  
  //metodo que retorna el id de la ultima tutoria insertada en la bd
  public function returnLastTutoria(){
		$stmt = Conexion::conectar()->prepare("SELECT MAX(id) FROM sesion_tutoria"); //conslta sql
		if($stmt->execute()) //ejecucion
			return $stmt->fetch(); //retorno de resultado
		else
			return "error";
		$stmt->close();
	}
  
  	//metodo registroMaestroModel: dado un arreglo asociativo de datos de un maestro, se inserta en la tabla maestros, la informacion especificada
	public function registroMaestroModel($data){
		$stmt = Conexion::conectar()->prepare("INSERT INTO maestros(numero_empleado, nombre, carrera, email, password, superadmin) VALUES(:numero, :nombre, :carrera, :correo, :password, :tipo)"); //se prepara la conexion con la consulta sql
		//se asocian los parametros de la consulta sql
		$stmt->bindParam(":numero", $data['numero_empleado']);
		$stmt->bindParam(":nombre", $data['nombre']);
		$stmt->bindParam(":carrera", $data['carrera']);
		$stmt->bindParam(":correo", $data['correo']);
		$stmt->bindParam(":password", $data['password']);
    $stmt->bindParam(":tipo", $data['superadmin']);
		if($stmt->execute()) //ejecucion de la consulta
			return "success"; //retornar respuesta
		else
			return "error";
		$stmt->close();
	}

	//metodo registroCarreraModel: dado un arreglo de datos de una carra, se inserta en la tabla carreras los datos especificados o mandados
	public function registroCarreraModel($data){
		$stmt = Conexion::conectar()->prepare("INSERT INTO carreras(nombre) VALUES(:nombre)");
		$stmt->bindParam(":nombre", $data['nombre']);
		if($stmt->execute())
			return "success"; //retorno de respuesta
		else
			return "error";
		$stmt->close();
	}

	//metodo getRegModel: dado un id de un registro y el nombre de la tabla se retorna la informacion del id asociado
	public function getRegModel($id, $table){
		//en base al nombre de la tabla se define el nombre de la llave primaria de la tabla
		if($table=="productos" || $table == "usuarios" || $table == "categorias"){
			$idName = "id";
		}
    	//se prepara la consulta sql
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE $idName = :id and deleted = 0");
		$stmt->bindParam(":id",$id); //se asocia el parametro 
		$stmt->execute(); //se ejecuta la consulta
		return $stmt->fetch(); //se retorna el resultado de la consulta
		$stmt->close();
	}

	//metodo getQueryFromX: dado un nombre de tabla, un nombre de campo, un operador (=, >, >=, <, <= ) y un valor, se obtienen todos los registros que cumplen este requisito de la tabla dada
	public function getQueryFromX($table, $field,$operator ,$equals){
    	//se prepara la consulta sql
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE $field $operator :equals and deleted = 0");
		$stmt->bindParam(":equals",$equals); //se asocia el parametro 
		$stmt->execute(); //se ejecuta la consulta
		return $stmt->fetchAll(); //se retorna el resultado de la consulta
		$stmt->close();
	}


	//metodo actualizarProductoModel: dado un array de datos y un id de un producto, se actualizan los datos de este con los datos mandados
	public function actualizarProductoModel($data, $id){
		$stmt = Conexion::conectar()->prepare("UPDATE productos SET codigo=:codigo, nombre = :nombre, id_categoria=:categoria,  descripcion = :descripcion, precio_unitario = :precio_unitario, stock = :stock WHERE id = $id");
		$stmt->bindParam(":nombre", $data['nombre']);
		$stmt->bindParam(":codigo", $data['codigo']);
		$stmt->bindParam(":descripcion", $data['descripcion']);
		$stmt->bindParam(":precio_unitario", $data['precio_unitario']);
		$stmt->bindParam(":stock", $data['stock']);
		$stmt->bindParam(":categoria", $data['categoria']);
		if($stmt->execute())
			return "success";
		else
			return "error";
		$stmt->close();


	}

	//metodo actualizarCategoriaModel: dado un array de datos y un id de una categoria, se actualizan los datos de este con los datos mandados
	public function actualizarCategoriaModel($data, $id){
		$stmt = Conexion::conectar()->prepare("UPDATE categorias SET nombre=:nombre WHERE id = $id");
		$stmt->bindParam(":nombre", $data['nombre']);
		if($stmt->execute())
			return "success";
		else
			return "error";
		$stmt->close();


	}

	//metodo actualizarCarreraModel: dado un array de datos y un id de una carrera, se actualizan los datos de este con los datos mandados
	public function actualizarCarreraModel($data, $id){
		$stmt = Conexion::conectar()->prepare("UPDATE carreras SET nombre = :nombre WHERE id = $id");
		$stmt->bindParam(":nombre", $data['nombre']);
		if($stmt->execute())
			return "success";
		else
			return "error";
		$stmt->close();


	}

	//metodo actualizarMaestroModel: dado un array de datos y un id de un maestro, se actualizan los datos de este con los datos mandados
	public function actualizarMaestroModel($data, $id){
		$stmt = Conexion::conectar()->prepare("UPDATE maestros SET nombre = :nombre, carrera = :carrera, email = :correo, password = :password, superadmin = :tipo WHERE numero_empleado = '$id'");
		$stmt->bindParam(":nombre", $data['nombre']);
		$stmt->bindParam(":carrera", $data['carrera']);
		$stmt->bindParam(":correo", $data['correo']);
		$stmt->bindParam(":password", $data['password']);
    $stmt->bindParam(":tipo", $data['superadmin']);
		if($stmt->execute())
			return "success";
		else
			return "error";
		$stmt->close();


	}

	//metodo borrarXModel: dado un id de un registro y un nombre de tabla se realiza la actualizacion del campo deleted en la base de datos de cualquier tabla existente
	public function borrarXModel($id, $table){
		//se define el nombre de la llave principal segun el nombre de la tabla especificado
		if($table=="productos" || $table=="categorias"){
			$idName = "id";
		}
		$stmt = Conexion::conectar()->prepare("UPDATE $table SET deleted=1 WHERE $idName = :id"); //actualizar a 1 el campo deleted de la tabla
		$stmt->bindParam(":id",$id); //se asocia el parametro indicado
		
		if($stmt->execute()){ //se ejecuta la consulta
			return "success"; //se retorna la respuesta
		}else{
			return "error";
		}
		$stmt->close();
	}

}



?>