<?php
 session_start();   
$con=mysqli_connect("localhost","root","password","happypaw");
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/HappyPaw/adminP');
define('SITE_PATH','http://localhost/HappyPaw/adminP');

define('PET_IMAGE_SERVER_PATH',SERVER_PATH.'/image/pet/');
define('PET_IMAGE_SITE_PATH',SITE_PATH.'/image/pet/');
?>