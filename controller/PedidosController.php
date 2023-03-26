<?php

  function listarPedidos(){
    global $conn;
    // prepara a query
    $sql = "SELECT SUM(pp.quantidade*p.valor_venda) AS preco, o.id
            FROM pedido_produto pp
            LEFT JOIN produtos p ON p.id = pp.produto_id
            LEFT JOIN pedidos o ON o.id = pp.pedido_id
            WHERE o.deleted_at IS NULL
            GROUP BY o.id";
    $stmt = $conn->prepare($sql);

    // executa a query
    $stmt->execute();

    // recupera os resultados
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $resultado;
  }

  function removerPedido($id){
    global $conn;
    // prepara a query
    $stmt = $conn->prepare("UPDATE pedidos SET deleted_at=NOW() WHERE id = $id");

    // executa a query
    if($stmt->execute()){

      // reabastecer o estoque
      $sql = "UPDATE produtos pr
      LEFT JOIN pedido_produto pp ON pp.produto_id = pr.id
      SET pr.estoque = pr.estoque+pp.quantidade
      WHERE pp.pedido_id = $id";

      $stmt_items = $conn->prepare($sql);
      $stmt_items->execute();

      return true;
    }else
      return false;

  }

  function cadastrarPedido(){
    global $conn;

    // preparar a instrução SQL para inserir o novo pedido
    $stmt = $conn->prepare("INSERT INTO pedidos VALUES (NULL, NOW(), NULL)");

    // executa a query
    if($stmt->execute()){
      // recuperar o ID do pedido que acabou de ser inserido
      $id = $conn->lastInsertId();

      $stmt_car = $conn->prepare("SELECT * FROM carrinho");

      $stmt_car->execute();

      $resultado = $stmt_car->fetchAll(PDO::FETCH_ASSOC);

      foreach($resultado AS $itens){
        $stmt_order = $conn->prepare("INSERT INTO pedido_produto VALUES($id, ".$itens["produto_id"].", ".$itens["quantidade"].")");
        $stmt_order->execute();

        // atualizar estoque
        $stmt_estoque = $conn->prepare("UPDATE produtos SET estoque=estoque-".$itens["quantidade"]." WHERE id=".$itens["produto_id"]);
        $stmt_estoque->execute();
      }

      // esvaziar carrinho
      $stmt_car_del = $conn->prepare("DELETE FROM carrinho");
      $stmt_car_del->execute();

      return true;
    }else
      return false;
  }

  function produtosPedido($id){
    global $conn;
    // prepara a query
    $sql = "SELECT pp.quantidade, p.descricao
    FROM pedido_produto pp
    LEFT JOIN produtos p on p.id = pp.produto_id
    WHERE pp.pedido_id=$id";
    $stmt = $conn->prepare($sql);

    // executa a query
    $stmt->execute();

    // recupera os resultados
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $resultado;
  }

  function addCarrinho(){
    global $conn;

    // preparar a instrução SQL
    $stmt = $conn->prepare("INSERT INTO carrinho VALUES (NULL, ".$_POST["produto_id"].", ".$_POST["quantidade"].")");

    // executa a query
    $stmt->execute();

    return true;
  }

  function produtosDisponiveis(){
    global $conn;

    // preparar a instrução SQL
    $sql = "SELECT p.*
            FROM produtos p
            LEFT JOIN carrinho c ON c.produto_id = p.id
            WHERE c.produto_id IS NULL
            AND p.deleted_at IS NULL
            ";
    $stmt = $conn->prepare($sql);

    // executa a query
    $stmt->execute();

    // recupera os resultados
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $resultado;
  }

  function listCar(){
    global $conn;

    // preparar a instrução SQL
    $sql = "SELECT p.descricao, c.quantidade, p.valor_venda, c.id
            FROM produtos p
            LEFT JOIN carrinho c ON c.produto_id = p.id
            WHERE c.produto_id IS NOT NULL
            ";
    $stmt = $conn->prepare($sql);

    // executa a query
    $stmt->execute();

    // recupera os resultados
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $resultado;
  }

  function removerCarrinho($id){
    global $conn;

    // preparar a instrução SQL
    $stmt = $conn->prepare("DELETE FROM carrinho WHERE id=$id");

    // executa a query
    $stmt->execute();

    return true;
  }

?>
