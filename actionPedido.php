<?php

  require 'config.php';
  require 'connection.php';
  require 'database.php';

  $numeroMesa = (int) $_POST['numeroMesa'];

  $arrayMesaAtual = DBReadQuery("select situacao from mesa where numeroMesa = {$numeroMesa}");

  //PROVAVELMENTE DEVO TIRAR ISSO DAQUI
  if (empty($arrayMesaAtual)){//FALTA CHECAR SE O ARRAY SÓ CONTEM A STRING 'FECHADA'
    $result1 = DBExecute("Insert into mesa(situacao,numeroMesa,total,troco) values ('Aberta', {$_POST['numeroMesa']}, 0, 0);");
  }

  $item = DBReadQuery("select idItem from item where nome = '{$_POST['nomeItem']}'");
  $idItem = (int)$item[0]['idItem'];
  $mesa = DBReadQuery("select idMesa from mesa where numeroMesa = {$numeroMesa} and situacao = 'Aberta';");
  $idMesa = (int)$mesa[0]['idMesa'];
  $quantidade = (int)$_POST['quantidade'];
  $preco = (float)$_POST['precoItem'];
  $total = $quantidade * $preco;

  $result2 = DBExecute("insert into pedido (item, mesa, quantidade, total, situacao) values ({$idItem}, {$idMesa}, {$quantidade}, {$total}, 'Carrinho');");


  header("Location: index.php");//VOLTA PRA PAGINA ANTERIOR


?>