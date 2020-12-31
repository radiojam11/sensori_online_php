<!DOCTYPE html>
<html><body>
<?php
/*
  TecnoGeppetto
  Inserimento dati in DB 
  11/07/2020
  
*/

$servername = "localhost:3306";

// REPLACE with your Database name
$dbname = "corso";
// REPLACE with Database user
$username = "valerio";
// REPLACE with Database user password
$password = "XXXXXXXXXXXXXXXXXXXXX";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
	
	
	//inserire qui la ricerca del parametro "nomesensore" dal modulo di ricerca creare il ciclo IF dalla riga 28 alla 40
	


//$sql = "SELECT id, sensor, location, value1, value2, value3, reading_time FROM SensorData ORDER BY id DESC";
	$sql = "SELECT id, sensor, location, value1, value2, value3, reading_time FROM SensorData  ORDER BY id DESC";
	
		
		
echo '<table cellspacing="5" cellpadding="5">
      <tr> 
        <td>ID</td> 
        <td>Sensori</td> 
        <td>Location</td> 
        <td>Temperatura</td> 
        <td>Altitudine</td>
        <td>Pressione</td> 
        <td>Timestamp</td> 
      </tr>';
 
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_id = $row["id"];
        $row_sensor = $row["sensor"];
        $row_location = $row["location"];
        $row_value1 = $row["value1"];
        $row_value2 = $row["value2"]; 
        $row_value3 = $row["value3"]; 
        $row_reading_time = $row["reading_time"];
        // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
        $row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 2 hours"));
      
        // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 4 hours"));
      
        echo '<tr> 
                <td>' . $row_id . '</td> 
                <td>' . $row_sensor . '</td> 
                <td>' . $row_location . '</td> 
                <td>' . $row_value1 . '</td> 
                <td>' . $row_value2 . '</td>
                <td>' . $row_value3 . '</td> 
                <td>' . $row_reading_time . '</td> 
              </tr>';
    }
    $result->free();
}

$conn->close();
?> 
</table>
</body>
</html>