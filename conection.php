
<?php
	function conectaDB() {
		echo "conectaDB";
		
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
