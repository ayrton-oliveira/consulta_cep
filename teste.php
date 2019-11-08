<?php
   require __DIR__ . '/src/BuscaViaCEP_inc.php';
   require_once "src/includes/conexao.php";
	
	$sqldisco = mysqli_query($conn, "SELECT * FROM consultacep");
	 //usar o helper
     use Jarouche\ViaCEP\HelperViaCep;
	 
     
     //Utilizando via Classe
    $class = new Jarouche\ViaCEP\BuscaViaCEPJSON();
    /*como é JSONP, existe a opção de setar o nome da callback function, 
     * ESTÁ OPÇÃO ESTÁ SOMENTE DISPONÍVEL SE UTILIZAR A CLASSE Jarouche\ViaCEP\BuscaViaCEPJSONP();
     */
 
    
    //Faz o retorno do CEP
    
    try{
      $result = $class->retornaCEP('07192140');
      echo $class->retornaConteudoRequisicao();
    }catch(Exception $e){
       echo "Ops: ".$e->getMessage();
    }

 
    $cep =  $result["cep"];
    $logradouro = $result["logradouro"];
    $bairro = $result["bairro"];
    $municipio = $result["localidade"];
    $uf = $result["uf"];

    $sql = mysqli_query($conn,"INSERT INTO consultacep (cep, logradouro, bairro, municipio, uf) VALUES ('$cep', '$logradouro', '$bairro', '$municipio','$uf')");
	  $n = mysqli_affected_rows($conn);




    
    echo "<table>";
    echo "<tr>";
    echo "<th>Cep</th>";
    echo "<th>Logradouro</th>";
    echo "<th>Bairro</th>";
    echo "<th>Municipio</th>";
    echo "<th>UF</th>";
    while ($rs_disco = mysqli_fetch_array($sqldisco)){
      ?>        
        <tr>
        <td><?php echo $rs_disco['cep']; ?></td>
        <td><?php echo $rs_disco['logradouro']; ?></td>
        <td><?php echo $rs_disco['bairro']; ?></td>
        <td><?php echo $rs_disco['municipio']; ?></td>
        <td><?php echo $rs_disco['uf']; ?></td>
        </tr>
<?php
    }

    echo "<table>";


   