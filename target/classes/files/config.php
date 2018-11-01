<?php
/*
-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-**-*-*-*
	CloudNet Webinterface by Niekold (Niekold#9410)

	- You are not allowed to resell the plugin/website
	- You are not allowed to reupload the plugin/website anywhere else
    - Refunds are not accepted
    - any error/bug should be posted in the resource's thread, not in the review section otherwise I will not give a support for reported bugs in     review section
	- You are not allowed to share this resource with others
    - You are not allowed to claim ownership of this resource

	Copyrighted by Niekold © 2018
	

	|-----------|
	|0 = false	|
	|1 = true	|
	|-----------|
	
	
-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-**-*-*-*
*/

/*
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
DON'T CHANGE THIS CONFIG
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/

/* Configurations */

%server_name%
%domain%
%ip%
%webport%
%token%
%user%

// 1 = Background Gray (Default)
// 2 = Background White
// 3 = Background Blue
$style = '1';


// 1 = Alles auf einer Seite
// 2 = Alles auf unterschiedlichen Seiten
$pagestyle = "2";


// noch keine Funktion
$lang = "de";

/* Recaptcha */
// Create Recaptcha on:
// https://www.google.com/recaptcha/admin

$recaptchaenabled = 0;

// 1 : Default Recaptcha
// 2 : invisible Recaptcha
$recaptchatype = 1;
$recaptchakey = "publickey";
$recaptchaprivatkey = "privatkey";


/* Expires BETA */

$expireenabled  = 0;

// Time in Seconds
$expiretime = 600;



/* Dont Change it! */

$dir = "cloudnet/webinterface/api/v2";
$dircn = "cloudnet/api/v1/util";
%version%
$versioncheck = "https://nevercold.eu/webinterface/version.json";
$debug = 0;





