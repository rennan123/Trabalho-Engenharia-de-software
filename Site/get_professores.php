<?php

	session_start();

	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	require_once('db.class.php');

	$id_usuario = $_SESSION['id_usuario'];

	$objDb = new db();
	$link = $objDb->conecta_mysql();
	
	$sql = " SELECT usuario, media, numAval FROM usuarios WHERE id < 39 ORDER BY usuario ";

	$resultado_id = mysqli_query($link, $sql);



$host = "localhost";
$username = "root";
$password = "";
$db = "twitter_clone";

mysql_connect($host,$username,$password) or die("Impossível conectar ao banco."); 

@mysql_select_db($db) or die("Impossível conectar ao banco"); 

$sql2 = " SELECT * FROM usuarios where id < 39 ORDER BY usuario "; 

$result=mysqli_query($link, $sql2);

	if($resultado_id){

		while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
			echo '<a href="#" class="list-group-item">';
				echo '<h4 class="list-group-item-heading">'.$registro['usuario'].'</h4>';

				if ($row=mysqli_fetch_object($result)) {
						echo "<img src='get_imagem.php?PicNum=$row->id' \">";
				}

				echo '<p class="list-group-item-text pull-right"><scam>Média: </scam>'.$registro['media'].'<br><br> ';
				if ($registro['media'] < 1 && $registro['numAval'] != 0) {
					echo '<img src="imagens/deslike.png" />';
				} else if ($registro['media'] < 1 && $registro['numAval'] == 0) {
					echo 'Ainda não foi avaliado.';
				} else if ($registro['media'] >= 1 && $registro['media'] < 1.25) {
					echo '<img src="imagens/1estrela.png" />';
				} else if ($registro['media'] >= 1.25 && $registro['media'] < 1.5) {
					echo '<img src="imagens/1e25.png" />';
				} else if ($registro['media'] >= 1.5 && $registro['media'] < 1.75) {
					echo '<img src="imagens/1emeio.png" />';
				} else if ($registro['media'] >= 1.75 && $registro['media'] < 2) {
					echo '<img src="imagens/1e75.png" />';
				} else if ($registro['media'] >= 2 && $registro['media'] < 2.25) {
					echo '<img src="imagens/2estrela.png" />';
				} else if ($registro['media'] >= 2.25 && $registro['media'] < 2.5) {
					echo '<img src="imagens/2e25.png" />';
				} else if ($registro['media'] >= 2.5 && $registro['media'] < 2.75) {
					echo '<img src="imagens/2emeio.png" />';
				} else if ($registro['media'] >= 2.75 && $registro['media'] < 3) {
					echo '<img src="imagens/2e75.png" />';
				} else if ($registro['media'] = 3) {
					echo '<img src="imagens/3estrela.png" />';
				}

				echo '</p>';
				echo '<div class="clearfix"></div>';
			echo '</a>';
		}

	} else {
		echo 'Erro na consulta de tweets no banco de dados!';
	}

?>