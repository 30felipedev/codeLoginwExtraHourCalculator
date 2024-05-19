<?php

$usuario = 'root';
$senha = '';
$database = 'bancodedados';
$host = 'localhost';

$conn = mysqli_connect($host, $usuario, $senha, $database);

if($conn->error) {
    die("Falha ao conectar ao banco de dados: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="index.css">

    <title>Login</title>

</head>

<body>

    <form id="main-content" action="" method="POST">

	<h2>Acesse sua conta</h2>

    <div class="div-input">
    <label>E-mail</label>
    <input type="email" name="email">
    </div>

    <div class="div-input">
    <label>Senha</label>
    <input type="password" name="senha">
    </div>
    <input class="button" type="submit" value="Entrar">

	<?php
    if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
        echo '<h5 class="titulo">Preencha seu e-mail</h5>';
    } else if(strlen($_POST['senha']) == 0) {
        echo '<h5 class="titulo">Preencha sua senha</h5>';
    } else {

        $email = mysqli_real_escape_string($conn, ($_POST['email']));
        $senha = mysqli_real_escape_string($conn, ($_POST['senha']));

        $sql_code = "SELECT * FROM tabela WHERE email = '$email' AND senha = '$senha'";
        $sql_query = mysqli_query($conn, $sql_code) or die("Falha na execução do código SQL: " . $conn->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();
            session_start();
            $_SESSION['id'] = $usuario['id'];
            
			$_SESSION['usuario'] = $usuario;
            header("Location: index.php");

        }else {
            echo '<h5 class="titulo">Falha ao logar! E-mail ou senha incorretos</h5>';
        }
        }

    }   
    ?>

    </form>

</body>

</html>