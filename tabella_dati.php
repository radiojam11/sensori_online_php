<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="stile_mio.css" type="text/css" />


<title>Tabella Dati</title>
</head>
<body>
<div align='center'>
<center>
<h1> Tabella Dati </h1>
<h2> TecnoGeppetto </h2>
<table width="80%" >
<!-- riga passata nel ciclo IF sotto
<tr><th>ID</th> <th>Sensor</th><th>Location</th><th>Temperatura</th><th>Umidità</th><th>Temp Percepita</th><th>Time Stamp</th><th>Elimina</th></tr>
-->

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
$password = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

/*
  blocco per gestire la stampa della tabella completa oppure il form cerca
  sensor
  location
  reading_time
  value1
  value2
  value3
*/
$contatore = 0;
if(!empty($_GET)){ 
	$sensor = $_GET["sensor"];
	$contatore = 1;
	if($sensor == ""){$contatore = 0;}
	if($sensor == "BMP180"){$contatore = 2;}
}



/*
  blocco try/catch di gestione delle eccezioni
*/

try {
  // stringa di connessione al DBMS
  $connessione = new PDO("mysql:host=$host;dbname=$db", $user, $password);
  // imposto dell'attributo necessario per ottenere il report degli errori
  $connessione->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  
  // selezione e visualizzazione dei dati estratti
  //Stampa di tutta la Tabella dati
  
  if($contatore == 0){
	  echo"<tr><h2> Stampa completa di tutta la Tabella </h2> <br> <a href='index.php'>Torna al Menù Principale</a> <br> <a href='form_cerca.php'>Vai al Menù Cerca</a> </tr>";
	  echo "<tr><th>ID</th> <th>Sensor</th><th>Location</th><th>Temperatura</th><th>Umidità/Altitud.</th><th>Temp Percepita/Pressione</th><th>Time Stamp</th><th>Elimina</th></tr>";
    foreach ($connessione->query("SELECT * FROM SensorData ORDER BY id DESC ") as $row)
	  {echo "<tr><td>". $row['id'] ."</td><td>". $row['sensor'] ."</td><td>". $row['location'] ."</td><td>". $row['value1'] ."</td><td>".$row['value2'] ."</td><td>".$row['value3'] ."</td><td>".$row['reading_time'] . "</td><td><a href='cancella_dati.php?id=".$row['id'] . "'>Elimina</a></td></tr>";
     }
  }
  
  // Stampa di un solo Sensore DHT11
  if($contatore == 1){
	 echo "<tr><th>ID</th> <th>Sensor</th><th>Location</th><th>Temperatura</th><th>Umidità</th><th>Temp Percepita</th><th>Time_Stamp</th><th>Elimina</th></tr>";
     foreach ($connessione->query("SELECT * FROM SensorData   WHERE sensor = '".$sensor."' ORDER BY id DESC") as $row )
	  {echo "<tr><td>". $row['id'] ."</td><td>". $row['sensor'] ."</td><td>". $row['location'] ."</td><td>". $row['value1'] ."</td><td>".$row['value2'] ."</td><td>".$row['value3'] ."</td><td>".$row['reading_time'] . "</td><td><a href='cancella_dati.php?id=".$row['id'] . "'>Elimina</a></td></tr>";
       }
  }
  
   // Stampa di un solo sensore BMP180
  if($contatore == 2){
	 echo "<tr><th>ID</th> <th>Sensor</th><th>Location</th><th>Temperatura</th><th>Altitudine</th><th>Pressione</th><th>Time Stamp</th><th>Elimina</th></tr>";
     foreach ($connessione->query("SELECT * FROM SensorData   WHERE sensor = '".$sensor."' ORDER BY id DESC") as $row )
	  {echo "<tr><td>". $row['id'] ."</td><td>". $row['sensor'] ."</td><td>". $row['location'] ."</td><td>". $row['value1'] ."</td><td>".$row['value2'] ."</td><td>".$row['value3'] ."</td><td>".$row['reading_time'] . "</td><td><a href='cancella_dati.php?id=".$row['id'] . "'>Elimina</a></td></tr>";
       }
  }
  // chiusura della connessione
  $connessione = null;
}
catch(PDOException $e)
{
  // notifica in caso di errore nel tentativo di connessione
  echo $e->getMessage();
}
?>

<tr><td></td></tr>
</table>
<a href="index.php">Torna al Menu</a>

</center>
</div>

</body>
</html>
