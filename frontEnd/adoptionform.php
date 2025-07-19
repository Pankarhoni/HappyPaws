<?php
require('connection.inc.php');
require('functions.inc.php');

if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']!='') 
{
    // Retrieve the user ID from the session
    $userEmail=$_SESSION['USER_EMAIL'];
    //$userId = $_SESSION['USER_ID']; // Assuming you store the user ID in the session as USER_ID
} else {
  
    header('location: LoginUser.php');
    exit(); // Stop further execution
}


$sql = "SELECT firstname, email, mobile FROM users WHERE email = '$userEmail'";
$result = $con->query($sql);

if ($result->num_rows == 1) {
    $userDetails = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit;
}

// Check if the pet_id is set in the query string
$petId = isset($_GET['pet_id']) ? mysqli_real_escape_string($con, $_GET['pet_id']) : '';
// Then a query to fetch the pet details based on $petId
if (isset($_GET['pet_id'])) {
    $petId = mysqli_real_escape_string($con, $_GET['pet_id']);

    // Fetch pet details from the database
    $query = "SELECT * FROM pet WHERE id = '$petId'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $petDetails = mysqli_fetch_assoc($result);
    } else {
        echo "Pet not found.";
        exit;
    }
} else {
    echo "No pet selected.";
    exit;
}


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'requestAdoption') {
    // Assuming you have validated the user is logged in and have their email in $userEmail
    
    // Sanitize input
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $email = mysqli_real_escape_string($con, $_POST['email']); // Though you might not want to change the email without verification
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $pet_id = mysqli_real_escape_string($con, $_POST['pet_id']); // For any pet related updates or checks

    // Update the user's details in the database
    $updateSql = "UPDATE users SET firstname = '$firstname', mobile = '$phone' WHERE email = '$userEmail'";
    if(mysqli_query($con, $updateSql)) {
        // Optional: Add any success message or redirection here
        echo "<script>alert('Requested for adoption, the shelter will contact you.'); window.location.href='Home.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Adoption Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
      font-family: Arial, sans-serif;
      background-color: #EEF0E5;
      margin: 0;
      padding: 0;
    }

     /*-- nav--*/

     nav {
      background-color:#D4E7C5;
      color: white;
      overflow: hidden;
    }

    nav a {
      float: right;
      display: block;
      color: #333;
      text-align: center;
      padding: 20px;
      text-decoration: none;
      transition: background-color 0.3s;
    }

    nav a:hover {
      background-color:white;
      color: black;
    }
     /*-- footer --*/

     footer {
      text-align: center;
      padding: 20px;
      background-color: #EEF0E5;
      color: #333;
      bottom: 0;
      width: 100%;
    }
    
    /*-- logo --*/

    .logo {
      float: left;
      display: flex;
      align-items: center;
      color: #333;
      margin-left: 2%;
    }

    .logo img {
      width: 60px;
      height: auto;
      margin-right: 10px;
    }
    .pet-container {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-bottom: 20px;
            background-color:#CCD3CA;
            padding:30px;
            margin: 30px;

        
            flex-direction: column; /* Keep stacking form elements vertically */
            width: 100%; /* Utilize full width for responsiveness */
            max-width: 600px; /* Optimal form width for readability */
            padding: 40px; /* Increased padding for better spacing */
            border-radius: 10px; /* Slightly larger radius for softer edges */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            margin: 20px auto; /* Center form on page with vertical spacing */
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; /* Modern, readable typography */
            color: #333; /* Darker text for better contrast and readability */


        }

        .pet-image {
            flex: 0 0 auto; /* Do not grow, do not shrink, and base width on the content */
            margin-right: 20px;
        }

        .pet-image img {
            width: 200px; /* Adjust based on your preference */
            height: auto;
            border-radius: 10px;
        }

        .pet-details {
            flex: 1; /* Take up remaining space */
        }

        .pet-details h2,
        .pet-details p {
            text-transform: uppercase;
            margin: 0 0 10px 0; /* Adjust spacing as needed */
        }
        .form-container {
    background-color: #CCD3CA; /* Lighter shade for a softer appearance */
    flex-direction: column; /* Keep stacking form elements vertically */
    align-items: center; /* Center-align items for a balanced look */
    width: 100%; /* Utilize full width for responsiveness */
    max-width: 600px; /* Optimal form width for readability */
    padding: 40px; /* Increased padding for better spacing */
    border-radius: 10px; /* Slightly larger radius for softer edges */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    margin: 20px auto; /* Center form on page with vertical spacing */
    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; /* Modern, readable typography */
    color: #333; /* Darker text for better contrast and readability */
}

input {
    width: calc(100% - 20px); /* Adjust width to account for padding */
    padding: 12px 10px; /* Increased padding for better text input experience */
    margin-bottom: 25px; /* Increased margin for better spacing */
    border: 1px solid #ccc; /* Lighter border color for softer UI */
    border-radius: 5px; /* Consistent border-radius with the form container */
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1); /* Subtle inner shadow for depth */
    font-size: 16px; /* Larger font size for readability */
}

input {
    border-color: #88a5b1; /* Highlight focus with a different border color */
    box-shadow: 0 0 0 2px rgba(136, 165, 177, 0.25); /* Soft outer glow on focus */
    outline: none; /* Remove default focus outline */
}

button {
    background-color: #4CAF50; /* Vibrant button color */
    color: white; /* Contrast text color */
    border: none; /* Remove default border */
    padding: 12px 20px; /* Comfortable padding */
    border-radius: 5px; /* Match input border-radius */
    cursor: pointer; /* Indicate clickable button */
    font-size: 16px; /* Readable font size */
    font-weight: bold; /* Bold text for call to action */
    transition: background-color 0.3s ease; /* Smooth transition for interaction */
}

button:hover {
    background-color: #45a049; /* Slightly darker on hover for interaction feedback */
}

    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="logo">
      <img src="img/logo.png" alt="Logo">
      <b>HappyPaws</b>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="Home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="adoptpage.php" onclick="checkUserLoggedIn()"  >Adopt</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="AboutUs.html">About</a>
        </li>
        <li class="nav-item">
        <?php if (isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN'] === true): ?>
        <a class="nav-link" href="logout.php">LOGOUT</a>
        <?php else: ?>
        <a class="nav-link" href="LoginUser.php">LOGIN</a>
        <?php endif; ?>
        </li>
      </ul>
    </div>
  </nav>

      <div class="pet-container">
      <h1>Adoption Form</h1>
    
        <div class="pet-image">
            <img src="<?php echo PET_IMAGE_SITE_PATH . $petDetails['image']; ?>" alt="Pet Image">
        </div>
        <div class="pet-details">
            <h2><?php echo htmlspecialchars($petDetails['name']); ?></h2>
            <p>Age: <?php echo htmlspecialchars($petDetails['age']); ?></p>
            <p>Breed: <?php echo htmlspecialchars($petDetails['breed']); ?></p>
        </div>
    </div>
    <div class="form-container">
    <h2>User Details</h2><br>
    <form  method="post">
        <label for="firstname">First Name:</label><br>
        <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($userDetails['firstname']); ?>"><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userEmail); ?>"><br>
        
        <label for="phone">Phone:</label><br>
        <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($userDetails['mobile']); ?>"><br>
        
        <input type="hidden" name="pet_id" value="<?php echo htmlspecialchars($petId); ?>"> <!-- Assuming $petId is available -->
        
        <button type="submit" name="action" value="requestAdoption">Request for Adopt</button>
    </form>
    </div>

</body>
</html>
