<?php

// Include your database connection and functions
require('connection.inc.php');
require('functions.inc.php');

// Initialize message variable
$msg='';

/// Check if form is submitted
if(isset($_POST['submit'])){
    // Retrieve form data using the names of the input fields
    $email = get_safe_value($con, $_POST['email']);
    $password = get_safe_value($con, $_POST['password']);
    
    // SQL query to check credentials and fetch user ID
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    
    $res = mysqli_query($con, $sql);
    $count = mysqli_num_rows($res);
    
    // If credentials are correct, redirect and set session variables
    if($count > 0){
        // Fetch the user data
        $userData = mysqli_fetch_assoc($res);
        
        // Assuming 'id' is the column name for user ID in your database
        $userId = $userData['id']; // Use the actual column name for user ID

        // Store user data in session variables
        $_SESSION['USER_ID'] = $userId;
        $_SESSION['USER_LOGIN'] = true;
        $_SESSION['USER_EMAIL'] = $email;

        // Redirect to another page
        header('location:adoptpage.php');
        die();
    } else {
        $msg = "Please enter correct login details";    
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Page</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="/fontawesome-free-6.5.1-web/css/all.min.css">
    
       
    <!-- Custom CSS -->
    <style>
        body {
            background-color:#88AB8E;
            background-image: url("img/bgpaws.jpg");
            background-repeat: no-repeat;
            color: black;
        }

        .login-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 200vh;
        }

    .card {
    border: none;
    border-radius: 1rem;
    background-color: rgba(255, 255, 255, 0.6);
    width: 100%; /* Use 100% for full-width or any other percentage */
    width: 1000px; /* Optional: use max-width to limit how wide the card can grow */
    }



        .card-img-top {
            border-radius: 1rem 0 0 1rem;
            object-fit: cover;
            height: 100%;
        }

        .btn-login {
            background-color: #88AB8E;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .btn-login:hover {
            background-color: #304D30;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            max-width: 80px;
        }
    </style>
</head>

<body>

    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-8 col-lg-10 col-md-12">
                    <div class="card" style="max-width: 1000px;">
                        <div class="row g-0">
                            <div class="col-md-6">
                                <img src="img/log2.jpg" alt="login form" class="card-img-top">
                            </div>
                            <div class="col-md-6">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <div class="logo-container">
                                        <img src="img/logo.png" alt="Logo" class="logo">
                                        <h2 class="h1 fw-bold mb-0">HappyPaws</h2>
                                    </div>

                                    <form method="POST">
                                        <div class="form-outline mb-4">
                                            <input type="email" name="email" id="email" class="form-control form-control-lg"  required />
                                            <label class="form-label" for="email">Email address</label>
                                        </div>
                                    
                                        <div class="form-outline mb-4">
                                            <div class="input-group">
                                                <input type="password"  name="password" id="password" class="form-control form-control-lg" required />
                                                <div class="input-group-append">
                                                    <span class="input-group-text password-toggle" onclick="togglePassword()">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                    
                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-login btn-lg btn-block" type="submit" name="submit">Login</button>
                                        </div>
                                    </form>
                                    <div style="color:red"><?php echo $msg ?></div>
                                    
                                    
                                    </div>
                                        <a class="small text-muted" href="#!">Forgot password?</a>
                                        <p class="mb-4">Don't have an account? <br>
                                            <a href="register.php" class="text-primary">Register here</a></p>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
crossorigin="anonymous"></script>

<script defer src="fontawesome-free-6.5.1-web/js/all.min.js"></script>

<script>
  function togglePassword() {
    var passwordInput = document.getElementById("password"); // Updated to match the input field ID
    var icon = document.querySelector(".input-group-text i");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}

</script>

</body>
</html>
