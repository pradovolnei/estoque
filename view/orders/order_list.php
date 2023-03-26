  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pedidos</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-4">
              <a href="?page=0"> <button type="button" class="btn btn-block bg-gradient-primary btn-lg">Retornar</button> </a>
          </div>
          <div class="col-lg-3 col-4">
              <a href="?page=4"> <button type="button" class="btn btn-block bg-gradient-primary btn-lg">Criar Pedido</button> </a>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-3">
            <?php include "model/order.php"; ?>
          </div>
        </div>

        <div class="row">
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-12 connectedSortable">
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">Pedido</th>
                    <th>Itens</th>
                    <th>Valor da Compra</th>
                    <th style="width: 40px">Cancelar</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                  $pedidos = listarPedidos();

                  foreach ($pedidos as $pedido) {
                    echo "<tr>";
                    echo "<td>".str_pad($pedido['id'], 4, 0, STR_PAD_LEFT)."</td>";
                    echo "<td>";
                      $produtos = produtosPedido($pedido['id']);
                      foreach ($produtos as $produto) {
                        echo $produto["quantidade"]."x ".$produto["descricao"]." <br />";
                      }
                    echo "</td>";
                    echo "<td>R$ ".number_format($pedido['preco'], 2, ',', '.')."</td>";

                    ?>
                      <td align='center'> <a href="#" class="removeOrder-link" data-id="<?=$pedido['id']?>" > <img src='dist/img/remove.png' class='icon' ></a></td>

                 <?php
                    echo "</tr>";
                  }
                ?>
              </tbody>
              </table>
            </div>
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
