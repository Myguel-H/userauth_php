<?php


$hostname = 'localhost';
$username = 'nygts';
$password = 'lirios00';
$dbname = 'register';

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $email_a_verificar = $_POST['email'] ?? '';

    //Verifica se a variavel (email fornecido no input usuario) nao esta vazio
    if (empty($email_a_verificar)) {
        echo "Erro: E-mail não fornecido.";
        exit;
    }

    $sql = "SELECT COUNT(*) FROM register WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email_a_verificar]);

    $email_existe = $stmt->fetchColumn();

    if ($email_existe > 0) {
        echo "Este e-mail já está cadastrado.";
    } else {
        echo "Este e-mail ainda não está cadastro, cadastre-o. </br>";
        echo 'Clique aqui para se registrar: <a href="./pages/reg_pag.html">Registrar-se</a>';
        // A partir daqui, você pode executar o INSERT
    }

} catch (PDOException $erro) {
    die("Erro no banco de dados: " . $erro->getMessage());
}
?>