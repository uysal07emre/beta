<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml"> 

<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<meta name='description' content='Ein Suchfunktionsscript...' /> 
<title>Suchfunktion by BerlinerBaer</title> 
</head> 

<body> 


<?php 
//* Datenbankverbindung aufbauen (START) 

$verbindung = mysql_connect ("localhost", "root", "root") 
or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch"); 

mysql_select_db("rox") or die ("Die Datenbank existiert nicht."); 

//* Datenbankverbindung aufbauen (ENDE) 



    $name = $_POST['name']; 
     
    echo "<b>Du hast nach dem Namen: \"<u>$name</u>\" gesucht. Dadurch wurden folgende Einträge gefunden:</b><br /><br />"; 

//* Überprüfung der Eingabe     
    $abfrage = "SELECT * FROM tabellenname WHERE name LIKE '%$name%'"; 
    $ergebnis = mysql_query($abfrage) or die(mysql_error()); 
    if($ausgabe = mysql_fetch_assoc($ergebnis)) 
        { echo "".$ausgabe['name'].""; } //* Wenn was gefunden wurde, wird es hier ausgegeben. 
    else 
        { echo "Es wurde kein Name unter den Namen \"<u>$name</u>\" gefunden.<br /> 
        Bitte versuche es mit einem anderen namen.<br /> 
        <a href='suchen.html'>Zur&uuml;ck!</a>"; 
    }    // * Wenn nichts gefunden wurde, dann kommt diese Fehlermeldung. 
             
?>  



</body>