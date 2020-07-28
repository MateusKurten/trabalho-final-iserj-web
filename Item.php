<?php

    class Item{

        public $nome;
        public $preco;
        public $urlImagem;
        public $disponivel;
        
        //CONSTRUTOR TEMPORARIO ENQUANTO NÃO TEMOS BANCO
        function __construct($nome, $preco, $urlImagem, $disponivel){
            //$this->$id = $id;
            $this->nome = $nome;
            $this->preco = $preco;
            $this->urlImagem = $urlImagem;
            $this->disponivel = $disponivel;
        }


        public function renderizarItem($fimDaLinha, $numeroMesa){
            if ($this->disponivel) {
                $html = "<div class='col-lg-6 col-md-6 mb-4'>\n";
                $html .= "<button type='button' data-toggle='modal' data-target='#modal" . str_replace(" ", "", $this->nome) . "'>";
                $html .= "<div class='card'>";
                $html .= "<img class='card-img-top' src='imagens/" . $this->urlImagem . "' alt='" . $this->nome . "'>";
                $html .= "<div class='card-body'>";
                $html .= "<h4 class='card-title' style='padding: 0px; margin-bottom:0px'>" . $this->nome . "</h4>";
                $html .= "<p class='card-text' style='font-size: 30px'>R$ " . $this->preco . "</p>";
                $html .= "</div>";
                $html .= "</div>";
                $html .= "</button>";
                $html .= "</div>";

                //Modal

                $html .= "<div class='modal fade' id='modal" . str_replace(" ", "", $this->nome) . "' tabindex='-1' role='dialog' aria-labelledby='modal" . str_replace(" ", "", $this->nome) . "Label' aria-hidden='true'>";
                $html .= "<div class='modal-dialog' role='document'>";
                $html .= "<div class='modal-content'>";
                $html .= "<div class='modal-header'>";
                $html .= "<h5 class='modal-title' id='" . str_replace(" ", "", $this->nome) . "'>Detalhes do pedido (" . $this->nome . ")</h5>";
                $html .= "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                $html .= "<span aria-hidden='true'>&times;</span>";
                $html .= "</button>";
                $html .= "</div>";
                $html .= "<form method='POST' action='actionPedido.php' name='form" . str_replace(" ", "", $this->nome) . "' class='form-inline'>";
                $html .= "<div class='modal-body'>";
                $html .= "<div class='form-row'>";
                $html .= "<p class='text-justify'><strong>Descrição:</strong><br>";
                $html .= "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br><br>";
                $html .= "<strong>Preço Unidade:</strong>  R$ " . $this->preco . "<br></p>";
                $html .= "</div>";
                $html .= "<div class='form-row text-left'>";
                $html .= "<div class='form-group >";
                $html .= "<label for='quantidade'><strong>Quantidade:&nbsp;&nbsp;&nbsp;</strong></p>";
                $html .= "<select class='form-control' id='quantidade' name='quantidade'>";
                for ($i = 1; $i < 7; $i++){
                    $html .= "<option>" . $i . "</option>";
                }
                $html .= "</select>";
                $html .= "</div>";
                $html .= "</div>";
                //final da row
                $html .= "</div>";
                $html .= "<div class='modal-footer'>";
                $html .= "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
                $html .= "<a type='submit' href='javascript:form" . str_replace(" ", "", $this->nome) . ".submit()' class='btn btn-success'>Adicionar ao Carrinho</a>";
                $html .= "<input type='hidden' name='nomeItem' value='{$this->nome}'>";
                $html .= "<input type='hidden' name='precoItem' value='{$this->preco}'>";
                $html .= "<input type='hidden' name='numeroMesa' value='{$numeroMesa}'>";
                $html .= "</div>";
                $html .= "</form>";
                $html .= "</div>";
                $html .= "</div>";
                $html .= "</div>";

                // //AJAX
                // $html .= "<script>";
                // $html .= "$(function () {";
                // $html .= "$('form" . str_replace(" ", "", $this->nome) . "').on('submit', function (e){
                //     e.preventDefault();
                //     $.ajax({
                //         type: 'POST',
                //         url: 'actionPedido.php',
                //         success: function() {
                //             alert('Pedido adicionado ao carrinho');
                //         }
                //         });
                // });});";
                // $html .= "</script>";

                if ($fimDaLinha){
                    $html .= "</div>\n";
                    $html .= "<!-- row -->\n\n";
                    $html .= "<div class='row text-center'>\n";
                }
                return $html; //CODIGO PARA GERAR O CARTÃO DO BOOTSTRAP
            } else {
                return false;
            }
        }
    }