<?php

	session_start();

	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	require_once('db.class.php');

	$id_usuario = $_SESSION['id_usuario'];

	$objDb = new db();
	$link = $objDb->conecta_mysql();
	
	$sql = " SELECT COUNT(*) AS qtde_tweets FROM usuarios_seguidores WHERE id_usuario = $id_usuario ";
	$resultado_id = mysqli_query($link, $sql);
	$qtde_tweets = 0;
	if($resultado_id){
		while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
			$qtde_tweets = $registro['qtde_tweets'];
			echo 'AVALIAÇÕES <br> '.$registro['qtde_tweets'].'';
		}
	} else {
		echo 'Erro na consulta de AVALIAÇÕES no banco de dados!';
	}

?>