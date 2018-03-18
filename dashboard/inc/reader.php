<?php


$reportingLevel = -1; //0 für alle PHP Fehler und Warungen ausblenden, -1 für alle anzeigen
error_reporting($reportingLevel); 

//Sicherheitsabfrage ob der Authentifizierungscode mit übergeben wurde.
//Wenn der Code nicht übergeben wurde wird die gesamte Prozedure abgebrochen.
checkAuthCode();

//Datenbankverbindung aufbauen
$connection = getDBConnection();

function getDBConnection(){
  //Einstellungen der Datenbank
  $dbusername = 'root'; 
  $dbpassword = 'root'; 
  $dburl='localhost'; //URL
  $dbname='ogx'; //Datenbankname


  $fehler1 = "Fehler 1: Fehler beim aufbauen der Datenbankverbindung!";
	$link = mysqli_connect($dburl, $dbusername, $dbpassword,$dbname);
	if (!$link) {
		die('Verbindung schlug fehl: ' . mysqli_error());
	}
  
  /* check connection */
  if (mysqli_connect_errno()) {
       die($fehler1);
  }
  return $link;
}


$method =  $_POST['method'];

if ($method == 'allEntrys'){
   getAllEntrys($connection);
}

function getAllEntrys($connection){
  $sqlStmt = "SELECT * FROM Plants;";
  $result =  mysqli_query($connection,$sqlStmt);
  $data = array();
  if ($result = $connection->query($sqlStmt)) {
      while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $de_name = $row["de_name"];
        array_push($data,array("ID"=> $id,"de_name"=>$de_name));  
      }
  $result->free();
}
  closeConnection($connection);
  
  foreach ($data as $d){
    echo $d["de_name"];
    echo "|";
  }  
}

function checkAuthCode(){
$fehler0 = "Fehler 0: Keine erfolgreiche Authentifizierung!";
if (isset($_POST['authkey']) AND isset($_POST['method'])){
  $authkey = $_POST['authkey'];
  if ($authkey != 'test321'){
    die($authkey);
  }
} else {
  die(var_dump($_POST));
}
}

function closeConnection($connection){
  mysqli_close($connection);
}

?>