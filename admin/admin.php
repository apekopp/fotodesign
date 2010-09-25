<?php
error_reporting(E_ALL);
ini_set('display_errors',0);

session_start();
include('db.php');

if (!isset($_SESSION["benutzer"]))
{
	die('Sie sind nicht angemeldet! ' . '<a href="login.php>zur Anmeldung</a>');
}

if (!isset( $_SESSION['timeout'] ))
{
    $_SESSION['timeout'] = time();
}

// Pruefen ob die Session noch aktiv ist
if ($_SESSION['timeout']+1000 <= time())
{
    // Session loeschen und zum Login umleiten
    $_SESSION["benutzer"] = array();
    session_destroy();
    die ('Die Zeit Ihrer Sitzung ist abgelaufen. Bitte loggen Sie sich erneut ein'.'<br />' . '<a href="login.php>zur Anmeldung</a>');
} 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Admin</title>
</head>
<body>
	
	
	<div id="wrapper">
	<a href="logout.php">ausloggen</a>
		<div id="formular">
			<form action="" method="post">
				<fieldset>
					<legend>Bild hochladen (nur jpeg&acute;s m&ouml;glich)</legend>
					<label for="search"><input type="file" name="search"/></label><br />
					
					<label for="themen"><input type="radio" name="thema" value ="1"></input>Architekur</label><br />
					<label for="themen"><input type="radio" name="thema" value ="2"></input>Stilleben</label><br />
					<label for="themen"><input type="radio" name="thema" value ="3"></input>Natur</label><br />
					<label for="themen"><input type="radio" name="thema" value ="4"></input>Hochzeiten</label><br />
					<label for="themen"><input type="radio" name="thema" value ="5"></input>Portrait</label><br />				
					
					<label for="upload"><input type="submit" name="upload" value="hochladen"></input></label>
					
				
				</fieldset>
			</form> 
		</div>
	
	</div>


</body>
</html>
