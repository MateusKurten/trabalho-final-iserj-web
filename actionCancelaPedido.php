<?php

  require 'config.php';
  require 'connection.php';
  require 'database.php';

  $idPedido = (int)$_POST['idPedido'];

  $result1 = DBExecute("update pedido set situacao = 'Cancelado' where situacao = 'Carrinho' and idPedido = {$idPedido};");

  header("Location: index.php");//VOLTA PRA PAGINA ANTERIOR