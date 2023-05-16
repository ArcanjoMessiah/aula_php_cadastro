
<?php
function function_alert($message)
{
	echo "<script>alert('$message');</script>";
}

function sessaoautenticada()
{
	var_dump($_SESSION);
	if (isset($_SESSION['autenticado'])) {
		if (time() > $_SESSION['expire']) {
			return 0;
		} else {
			return $_SESSION['autenticado'];
		}
	} else {
		return 0;
	}
}

function redirect($url)
{
	if (headers_sent()) {
		die('<script type="text/javascript">window.location=\'' . $url . '\';</script‌​>');
	} else {
		header('Location: ' . $url);
		die();
	}
}
?>
