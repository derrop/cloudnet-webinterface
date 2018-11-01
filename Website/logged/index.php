<?php 
include '../config.php';
session_start(); 
?>
<?php
  $options = array('http'=>array('method'=>"GET",'header'=>"-Xversion:aktuelleversion\r\n"));
  $context = stream_context_create($options);
  $jsonlol = file_get_contents($versioncheck, false, $context);
  $json = json_decode($jsonlol);
  $disableversion = $json->response->disableversion;
  
if (in_array($version, $disableversion)) {
    echo "Version deaktviert!";
	} else {
		if($pagestyle == 2) {
			if(isset($_GET["set"])) {
				if($_GET["set"] == "server") { 
				include "tech/page/style2/server.php";
				}
				if($_GET["set"] == "proxy") { 
				include "tech/page/style2/proxy.php";
				} 
			} else {
				include "tech/page/style2/index.php";
				}
	
									
		} else {
		include "tech/page/style1/index.php";
		}
	}	 	
	?> 
