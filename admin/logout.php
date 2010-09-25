<?php
     session_start();
     
     if (isset($_SESSION["benutzer"]))
	{
		$_SESSION = array();
		session_destroy();
		echo 'Sie haben sich erfolgreich ausgelogt' . "<br />" . "<a href=\"login.php\">Neu einloggen?</a>";
	}
	else {
		echo"Sie haben sich bereits ausgeloggt" . "<br />" . "<a href=\"login.php\">Neu einloggen?</a>";
	}
?>