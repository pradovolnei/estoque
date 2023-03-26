<?php

  if(isset($_GET["action"])){

    if($_GET["action"] == "remove"){
      if(removerPedido($_GET["id"]) == true){
        echo '<div class="alert alert-success" role="alert">
                Pedido removido com sucesso!
              </div>';
      }else{
        echo '<div class="alert alert-danger" role="alert">
                Erro ao remover pedido...
              </div>';
      }
    }

    if($_GET["action"] == "cadastro"){
        if(cadastrarPedido() == true){
          echo '<div class="alert alert-success" role="alert">
                Pedido cadastrado com sucesso!
              </div>';
        }else{
          echo '<div class="alert alert-danger" role="alert">
                  Erro ao cadastrar pedido...
                </div>';
        }
    }

    if($_GET["action"] == "addCar"){
      if(addCarrinho() == true){
        echo '<div class="alert alert-success" role="alert">
              Produto adicionado no carrinho!
            </div>';
      }else{
        echo '<div class="alert alert-danger" role="alert">
                Erro ao cadastrar produto...
              </div>';
      }
    }

    if($_GET["action"] == "removeCar"){
      removercarrinho($_GET["id"]);
    }

  }

?>
