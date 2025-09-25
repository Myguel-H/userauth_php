<?php

$hostname = 'localhost';
$username = 'nygts';
$password = 'lirios00';
$dbname = 'register';


try {
    $conn = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("E-mail invalido !");
    }
    if (empty($password) || strlen($password) < 6) {
        die("Senha inválida! Mínimo 6 caracteres.");
    }

    $sql = "SELECT id FROM register WHERE email = :email LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->fetch(PDO::FETCH_ASSOC)) {
        die("E-mail já cadastrado!");
    }

    $pass = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO register (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    echo "Usuario Cadastrado !";
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

$conn = null;
