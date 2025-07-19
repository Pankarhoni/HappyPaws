<?php
require('connection.inc.php');
require('functions.inc.php');

if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']!=''){

}else{
	header('location:LoginUser.php');
	die();
}

// Retrieve pet id from GET request and sanitize it
$petId = isset($_GET['pet_id']) ? mysqli_real_escape_string($con, $_GET['pet_id']) : '';

// Fetch pet details from the database
$sql = "SELECT pet.*, categories.categories as category_name FROM pet JOIN categories ON pet.categories_id = categories.id WHERE pet.id = '" . $petId . "' LIMIT 1";
$result = $con->query($sql);

if (!$result || $result->num_rows == 0) {
    die("Pet not found");
}

$petDetails = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    .profile-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 40px; /* Adds some space between the image and details */
    padding: 20px;
    margin-top:5%;
      }

  .pet-image-container {
    flex: 1; /* Flex grow */
    max-width: 600px; /* Adjust based on your preference */
    display: flex;
    justify-content: center; /* Center the image horizontally */
    align-items: center; /* Center the image vertically */
    overflow: hidden; /* Ensures nothing spills out */
    border-radius: 10px; /* Rounded corners for the container */
    height:900px;
  }

  .pet-image {
    max-width: 100%; /* Allows the image to scale down if it's too wide for the container */
    max-height: 100%; /* Allows the image to scale down if it's too tall for the container */
    object-fit: contain; /* Ensures the full image is visible, may add letterboxing */
  }

  .pet-details {
    flex: 1 1 200px; /* Flex grow, flex shrink, flex basis */
    max-width: 400px; /* Adjust based on your preference */
    /* Your existing styles for pet-details */
  }

    .pet-details h1 {
    text-transform: uppercase; /* Make the pet name uppercase */
    }

    .pet-details p label {
    font-weight: bold; /* Make the attribute labels bold */
    font-size: 18px;
    }
    .pet-details hr {
    border: 0;
    height: 3px; /* Adjust the thickness of the <hr> */
    background-color: #000000; /* Color of the <hr> */
    width: 100%; /* Adjust the width as needed */
    margin: 20px auto; 
    }

    .adopt-button {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .adopt-button:hover {
      background-color: #45a049;
    }
  </style>
  <title>Pet Profile</title>
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

      <div class="container">
        <div class="profile-container">
            <div class="pet-image-container">
            <img src="<?php echo PET_IMAGE_SITE_PATH.$petDetails['image']; ?>" alt="Pet Image" class="pet-image">
            </div>

            <div class="pet-details">
                <!-- Display pet details -->
              <h1><?php echo htmlspecialchars($petDetails['name']); ?></h1><hr>
              <p><label>Category:</label> <?php echo htmlspecialchars($petDetails['category_name']); ?></p>
              <p><label>Age:</label> <?php echo htmlspecialchars($petDetails['age']); ?></p>
              <p><label>Breed:</label> <?php echo htmlspecialchars($petDetails['breed']); ?></p>
              <p><label>Gender:</label> <?php echo htmlspecialchars($petDetails['gender']); ?></p>
              <p><label>Vaccination status:</label> <?php echo htmlspecialchars($petDetails['vaccination']); ?></p>
              <p><label>About:</label> <?php echo htmlspecialchars($petDetails['about']); 
; ?></p>
              <a href="adoptionform.php?pet_id=<?php echo $petDetails['id']; ?>" class="btn btn-success">Adopt</a>


            </div>
        </div>
    </div>
   
  <!-- Bootstrap JS and Popper.js (required for Bootstrap components to work) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
