  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Carrinho de compra </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">

      <div class="row">
          <div class="col-lg-4">
            <a href="?page=3" class='btn btn-block bg-gradient-primary btn-lg' > Retornar </a>
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
                    <th>Descrição</th>
                    <th>Quantidade</th>
                    <th>Valor de Compra</th>
                    <th colspan="2" style="width: 40px">Ação</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                  $produtos = listCar();

                  foreach ($produtos as $produto) {

                    echo "<td>".$produto['descricao']."</td>";
                    echo "<td>".$produto['quantidade']."</td>";
                    echo "<td>R$ ".number_format($produto['valor_venda']*$produto['quantidade'], 2, ',', '.')."</td>";

                    echo "<td><a href='#' class='removeCar-link' data-id='".$produto['id']."' > <img src='dist/img/remove.png' class='icon' ></a></td>";

                    echo "</tr>";
                  }
                ?>
              </tbody>
              </table>
            </div>
          </section>
          <!-- right col -->
        </div>

        <div class="row">
          <div class="col-lg-4">
            <a href="?page=3&action=cadastro" class='btn btn-block bg-gradient-primary btn-lg' > Finalizar Compra </a>
          </div>
        </div>

        <h1 class="m-0">Produtos </h1>
        <div class="row">
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-12 connectedSortable">
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Descrição</th>
                    <th>Valor de Venda</th>
                    <th colspan="2" style="width: 40px">Ação</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                  $produtos = produtosDisponiveis();

                  foreach ($produtos as $produto) {
                    echo "<form action='?page=4&action=addCar' method='POST'>";
                    echo "<tr>";
                    echo '<td>';
                    echo '<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">';
                    echo '<div class="carousel-inner">';
                    $galeria = galeriaProduto($produto['id']);
                    $i=0;
                    foreach($galeria as $imagem){
                      $active = "";
                      if($i == 0)
                        $active = "active";

                        echo '<div class="carousel-item '.$active.'">
                        <img class="d-block" style="width: 80px" src="'.$imagem["imagem"].'" alt="Primeiro Slide">
                      </div>
                      ';
                      $i++;
                    }

                  echo '</div>';
                  echo '</div>';

                  echo '</td>';
                    echo "<td>".$produto['descricao']."</td>";
                    echo "<td>R$ ".number_format($produto['valor_venda'], 2, ',', '.')."</td>";

                    echo "<input type='hidden' name='produto_id' value='".$produto['id']."'>";
                    echo "<td align='center'> <input type='number' name='quantidade' min=1 max=".$produto['estoque']." required ></td>";

                    echo "<td align='center'> <input type='submit' name='send' value='Add' class='btn btn-block bg-gradient-primary btn-lg' ></td>";

                    echo "</tr>";
                    echo "</form>";
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
