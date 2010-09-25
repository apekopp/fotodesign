<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Kontakt</title>
</head>
<body>

<form action="<?=GetParam('PHP_SELF','S')?>" method="post">
<fieldset>
	<legend>Kontakt</legend>
		Name: <input type="text" name="fromname" size=50 maxlength=120 value="<?=$from_name?>"/><br />
		E-Mail-Adresse: <input type="text" name="frommail" size=50 maxlength=120 value="<?=$from_mail?>"/><br />
		Betreff: <input type="text" name="mailsubject" size=50 maxlength=120 value="<?=$mail_subject?>"/><br />	
		Nachricht: <textarea cols=43 rows=10 name="mailtext"><?=$mail_text?></textarea><br />
		<input type="hidden" value="1" name="s"/>
		<input type="submit" value="Nachricht versenden" name="submit"/>
</fieldset>
</form>

</body>
</html>

<?php

$mail_to = 'apekopp@gmx.de';

$from_name=GetParam('fromname');
$from_mail=strtolower(GetParam('frommail'));
$mail_subject=GetParam('mailsubject');
$mail_text=GetParam('mailtext');
$send=GetParam('s');

$err_text='';
if(trim($from_name)=='') $err_text.='Bitte geben Sie Ihren Namen an.<br>';
if(trim($from_mail)=='')
  $err_text.='Bitte geben Sie Ihre E-Mail-Adresse an.<br>';
else
  if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,6})$/i',$from_mail))
    $err_text.='Bitte geben Sie eine g&uuml;ltige E-Mail-Adresse an.<br>';
if(trim($mail_subject)=='') $err_text.='Bitte geben Sie einen Betreff ein.<br>';
if(trim($mail_text)=='') $err_text.='Bitte geben Sie einen Nachrichtentext ein.<br>';


if(strlen($mail_text)>1000) {
  $mail_text=substr($mail_text,0,1000).'... (Text wurde gek&uuml;rzt!)';
}
$from_name=str_replace(chr(34),"''",$from_name);
$mail_subject=str_replace(chr(34),"''",$mail_subject);
$from_name=stripslashes($from_name);
$from_mail=stripslashes($from_mail);
$mail_subject=stripslashes($mail_subject);
$mail_text=stripslashes($mail_text);

if (($send == '1') && ($err_text != '')) {
  echo '<p><big><b>Fehler:</b></big><br>';
  echo $err_text.'</p>';
}

if (($send != '1') || ($err_text != '')) {

} else {
  $header="From: $from_name <$from_mail>\n";
  $header.="Reply-To: $from_mail\n";
  $header.="X-Mailer: PHP-ContactForm-Script\n";
  $header.="Content-Type: text/plain";
  $mail_date=gmdate('D, d M Y H:i:s').' +0000';
  $send=0;
  if(@mail($mail_to,$mail_subject,$mail_text,$header))
  {
    echo "<p><b>Die Nachricht wurde erfolgreich abgesendet.</b></p>";
    echo "<p><a href=\"".GetParam('PHP_SELF','S')."?from_name=$from_name&from_mail=$from_mail\">Zur&uuml;ck zum Formular</a></p>";
    echo "<p><a href=\"home.php\">zur&uuml;ck zur Homepage</a></p>";
  }else{
    echo "<p><b>Beim Versenden der Nachricht ist ein Fehler aufgetreten!</b></p>";
    echo "<p><a href=\"".GetParam('PHP_SELF','S')."?from_name=$from_name&from_mail=$from_mail&mail_subject=$mail_subject&mail_text=";
    echo urlencode($mail_text)."\">Zur&uuml;ck zum Formular</a></p>";
  }
}

function GetParam($ParamName, $Method = 'P', $DefaultValue = '') {
  if ($Method == 'P') {
    if (isset($_POST[$ParamName])) return $_POST[$ParamName]; else return $DefaultValue;
  } else if ($Method == 'G') {
    if (isset($_GET[$ParamName])) return $_GET[$ParamName]; else return $DefaultValue;
  } else if ($Method == 'S') {
    if (isset($_SERVER[$ParamName])) return $_SERVER[$ParamName]; else return $DefaultValue;
  }
}
?>

