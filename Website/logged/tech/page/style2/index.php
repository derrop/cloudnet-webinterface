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
<!-- One -->
<section id="1" class="wrapper style<?php echo $style; ?> special">
    <header class="major">
        <h2><?php echo $servername; ?></h2>
    </header>	
    <div class="container">
        <div class="row">
            <div class="4u 12u$(medium)">
                <section class="box">
                    <h3>Willkommen, <?php echo $email; ?></h3>
					<h4>Im Webinterface!</h4>
					<p><img src="https://minotar.net/cube/<?php echo $email;?>/120" class="img-responsive"></p>
					<p><a href="<?php echo $domain; ?>/logout.php" class="button">Ausloggen</a></p>
                </section>
			</div>
            <div class="4u 12u$(medium)">	
				<section class="box">
<h2>
<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:networkinfo\r\n"."-Xvalue:\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
$online = $json->response->onlineCount;
$maxonline = $json->response->maxPlayers;

echo 'Zurzeit sind ' . $online . ' Spieler von ' . $maxonline . ' Spieler Online.';

?></h2>
<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:permission\r\n"."-Xvalue:".$email."\r\n"."-Xextras:web.setgroup\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
if ($json->response == true) {
	?>
<h3>Spieler in eine Gruppe setzen</h3>
				<form action="<?php echo $domain; ?>/logged/tech/setpermgroup.php" method="get">	
<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:onlineplayers\r\n"."-Xvalue:\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
$playersonline = $json->response;	
?>					
					<p>Spieler: <select name="spieler"></p>
					<!-- Alle gruppen auflisten -->
                            <?php foreach ($playersonline as $element):?>
                                <option value="<?php echo $element->name; ?>"><span style="color: #40FF00"><?php echo $element->name; ?></span></option>
                            <?php endforeach; ?>
									
      
					</select>
<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:permissiongroups\r\n"."-Xvalue:\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
$permgroups = $json->response;	
?>	
								<?php if($debug == 1) { 
										echo $jsonlol;
										} ?>	
			
					<p>Gruppe: <select name="gruppe"></p>
					<!-- Alle gruppen auflisten -->
                            <?php foreach ($permgroups as $element):?>
                                <option value="<?php echo $element->name; ?>"><span style="color: #40FF00"><?php echo $element->name; ?></span></option>
                            <?php endforeach; ?>
									
      
					</select>
					<p></p>
					<input type="submit" value="Gruppe setzen" />
				</form>	
				<?php
}
?>
                </section>
				
			</div>
			<div class="4u 12u$(medium)">
                <section class="box">
                    <h3>CloudNet - Webinterface</h3>
					<h4>Version <?php echo $version;?> von Niekold</h4>
					
				<?php
				
  $options = array('http'=>array('method'=>"GET",'header'=>"-Xversion:aktuelleversion\r\n"));
  $context = stream_context_create($options);
  $jsonlol = file_get_contents($versioncheck, false, $context);
  $json = json_decode($jsonlol);
  $newversion = $json->response->version;
  $devversion = $json->response->devversion;
  $oldversion = $json->response->oldversion;
  
  
			if (in_array($version, $oldversion)) {?>
				<h4>Du nutzt eine Alte Version.</h4> <?php
			} else {
				if ($version == $devversion) { ?>
					<h4>Du nutzt eine Dev Version.</h4> <?php
				} else {
					if ($version == $newversion) { ?>
						<h4>Du nutzt die aktuelle Version.</h4> <?php
					} else { ?>
						<h4>Ein Fehler beim Version Überprüfen ist aufgetreten.</h4> <?php
						}
				}	
			}
		
  ?>
					<p></p>
					<p><a href="https://discord.gg/CYHuDpx" class="button">Support Discord</a></p>
					<p><a href="https://www.spigotmc.org/resources/cloudnet-webinterface.58905/" class="button">Spigot Seite</a></p>
					
					<?php
  $options = array('http'=>array('method'=>"GET",'header'=>"-Xversion:aktuelleversion\r\n"));
  $context = stream_context_create($options);
  $jsonlol = file_get_contents($versioncheck, false, $context);
  $json = json_decode($jsonlol);
  
