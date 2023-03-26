<?php
  // informações de conexão
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "estoque";

  /// cria uma instância da classe PDO
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

?>
