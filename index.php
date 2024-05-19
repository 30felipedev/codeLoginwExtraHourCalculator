<?php
if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])){
    header('Location: index.php');

}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Calcular hora extra</title>
<link rel="stylesheet" href="main.css">

</head>
<body>
<div class="user-info">
    <?php

        include('conn.php');

        $id = $_SESSION['id'];
        $sql = "SELECT nome FROM tabela WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);

        echo 'Bem vindo, ' . $user['nome'] . '.';

    ?>
    <a href="logout.php">Sair</a>
    </div>

	<div class="main-content">

		<h2>Calculadora de hora extra</h2>
		<form method="post">

			<label for="salario">Salário bruto:</label>
			<input type="number" name="salario" id="salario" required>

			<label for="cargaMensal">Carga horária mensal:</label>
			<input type="number" name="cargaMensal" id="cargaMensal" required>

			<label for="porcentagemHExtra">Porcentagem da hora extra:</label>
			<input type="number" name="porcentagemHExtra" id="porcentagemHExtra" required>

			<label for="quantHExtra">Quantidade de horas extras:</label>
			<input type="number" name="quantHExtra" id="quantHExtra" required>

			<input type="submit" value="Calcular">

		</form>
		</div>

		<div class="main-content">
		<?php
			echo '<h2 class="result">Resultado:</h2><br>';
			if ($_SERVER["REQUEST_METHOD"] == "POST") {

				$salario = $_POST["salario"];
				$cargaMensal = $_POST["cargaMensal"];
				$porcentagemHExtra = $_POST["porcentagemHExtra"];
				$quantHExtra = $_POST["quantHExtra"];

				$hora = $salario / $cargaMensal;

				if($porcentagemHExtra == 50){
					
					$hExtra = $quantHExtra * ($hora * 1.5);

					
					echo "<p>Salário bruto: R$". number_format($salario)."</p><br>";
					echo "<p>Carga horária mensal: ". $cargaMensal."</p><br>";
					echo "<p>Salário hora: R$". number_format($hora)."</p><br>";
					echo "<p>Porcentagem das horas extras: ". $porcentagemHExtra."%"."</p><br>";
					echo "<p>Quantidade de horas extras: ". $quantHExtra."</p><br>";
					echo "<p>Valor das horas extras: R$". number_format($hExtra)."</p><br>";

				}
				if($porcentagemHExtra == 100){

					$hExtra = $hora * 2;
					$vExtra = $hExtra * $quantHExtra;

					
					echo "<p>Salário bruto: R$". number_format($salario)."</p><br>";
					echo "<p>Carga horária mensal: ". $cargaMensal."</p><br>";
					echo "<p>Salário hora: R$". number_format($valor_hora)."</p><br>";
					echo "<p>Porcentagem das horas extras: ". $porcentagemHExtra."%"."</p><br>";
					echo "<p>Quantidade de horas extras: ". $quantHExtra."</p><br>";
					echo "<p>Valor das horas extras: R$". number_format($vExtra)."</p><br>";

				}
            }
        ?>
		</div>
</body>
</html>