<?php

  require 'Pedido.php';
  require 'config.php';
  require 'connection.php';
  require 'database.php';

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
  <div class="container">
    <br>

    <div class="row text-center">
      
      <div class="col-lg-4 col-md-6 mb-4">
        <button type="button" class="btn btn-info btn-lg btn-block botao-redondo" style="height: 120px; font-size: 35px;" data-toggle="modal" data-target="#modalChamarGarçom">Chamar Garçom</button>
      </div>
    
      <div class="col-lg-4 col-md-6 mb-4">
        <button type="button" class="btn btn-info btn-lg btn-block botao-redondo" style="height: 120px; font-size: 35px;" data-toggle="modal" data-target="#modalEncerrarConta">Encerrar Conta</button>
      </div>

      <div class="col-lg-4 col-md-6 mb-4">
          <button type="button" class="btn btn-success btn-lg btn-block botao-redondo" style="height: 120px" data-toggle="modal" data-target="#modalCarrinho"><img src="imagens/carrinho.png" height="100px"></button>
      </div>

    <!-- MODAL DO CARRINHO -->

    <div class="modal fade" id="modalCarrinho" tabindex="-1" role="dialog" aria-labelledby="modalCarrinhoLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCarrinhoLabel">Carrinho</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Produto</th>
                  <th scope="col">Quantidade</th>
                  <th scope="col">Total</th>
                  <th scope="col">Cancelar</th>
                </tr>
              </thead>
              <tbody>
                <?php

                  $numeroMesa = 1;
                  $totalCarrinho = 0;
                  $arrayPedidos = DBExecute("select p.idPedido, i.nome, p.quantidade, p.total from pedido p, item i, mesa m where i.idItem = p.item and m.idMesa = p.mesa and m.situacao = 'Aberta' and p.situacao = 'Carrinho' and m.numeroMesa = {$numeroMesa};"); //PEGAR NUMERO DA MESA DE ALGUM LUGAR

                  if (!empty($arrayPedidos)) {

                    foreach($arrayPedidos as $filtroPedido){
                      $objPedido = new Pedido($filtroPedido['idPedido']);
                      echo "<tr>";
                      echo "<td class='align-middle'>{$filtroPedido['nome']}</td>";
                      echo "<td class='align-middle'>{$filtroPedido['quantidade']}</td>";
                      echo "<td class='align-middle'>R$ {$filtroPedido['total']}</td>";
                      echo ($objPedido->renderizarBotaoCancelar());
                      echo "</tr>";
                      $totalCarrinho += $filtroPedido['total'];
                    }

                    echo "<tr>";
                    echo "<td></td>";
                    echo "<td class='align-middle'><strong>Total</strong></td>";
                    echo "<td class='align-middle'><strong>R$ {$totalCarrinho}</strong></td>";
                    echo "<td class='align-middle'> </td>";
                    echo "</tr>";
                  }
                ?>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
            <form method='POST' action='actionCarrinho.php' name='formCarrinho'>
              <input type='hidden' name='numeroMesa' value=1> <!-- MUDAR PARA PEGAR NUMERO DA MESA DE ALGUM LUGAR -->
              <a type="submit" href="javascript:formCarrinho.submit()" class="btn btn-success">Confirmar</a>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- MODAL VER PEDIDOS/ENCERRAR CONTA -->

    <div class="modal fade" id="modalEncerrarConta" tabindex="-1" role="dialog" aria-labelledby="modalEncerrarContaLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form method='POST' action='actionEncerraConta.php' name='formEncerrarConta'>
            <div class="modal-header">
              <h5 class="modal-title" id="modalEncerrarContaLabel">Encerrar Conta</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Produto</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                    $numeroMesa = 1;
                    $total = 0;
                    $arrayPedidosConfirmados = DBExecute("select p.idPedido, i.nome, p.quantidade, p.total from pedido p, item i, mesa m where i.idItem = p.item and m.idMesa = p.mesa and m.situacao = 'Aberta' and p.situacao = 'Confirmado' and m.numeroMesa = {$numeroMesa};"); //PEGAR NUMERO DA MESA DE ALGUM LUGAR

                    if (!empty($arrayPedidosConfirmados)) {

                      foreach($arrayPedidosConfirmados as $filtroPedido){
                        $objPedido = new Pedido($filtroPedido['idPedido']);
                        echo "<tr>";
                        echo "<td class='align-middle'>{$filtroPedido['nome']}</td>";
                        echo "<td class='align-middle'>{$filtroPedido['quantidade']}</td>";
                        echo "<td class='align-middle'>R$ {$filtroPedido['total']}</td>";
                        echo "</tr>";
                        $total += $filtroPedido['total'];
                      }

                      echo "<tr>";
                      echo "<td></td>";
                      echo "<td class='align-middle'><strong>Total</strong></td>";
                      echo "<td class='align-middle'><strong>R$ {$total}</strong></td>";
                      echo "</tr>";
                    }
                  ?>
                </tbody>
              </table>
              <div class='text-left'>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" id="metodoPagamentoRadioDinheiro"  name='metodoPagamento' value="Dinheiro" checked="checked">
                  <label class="form-check-label" for="metodoPagamentoRadioDinheiro">Dinheiro</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" id="metodoPagamentoRadioCartão" name='metodoPagamento' value="Cartão">
                  <label class="form-check-label" for="metodoPagamentoRadioCartão">Cartão</label>
                </div>
                <br>
                <br>
                <label for="campoTrocoPraQuanto">Troco pra quanto?  R$</label>
                <input class="form-control-inline col-2" type="number" id="campoTrocoPraQuanto" name="valorPago">
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                <input type='hidden' name='numeroMesa' value=1> <!-- MUDAR PARA PEGAR NUMERO DA MESA DE ALGUM LUGAR -->
                <input type='hidden' name='total' value=<?php echo $total; ?>>
                <a type="submit" href="javascript:formEncerrarConta.submit()" class="btn btn-success">Encerrar Conta</a>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- MODAL CHAMAR GARÇOM -->

    <div class="modal fade" id="modalChamarGarçom" tabindex="-1" role="dialog" aria-labelledby="chamarGarçomLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="chamarGarçom">Chamar Garçom</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-left">
            Tem certeza que deseja chamar o garçom?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <form action="actionChamarGarcom.php" name='formChamarGarcom' method="POST">
              <input type='hidden' name='numeroMesa' value=1> <!-- MUDAR PARA PEGAR NUMERO DA MESA DE ALGUM LUGAR -->
              <a type="submit" href="javascript:formChamarGarcom.submit()" class="btn btn-success">Sim</a>
            </form>
          </div>
        </div>
      </div>
    </div>

    </div>
    <!-- /.row -->

    <div class="row text-center row-menu-inicial">

      <div class="col-lg-4 col-md-6 mb-4">
        <form method='POST' action="viewItem.php" name='formComida'>
          <input type="hidden" name="categoria" value='Comida'>
          <input type="hidden" name="numeroMesa" value=1>
          <a href='javascript:formComida.submit()'>
            <div class="card h-100">
              <img class="card-img-top" src="imagens/comida-menu.png" alt="Comida">
              <div class="card-body">
                <h4 class="card-title">Comida</h4>
                <p class="card-text">Nossa seleção de comidas.</p>
              </div>
            </div>
          </a>
        </form>
      </div>

      <div class="col-lg-4 col-md-6 mb-4">
        <form method='POST' action="viewItem.php" name='formBebida'>
          <input type="hidden" name="numeroMesa" value=1>
          <input type="hidden" name="categoria" value='Bebida'>
          <a href='javascript:formBebida.submit()'>
            <div class="card h-100">
              <img class="card-img-top" src="imagens/bebida-menu.jpeg" alt="Bebida">
              <div class="card-body">
                <h4 class="card-title">Bebidas</h4>
                <p class="card-text">Nossa seleção de bebidas.</p>
              </div>
            </div>
          </a>
        </form>
      </div>

      <div class="col-lg-4 col-md-6 mb-4">
       <form method='POST' action="viewItem.php" name='formSobremesa'>
          <input type="hidden" name="numeroMesa" value=1>
          <input type="hidden" name="categoria" value='Sobremesa'>
          <a href='javascript:formSobremesa.submit()'>
            <div class="card h-100">
              <img class="card-img-top" src="imagens/sobremesa-menu.jpg" alt="Sobremesa">
              <div class="card-body">
                <h4 class="card-title">Sobremesa</h4>
                <p class="card-text">Nossa seleção de sobremesas.</p>
              </div>
            </div>
          </a>
        </form>
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
