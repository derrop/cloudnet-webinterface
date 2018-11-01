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
            <div class="20u 12u$(medium)">
                <section class="box">
                    <h5><?php 
$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:corelog\r\n"."-Xvalue:\r\n"));
$context = stream_context_create($options);
$jsonlol = file_get_contents($url, false, $context);
$json = json_decode($jsonlol);



$log = $json->log;



echo $log;   
?>  </h5>
                </section>
            </div>
			<div class="6u 12u$(medium)">
                <section id="1" class="box">
                    <h3>Befehl an die Konsole senden</h3>
				<form action="tech/consoledispatchcommand.php" method="get">
					<p>Befehl: <input type="text" name="command" class="form-control" placeholder="Befehl" required /></p>
					<p></p>
					<input class="button disabled" value="Befehl senden" />
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
        </div>
    </div>
</section>




