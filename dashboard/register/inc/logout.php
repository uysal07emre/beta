<?php 
session_start();
session_destroy();
unset($_SESSION['userid']);

//Remove Cookies
setcookie("identifier","",time()-(3600*24*365)); 
setcookie("securitytoken","",time()-(3600*24*365)); 

require_once("config.inc.php");
require_once("functions.inc.php");
header("refresh:0;URL=http://192.168.1.38/dashboard/logout.php");  //10 sind die sek ?>



