<?php
   require __DIR__ . '/src/BuscaViaCEP_inc.php';
   require_once "src/includes/conexao.php";
	
	
	 //usar o helper
     use Jarouche\ViaCEP\HelperViaCep;

     
     //Utilizando via Classe
    $class = new Jarouche\ViaCEP\BuscaViaCEPJSON();
    $msg = "";
    if(isset($_POST["cep"])){
        $cep = $_POST["cep"];
        try{
            $result = $class->retornaCEP($cep);
            $cep =  $result["cep"];
            $logradouro = $result["logradouro"];
            $bairro = $result["bairro"];
            $municipio = $result["localidade"];
            $uf = $result["uf"];
        
            $sql = mysqli_query($conn,"INSERT INTO consultacep (cep, logradouro, bairro, municipio, uf) VALUES ('$cep', '$logradouro', '$bairro', '$municipio','$uf')");
            $n = mysqli_affected_rows($conn);


          }catch(Exception $e){
             $msg = "Ops: ".$e->getMessage();
         }
    }
    $sqldisco = mysqli_query($conn, "SELECT * FROM consultacep");


    ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
    .w-65{
        width: 65%;
    }
    .navbar-darck{
        background-color: #fff;
        box-shadow: 0 2px 4px -1px rgba(0,0,0,0.06), 0 4px 5px 0 rgba(0,0,0,0.06), 0 1px 10px 0 rgba(0,0,0,0.08);
    }
    .margin-top{
        margin-top: 50px;
    }
    .center-itens{
        display: flex;
    justify-content: center;
    }
   
    </style>
    <title>Busca de Cep</title>
  </head>
  <body>
    <header>
        
          <main>
              <div class="container">
                  <div class="row">
                      <div class="col-md-12">
                          <h1 class="text-center margin-top">Informe seu cep</h1>
                      </div>
                  </div>
                  <div class="row margin-top">
                      <div class="col-md-12 center-itens">
                        <form class="form-inline" method="post">
                            <div class="form-group mx-sm-3 mb-2">
                              <label for="cep" class="sr-only">Cep</label>
                              <input type="text" class="form-control" id="cep" name="cep" placeholder="">
                            </div>
                            <button type="submit" name="acao" id="acao" value="salvar" class="btn btn-primary mb-2">BUSCAR</button>
                            <div class="form-group mx-sm-3 mb-2">
                            <?php echo $msg; ?>
                            </div>
                          </form>
                      </div>
                  </div>
                  <?php
                  if(isset($_POST["cep"])){
                  ?>
                  <div class="row  margin-top">
                      <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                              <th scope="col">Cep</th>
                                <th scope="col">Logradouro</th>
                                <th scope="col">Bairro</th>
                                <th scope="col">Municipio</th>
                                <th scope="col">Uf</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>                                
                                <td><?php echo $cep; ?></td>
                                <td><?php echo $logradouro; ?></td>
                                <td><?php echo $bairro; ?></td>
                                <td><?php echo $municipio; ?></td>
                                <td><?php echo $uf; ?></td>
                              </tr>
                            </tbody>
                          </table>
                      </div>
                  </div>
                  <?php
                  }
                  ?>
                  <div class="row margin-top">
                      <div class="col-md-12">
                      <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">Cep</th>
                                <th scope="col">Logradouro</th>
                                <th scope="col">Bairro</th>
                                <th scope="col">Municipio</th>
                                <th scope="col">Uf</th>
                              </tr>
                            </thead>
                            <tbody>
                        <?php
                            while ($rs_disco = mysqli_fetch_array($sqldisco)){
                                ?>   
                                <tr>
                                <th scope="row"><?php echo $rs_disco['cep']; ?></th>
                                <td><?php echo $rs_disco['logradouro']; ?></td>
                                <td><?php echo $rs_disco['bairro']; ?></td>
                                <td><?php echo $rs_disco['municipio']; ?></td>
                                <td><?php echo $rs_disco['uf']; ?></td>
                              </tr>

                                <?php
                            }
                        ?>

                            </tbody>
                          </table>
                     
                        </div>
                  </div>
              </div>
          </main>
    </header>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>