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
			include 'validapessoa.php';
		
			function excluirOO($conn, $pessoa){
				
				echo "<br> Nome: ".$pessoa->getNome();
				echo "<br> SobreNome: ".$pessoa->getSobreNome();
				echo "<br> Login: ".$pessoa->getLogin();
				echo "<br> Email: ".$pessoa->getEmail();
				echo "<br> Endereço: ".$pessoa->getEndereco();
				echo "<br> Pais: ".$pessoa->getPais();
				echo "<br> Estado: ".$pessoa->getEstado();
				echo "<br> Cep: ".$pessoa->getCep();
				
				$nome = $pessoa->getNome();
				$sobrenome = $pessoa->getSobreNome();
				$login = $pessoa->getLogin();
				$email = $pessoa->getEmail();
				$endereco = $pessoa->getEndereco();
				$pais = $pessoa->getPais();
				$estado = $pessoa->getEstado();
				$cep = $pessoa->getCep();
				
				$sql = "DELETE FROM cadastro.pessoa ";
				$sql .= "WHERE LOGIN = "."'".$pessoa->getLogin()."'". " ";
				
				echo "<br>";
				echo $sql;
				
				if ($conn->query($sql) === TRUE) {
					echo "<br> Registros Excluidos com sucesso";
					function_alert("Registros Excluidos com sucesso");
				} else {
					echo "Error Delete: " . $conn->error;
				}
			}
			
			function excluir() {
						
				if (valida() == true && sessaoautenticada()) {
					
					// abre conexão com o banco de dados
					$conn = conectaDB();
					
					// recuperando dados via POST
					$nome = $_POST["nome"];
					$sobrenome = $_POST["sobrenome"];
					$login = $_POST["login"];
					$email = $_POST["email"];
					$endereco = $_POST["endereco"];
					$pais = $_POST["pais"];
					$estado = $_POST["estado"];
					$cep = $_POST["cep"];
					
					// realiza insert
					//insert($conn, $nome, $sobrenome, $login, $email, $endereco, $pais, $estado, $cep);
				
					$pessoa = new Pessoa();
					$pessoa->setNome($nome);
					$pessoa->setSobreNome($sobrenome);
					$pessoa->setLogin($login);
					$pessoa->setEmail($email);
					$pessoa->setEndereco($endereco);
					$pessoa->setPais($pais);
					$pessoa->setEstado($estado);
					$pessoa->setCep($cep);
					
					excluirOO($conn, $pessoa);
				}
			}
			
			if (isset($_POST["excluir"]))
				excluir();

		?>
	</body>
</html>
