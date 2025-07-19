<?php
require('connection.inc.php');
require('functions.inc.php');

$firstname = $lastname = $email = $password = "";
$firstname_err = $lastname_err = $email_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    if (empty(trim($_POST["firstname"]))) {
        $firstname_err = "Please enter your first name.";
    } else {
        $firstname = trim($_POST["firstname"]);
    }

    if (empty(trim($_POST["lastname"]))) {
        $lastname_err = "Please enter your last name.";
    } else {
        $lastname = trim($_POST["lastname"]);
    }

    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        // Check if email already exists
        $sql = "SELECT id FROM users WHERE email = ?";
        if ($stmt = $con->prepare($sql)) {
            $stmt->bind_param("s", $param_email);
            $param_email = trim($_POST["email"]);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $email_err = "This email is already taken.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Check input errors before inserting in database
    if (empty($firstname_err) && empty($lastname_err) && empty($email_err) && empty($password_err)) {
        $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";
        if ($stmt = $con->prepare($sql)) {
            $stmt->bind_param("ssss", $param_firstname, $param_lastname,$param_email, $param_password);
            // Set parameters and execute
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_email = $email;
            $param_password = $password; 

            if ($stmt->execute()) {

            $userId = $con->insert_id; // Get the ID of the last inserted row
           

            $_SESSION['USER_ID'] = $userId;
            $_SESSION['USER_LOGIN'] = true;
            $_SESSION['USER_EMAIL'] = $email;

            header("location: adoptpage.php");
            exit; 
            } else {
                echo "Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }
    $con->close();
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>register Page</title>
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous">

        <style>
            body{
            background-image: url('img/bg3.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            }
            .card {
            background-color: rgba(255, 255, 255, 0.7);
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .logo
        {
            width: 100px;
            height: 100px;
        }
        label{
          text-align:left;
        }
        .text-danger {
        color: red;
        }
        </style>
      
    </head>
    <body >
    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
      <div class="row gx-lg-5 align-items-center mb-5">
        <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
            <img src="img/logo.png" alt="logo" class="logo">
          <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
            Choose to adopt, <br />
            <span style="color: hsl(218, 81%, 75%)">and you'll gain a friend for life.</span>
          </h1>
          <p class="mb-4 opacity-70" style="color: white">
            Pet adoption is a heartfelt commitment that not only transforms the lives of the animals involved but also brings immeasurable joy and fulfillment to their human companions. 
            Choosing to adopt a pet from shelters or rescue organizations is an act of compassion, providing animals with a second chance at a loving home.
          </p>
        </div>
  
        <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
          <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
          <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>
  
          <div class="card bg-glass" >
            <div class="card-body px-4 py-5 px-md-5">
                <h3 class="fw-normal mb-4">Register now</h3>
            
              <form method="POST">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row">
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" name="firstname" id="form3Example1" class="form-control" />
                      <label class="form-label" for="form3Example1">First name</label>
                      <span class="text-danger"><?php echo $firstname_err; ?></span>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" name="lastname" id="form3Example2" class="form-control" />
                      <label class="form-label" for="form3Example2">Last name</label>
                      <span class="text-danger"><?php echo $lastname_err; ?></span>
                    </div>
                  </div>
                </div>
  
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" name="email" id="form3Example3" class="form-control" />
                  <label class="form-label" for="form3Example3">Email address</label>
                  <span class="text-danger"><?php echo $email_err; ?></span>
                </div>
  
                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form3Example4" class="form-control" />
                  <label class="form-label" for="form3Example4">Password</label>
                  <span class="text-danger"><?php echo $password_err; ?></span>
                </div>
  
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">
                  Sign up
                </button>

                <p class="mb-4">Already have an account? 
                  <a href="LoginUser.html" class="text-primary">Login here</a></p>
  
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </body>
  </html>