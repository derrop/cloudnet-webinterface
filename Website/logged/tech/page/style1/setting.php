<!DOCTYPE HTML>

<?php
require '../mojang-api.class.php';
include '../config.php';
session_start(); 

?>
<?php if($expireenabled == 1) {
if(isset($_SESSION['Logged'])) {
        echo " ";
        //erfolg
    } else {
		header('Location: '.$domain.'/index.php?error=403');
//error
    
}                  

                
// Session automatisch nach 5 Minuten Inaktivität beenden. 


if (isset($_SESSION['Logged']) && isset($_SESSION['expires']) && $_SESSION['expires'] < $_SERVER['REQUEST_TIME']) { 
 session_destroy(); 
 if (isset($_COOKIE[session_name()]) ) { 
  setcookie(session_name(), null, 0); 
  header('Location: '.$domain.'/index.php?error=expires'); // Weiterleitung 
 } 
 session_start(); 
 session_regenerate_id(); 
} 
$_SESSION['expires'] = $_SERVER['REQUEST_TIME'] + $expiretime; // Angabe in Sekunden 

$email = $_SESSION['email'];
}?> 
<?php if($expireenabled == 0) {
                  

                
if(isset($_SESSION['Logged'])) {
        echo " ";
        //erfolg
    } else {
		header('Location: '.$domain.'/index.php?error=403');
//error
    
}


$email = $_SESSION['email'];

}?> 


<html>
<head>
    <title><?php echo $servername; ?></title>
    <meta name="description" content="<?php echo $servername; ?>">
    <meta name="theme-color" content="#424242">
    <meta charset="UTF-8">	
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
		</noscript>

</head>

<body id="landing">
<!-- Header -->

<header id="header">


    <h1><a href="<?php echo $domain; ?>"><?php echo $servername; ?></a></h1>
    <nav id="nav">
        <ul>
		
			<li><a href="<?php echo $domain; ?>/logged/index.php#1">Server Starten</a></li>
			<li><a href="<?php echo $domain; ?>/logged/index.php#2">Server Stoppen</a></li>
			<li><a href="<?php echo $domain; ?>/logged/index.php#3">Stats anzeigen</a></li>
			<li><a href="<?php echo $domain; ?>/logged/index.php#4">Konsole öffnen</a></li>
		<li><a>
			Server Status: 
            <?php 
$ping = MojangAPI::ping($ip, 25565);
if ($ping) {
    echo '<span style="color: #40FF00"> Online</span>';
    
} else {
    echo '<span style="color: #FF0000"> Offline</span>';
}
?></a></li>
        </ul>
	</nav>	
</header>
<!-- One -->
<section id="one" class="wrapper style<?php echo $style; ?>">
    <header class="major">
        <h2><?php echo $servername; ?></h2>
    </header>	
    <div class="container">
        <div class="row">
            <div class="10u 20u$(medium)">
                <section class="box">
                    <h5>
<?php
$gruppe = $_GET['gruppe'];

$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:proxygroup\r\n"."-Xvalue:".$gruppe."\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);


$motd = $json->response->proxyConfig->motdsLayouts; 
$motd1 = $json->response->proxyConfig->motdsLayouts->firstLine; 
$motd2 = $json->response->proxyConfig->motdsLayouts->secondLine;
$speicherort = $json->response->template->backend;
$bungeeversion = $json->response->proxyVersion;
$startport = $json->response->startPort;
$minonline = $json->response->startup;
$ram = $json->response->memory;
$motdenabled = $json->response->proxyConfig->enabled;
$maintenanceenabled = $json->response->proxyConfig->maintenance;
$maintenaceprotocol = $json->response->proxyConfig->maintenaceProtocol;
$maxplayer = $json->response->proxyConfig->maxPlayers;
$fastconnect = $json->response->proxyConfig->fastConnect;
$custompayloadfixer = $json->response->proxyConfig->customPayloadFixer;
$dynamicslotsize = $json->response->proxyConfig->autoSlot->dynamicSlotSize;
$dynamicslotenabled = $json->response->proxyConfig->autoSlot->enabled;
$tablistenabled = $json->response->tabList->enabled;
$tablistheader = $json->response->proxyConfig->tabList->header;
$tablistfooter = $json->response->proxyConfig->tabList->footer;
$groupmode = $json->response->proxyGroupMode;
$playerinfo = $json->response->proxyConfig->playerInfo;
echo $maintenanceenabled ? "true" : "false" ;




        ?>
		<p>1.<?php echo $motd;?></p> 
