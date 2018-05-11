<?php
if(count($_POST) > 0 ){
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
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://hooks.slack.com/services/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');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"text\":\"Nome {$nome} - Telefone: {$telefone} - Email:{$email} - Mensagem: {$mensagem} - D\"}");
        curl_setopt($ch, CURLOPT_POST, 1);
        $headers = array();
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        echo "<center>Contato Enviado com sucesso</center>";
    } catch(PDOException $e) {
        echo "Ops! Erro ao processar sua solicitação.";
    }
}