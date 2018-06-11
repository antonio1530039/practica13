<?php
	//se incluyen los archivos de modelo y controlador
	require_once("model/crud.php");
	require_once("controller/controller.php");

	//se crea la instancia del controlador
	$controller = new MVC();
	//en base al tipo de eliminacion se define el nombre del campo que corresponde a su llave primaria
	if($_GET['tipo']=='productos' || $_GET['tipo']=='categorias' || $_GET['tipo']=='usuarios' || $_GET['tipo']=='tiendas' || $_GET['tipo']=='ventas'){
		$pos = "id";
	}


	//se ejecuta el metodo borrar de la clase del controlador
	$controller->borrarController($_GET[$pos],$_GET['tipo']);

?>