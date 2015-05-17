<?php
if ($_POST) {
	$mongo = new Mongo();
	$db = $mongo->selectDB("librosdb");
	$c_libros = $mongo->selectCollection("librosdb","libros");

	//////////////////////////////////////
	$nameLibro = $_POST["nameLibro"];
	$autor = $_POST["autor"];
	$descripcion = $_POST["descripcion"];
	//////////////////////////////////////

	$nuevoLibro = array("nombre"=>$nameLibro,"autor"=>$autor,"descripcion"=>$descripcion);
	//print_r($nuevoLibro);
	//newt_delay(1000);
	$c_libros->insert($nuevoLibro);
	$msg = "1";
 	echo $msg;
}else{
	$msg = "0";
 	echo $msg;
}	
	
?>