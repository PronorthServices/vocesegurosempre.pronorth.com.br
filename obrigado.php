<?php

$nome = $_POST["Nome"];
$telefone = $_POST["Telefone"];
$email = $_POST["Email"];
$mensagem = $_POST["Mensagem"];

try {
    $pdo = new PDO('mysql:host=localhost;dbname=clientes',"root", "");
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $pdo->prepare('INSERT INTO clientes (nome, telefone, email, mensagem) VALUES(:nome,:telefone,:email,:mensagem)');
  $stmt->execute(array(
      ':nome' => $nome,
      ':telefone' => $telefone,
      ':email' => $email,
      ':mensagem' => $mensagem
  ));

  echo $stmt->rowCount();
} catch(PDOException $e) {
    echo "Ops! Erro ao processar sua solicitação.";
}


