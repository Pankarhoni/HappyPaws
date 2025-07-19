<?php
session_start();
unset($_SESSION['USER_LOGIN']);
unset($_SESSION['USER_EMAIL']);
unset($_SESSION['USER_ID']);

header('location:Home.php');
die();