if (in_array($version, $oldversion)) { ?>
	<h1><span style="color: #FF0000"> Du nutzt eine Alte Version, bitte Update!</span></h1>
	<h1><span style="color: #FF0000"> Für diese Version gibt es kein Support mehr!</span></h1><?php
}
	?> 
								<?php if($debug == 1) { 
										echo $jsonlol;
										} ?>
  
  
					
					
					
					
					
					
					

					</section>
				</div>
			<div class="8u 12u$(medium)" name="test">
                <section class="box">
                    <h3>CloudNet - Stats</h3>
                    <p></p>
<?php
  $url = "http://". $ip . ":" . $webport . "/" . $dir. "";
  $options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:statistics\r\n"."-Xvalue:\r\n"));
  $context = stream_context_create($options);
  $jsonlol = file_get_contents($url, false, $context);
  $json = json_decode($jsonlol);
?>					
    <h5>Cloud starts: <?php echo $json->response->cloudStartup; ?></h5>
    <h5>Wrapper starts: <?php echo $json->response->wrapperConnections; ?></h5>
    <h5>Spieler Logins: <?php echo $json->response->playerLogin; ?></h5>
    <h5>Höchste Spieleranzahl gleichzeitig: <?php echo $json->response->highestPlayerOnline; ?></h5>
    <h5>Anzahl ausgeführter Befehle: <?php echo $json->response->playerCommandExecutions; ?></h5>
    <h5>Anzahl gestarter Server: <?php echo $json->response->startedServers; ?></h5>
    <h5>Anzahl gestarter Proxys: <?php echo $json->response->startedProxys; ?></h5>
    <h5>Höchste Serveranzahl gleichzeitig: <?php echo $json->response->highestServerOnlineCount; ?></h5>
    <h5>Servergruppen: <?php
      $groupamount = 0;
      foreach ($servergroups as $element) {
          $groupamount++;
      }
      echo $groupamount;
      ?></h5>
    <h5>Proxygruppen: <?php
      $groupamount = 0;
      foreach ($proxygroups as $element) {
          $groupamount++;
      }
      echo $groupamount;
      ?></h5>
                </section>
            </div>
			<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:permission\r\n"."-Xvalue:".$email."\r\n"."-Xextras:web.createuser\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
if ($json->response == true) {
?>
			<div class="4u 12u$(medium)">
                <section class="box">
                    <h3>CloudNet-User erstellen</h3>
                    <p>Erstelle einen User der sich ins ACP einloggen kann.</p>
				<form action="<?php echo $domain; ?>/logged/tech/createuser.php" method="post">
					<p>Name: <input type="text" name="user" class="form-control" placeholder="Nutzername" required /></p>
					<p>Passwort: <input type="password" name="password" class="form-control" placeholder="Passwort" required /></p>
					<p></p>
					<input type="submit" value="User erstellen" />
				</form>	
						<p><?php
					if(isset($_GET["erfolg"])) {
						if($_GET["erfolg"] == "createuser") { 
						echo '<span style="color: #40FF00"> Der User wurde erfolgreich erstellt.</span>';
						}
					}	
						
					?>	</p>
                </section>
            </div>
			<?php
}
?>
			
			<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:permission\r\n"."-Xvalue:".$email."\r\n"."-Xextras:web.sendcommandtoconsole\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
if ($json->response == true) {
?>
			<div class="6u 12u$(medium)">
                <section class="box">
                    <h3>Befehl an die Konsole senden</h3>
                    <p>Sende einen Befehl an die CloudNet-Master Konsole</p>
				<form action="tech/dispatchcommand.php" method="get">
					<p>Befehl: <input type="text" name="command" class="form-control" placeholder="Befehl" required /></p>
					<p></p>
					<input type="submit" value="Befehl senden" />
				</form>	
						<p><?php
					if(isset($_GET["erfolg"])) {
						if($_GET["erfolg"] == "commandsend") { 
						echo '<span style="color: #40FF00"> Der Command wurde erfolgreich gesendet.</span>';
						}
					}	
						
					?>	</p>
                </section>
            </div>
			
			<?php
}
?>
			
			<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:permission\r\n"."-Xvalue:".$email."\r\n"."-Xextras:web.sendcommandtoserver\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
