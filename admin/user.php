<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>neues Konto</title>
</head>
<body>
<form action="user.php" method="post">

<fieldset>
<legend>Benutzernamen und Passwort anlegen</legend>
<label>neuer Benutzer: <input type="text" name="user"></input></label>
<label>neues Passwort: <input type="password" name="pass"></input></label>
<input type="submit" name="submit" value="best&auml;tigen"></input>
</fieldset>

</form>

</body>
</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors',0);
include '../db.php';

$user=$_POST['user'];
$passwort=md5($_POST['pass']);
$update ="Update user SET name='$user', password='$passwort'";
$insert ="Insert INTO user (name, password) Values ('$user', '$passwort')";



if (
	isset($_POST['submit']) &&
	empty($_POST['user']) ||
	empty($_POST['pass'])
	)
{
	echo 'Bitte tragen sie ihren Benutzernamen und Passwort ein' . '<br />';
}
	
	else if ($db->affected_rows >= 0)
	{
		
	$db->query($update);
	echo "Datensatz erfolgreich geändert" . '<br />'; 
	echo '<a href="user_eintrag.html">zur&uuml;ck</a>';
	}
	else
	{
	$db->query($insert);
	echo "neuer Datensatz erfolgreich eingetragen" . '<br />'; 
	echo '<a href="admin.php">zur&uuml;ck</a>';
}
	

?>