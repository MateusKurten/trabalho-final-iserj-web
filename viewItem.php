<?php 

  require_once 'Item.php';
  require 'config.php';
  require 'connection.php';
  require 'database.php';


  $fimDaLinha = false;

?>
<!DOCTYPE html>
<html lang="en">


<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Menu</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.css" rel="stylesheet">

  <!-- Custom styles for this site -->
  <link href="css/heroic-features.css" rel="stylesheet">
  <link href="css/estilo.css" rel="stylesheet">

</head>

<body style="background-image: url(imagens/background.png); background-attachment: fixed; ">
  <!-- Page Content -->
    <br>
    <div class="container">

      <div class="row text-center">
        <div class="col-lg-9 mb-4">

          <div class="row text-center">
            <?php

              $html = "";

              $arrayItens = DBReadQuery("select nome, preco, urlImagem, disponivel from item where categoria = '" . $_POST['categoria'] . "'");
              foreach ($arrayItens as $item) {
                $objItem = new Item($item['nome'], $item['preco'], $item['urlImagem'], $item['disponivel']);
                $item = $objItem->renderizarItem($fimDaLinha, 1); //MUDAR PARA PEGAR O NUMERO DA MESA DE ALGUM LUGAR
                if ($item) {
                  $html .= $item;
                  $fimDaLinha = !$fimDaLinha;
                }
              }
              $html = strrev(implode(strrev(""), explode(strrev("<div class='row text-center'>\n"), strrev($html), 2))); // Encerra Rows
              echo $html;
            ?>
        </div>
        

        <div class="col-lg-3 col-md-3 mb-4" style="position:fixed; right:0px">
          <button type="button" class="btn btn-info btn-lg btn-block botao-redondo" style="height: 100px; font-size: 35px;" onclick="location.href='index.php'">Voltar</button>          
          <button type="button" class="btn btn-info btn-lg btn-block botao-redondo" style="height: 100px; font-size: 28px;">Chamar<br>Garçom</button>
          <button type="button" class="btn btn-info btn-lg btn-block botao-redondo" style="height: 100px; font-size: 28px;">Encerrar<br>Conta</button>
          <button type="button" class="btn btn-success btn-lg btn-block botao-redondo" style="height: 100px"><img src="imagens/carrinho.png" height="80px"></button>
        </div>
      </div>
      <!-- /.row -->

  </div>
  <!-- /.container -->


  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>
