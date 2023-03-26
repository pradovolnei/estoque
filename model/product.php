<?php

  if(isset($_GET["action"])){

    if($_GET["action"] == "remove"){
      if(removerProduto($_GET["id"]) == true){
        removerProduto($_GET["id"]);

        echo '<div class="alert alert-success" role="alert">
                Produto removido com sucesso!
              </div>';
      }else{
        echo '<div class="alert alert-danger" role="alert">
                Erro ao remover produto...
              </div>';
      }
    }

    if($_GET["action"] == "cadastro"){
        if(cadastrarProduto() == true){
          echo '<div class="alert alert-success" role="alert">
                Produto cadastrado com sucesso!
              </div>';
        }else{
          echo '<div class="alert alert-danger" role="alert">
                  Erro ao cadastrar produto...
                </div>';
        }
    }

    if($_GET["action"] == "edit"){
      if(editarProduto($_POST["id"]) == true){
        echo '<div class="alert alert-success" role="alert">
              Produto editado com sucesso!
            </div>';
      }else{
        echo '<div class="alert alert-danger" role="alert">
                Erro ao editar produto...
              </div>';
      }
    }

    if($_GET["action"] == "removeImage"){
      removerImagem($_GET["idImage"]);
    }

  }

?>
