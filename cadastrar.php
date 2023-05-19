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
        $nome = $_POST["nome"];
        $cpf = $_POST["cpf"];
        $email = $_POST["email"];
        $login = $_POST["login"]; // new parameter
        $endereco = $_POST["endereco"]; // new parameter
        $pais = $_POST["pais"]; // new parameter
        $estado = $_POST["estado"]; // new parameter
        $sobrenome = $_POST["sobrenome"]; // new parameter
        $cep = $_POST["cep"]; // new parameter

        cadastrar($nome, $cpf, $email, $login, $endereco, $pais, $estado, $sobrenome, $cep);
    }

    function cadastrar($nome, $cpf, $email, $login, $endereco, $pais, $estado, $sobrenome, $cep)
    {
        if (valida($nome, $cpf, $email) == true) {
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



            // fix: set cpf before inserting into database
            $cpf = $pessoa->getCpf();

            // fix: remove one of the insert functions
            // conectaDB($conn, $pessoa);

            // fix: use the addicionar() function instead
            adicionar($conn, $pessoa);
        }
    }

    function adicionar($conn, $pessoa)
    {
        // use an array to store the values
        $values = array(
            $pessoa->getNome(),
            $pessoa->getSobreNome(),
            $pessoa->getLogin(),
            $pessoa->getEmail(),
            $pessoa->getEndereco(),
            $pessoa->getPais(),
            $pessoa->getEstado(),
            $pessoa->getCep(),
            $pessoa->getCpf()
        );



        try {
            $stmt = $conn->prepare('INSERT INTO pessoa (nome, sobrenome, login, email, endereco, pais, estado, cep, cpf) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $stmt->bind_param('sssssssss', ...$values); // unpack the array


            $result_sql = $stmt->execute();
           
            if ($result_sql) {
                echo "<br><br>";
                echo "Records inserted successfully";
                function_alert("Records inserted successfully");

       

                echo "<br><br>";
                echo" 
                    
                    </div>
                    </div>
                    </main>";


            } else {
                echo "<br><br>";
                echo "Error insert: " . $stmt->error;
            }
        } catch (mysqli_sql_exception $e) {
            function_alert("Error in insertion");
        }

        // fix: close the database connection
        $conn->close();
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



            if ($conn->query($sql) == TRUE) {
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
        echo "cadastrar 6";
        $stmt = $conn->prepare("INSERT INTO pessoa (nome, sobrenome, login, email, endereco, pais, estado, cep) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $nome, $sobrenome, $login, $email, $endereco, $pais, $estado, $cep);

        $stmt->execute();
        $stmt->close();

        echo "Pessoa added successfully to database";
    }


    ?>
</body>

</html>