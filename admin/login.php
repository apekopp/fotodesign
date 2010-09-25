<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>login</title>
</head>
<body>
<form action="login.php" method="post">

	<fieldset>
		<legend>Login</legend>
		<label>Benutzer: <input type="text" name="user"></input></label>
		<label>Passwort: <input type="password" name="pass"></input></label>
		<input type="submit" name="submit" value="Abschicken"></input>
	</fieldset>
</form>
</body>
</html>

<?php 
	
	session_start();  
     error_reporting(E_ALL);
	ini_set('display_errors',1);
	include '../db.php'; 
	
     if (isset($_SESSION["benutzer"]))
     {
     	session_destroy();
     	die ('Ihre Sitzung wurde aus Sicherheitsgr&uuml;nden geschlossen' . '<br />');
     }
  
    if(isset($_POST['user']) AND isset($_POST['pass'])) {  
    	$username = $_POST["user"];  
    
        $passwort = $_POST["pass"];  

        if(preg_match('/[<>]/',$username)) {  
        echo 'Eingabe abgelehnt, Eingabe enthält eines der folgenden Zeichen: <>';  
        exit();  
        }   
         
       if(preg_match('/[<>]/',$passwort)) {  
         echo 'Eingabe abgelehnt, Eingabe enthält eines der folgenden Zeichen: <>';  
         exit();  
         }   
           
        $passwort=md5($passwort);
     	
           
         $select = "SELECT  
                         name,  
                         password  
                     FROM  
                         user  
                     WHERE  
                         name = '".$username."'  
                         AND  
                         password = '".$passwort."'";  
         
         $ergebnis = $db->query($select) OR die(mysqli_error());  
         $row = mysqli_num_rows($ergebnis);  
   
         if($row==true) {
             $_SESSION["benutzer"] = $username;
             echo  "Hallo " . $_SESSION["benutzer"] ."!" . "<br />";
             echo 'Eingabe akzeptiert' . "<br />";
             echo '<a href="admin.php">zur Bilderdatenbank</a>' . "<br />" ;
             echo '<a href="">zur Galerie</a>' . "<br />" ;
            } else {  
             die ("Falsche Eingabe!");
         } 
    }


?>
