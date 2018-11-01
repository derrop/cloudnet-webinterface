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

<?php
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:permission\r\n"."-Xvalue:".$email."\r\n"."-Xextras:web.console\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
if ($json->response == true) {
} else {
	header('Location: '.$domain.'/logged'); 
}
?>

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
			<div class="6u 12u$(medium)">
                <section class="box">
                    <h3>Motd und Maxplayer</h3>
<?php
$bungee = $_POST['proxy'];
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:proxygroup\r\n"."-Xvalue:".$bungee."\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);
$motd = $json->response->proxyConfig->motdsLayouts;
$motdmaintenance = $json->response->proxyConfig->maintenanceMotdLayout;
$maxplayer = $json->response->proxyConfig->maxPlayers;
$bungeeversion = $json->response->proxyVersion;
$tablist = $json->response->proxyConfig->tabList;
echo $json->response->proxyConfig->motdsLayouts->firstLine;
?>	
					
				<form action="<?php echo $domain; ?>/logged/tech/editbungeemotd.php" method="get">  
				
							
				<?php $i = 1; ?>
							<?php foreach ($motd as $element):?>
								<p>1. Motd Zeile: <input type="text" value="<?php echo $element->firstLine; ?>" name="firstline<?php echo $i++?>" class="form-control" placeholder="1. Motd Zeile" required /></p>
								<p>2. Motd Zeile: <input type="text" value="<?php echo $element->secondLine; ?>" name="secondline<?php echo $i++?>" class="form-control" placeholder="2. Motd Zeile" required /></p>
                            <?php endforeach; ?>
				
					<p></p>
					<input type="submit" value="Speichern" />
				</form>
			</div>
<div class="6u 12u$(medium)">
                <section class="box">
                    <h3>Wartungsmotd</h3>
					
<form action="<?php echo $domain; ?>/logged/tech/editbungeemaintenancemotd.php" method="get">                            

								<p>1. Motd Zeile: <input type="text" value="<?php echo $motdmaintenance->firstLine; ?>" name="firstline" class="form-control" placeholder="1. Motd Zeile" required /></p>
								<p>2. Motd Zeile: <input type="text" value="<?php echo $motdmaintenance->secondLine; ?>" name="secondline" class="form-control" placeholder="2. Motd Zeile" required /></p>
				
					<p></p>
					<input type="submit" value="Speichern" />
				</form>
			</div>				
			<div class="4u 12u$(medium)">
                <section class="box">
                    <h3>Maxplayers</h3>
					
<form action="<?php echo $domain; ?>/logged/tech/editbungeemaxplayer.php" method="get">                            
				

					<p>Maximale Spieler: <input type="text" value="<?php echo $maxplayer; ?>" name="maxplayer" class="form-control" placeholder="Maximale Spieler: " required /></p>
				
					<p></p>
					<input type="submit" value="Speichern" />
				</form>
			</div>		
			<div class="4u 12u$(medium)">
                <section class="box">
                    <h3>Bungeecord Version</h3>
					
				<form action="<?php echo $domain; ?>/logged/tech/editbungeeversion.php" method="get">                            
				
					
					<p>BungeeCord Version: <select name="version"></p>
                                <option value="<?php echo $bungeeversion; ?>">Keine Änderung (<?php echo $bungeeversion; ?>)</span></option>
                                <option value="BUNGEECORD">Bungeecord</option>
                                <option value="HEXACORD">Hexacord</option>
                                <option value="WATERFALL">Waterfall</option>
					</select>
				
					<p></p>
					<input type="submit" value="Speichern" />
				</form>
			</div>	
			<div class="10u 12u$(medium)">
                <section class="box">
                    <h3>Tablist</h3>
					
<form action="<?php echo $domain; ?>/logged/tech/editbungeetablist.php" method="get">                            
				
								<p>1. Tablist Zeile: <input type="text" value="<?php echo $tablist->header; ?>" name="firstline" class="form-control" placeholder="1. Tablist Zeile" required /></p>
								<p>2. Tablist Zeile: <input type="text" value="<?php echo $tablist->footer; ?>" name="secondline" class="form-control" placeholder="2. Tablist Zeile" required /></p>
				
					<p></p>
					<input type="submit" value="Speichern" />
				</form>
			</div>					
        </div>
    </div>
</section>




