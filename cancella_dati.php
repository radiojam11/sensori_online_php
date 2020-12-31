<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="stylesheet" href="stile_mio.css" type="text/css" />




<title>Tabella dati</title>
</head>

<body>




<?php
/*
  blocco dei parametri di connessione
*/
// nome di host
$host = "localhost:3306";
// nome del database
$db = "corso";
// username dell'utente in connessione
$user = "valerio";
// password dell'utente
$password = "XXXXXXXXXXXXXXXXX";

//dati da inserire
$id = $_GET['id'];

try {
  // stringa di connessione al DBMS
  $connessione = new PDO("mysql:host=$host;dbname=$db", $user, $password);
  // imposto dell'attributo necessario per ottenere il report degli errori
  $connessione->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  //iserisco i dati
  
$sql = "DELETE FROM SensorData WHERE id='".$id."'";
$stmt= $connessione->prepare($sql);
$stmt->execute();

echo 'La cancellazione è riuscita';

$connessione = null;
}

catch(PDOException $e)
{
  // notifica in caso di errore nel tentativo di connessione
  echo $e->getMessage();
}
$ref = $_SERVER['HTTP_REFERER'];
header( 'refresh: 2; url='.$ref);
?>


<br>
<a href="index.php">Torna al Menu</a>


</body>
</html>