if ($json->response == true) {
?>
			<div class="6u 12u$(medium)">
                <section class="box">
                    <h3>Befehl an einen Server/Proxy senden</h3>
                    <p>Sende einen Befehl an einen bestimmten Server/Proxy</p>
				<form action="tech/sendcommandtoserver.php" method="get">
					<p>Server/Proxy: <input type="text" name="server" class="form-control" placeholder="Server/Proxy" required /></p>
					<p>Befehl: <input type="text" name="command" class="form-control" placeholder="Befehl" required /></p>
					<p></p>
					<input type="submit" value="Befehl senden" />
				</form>	
						<p><?php
					if(isset($_GET["erfolg"])) {
						if($_GET["erfolg"] == "commandsendtoserver") { 
						echo '<span style="color: #40FF00"> Der Command wurde erfolgreich gesendet.</span>';
						}
					}	
						
					?>	</p>
                </section>
            </div>
			
			<?php
}
?>
			
			<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:permission\r\n"."-Xvalue:".$email."\r\n"."-Xextras:web.console\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
if ($json->response == true) {
?>
			<div class="6u 12u$(medium)">
                <section class="box">
                    <h3>Konsole</h3>
                    <p>Hier findest du die CloudNet Master Konsole.</p>
					<p></p>
					<p><a href ="<?php echo $domain; ?>/logged/console.php" class="button">Konsole öffnen</a></p>
                </section>
            </div>
			
			<?php
}
?>
			
			<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:permission\r\n"."-Xvalue:".$email."\r\n"."-Xextras:web.stopcloud\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
if ($json->response == true) {
?>
			<div class="6u 12u$(medium)">
                <section class="box">
                    <h3>Cloud stoppen</h3>
                    <p>Stoppe die Cloud</p>
					<p></p>
					<p><a href="<?php echo $domain; ?>/tech/stopcloud.php" class="button">Cloud stoppen</a></p>
                </section>
            </div>
			
			<?php
}
?>
		</div>
	</div>
</section>
			<!-- -->	
