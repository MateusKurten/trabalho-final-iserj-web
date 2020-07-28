<?php

class Pedido{

  public $idPedido;
  public $item;
  public $mesa;
  public $hora;
  public $quantidade;
  public $total;
  public $situacao;

  // function __construct($idPedido, $item, $mesa, $hora, $quantidade, $total, $situacao){
  //   $this->idPedido = $idPedido;
  //   $this->item = $item;
  //   $this->mesa = $mesa;
  //   $this->hora = $hora;
  //   $this->quantidade = $quantidade;
  //   $this->total = $total;
  //   $this->situacao = $situacao;
  // }

  function __construct($idPedido){
    $this->idPedido = $idPedido;
  }

  function renderizarBotaoCancelar() {
    $html = "<td>
    <form method='POST' action='actionCancelaPedido.php' name='formCancelaPedido{$this->idPedido}'>
    <input type='hidden' name='idPedido' value={$this->idPedido}>
    <a class='btn btn-danger' href='javascript:formCancelaPedido{$this->idPedido}.submit()';>X</a>
    </form> 
    </td>";

    return $html;
  }
}