<!DOCTYPE html>
<html lang="en">
<?php
  include "view/header.php";
  include "database/connection.php";
  include "controller/ProdutosController.php";
  include "controller/PedidosController.php";
?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <?php
    if(isset($_GET["page"])){
      $page = $_GET["page"];
    }else{
      $page = 0;
    }
      $link[0] = "view/home.php";
      $link[1] = "view/products/product_list.php";
      $link[2] = "view/products/product_add.php";
      $link[3] = "view/orders/order_list.php";
      $link[4] = "view/orders/order_add.php";
      $link[5] = "view/products/product_edit.php";

      include $link[$page];

  ?>
</div>

</body>
<?php
  include "view/footer.php";
?>
</html>
