<!DOCTYPE html>
<html>
	<head> 
		<meta charset="UTF-8"> 
		<link href="bootstrap-5.2.1-dist/css/bootstrap.min.css" rel="stylesheet">		
	</head>
	<body>
		<h1>exemplo</h1> 
		
		<?php
			
			include 'conection.php';
			include 'pessoa.php';
			include 'util.php';
			
			function selectOO($conn, $pessoa){
				
				echo "<br> Login: ".$pessoa->getLogin();
				
				$sql = "SELECT NOME, SOBRENOME FROM cadastro.pessoa WHERE LOGIN = '".$pessoa->getLogin()."'";								
				
				echo "<br>". $sql;
				
				$result = $conn->query($sql);

				echo "<br> Numero de Linhas = ".$result->num_rows."<br>";

				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						var_dump($row);
						echo "<br>". " - Nome: " . $row["NOME"];
						echo "<br>". " - Sobre Nome: " . $row["SOBRENOME"];
					}
				}
			}
			
			function pesquisaBind($conn, $pessoa){
				
				echo "<br> Login: ".$pessoa->getLogin();
				
				$stm = $conn->prepare('SELECT NOME, SOBRENOME FROM cadastro.pessoa WHERE LOGIN=?');
				
				$stm->bind_param('s', $pessoa->getLogin());
				
				$stm->execute();
				
				try {
					while($row = $stm->get_result()->fetch_assoc()) {
						var_dump($row);
						echo "<br>". " - Nome: " . $row["NOME"];
						echo "<br>". " - Sobre Nome: " . $row["SOBRENOME"];
					}
				}
				catch (mysqli_sql_exception $e) {
				}
			}
						
			function pesquisar() {
				
				if (sessaoautenticada() === 0) {
					echo "<br>"."Não Logado";
					redirect("login.html");
				}
				else {
					echo "<br>"."Logado = " . sessaoautenticada();
				}
				
				if (isset($_POST["login"])) {
					
					// abre conexão com o banco de dados
					$conn = conectaDB();
					
					$pessoa = new Pessoa();
					$pessoa->setLogin($_POST["login"]);
					
					//selectOO($conn, $pessoa
					
					pesquisaBind($conn, $pessoa);
					
				}
			}
			
			if (isset($_POST["pesquisar"]))
				pesquisar();

		?>
	</body>
</html>
