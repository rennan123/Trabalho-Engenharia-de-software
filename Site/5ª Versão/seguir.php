<?php

	session_start();

	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	require_once('db.class.php');

	$id_usuario = $_SESSION['id_usuario'];
	$seguir_id_usuario = $_POST['seguir_id_usuario'];
	$avaliacao = $_POST['avaliacao'];

	if($id_usuario == '' || $seguir_id_usuario == ''){
		die();
	}

	$objDb = new db();
	$link = $objDb->conecta_mysql();
	
	$sql = " INSERT INTO usuarios_seguidores(id_usuario, seguindo_id_usuario)values($id_usuario, $seguir_id_usuario) ";
	$sql2 = " INSERT INTO avaliacao(id_usuario, avaliacao)values($seguir_id_usuario, $avaliacao) ";
	$sql3 = " UPDATE usuarios SET media = (SELECT avg(avaliacao) from avaliacao where id_usuario = $seguir_id_usuario) WHERE id = $seguir_id_usuario ";

	mysqli_query($link, $sql);
	mysqli_query($link, $sql2);
	mysqli_query($link, $sql3);

?>