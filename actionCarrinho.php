<?php

  require 'config.php';
  require 'connection.php';
  require 'database.php';

$numeroMesa = (int) $_POST['numeroMesa'];

$arrayidMesa = DBReadQuery("select m.idMesa from mesa m, pedido p where m.idMesa = p.mesa and m.situacao = 'Aberta' and p.situacao = 'Carrinho' and m.numeroMesa = {$numeroMesa};");

$idMesa = (int)$arrayidMesa[0]['idMesa'];

$result1 = DBExecute("update pedido set situacao = 'Confirmado' where situacao = 'Carrinho' and mesa = {$idMesa};");

header("Location: index.php");//VOLTA PRA PAGINA ANTERIOR