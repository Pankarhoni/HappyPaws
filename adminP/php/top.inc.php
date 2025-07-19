<?php
require('connection.php');
require('functions.inc.php');

if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!=''){

}else{
	header('location:admin_login.php');
	die();
}
?>

<html>
<head>
    
    <link rel="stylesheet" type="text/css" href="sty.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <title>Admin Panel</title>
   
</head>
<body>
   
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Dashboard </h4>
                </div>
            </div>
        </div>
    </div>
   
    <div id="wrapper" class="toggled">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                  <li class="sidebar-brand">Menu</li>
                  <li>
                     <a href="categories.php" >Categories</a>
                  </li>
                  <li>
                     <a href="pets.php" >Pets</a>
                  </li>
				  <li>
                     <a href="users.php" >Users</a>
                  </li>
                  <li>
                    <a href="logout.php" >Logout</a>
                 </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->