<?php		foreach ($motd as $element1) {
		?>
            <?php $num = 0;?>
			<p>Firstline: <input type="text" value="<?php echo $element1->firstLine;?>" name="firstline" class="form-control" placeholder="Befehl" required /></p>
			<p>Secondline: <input type="text" value="<?php echo $element1->secondLine;?>" name="secondline" class="form-control" placeholder="Befehl" required /></p>
			<p></p>
<?php
      }
      ?>
		<p>4.<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:proxygroup\r\n"."-Xvalue:".$gruppe."\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
$wrappers = $json->response->wrapper;	
	

                            foreach ($wrappers as $element):
                                echo $element;
                            endforeach;?>
							
</p>
		<p>5.<?php echo $speicherort;?></p>
		<p>6.<?php echo $bungeeversion;?></p>
		<p>7.<?php echo $startport;?></p>
		<p>8.<?php echo $minonline;?></p>
		<p>9.<?php echo $ram;?></p>
		<p>10.<?php echo $motdenabled;?></p>
		<p>11.<?php echo $maintenanceenabled ? "true" : "false" ;?></p>
		<p>12.<?php echo $maintenaceprotocol;?></p>
		<p>13.<?php echo $maxplayer;?></p>
		<p>14.<?php echo $fastconnect ? "true" : "false" ;?></p>
		<p>15.<?php echo $custompayloadfixer;?></p>
		<p>16.<?php echo $dynamicslotenabled ? "true" : "false" ;?></p>
		<p>17.<?php echo $dynamicslotsize;?></p>
		<p>18.<?php echo $tablistenabled ? "true" : "false" ;?></p>
		<p>19.<?php echo $tablistheader;?></p>
		<p>20.<?php echo $tablistfooter;?></p>
		<p>21.<?php echo $groupmode;?></p>
		<form action="tech/kp.php" method="get">
	  <?php
  foreach ($motd as $element1) {
		?>
		<p>Firstline: <input type="text" value="<?php echo $element1->firstLine;?>" name="firstline" class="form-control" placeholder="Befehl" required /></p>
		<p>Secondline: <input type="text" value="<?php echo $element1->secondLine;?>" name="secondline" class="form-control" placeholder="Befehl" required /></p>
		<p></p>
<?php
      }
      ?>	  		
					<input type="submit" value="Befehl senden" />
		</form>	
                </section>
            </div>
            <div class="10u 12u$(medium)">
                <section class="box">
					<form action="tech/kp.php" method="get">
					<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:wrapper\r\n"."-Xvalue:\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
$wrapper1 = $json->response;
?>				
                                <option value="<?php echo $wrapper; ?>">Nicht ändern</option>
					<!-- Alle gruppen auflisten -->
                            <?php foreach ($wrapper1 as $element):?>
                                <option value="<?php echo $element->id; ?>"><?php echo $element->id; ?></option>
                            <?php endforeach; ?>
							<?php
$gruppe = $_GET['gruppe'];

