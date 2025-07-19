<?php
require('connection.php');
require('functions.inc.php');
$msg='';
if(isset($_POST['submit'])){
	
  $username=get_safe_value($con,$_POST['username']);
	$password=get_safe_value($con,$_POST['password']);
	
   $sql="select * from admin_users where username='$username' and password='$password'";
	$res=mysqli_query($con,$sql);
	$count=mysqli_num_rows($res);
	
   if($count>0){
		$_SESSION['ADMIN_LOGIN']='yes';
		$_SESSION['ADMIN_USERNAME']=$username;
		header('location:categories.php'); //to redirect the user to a specific page 
		die();
	}else{
		$msg="Please enter correct login details";	
	}
	
}
?>
<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="css/sty.css">
    </head>
<body>
   <section class="vh-100" style="background-color: #9A616D;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="https://images.pexels.com/photos/6440168/pexels-photo-6440168.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
  
                  <form  method="post">
  
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                      <span class="h1 fw-bold mb-0">Happy Paws.</span>
                    </div>
  
                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Welcome Admin!</h5>
  
                    <div class="form-outline mb-4">
                      <input type="text" name="username"  class="form-control form-control-lg"placeholder="Username" required />
                      <label class="form-label">Username</label>
                    </div>
  
                    <div class="form-outline mb-4">
                      <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
                      <label class="form-label">Password</label>
                    </div>
  
                    <div class="pt-1 mb-4">
                      <button type="submit" name="submit" class="btn btn-secondary btn-lg btn-block" type="submit">Login</button>
                    </div>
                  </form>
                  <div style="color:red"><?php echo $msg ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>