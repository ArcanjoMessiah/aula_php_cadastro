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

			// criar campo de senha no banco de dados
			// alter TABLE pessoa ADD senha CHARACTER(8);
			// inserir senha 123456 para todos
			// update pessoa set senha = '123456';
			
			function autenticarBind($conn, $pessoa){
				
				echo "<br> Login: ".$pessoa->getLogin();
				
				$stm = $conn->prepare('SELECT NOME, SOBRENOME FROM cadastro.pessoa WHERE LOGIN=? and SENHA=?');
				
				$stm->bind_param('ss', $pessoa->getLogin(), $pessoa->getSenha());
				
				$stm->execute();
						
				$autenticado = 0;
				
				$result = $stm->get_result();
				
				try {
					while($row = mysqli_fetch_assoc($result)) {
						var_dump($row);
						echo "<br>". " - Nome: " . $row["NOME"];
						echo "<br>". " - Sobre Nome: " . $row["SOBRENOME"];
						$autenticado=1;
					}
				}
				catch (mysqli_sql_exception $e) {
					$autenticado=0;
				}
				
				echo "<br>"."<br>"."Valor Interno login ".$autenticado;
				
				$_SESSION['autenticado'] = $autenticado;
				
				if ($autenticado == 1) {
					$inactive = 10;

					$_SESSION['expire'] = time() + $inactive; // static expire
					
					redirect("index.html");
				}
				else
					redirect("login.html");
			}
						
			function autenticar() {
						
				if (isset($_POST["login"]) && isset($_POST["senha"])) {
					
					// abre conexão com o banco de dados
					$conn = getInstance();
					
					$pessoa = new Pessoa();
					$pessoa->setLogin($_POST["login"]);
					$pessoa->setSenha($_POST["senha"]);

					autenticarBind($conn, $pessoa);
					
				}
			}
			
			if (isset($_POST["autenticar"]))
				autenticar();

		?>
	</body>
</html>