$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:proxygroup\r\n"."-Xvalue:".$gruppe."\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
?>							
					</select>	
						<p>Wrapper: <select name="wrapper"></p>
					<p>Speicherort: <select name="speicherort"></p>
                                <option value="<?php echo $speicherort; ?>">Nicht ändern</option>
                                <option value="local">Local</span></option>
                                <option value="master">Master</span></option>
					</select>
					<p>Bungeecord Version: <select name="bungeeversion"></p>
                                <option value="<?php echo $bungeeversion; ?>">Nicht ändern</option>
                                <option value="local">Bungeecord</span></option>
                                <option value="master">Hexacord</span></option>
                                <option value="master">Waterfall</span></option>
					</select>
						<p>Startport: <input type="text" value="<?php echo $json->response->startPort;?>" name="startport" class="form-control" placeholder="Befehl" required /></p>
						<p>Immer Online: <input type="text" value="<?php echo $json->response->startup;?>" name="minonline" class="form-control" placeholder="Wieviele Proxys sollen immer Online sein?" required /></p>
						<p>Ram: <input type="text" value="<?php echo $json->response->memory;?>" name="memory" class="form-control" placeholder="Ram" required /></p>
						
						<h4>Motd</h4>
						<p>Motd Aktiviert: <select name="motdenabled"></p>
                                <option value="<?php echo $json->response->proxyConfig->enabled; ?>">Nicht ändern</option>
                                <option value="local">true</span></option>
                                <option value="master">false</span></option>
						</select>
						<?php		foreach ($motd as $element1) {
		?>
			<p>Firstline: <input type="text" value="<?php echo $element1->firstLine;?>" name="motdfirstline" class="form-control" placeholder="Befehl" required /></p>
			<p>Secondline: <input type="text" value="<?php echo $element1->secondLine;?>" name="motdsecondline" class="form-control" placeholder="Befehl" required /></p>

<?php
      }
      ?>
						<p>Wartung Aktiviert: <select name="maintenanceenabled"></p>
                                <option value="<?php echo $maintenanceenabled ? "true" : "false" ;?>">Nicht ändern</option>
                                <option value="local">true</span></option>
                                <option value="master">false</span></option>
						</select>
						<p>Maintenance Protocol: <input type="text" value="<?php echo $json->response->proxyConfig->maintenaceProtocol; ?>" name="maintenaceprotocol" class="form-control" placeholder="Wieviele Proxys sollen immer Online sein?" required /></p>
						<p>MaxPlayer: <input type="text" value="<?php echo $json->response->proxyConfig->maxPlayers;?>" name="maxplayer" class="form-control" placeholder="Befehl" required /></p>
						<p>Fastconnect: <select name="fastconnect"></p>
                                <option value="<?php echo $fastconnect ? "true" : "false" ;?>">Nicht ändern</option>
                                <option value="local">true</span></option>
                                <option value="master">false</span></option>
						</select>
						<p>Custompayloadfixer: <select name="custompayloadfixer"></p>
                                <option value="<?php echo $json->response->proxyConfig->customPayloadFixer; ?>">Nicht ändern</option>
                                <option value="local">true</span></option>
                                <option value="master">false</span></option>
						</select>
						<h4>DynamicSlots</h4>
						<p>DynamicSlotSize: <input type="text" value="<?php echo $json->response->proxyConfig->autoSlot->dynamicSlotSize;?>" name="dynamicslotsize" class="form-control" placeholder="Befehl" required /></p>
						<p>DynamicSlotEnabled: <select name="dynamicslotenabled"></p>
                                <option value="<?php echo $dynamicslotenabled ? "true" : "false" ;?>">Nicht ändern</option>
                                <option value="local">true</span></option>
                                <option value="master">false</span></option>
						</select>
						
						<h4>Tablist</h4>
						<p>TablistEnabled: <select name="tablistenabled"></p>
                                <option value="<?php echo $tablistenabled ? "true" : "false" ;?>">Nicht ändern</option>
                                <option value="local">true</span></option>
                                <option value="master">false</span></option>
						</select>
						<p>TablistHeader: <input type="text" value="<?php echo $json->response->proxyConfig->tabList->header;?>" name="tablistheader" class="form-control" placeholder="Befehl" required /></p>
						<p>TablistFooter: <input type="text" value="<?php echo $json->response->proxyConfig->tabList->footer;?>" name="tablistfooter" class="form-control" placeholder="Befehl" required /></p>
						<p>Gruppenmode: <select name="groupmode"></p>
                                <option value="<?php echo $json->response->proxyGroupMode; ?>">Nicht ändern</option>
                                <option value="DYNAMIC">Dynamic</span></option>
                                <option value="STATIC">Static</span></option>
						</select>
						<h4>Playerinfo</h4>						
						<?php		foreach ($playerinfo as $element) {
		?>
			<p><input type="text" value="<?php echo $element;?>" name="motdfirstline" class="form-control" placeholder="Befehl" required /></p>


<?php
      }
      ?>
						<p></p> 		
						<input type="submit" value="Befehl senden" />
				</form>	
                </section>
            </div>
        </div>
    </div>
</section>


<?php 
$string = '{"name": "'.$groupname.'","wrapper": ["'.$wrapper.'"],"template": {"name": "default","backend": "'.$speicherort.'","url": null,"processPreParameters": [],"installablePlugins": []},"proxyVersion": "'.$bungeeversion.'","startPort": '.$startport.',"startup": '.$minonline.',"memory": '.$memory.',"proxyConfig": {"enabled": '.$motdenabled.',"maintenance": '.$maintenance.',"motdsLayouts": [{"firstLine": "'.$motdfirstline.'","secondLine": "'.$motdsecondline.'"}],"maintenanceMotdLayout": {"firstLine": "'.$maintenancefirstline.'","secondLine": "'.$maintenancesecondline.'"},"maintenaceProtocol": "'.$maintenanceprotocol.'","maxPlayers": '.$maxplayer.',"fastConnect": '.$fastconnect.',"customPayloadFixer": '.$custompayloadfixer.',"autoSlot": {"dynamicSlotSize": '.$dynamicSlotSize.',"enabled": '.$dynamicSlotenabled.'},"tabList": {"enabled": '.$tablistenabled.',"header": "'.$tablistheader.'","footer": "'.$tablistfooter.'"},"playerInfo": [],"whitelist": [],"dynamicFallback": {"defaultFallback": "Lobby","fallbacks": [{"group": "Lobby","permission": null}]}},"proxyGroupMode": "'.$groupmode.'","settings": {}}';
?>


