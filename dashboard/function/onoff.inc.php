<h3>
	<font color="#FF0004"><?php
	

	$ip = "google.de";
    $port = "80";
	if (!@$fp = fsockopen($ip, $port, $errno, $errstr, 1)){
		echo "Offline";
	} ?>
	</font></h3>
<h3>
	<font color="#00FD15">
	<?php
	
	
$ip = "google.de";
$port = "80";
if (!@$fp = fsockopen($ip, $port, $errno, $errstr, 1)){
} else {
echo "Online";
} 
	
	?>
	</font>	
</h3>