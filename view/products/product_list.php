  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Produtos</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-4">
              <a href="?page=0"> <button type="button" class="btn btn-block bg-gradient-primary btn-lg">Retornar</button> </a>
          </div>
          <div class="col-4">
              <a href="?page=2"> <button type="button" class="btn btn-block bg-gradient-primary btn-lg">Cadastro de Produto</button> </a>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-3">
            <?php include "model/product.php"; ?>
          </div>
        </div>

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
                    <th>Estoque</th>
                    <th colspan="2" style="width: 40px">Ação</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                  $produtos = listarProdutos();

                  foreach ($produtos as $produto) {
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
                        <img class="d-block" style="width: 80px" src="'.$imagem["imagem"].'"">
                      </div>
                      ';
                      $i++;
                    }

                  echo '</div>';
                  echo '</div>';

                  echo '</td>';
                    echo "<td>".$produto['descricao']."</td>";
                    echo "<td>R$ ".number_format($produto['valor_venda'], 2, ',', '.')."</td>";
                    echo "<td>".$produto['estoque']."</td>";

                    echo "<td align='center'> <a href='?page=5&id=".$produto['id']."'> <img src='dist/img/pen.png' class='icon'> </a></td>";
                    ?>
                      <td align='center'> <a href="#" class="remove-link" data-id="<?=$produto['id']?>" > <img src='dist/img/remove.png' class='icon' ></a></td>

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
