<?php
session_start();
require_once( "inc/config.inc.php" );
require_once( "inc/functions.inc.php" );
$user = check_user();
header ("Refresh: 0; http://localhost/register.php");

?>

