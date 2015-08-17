<?php

define("SITE_PATH", "http://marcinwitek.com/cms/");
define("APP_PATH", str_replace("\\","/", dirname(__FILE__)) . "/");
define("APP_RES","http://marcinwitek.com/cms/app/res/");

include("core/core.php");
$serwer = 'sql.s24.vdl.pl';
$user = 'mendieta_cms';
$password = 'antyradiomarcin1';
$db = 'mendieta_cms';


$SK = new SK_Core($serwer,$user,$password,$db);




?>