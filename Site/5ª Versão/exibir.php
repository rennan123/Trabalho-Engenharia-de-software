<?php

$host = "localhost";
$username = "root";
$password = "";
$db = "twitter_clone";

mysql_connect($host,$username,$password) or die("Impossível conectar ao banco."); 

@mysql_select_db($db) or die("Impossível conectar ao banco"); 

$result=mysql_query("SELECT * FROM usuarios") or die("Impossível executar a query"); 

while($row=mysql_fetch_object($result)) { 
	echo "<img src='get_imagem.php?PicNum=$row->id' \">";
} 

?>