
<?php



function validaEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false; // email is invalid
    }
    return true; // email is valid
}

function validaTelefone($telefone)
{
	$telefone = str_replace(array(" ", "-", "(", ")"), "", $telefone);
	if (strlen($telefone) < 10 || strlen($telefone) > 11) {
		return "Telefone inválido";
	}
}
function validaNome($nome)
{
    // Check if value is empty or null
    if (empty($nome) || is_null($nome)) return false;

    // Allow only alphabetical characters (both uppercase and lowercase) and spaces
    if (!preg_match('/^[a-zA-Z\s]+$/', $nome)) return false;

    return true;
}

function validaCpf($cpf)
{
	// Check if value is empty or null
	if (empty($cpf) || is_null($cpf)) return false;

	// Remove non-numeric characters from input
	$cpf = preg_replace("/[^0-9]/", "", $cpf);

	// Check if input has 11 numeric characters
	if (strlen($cpf) != 11) return false;

	// Check if all digits are the same (invalid CPF)
	if (preg_match('/(\d)\1{10}/', $cpf)) return false;

	// Validate CPF algorithm
	$sum = 0;
	for ($i = 0; $i < 9; $i++) {
		$sum += intval(substr($cpf, $i, 1)) * (10 - $i);
	}
	$digit1 = ($sum % 11 < 2) ? 0 : 11 - $sum % 11;

	$sum = 0;
	for ($i = 0; $i < 9; $i++) {
		$sum += intval(substr($cpf, $i + 1, 1)) * (11 - $i);
	}
	$digit2 = ($sum % 11 < 2) ? 0 : 11 - $sum % 11;

	// Check if calculated check digits match input
	if ($cpf == substr($cpf, 0, 9) . $digit1 . $digit2) {
		return true;
	} else {
		return false;
	}
}

function valida($nome, $cpf, $email)
{
	$resp = true;


    $validacao = array(
        validaEmail($email),
        validaCpf($cpf),
        validaNome($nome)
    );


	for ($i = 0; $i < sizeof($validacao); $i++) {
        if ($validacao[$i] == false) {
            // Return the error message as a string
			//echo $i;
            if ($i == 0) {
                return "E-mail inválido";
            } elseif ($i == 1) {
                return "CPF inválido";
            } elseif ($i == 2) {
                return "Nome inválido";
            }
        }
    }

    return $resp;
}

?>