<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:permission\r\n"."-Xvalue:".$email."\r\n"."-Xextras:web.onlineserver\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
if ($json->response == true) {
?>
								<?php if($debug == 1) { 
										echo $jsonlol;
										} ?>	
<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:servergroups\r\n"."-Xvalue:\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
$servergroups = $json->response;
?>	
								<?php if($debug == 1) { 
										echo $jsonlol;
										} ?>
<section id="2" class="wrapper style<?php echo $style; ?>">
<header class="major">
        <h2>Online-Server</h2>
    </header>	
    <div class="container">
        <div class="row">
		
			<h3>Server</h3>
				<div class="table-scrollable">
					<table>
						<tr>
							<th>Gruppe</th>
							<th>Online</th>
							<th>Server</th>
							<th>Wrapper</th>
							<th>Spieler</th>
							<th>Template</th>
							<th>State</th>
							<th>Motd</th>
							<th>Ram</th>
							<th>Server stoppen</th>
						</tr>	
			
					<!-- Alle gruppen auflisten -->
                            <?php foreach ($servergroups as $element):
							
								$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
								$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:serverinfos\r\n"."-Xvalue:".$element->name."\r\n"));
								$context = stream_context_create($options);
								$jsonlol = file_get_contents($url, false, $context);
								$json = json_decode($jsonlol);
								$serverinfos = $json->response;
								?>	
								<?php if($debug == 1) { 
										echo $jsonlol;
										} ?>
									
									<tr>
										<td><?php echo $element->name; ?></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td><a href="tech/infostopgroup.php?server=<?php echo $element->name; ?>" class="button">Stoppen</a></td>
									</tr>
									<?php foreach ($serverinfos as $element): ?>
									<tr>
										<td></td>
										<td><?php if ($element->online == true) { 
										?>
											<span style="font-size: 25px; color: #40FF00;">
												<i class="fa fa-check"></i>
											</span>
										<?php	
										} else { ?>
											<span style="font-size: 25px; color: #FF0000;">
												<i class="fa fa-times"></i>
											</span>
											<?php
										}
										?></td>
										<td><?php echo $element->serviceId->serverId; ?></td>
										<td><?php echo $element->serviceId->wrapperId; ?></td>
										<td><?php echo $element->onlineCount; ?> / <?php echo $element->maxPlayers; ?>   </td>
										<td><?php echo $element->template->name; ?></td>
										<td><?php echo $element->serverState; ?></td>
										<td><?php echo $element->motd; ?></td>
										<td><?php echo $element->memory ?>mb</td>
										<td><a href="tech/infostopserver.php?server=<?php echo $element->serviceId->serverId; ?>" class="button">Stoppen</a></td>
									</tr>
									<?php endforeach; ?>
								<?php endforeach; ?>			
					</table>
				</div>
					

<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:proxygroups\r\n"."-Xvalue:\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
$proxygroups = $json->response;
?>	
								<?php if($debug == 1) { 
										echo $jsonlol;
										} ?>

			<h3>Proxy</h3>
				<div class="table-scrollable">
					<table>
						<tr>
							<th>Gruppe</th>
							<th>Online</th>
							<th>Server</th>
							<th>Wrapper</th>
							<th>Spieler</th>
							<th>Ram</th>
							<th>Server stoppen</th>
						</tr>	
			
					<!-- Alle gruppen auflisten -->
                            <?php foreach ($proxygroups as $element):
							
								$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
								$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:proxyinfos\r\n"."-Xvalue:".$element->name."\r\n"));
								$context = stream_context_create($options);
								$jsonlol = file_get_contents($url, false, $context);
								$json = json_decode($jsonlol);
								$proxyinfos = $json->response;
								?>
								<?php if($debug == 1) { 
										echo $jsonlol;
										} ?>
									
									<tr>
										<td><?php echo $element->name; ?></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td><a href="tech/infostopgroup.php?server=<?php echo $element->name; ?>" class="button">Stoppen</a></td>
									</tr>
									<?php foreach ($proxyinfos as $element): ?>
									<tr>
										<td></td>
										<td><?php if ($element->online == true) { 
										?>
											<span style="font-size: 25px; color: #40FF00;">
												<i class="fa fa-check"></i>
											</span>
										<?php	
										} else { ?>
											<span style="font-size: 25px; color: #FF0000;">
												<i class="fa fa-times"></i>
											</span>
											<?php
										}
										?></td>
										<td><?php echo $element->serviceId->serverId; ?></td>
										<td><?php echo $element->serviceId->wrapperId; ?></td>
										<td><?php echo $element->onlineCount; ?></td>
										<td><?php echo $element->memory ?>mb</td>
										<td><a href="tech/infostopproxy.php?server=<?php echo $element->serviceId->serverId; ?>" class="button">Stoppen</a></td>
									</tr>
									<?php endforeach; ?>
								<?php endforeach; ?>			
					</table>
				</div>
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
			
			<h3>Wrapper</h3>							
				<div class="table-scrollable">
					<table>
						<tr>
							<th>Online</th>
							<th>Wrapper</th>
							<th>IP</th>
							<th>Startport</th>
							<th>Ram</th>
							<th>CPU-Kerne</th>
							<th>CPU-Auslastung</th>
							<th>Queue-Größe</th>
						</tr>	
			
					<!-- Alle gruppen auflisten -->
                            <?php foreach ($wrapper as $element):
							
								$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
								$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:wrapperinfos\r\n"."-Xvalue:".$element->name."\r\n"));
								$context = stream_context_create($options);
								$jsonlol = file_get_contents($url, false, $context);
								$json = json_decode($jsonlol);
								$wrapperinfos = $json->response;
								?>
								<?php if($debug == 1) { 
										echo $jsonlol;
										} ?>
									<?php foreach ($wrapperinfos as $element): ?>
									<tr>
										<td><?php if ($element->ready == true) { 
										?>
											<span style="font-size: 25px; color: #40FF00;">
												<i class="fa fa-check"></i>
											</span>
										<?php	
										} else { ?>
											<span style="font-size: 25px; color: #FF0000;">
												<i class="fa fa-times"></i>
											</span>
											<?php
										}
										?></td>
										<td><?php echo $element->serverId; ?></td>
										<td><?php echo $element->hostName; ?></td>
										<td><?php echo $element->startPort; ?></td>
										<td><?php echo $element->usedMemory; ?>mb / <?php echo $element->memory; ?>mb</td>
										<td><?php echo $element->availableProcessors; ?></td>
										<td><?php echo $element->cpuUsage; ?></td>
										<td><?php echo $element->process_queue_size; ?></td>
									</tr>
									<?php endforeach; ?>
								<?php endforeach; ?>			
					</table>
				</div>
		</div>
	</div>	
</section>
	
	
								<?php if($debug == 1) { 
										echo $jsonlol;
										} ?>	
										
<?php
}
?>
	
</body>
</html>
