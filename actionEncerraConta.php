<?php

require 'config.php';
require 'connection.php';
require 'database.php';

$numeroMesa = (int) $_POST['numeroMesa'];
$total = (float) $_POST['total'];

$arrayidMesa = DBReadQuery("select idMesa from mesa where situacao = 'Aberta' and numeroMesa = {$numeroMesa};");
$idMesa = (int)$arrayidMesa[0]['idMesa'];

if (!empty($arrayidMesa)){
  
  if ($_POST['metodoPagamento'] == 'Dinheiro') {
    $valorPago = (float) $_POST['valorPago'];
    if (isset($valorPago) and $valorPago > $total){
      $troco = $valorPago - $total; 
      $result1 = DBExecute("update mesa set situacao = 'Aguardando Conta', total = {$total}, metodoPagamento = 'Dinheiro', troco = {$troco} where idMesa = {$idMesa};");
    } else {
      $result1 = DBExecute("update mesa set situacao = 'Aguardando Conta', total = {$total}, metodoPagamento = 'Dinheiro' where idMesa = {$idMesa};");
    }
  } else if ($_POST['metodoPagamento'] = 'Cartão'){
    $result1 = DBExecute("update mesa set situacao = 'Aguardando Conta', total = {$total}, metodoPagamento = 'Cartão' where idMesa = {$idMesa};");
  }

  $result2 = DBExecute("update pedido set situacao = 'Cancelado' where situacao = 'Carrinho' and mesa = {$idMesa}");

  if($result1 && $result2){
    header("Location: index.php");//VOLTA PRA PAGINA ANTERIOR
  } else {
    echo 'DEU ERRO';
    var_dump($_POST);
    var_dump($result1);
    var_dump($result2);
  }
}