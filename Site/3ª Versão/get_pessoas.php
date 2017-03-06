<?php

	session_start();

	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	require_once('db.class.php');

	$nome_pessoa = $_POST['nome_pessoa'];
	$id_usuario = $_SESSION['id_usuario'];

	$objDb = new db();
	$link = $objDb->conecta_mysql();
	
	$sql = " SELECT u.*, us.* ";
	$sql.= " FROM usuarios AS u ";
	$sql.= " LEFT JOIN usuarios_seguidores AS us ";
	$sql.= " ON (us.id_usuario = $id_usuario AND u.id = us.seguindo_id_usuario) ";
	$sql.= " WHERE u.usuario like '%$nome_pessoa%' AND u.id <> $id_usuario ";

	$resultado_id = mysqli_query($link, $sql);

	if($resultado_id){

		while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
			echo '<a href="#" class="list-group-item">';
				echo '<strong>'.$registro['usuario'].'</strong> <small> - '.$registro['email'].'</small>';
				echo '<p class="list-group-item-text pull-right">';

					$esta_seguindo_usuario_sn = isset($registro['id_usuario_seguidor']) && !empty($registro['id_usuario_seguidor']) ? 'S' : 'N';

					$btn_seguir_display = 'block';
					$btn_seguir_display1 = 'block';
					$btn_seguir_display2 = 'block';

					$btn_deixar_seguir_display = 'block';

					if($esta_seguindo_usuario_sn == 'N'){
						$btn_deixar_seguir_display = 'none';
					} else {
						$btn_seguir_display = 'none';
						$btn_seguir_display1 = 'none';
						$btn_seguir_display2 = 'none';

					}

					echo '<button type="button" id="btn_seguir_'.$registro['id'].'" style="display: '.$btn_seguir_display.'" class="btn btn-default btn_seguir" data-id_usuario="'.$registro['id'].'" data-avaliacao="1"><img src="imagens/1star_transparent.png" /></button>';
					echo '<button type="button" id="btn_seguir_1'.$registro['id'].'" style="display: '.$btn_seguir_display1.'" class="btn btn-default btn_seguir" data-id_usuario="'.$registro['id'].'" data-avaliacao="2"><img src="imagens/2star_transparent.png" /></button>';
					echo '<button type="button" id="btn_seguir_2'.$registro['id'].'" style="display: '.$btn_seguir_display2.'" class="btn btn-default btn_seguir" data-id_usuario="'.$registro['id'].'" data-avaliacao="3"><img src="imagens/3star_transparent.png" /></button>';
					echo '<spam id="btn_deixar_seguir_'.$registro['id'].'" style="display: '.$btn_deixar_seguir_display.'" class="btn_deixar_seguir" data-id_usuario="'.$registro['id'].'">Avaliado!</spam>';
				echo '</p>';
				echo '<div class="clearfix"></div>';
			echo '</a>';
		}

	} else {
		echo 'Erro na consulta de usuários no banco de dados!';
	}

?>