<?php

require '../mojang-api.class.php';
include '../config.php';
session_start(); 

$url = "http://31.214.246.103:1520/cloudnet/webinterface/api/v2";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:Pierre\r\n"."-Xcloudnet-token:3LDR2CZB7T0PDJMC\r\n"."-Xmessage:proxygroup\r\n"."-Xvalue:Bungee\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);


$json->response->proxyConfig->motdsLayouts->firstLine = "dienudelvonnebenan";

$string = json_encode($json);

$string1 = '{"group": '.$string.'}';

echo $string;



