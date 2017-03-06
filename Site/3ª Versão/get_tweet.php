<?php

	session_start();

	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	require_once('db.class.php');

	$id_usuario = $_SESSION['id_usuario'];

	$objDb = new db();
	$link = $objDb->conecta_mysql();
	
	$sql = " SELECT avg(avaliacao), us.* FROM avaliacao as a LEFT JOIN usuarios_seguidores AS us ON (a.id_usuario = us.seguindo_id_usuario) WHERE id < 20 ";
	$sql2 = " SELECT u.*, us.* ";
	$sql2.= " FROM usuarios AS u ";
	$sql2.= " LEFT JOIN usuarios_seguidores AS us ";
	$sql2.= " ON (us.id_usuario = $id_usuario AND u.id = us.seguindo_id_usuario) ";
	$sql2.= " WHERE u.id < 20 and u.id <> $id_usuario";

	$resultado_id = mysqli_query($link, $sql);
	$resultado_id2 = mysqli_query($link, $sql2);
	$media_aval = 0;

	if($resultado_id && $resultado_id2){

		while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC) && $registro2 = mysqli_fetch_array($resultado_id2, MYSQLI_ASSOC)){
			$media_aval = $registro2['media_aval'];
			echo '<a href="#" class="list-group-item">';
				echo '<h4 class="list-group-item-text">'.$registro['usuario'].'</h4>';
				echo '<strong>'.$registro2['media_aval'].'</strong>';
				echo '<p class="list-group-item-text pull-right">';
				echo '<spam> nhaaaaaaaaaa</spam>';
				echo '</p>';
				echo '<div class="clearfix"></div>';
			echo '</a>';
		}

	} else {
		echo 'Erro na consulta de professores no banco de dados!';
	}

?>