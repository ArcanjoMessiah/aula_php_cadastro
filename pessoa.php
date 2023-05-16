
<?php
class Pessoa
{
	private $nome;
	private $sobrenome;
	private $login;
	private $email;
	private $endereco;
	private $pais;
	private $estado;
	private $cep;
	private $senha;
	private $cpf;

	function setNome($nome)
	{
		$this->nome = $nome;
	}
	function getNome()
	{
		return $this->nome;
	}
	function setSobreNome($sobrenome)
	{
		$this->sobrenome = $sobrenome;
	}
	function getSobreNome()
	{
		return $this->sobrenome;
	}
	function setLogin($login)
	{
		$this->login = $login;
	}
	function getLogin()
	{
		return $this->login;
	}
	function setEmail($email)
	{
		$this->email = $email;
	}
	function getEmail()
	{
		return $this->email;
	}
	function setEndereco($endereco)
	{
		$this->endereco = $endereco;
	}
	function getEndereco()
	{
		return $this->endereco;
	}
	function setPais($pais)
	{
		$this->pais = $pais;
	}
	function getPais()
	{
		return $this->pais;
	}
	function setEstado($estado)
	{
		$this->estado = $estado;
	}
	function getEstado()
	{
		return $this->estado;
	}
	function setCep($cep)
	{
		$this->cep = $cep;
	}
	function getCep()
	{
		return $this->cep;
	}
	function setSenha($senha)
	{
		$this->senha = $senha;
	}
	function getSenha()
	{
		return $this->senha;
	}
	function setCpf($cpf)
	{
		$this->cpf = $cpf;
	}
	function getCpf()
	{
		return $this->cpf;
	}
}
?>
