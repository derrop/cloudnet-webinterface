<!DOCTYPE HTML>

<?php
require '../mojang-api.class.php';
include '../config.php';
session_start(); 


  $options = array('http'=>array('method'=>"GET",'header'=>"-Xversion:aktuelleversion\r\n"));
  $context = stream_context_create($options);
  $jsonlol = file_get_contents($versioncheck, false, $context);
  $json = json_decode($jsonlol);
  $oldversion = $json->response->oldversion;
  
if (in_array($version, $oldversion)) { ?>
	<h1><span style="color: #FF0000"> Du nutzt eine Alte Version, bitte Update!</span></h1>
	<h1><span style="color: #FF0000"> Für diese Version gibt es kein Support mehr!</span></h1><?php
}
?>
								<?php if($debug == 1) { 
										echo $jsonlol;
										} ?>
<?php
  $options = array('http'=>array('method'=>"GET",'header'=>"-Xversion:aktuelleversion\r\n"));
  $context = stream_context_create($options);
  $jsonlol = file_get_contents($versioncheck, false, $context);
  $json = json_decode($jsonlol);
  $publicversion = $json->response->publicversion;
  
if (in_array($version, $publicversion)){
	} else {
		session_destroy();
		setcookie("loginname","1",time()-1);
		setcookie("loginpass","1",time()-1); 
		header('Location: '.$domain.'/index.php?error=versionerror');
	} 
	?>
								<?php if($debug == 1) { 
										echo $jsonlol;
										} ?>
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
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
		</noscript>
<style>

table {
    width: 100%;
    margin: 2em 0;
    border-collapse: collapse;
    word-break:normal;
}

td {
    padding: .5em;
    vertical-align: top;
    border: 1px solid #bbbbbb;
}

th {
    padding: .5em;
    text-align: left;
    border: 1px solid #bbbbbb;
    border-bottom: 3px solid #bbbbbb;
    background:#f4f7fa;
}

	
.table-scrollable {
	width: 100%;
	overflow-y: auto;
	margin: 0 0 1em;	
}

.table-scrollable::-webkit-scrollbar {
	-webkit-appearance: none;
	width: 14px;
	height: 14px;
}

.table-scrollable::-webkit-scrollbar-thumb {
	border-radius: 8px;
	border: 3px solid #fff;
	background-color: rgba(0, 0, 0, .3);
}

</style>
		
		
</head>

<body id="landing">
<!-- Header -->

<header id="header">


    <h1><a href="<?php echo $domain; ?>"><?php echo $servername; ?></a></h1>
    <nav id="nav">
        <ul>
		
			<li><a href="index.php">Start</a></li>
			<li><a href="index.php?set=server">Server</a></li>
			<li><a href="index.php?set=proxy">Proxy</a></li>
		<li><a>
			Cloud Status: 
            <?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:testonline\r\n"."-Xvalue:\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
if ($json->success == true) {
	echo '<span style="color: #40FF00"> Online</span>';    
} else {
    echo '<span style="color: #FF0000"> Offline</span>';
}
	
	?></a></li>
        </ul>
	</nav>	
</header>
<section id="1" class="wrapper style<?php echo $style; ?>">
    <div class="container">
        <div class="row">

