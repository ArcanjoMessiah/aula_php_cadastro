
<?php
	function conectaDB() {


		?>
		<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="">SENAC-AULA</a>
<input class="form-control form-control-dark w-100" type="text" placeholder="Pesquisar" aria-label="Search">
<ul class="navbar-nav px-3">
<li class="nav-item text-nowrap">
  <a class="nav-link" href="index.html">Sair</a>
</li>
</ul>
</nav>

<div class="container-fluid">
<div class="row">
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">
	<ul class="nav flex-column">
	   <li class="nav-item">
		<a class="nav-link active" href="login.html">
		  <span data-feather="home"></span>
		  Login <span class="sr-only"></span>
		</a>
	  </li>			  
	  <li class="nav-item">
		<a class="nav-link active" href="index.html">
		  <span data-feather="home"></span>
		  Inicial <span class="sr-only"></span>
		</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link active" href="cadastrar.html">
		  <span data-feather="users"></span>
		  Cadastrar
		</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link active" href="atualizar.html">
		  <span data-feather="users"></span>
		  Atualizar
		</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link active" href="excluir.html">
		  <span data-feather="users"></span>
		  Excluir
		</a>
	  </li>
	</ul>

	<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Relatórios</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="pesquisar.html">
                  <span data-feather="file-text"></span>
                  Pessoas
                </a>
              </li>
			  
            </ul>

			<hr class="my-4">
			<div class="row g-3">
                        <div class="col-md-4">
                            <button onclick="history.back()" class="w-100 btn btn-secondary btn-lg">Voltar</button>
                        </div>
                    </div>
          </div>
        </nav>
		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

          <div class="d-flex justify-content-between  align-items-center pb-2 mb-3 border-bottom">
	<?php

		echo "conectaDB result = ";
		
		// comando para alterar a senha do mysql: precisa estar no banco do mysql
		//ALTER USER 'root'@'localhost' IDENTIFIED BY 'root';
		// alterando a senha de root é preciso alterar o arquivo do phpMyadmin
		
		// C:\xampp\phpMyAdmin\config.inc.php para a senha root 
		// $cfg['Servers'][$i]['password'] = 'root';
		$servername = "localhost";
		$username = "root";
		$password = "";
		$db = "cadastro";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $db);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		
		echo "Connected successfully";
		echo "<br><br>";
		
		return $conn;
	}

	/*static function getInstance() {
		try {
			if (!isset(self::$instance)) {
				self::$instance = new PDO("mysql:host=localhost;dbname=db_sistema1.1;charset=UTF8","root","");
				self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
		} catch (PDOException $exc) {
			throw new Exception("Erro ao conectar o banco de dados :" . $exc->getMessage());
		}
		if (!self::$instance instanceof PDO) {
			throw new Exception("Erro ao conectar o banco de dados: PDO não foi instanciado corretamente");
		}
		return self::$instance;
	}*/
?>
