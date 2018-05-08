<?php

$nome = $_POST["Nome"];
$telefone = $_POST["Telefone"];
$email = $_POST["Email"];
$mensagem = $_POST["Mensagem"];

try {
    $pdo = new PDO('mysql:host=centraldoslead.mysql.dbaas.com.br;dbname=centraldoslead',"centraldoslead", "julio10");
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $pdo->prepare('INSERT INTO adt_leads(name, phone, email, message, date_created) VALUES(:nome,:telefone,:email,:mensagem, :date)');
  $stmt->execute(array(
      ':nome' => $nome,
      ':telefone' => $telefone,
      ':email' => $email,
      ':mensagem' => $mensagem,
      ':date' => date('Y-m-d H:i:s')
  ));

  echo "Contato Enviado com sucesso";
} catch(PDOException $e) {
    echo "Ops! Erro ao processar sua solicitação.";
}