<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:permission\r\n"."-Xvalue:".$email."\r\n"."-Xextras:web.creategroup\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
if ($json->response == true) {
?>		
			<div class="4u 12u$(medium)">
                <section class="box">
                    <h3>Gruppe erstellen</h3>
                    <p>Erstelle eine Gruppe</p>
				<form action="<?php echo $domain; ?>/logged/tech/createserver.php" method="get">
					<p>Gruppenname: <input type="text" name="groupname" class="form-control" placeholder="Gruppenname" required /></p>
					<p>Ram: <input type="text" name="memory" class="form-control" placeholder="Ram" required /></p>
					<p>Immer Online: <input type="text" name="minonline" class="form-control" placeholder="Wieviele Server sollen immer Online sein" required /></p>
					<p>Wievoll: <input type="text" name="percent" class="form-control" placeholder="Wievoll soll der Server sein das ein neuer startet? in %" required /></p>
					<p>Gruppenmode: <select name="groupmode"></p>
                                <option value="LOBBY">Lobby</span></option>
                                <option value="DYNAMIC">Dynamic</span></option>
                                <option value="STATIC">Static</span></option>
                                <option value="STATIC_LOBBY">Static-Lobby</span></option>
					</select>
					<p>Serverversion: <select name="servertype"></p>
                                <option value="BUKKIT">Bukkit</span></option>
                                <option value="CAULDRON">Cauldron</span></option>
                                <option value="GLOWSTONE">Glowstone</span></option>
					</select>
					<p>Speicherort: <select name="speicherort"></p>
                                <option value="LOCAL">Local</span></option>
                                <option value="MASTER">Master</span></option>
					</select>
					<p>Wieviele Server sollen Online sein wenn 100 Spieler in der gruppe sind: <input type="text" name="onlinegroup" class="form-control" placeholder="Wieviele Server sollen Online sein wenn 100 Spieler in der gruppe sind" required /></p>
                    <p>Wieviele Server sollen Online sein wenn 100 Spieler Online sind: <input type="text" name="onlineglobal" class="form-control" placeholder="Wieviele Server sollen Online sein wenn 100 Spieler Online sind" required /></p>
<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:wrapper\r\n"."-Xvalue:\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
$wrapper = $json->response;
?>	
								<?php if($debug == 1) { 
										echo $jsonlol;
										} ?>			
					<p>Wrapper: <select name="wrapper"></p>
					<!-- Alle gruppen auflisten -->
                            <?php foreach ($wrapper as $element):?>
                                <option value="<?php echo $element->id; ?>"><?php echo $element->id; ?></option>
                            <?php endforeach; ?>
									
      
					</select>					
					<p></p>
					<input type="submit" value="Gruppe erstellen" />
				</form>	
						<p><?php
					if(isset($_GET["erfolg"])) {
						if($_GET["erfolg"] == "grupperstellt") { 
						echo '<span style="color: #40FF00"> Die Gruppe wurde erfolgreich erstellt.</span>';
						}
					}	
						
					?>	</p>

                </section>
            </div>



<?php } ?>
<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:permission\r\n"."-Xvalue:".$email."\r\n"."-Xextras:web.stopserver\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
if ($json->response == true) {
?>			
			<div class="4u 12u$(medium)">
                <section class="box">
                    <h3>Servergruppe stoppen</h3>
                    <p>Stoppe eine Gruppe</p>
				<form action="tech/stopgroup.php" method="get">
<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:cloudnetwork\r\n"."-Xvalue:\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
$servergroups = $json->response->serverGroups;	
?>				
					<p>Gruppe: <select name="gruppe"></p>
					<!-- Alle gruppen auflisten -->
                            <?php foreach ($servergroups as $element):?>
                                <option value="<?php echo $element->name; ?>"><span style="color: #40FF00"><?php echo $element->name; ?></span></option>
                            <?php endforeach; ?>
									
      
					</select>
					<p></p>
					<input type="submit" value="Gruppe stoppen" />
				</form>	
						<p><?php
					if(isset($_GET["erfolg"])) {
						if($_GET["erfolg"] == "stopgroup") { 
						echo '<span style="color: #40FF00"> Die Gruppe wurden erfolgreich gestoppt.</span>';
						}
					}	
						
					?>	</p>

                </section>
            </div>	

<?php } ?>
<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:permission\r\n"."-Xvalue:".$email."\r\n"."-Xextras:web.stopserver\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
if ($json->response == true) {
?>			

			<div class="4u 12u$(medium)">
                <section class="box">
                    <h3>Stoppe ein Server</h3>
                    <p>Stoppe einen Server</p>
				<form action="tech/stopserver.php" method="get">
<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:servernames\r\n"."-Xvalue:\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
$servernames = $json->response;	
?>				
					<p>Server: <select name="gruppe"></p>
					<!-- Alle gruppen auflisten -->
                            <?php foreach ($servernames as $element):?>
                                <option value="<?php echo $element; ?>"><span style="color: #40FF00"><?php echo $element; ?></span></option>
                            <?php endforeach; ?>
									
      
					</select>
					<p></p>
					<input type="submit" value="Gruppe stoppen" />
				</form>	
						<p><?php
					if(isset($_GET["erfolg"])) {
						if($_GET["erfolg"] == "stopserver") { 
						echo '<span style="color: #40FF00"> Der Server wurden erfolgreich gestoppt.</span>';
						}
					}	
						
					?>	</p>

                </section>
            </div>		
		
<?php } ?>	
<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:permission\r\n"."-Xvalue:".$email."\r\n"."-Xextras:web.startserver\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
if ($json->response == true) {
?>
			<div class="4u 12u$(medium)">
                <section class="box">
                    <h3>Server starten</h3>
                    <p>Starte einen Server</p>
				<form action="tech/startserver.php" method="get">
					<p>Anzahl: <input type="text" name="anzahl" class="form-control" placeholder="Anzahl" required /></p>
<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:cloudnetwork\r\n"."-Xvalue:\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
$servergroups = $json->response->serverGroups;	
?>				
					<p>Gruppe: <select name="gruppe"></p>
					<!-- Alle gruppen auflisten -->
                            <?php foreach ($servergroups as $element):?>
                                <option value="<?php echo $element->name; ?>"><span style="color: #40FF00"><?php echo $element->name; ?></span></option>
                            <?php endforeach; ?>
									
      
					</select>
					<p></p>
					<input type="submit" value="Server starten" />
				</form>	
						<p><?php
					if(isset($_GET["erfolg"])) {
						if($_GET["erfolg"] == "serverstart") { 
						echo '<span style="color: #40FF00"> Der/Die Server wurden erfolgreich gestartet.</span>';
						}
					}	
						
					?>	</p>

                </section>
			</div>
			
<?php } ?>
<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:permission\r\n"."-Xvalue:".$email."\r\n"."-Xextras:web.deletegroup\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
if ($json->response == true) {
?>

			<div class="6u 12u$(medium)">
                <section class="box">
                    <h3>Servergruppe löschen</h3>
                    <p>Lösche eine Gruppe</p>
				<form action="tech/deleteservergroup.php" method="get">
<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:cloudnetwork\r\n"."-Xvalue:\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
$servergroups = $json->response->serverGroups;	
?>				
					<p>Gruppe: <select name="gruppe"></p>
					<!-- Alle gruppen auflisten -->
                            <?php foreach ($servergroups as $element):?>
                                <option value="<?php echo $element->name; ?>"><span style="color: #40FF00"><?php echo $element->name; ?></span></option>
                            <?php endforeach; ?>
									
      
					</select>
					<p></p>
					<input type="submit" value="Gruppe löschen" />
				</form>	
						<p><?php
					if(isset($_GET["erfolg"])) {
						if($_GET["erfolg"] == "deleteservergroup") { 
						echo '<span style="color: #40FF00"> Die Gruppe wurden erfolgreich gelöscht.</span>';
						}
					}	
						
					?>	</p>

                </section>
            </div>	
			
<?php } ?>
		</div>
	</div>
</section>	