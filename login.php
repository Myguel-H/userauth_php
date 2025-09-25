<?php


session_start();

    try {
        $pdo = new PDO("pgsql:host=localhost;dbname=register", "nygts", "lirios00" );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $email = $_POST['email'];
    $password = $_POST['password'];


        $sql = "SELECT * FROM register WHERE email=?";
        $executar = $pdo->prepare($sql);
        $executar->execute([$email]);

        $usuario = $executar->fetch(PDO::FETCH_ASSOC);

        if($usuario && password_verify($senha, $usuario["senha"])) {
    echo "Acessou";
}else {
    "Senha nao existe ou usuario nao encontrado";
}

    }catch (PDOException $erro) {
        die("Deu erro: " . $erro->getMessage());
    }

    session_destroy();

?>