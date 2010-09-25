<?php

$db = new mysqli('localhost', 'root', 'root', 'k2op');

if (mysqli_connect_errno()) {
	die ("Die Verbindung mit der Datenbank konnte nicht hergestellt werden");
}

?>