<!DOCTYPE HTML>

<!-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
	CloudNet Webinterface by Niekold (Niekold | DeinsystemNET#9410)

	- You are not allowed to resell the plugin
	- You are not allowed to reupload the plugin anywhere else
    - any error/bug should be posted in the resource's thread, not in the review section otherwise I will not give a support for reported bugs in     review section
    - You are not allowed to claim ownership of this resource

	Copyrighted by Niekold © 2018
	
	
	Support Discord: https://discord.gg/CYHuDpx
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -->

<?php

        $url = "http://". $ip . ":" . $webport . "/" . $dir. "";
        $options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:config\r\n"."-Xvalue:config.json\r\n"));
        $context = stream_context_create($options);
        $jsonlol = file_get_contents($url, false, $context);
        $json = json_decode($jsonlol);

?>
<?php
require 'mojang-api.class.php';
include 'config.php';
?>
<?php
session_start();

if(isset($_SESSION['Logged'])) {
        header('Location: '.$domain.'/logged/index.php');
        //man wird automatisch geleitet wenn eingeloggt
    } 
    
if (in_array($version, $publicversion)){
	} else {
		session_destroy();
		setcookie("loginname","1",time()-1);
		setcookie("loginpass","1",time()-1); 
	}
	
if(isset($_COOKIE['loginname'])) {
        $email = $_COOKIE['loginname'];
        $password = $_COOKIE['loginpass'];
        $url = "http://". $ip . ":" . $webport . "/" . $dir. "";
        $options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:authorize\r\n"."-Xvalue:".$email."\r\n-Xpassword:".$password."\r\n"));
        $context = stream_context_create($options);
        $jsonlol = file_get_contents($url, false, $context);
        $json = json_decode($jsonlol);
        if($json->response == true) {
			$_SESSION['email'] = $email;
            $_SESSION['Logged'] = true;
            header('Location: '.$domain.'/logged/index.php?test=erfolgreich');
		}
    
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
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
     <script>
       function onSubmit(token) {
         document.getElementById("login").submit();
       }
     </script>

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
<section id="one" class="wrapper style<?php echo $style; ?>">
    <header class="major">
        <h2><?php echo $servername; ?></h2>
    </header>	
    <div class="container">
        <div class="row">
			<div class="4u 12u$(medium)">
                <section class="box">
                    <h3>User Panel</h3>
                    <p>Logge dich mit deinem Account ein.</p>
					<p></p>
					<p>Deine Daten werden bei uns nicht gespeichert.</p>
                </section>
            </div>
            <div class="4u 12u$(medium)">
                <section id="2" class="box">
                    <h3>Login</h3>
					<?php
		$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
		$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n".	"-Xmessage:testonline\r\n"."-Xvalue:\r\n"));
		$context = stream_context_create($options);
		$jsonlol = file_get_contents($versioncheck, false, $context);
		$json = json_decode($jsonlol);
		if ($json->success == true) {
			$options = array('http'=>array('method'=>"GET",'header'=>"-Xversion:aktuelleversion\r\n"));
			$context = stream_context_create($options);
			$jsonlol = file_get_contents($versioncheck, false, $context);
			$json = json_decode($jsonlol);
			$newversion = $json->response->version;
			$publicversion = $json->response->publicversion;
			if (in_array($version, $publicversion)) {
				$url = "http://". $ip . ":" . $webport . "/" . $dir. "";
				$options = array('http'=>array('method'=>"GET",'header'=>"-Xcloudnet-user:".$cloudnetuser."\r\n"."-Xcloudnet-token:".$cloudnettoken."\r\n"."-Xmessage:testonline\r\n"."-Xvalue:\r\n"));
				$context = stream_context_create($options);
				$jsonlol = file_get_contents($url, false, $context);
				$json = json_decode($jsonlol);
				if ($json->success == true) {
					$options = array('http'=>array('method'=>"GET",'header'=>"-Xversion:aktuelleversion\r\n"));
					$context = stream_context_create($options);
					$jsonlol = file_get_contents($versioncheck, false, $context);
					$json = json_decode($jsonlol);
					$disableversion = $json->response->disableversion;
					if (in_array($version, $disableversion)) {
						?>
						<h1>Diese Version ist deaktiviert!</h1>
						<?php
					} else {
						?>
                    <form id="login" action="login.php" method="post">
						<p>Username: <input type="text" name="email" class="form-control" placeholder="Username" required /></p>
						<p>Passwort: <input type="password" name="password" class="form-control" placeholder="Passwort" autocomplete="off" required /></p>
						<input type="checkbox" id="cookielogged" name="cookielogged">
						<label for="cookielogged">Eingeloggt bleiben</label>
						<p></p>
					<?php if($recaptchaenabled == 1) { ?>	
						<?php if($recaptchatype == 1) { ?>
						<div class="g-recaptcha" data-sitekey="<?php echo $recaptchakey ?>" required /></div>
						<?php } ?>
						<p></p>
						<?php if($recaptchatype == 2) { ?>
						<input value="Einloggen" class="g-recaptcha" data-sitekey="<?php echo $recaptchakey ?>" data-callback='onSubmit' type="submit"></input>

						<?php } else { ?>
						<input type="submit" value="Einloggen" /><?php }
					} ?>
					<?php if($recaptchaenabled == 0) { ?>	
						<input type="submit" value="Einloggen" />
					<?php } 
					}
				} else {
					echo '<span style="color: #FF0000"> Es konnte keine Verbindung mit dem CloudNet-Master hergestellt werden.</span>';
				}
			} else {
				echo '<span style="color: #FF0000"> Ein Fehler bei der Version-Überprüfung ist aufgetreten.</span>';
			}
		} else {
			echo '<span style="color: #FF0000"> Einer Fehler beim Verbinden zum Kontrolserver ist aufgetreten.</span>';
		}	
		
				?>		
						<p></p>
					</form>

					<p><?php
					if(isset($_GET["error"])) {
						if($_GET["error"] == "401") { 
						echo '<span style="color: #FF0000"> Deine Username oder Passwort ist falsch.</span>';
						}
						if($_GET["error"] == "403") { 
						echo '<span style="color: #FF0000"> Du bist nicht eingeloggt.</span>';
						}
						if($_GET["error"] == "logout") { 
						echo '<span style="color: #40FF00"> Du wurdest erfolgreich ausgeloggt.</span>';
						}
						if($_GET["error"] == "expires") { 
						echo '<span style="color: #FF0000"> Du wurdest ausgeloggt da du '.$expiretime.' Sekunden Inaktiv warst.</span>';
						}
						if($_GET["error"] == "shutdown") { 
						echo '<span style="color: #40FF00"> Die Cloud wurde erfolgreich gestoppt.</span>';
						}
						if($_GET["error"] == "bot") { 
						echo '<span style="color: #FF0000"> Bitte bestätige das du kein Bot bist.</span>';
						}
						if($_GET["error"] == "versionerror") { 
						echo '<span style="color: #FF0000"> Deine Version ist ungültig!</span>';
						}
					}
					?></p>
                </section>
            </div>
			<div class="4u 12u$(medium)">
                <section class="box">
                    <h3><span style="color: #FF0000"> ACHTUNG</span></h3>
                    <p>Diese Webseite ist noch in der Alpha.</p>
					<p>Es können Fehler auftreten!</p>
					<?php
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
                </section>
            </div>
        </div>
    </div>
</section>

</body>
</html>
