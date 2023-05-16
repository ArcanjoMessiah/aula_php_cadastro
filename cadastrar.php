<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<link href="bootstrap-5.2.1-dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<h1>Exemplo</h1>

	<?php

	include 'conection.php';
	include 'pessoa.php';
	include 'util.php';
	include 'validapessoa.php';

	session_start(); // inicializando a sessão

	if (isset($_POST["gravar"])) {
		$nome = $_POST["nome"] ;
		$cpf = $_POST["cpf"];
		$email = $_POST["email"] ;
		$login = $_POST["login"] ; // new parameter
		$endereco = $_POST["endereco"]; // new parameter
		$pais = $_POST["pais"]; // new parameter
		$estado = $_POST["estado"]; // new parameter
		$sobrenome = $_POST["sobrenome"]; // new parameter
		$cep = $_POST["cep"]; // new parameter

		cadastrar($nome, $cpf, $email, $login, $endereco, $pais, $estado, $sobrenome, $cep);

	   

	}		

	function cadastrar($nome, $cpf, $email, $login, $endereco, $pais, $estado, $sobrenome, $cep)
{
    if (valida($nome, $cpf, $email) === true && sessaoautenticada() === true) {
        $conn = conectaDB();

        $pessoa = new Pessoa();
        $pessoa->setNome($nome);
        $pessoa->setCpf($cpf);
        $pessoa->setEmail($email);
        $pessoa->setLogin($login);
        $pessoa->setEndereco($endereco);
        $pessoa->setPais($pais);
        $pessoa->setEstado($estado);
        $pessoa->setSobreNome($sobrenome);
        $pessoa->setCep($cep);

        insert($conn, $pessoa);
    }
}


	function adicionar($conn, $pessoa)
	{
		try {
			$insere = $conn->prepare('INSERT INTO cadastro.pessoa (nome, sobrenome, login, email, endereco, pais, estado, cep, cpf) VALUES(?,?,?,?,?,?,?,?,?);');
			$insere->bind_param('sssssssss',
				$pessoa->getNome(),
				$pessoa->getSobreNome(),
				$pessoa->getLogin(),
				$pessoa->getEmail(),
				$pessoa->getEndereco(),
				$pessoa->getPais(),
				$pessoa->getEstado(),
				$pessoa->getCep(),
				$pessoa->getCpf());
			$result_sql = $insere->execute();

			if ($result_sql) {
				echo "Records inserted successfully";
				function_alert("Records inserted successfully");
			} else {
				echo "Error insert: " . $insere->error;
			}
		} catch (mysqli_sql_exception $e) {
			function_alert("Error in insertion");
		}
	}


	function insertOO($conn, $pessoa)
{
    // First check if the Pessoa already exists in the database
    $cpf = $pessoa->getCpf();
    $sql_check = "SELECT cpf FROM cadastro.pessoa WHERE cpf='$cpf'";
    $result = $conn->query($sql_check);

    if ($result->num_rows == 0) { // If the Pessoa does not exist, insert into the database
        $nome = $pessoa->getNome();
        $sobrenome = $pessoa->getSobreNome();
        $login = $pessoa->getLogin();
        $email = $pessoa->getEmail();
        $endereco = $pessoa->getEndereco();
        $pais = $pessoa->getPais();
        $estado = $pessoa->getEstado();
        $cep = $pessoa->getCep();

        $sql = "INSERT INTO cadastro.pessoa (nome, sobrenome, login, email, endereco, pais, estado, cep, cpf) 
                VALUES ('$nome','$sobrenome','$login','$email','$endereco','$pais','$estado','$cep','$cpf')";

        echo "<br>" . $sql;

        if ($conn->query($sql) === TRUE) {
            echo "Records inserted successfully";
            function_alert("Records inserted successfully");
            insert($conn, $pessoa);
        } else {
            echo "Error insert: " . $conn->error;
        }
    } else {
        echo "Error insert: Pessoa with CPF $cpf already exists in database";
    }
}

function insert($conn, $pessoa)
{
    

    $nome = $pessoa->getNome();
    $sobrenome = $pessoa->getSobreNome();
    $login = $pessoa->getLogin();
    $email = $pessoa->getEmail();
    $endereco = $pessoa->getEndereco();
    $pais = $pessoa->getPais();
    $estado = $pessoa->getEstado();
    $cep = $pessoa->getCep();

	$stmt = $conn->prepare("INSERT INTO pessoas (nome, sobrenome, login, email, endereco, pais, estado, cep) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $nome, $sobrenome, $login, $email, $endereco, $pais, $estado, $cep);

    $stmt->execute();
    $stmt->close();

    echo "Pessoa added successfully to database";
}
	

	?>
</body>

</html>
