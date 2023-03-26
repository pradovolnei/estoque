<?php
  $dadosProduto = dadosProduto($_GET["id"]);
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Editar Produto <?=$_GET["id"]?></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <a href="?page=1"> <button type="button" class="btn btn-block bg-gradient-danger btn-lg">Cancelar</button> </a>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-3">
            <?php include "model/product.php"; ?>
          </div>
        </div>

        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <!-- left column -->
              <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Dados</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="?page=1&action=edit" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?=$_GET["id"]?>" />
                    <div class="card-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Descrição</label>
                        <input type="text" class="form-control" name="descricao" value="<?=$dadosProduto["descricao"]?>" placeholder="Descrição do produto" require>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Valor Venda</label>
                        <input type="text" class="form-control" value="<?=$dadosProduto["valor_venda"]?>" name="valor_venda" placeholder="Valor em R$" require >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Estoque</label>
                        <input type="number" class="form-control" value="<?=$dadosProduto["estoque"]?>" name="estoque" placeholder="Quantidade em estoque" require>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputFile">Imagens <a href="#" class="btn btn-primary" onclick="novaImagem()"> + </a> </label>
                        <?php

                          $imagens = galeriaProduto($_GET["id"]);

                          foreach($imagens as $image){
                            ?>
                            <div class='form-group' >
                              <img src='<?=$image['imagem']?>' style='width: 60px' />
                              <a href="#" class="removeImage-link" data-id="<?=$image['id']?>" data-prod=<?=$_GET["id"]?> > <img src='dist/img/remove.png' class='icon' ></a>
                            </div>
                          <?php
                          }
                        ?>
                        <div class="form-group" id="imagens"  >
                          <div class="form-group" >
                            <input type="file" name="imagem[]">
                          </div>

                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <input type="submit" class="btn btn-primary" value="Salvar" />
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

