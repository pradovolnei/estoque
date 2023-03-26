<?php

  function listarProdutos(){
    global $conn;
    // prepara a query
    $stmt = $conn->prepare("SELECT * FROM produtos WHERE deleted_at IS NULL");

    // executa a query
    $stmt->execute();

    // recupera os resultados
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $resultado;
  }

  function removerProduto($id){
    global $conn;
    // prepara a query
    $stmt = $conn->prepare("UPDATE produtos SET deleted_at=NOW() WHERE id = $id");

    // executa a query
    if($stmt->execute())
      return true;
    else
      return false;

  }

  function cadastrarProduto(){
    global $conn;

    // preparar a instrução SQL para inserir o novo produto
    $stmt = $conn->prepare("INSERT INTO produtos(descricao, valor_venda, estoque, created_at) VALUES (:descricao, :valor_venda, :estoque, NOW())");

    // vincular os parâmetros da instrução SQL aos valores enviados pelo formulário
    $stmt->bindParam(':descricao', $_POST["descricao"]);
    $stmt->bindParam(':valor_venda', $_POST["valor_venda"]);
    $stmt->bindParam(':estoque', $_POST["estoque"]);

    // executa a query
    if($stmt->execute()){
      // recuperar o ID do produto que acabou de ser inserido
      $id = $conn->lastInsertId();
      for($i=0; $i<count($_FILES["imagem"]["name"]); $i++) {

        $stmt_img = $conn->prepare("INSERT INTO galeria(produto_id) VALUES (:produto_id)");
        $stmt_img->bindParam(':produto_id', $id);
        $stmt_img->execute();

        $id_imagem = $conn->lastInsertId();
        // criar uma variável para armazenar o caminho onde o arquivo será salvo
        $caminhoArquivo = "dist/img/products/" . $id_imagem.".jpg";

        $stm_upload = $conn->prepare("UPDATE galeria SET imagem='$caminhoArquivo' WHERE id=$id_imagem");
        $stm_upload->execute();

        // mover o arquivo da pasta temporária para a pasta de destino
        move_uploaded_file($_FILES["imagem"]["tmp_name"][$i], $caminhoArquivo);
      }

      return true;
    }else
      return false;
  }

  function galeriaProduto($id){
    global $conn;

    // prepara a query
    $stmt = $conn->prepare("SELECT * FROM galeria WHERE produto_id = $id");

    // executa a query
    $stmt->execute();

    // recupera os resultados
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $resultado;
  }

  function editarProduto($id){
    global $conn;

    // prepara a query
    $stmt = $conn->prepare("UPDATE produtos SET descricao = :descricao, valor_venda= :valor_venda, estoque = :estoque WHERE id = $id");
    $stmt->bindParam(':descricao', $_POST["descricao"]);
    $stmt->bindParam(':valor_venda', $_POST["valor_venda"]);
    $stmt->bindParam(':estoque', $_POST["estoque"]);

    // executa a query
    if($stmt->execute()){
      $id = $_POST["id"];
      for($i=0; $i<count($_FILES["imagem"]["name"]); $i++) {

        $stmt_img = $conn->prepare("INSERT INTO galeria(produto_id) VALUES (:produto_id)");
        $stmt_img->bindParam(':produto_id', $id);
        $stmt_img->execute();

        $id_imagem = $conn->lastInsertId();
        // criar uma variável para armazenar o caminho onde o arquivo será salvo
        $caminhoArquivo = "dist/img/products/" . $id_imagem.".jpg";

        $stm_upload = $conn->prepare("UPDATE galeria SET imagem='$caminhoArquivo' WHERE id=$id_imagem");
        $stm_upload->execute();

        // mover o arquivo da pasta temporária para a pasta de destino
        move_uploaded_file($_FILES["imagem"]["tmp_name"][$i], $caminhoArquivo);

        return true;
      }
    }else
      return false;
  }

  function dadosProduto($id){
    global $conn;
    // prepara a query
    $stmt = $conn->prepare("SELECT * FROM produtos WHERE id = $id");

    // executa a query
    $stmt->execute();

    // recupera os resultados
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    return $resultado;
  }

  function removerImagem($id){
    global $conn;
    // prepara a query
    $stmt = $conn->prepare("DELETE FROM galeria WHERE id = $id");

    // executa a query
    if($stmt->execute()){
      $caminho_arquivo = "dist/img/products/$id.jpg"; // caminho completo para o arquivo que será removido

      if (file_exists($caminho_arquivo)) { // verifica se o arquivo existe
          unlink($caminho_arquivo); // remove o arquivo
      }
      return true;
    }
  }

?>
