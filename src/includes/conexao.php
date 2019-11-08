<?php

	$servidor = "localhost";
	$userdb = "root";
	$passdb = "";
	$banco = "sistemacep";
	
	$conn = mysqli_connect($servidor, $userdb, $passdb, $banco);
	
	mysqli_query($conn,"SET NAMES 'utf8'");
	mysqli_query($conn,'SET character_set_connection=utf8');
	mysqli_query($conn,'SET character_set_client=utf8');
	mysqli_query($conn,'SET character_set_results=utf8');
	
	if (!$conn){
		die("Erro ao conectar com o Banco de Dados! Tente novamente!");
	}
	
	function limitar($string, $tamanho, $encode = 'UTF-8') {
		if( strlen($string) > $tamanho )
			$string = mb_substr($string, 0, $tamanho - 3, $encode) . '...';
		else
			$string = mb_substr($string, 0, $tamanho, $encode);

		return $string;
	}
?>