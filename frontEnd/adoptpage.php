<?php
require('connection.inc.php');
require('functions.inc.php');

if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']!=''){

}else{
	header('location:LoginUser.php');
	die();
}

// Retrieve pet type from GET request and sanitize it
//$petType = isset($_GET['pet_type']) ? mysqli_real_escape_string($con, $_GET['pet_type']) : '';

// Start with a base query to join pet and categories tables
// Ensure you replace 'categories.name' with the actual column name if it's different
//$sql = "SELECT pet.id, pet.name, pet.age, pet.image, categories.categories as category_name FROM pet JOIN categories ON pet.categories_id = categories.id";

// Append to the query if a pet type is selected
//if (!empty($petType)) {
 //   $sql .= " WHERE categories.id = '" . $petType . "'";
//}

//$result = $con->query($sql);

//if (!$result) {
  //  die("Query failed: " . $con->error);
//}
//------------------------------------------------------------------------------------------------
// Retrieve pet type from GET request and sanitize it
$petType = isset($_GET['pet_type']) ? mysqli_real_escape_string($con, $_GET['pet_type']) : '';

// Get the name of the selected category for display
$categoryName = "";
if (!empty($petType)) {
    $categoryResult = $con->query("SELECT categories FROM categories WHERE id = '$petType'");
    if ($categoryResult && $categoryRow = $categoryResult->fetch_assoc()) {
        $categoryName = $categoryRow["categories"];
    }
}

// Start with a base query to join pet and categories tables
// Ensure you replace 'categories.name' with the actual column name if it's different
$sql = "SELECT pet.id, pet.name, pet.age, pet.image, categories.categories as category_name FROM pet JOIN categories ON pet.categories_id = categories.id";

// Append to the query if a pet type is selected
if (!empty($petType)) {
    $sql .= " WHERE categories.id = '" . $petType . "'";
}

$result = $con->query($sql);

if (!$result) {
    die("Query failed: " . $con->error);
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #D4E7C5;
    }

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


    .container {
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(190, 226, 187, 0.201);
      padding: 20px;
      margin-top: 20px;
      
    }

    .card {
      border: 1px solid #ced4da;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease-in-out;
    }

    .card:hover {
      transform: scale(1.05);
    }

    .card img {
      height: 200px; /* Adjust the height as needed */
      object-fit: cover;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
    }
    .row
    {
      margin: 3%;
    }
    .col-md-3
    {
      padding-top: 30px;
    }

    .form-container {
            background-color: #E8ECEF;
            flex-direction: column; /* Stack form elements vertically */
            align-items: flex-start; /* Align items to the start */
            width: 100%; /* Full width of the container */
            max-width: 600px; /* Maximum width of the form container */
            padding: 30px;
            border-radius: 8px;
        }

        form {
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"], input[type="email"], input[type="tel"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        button {
            background-color: #5cb85c; /* Green background */
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4cae4c; /* Darker green on hover */
        }

        h1, h2 {
            color: #333;
        }
 

  </style>


  <title>Adopt a Pet</title>
</head>
<body>

  <!-- Top Navigation Bar -->
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

  <!-- Search Bar -->
  <!-- Search Bar with Dropdown -->
  <div class="container mt-3">
    <form action="" method="GET">
      <div class="input-group mb-3">
        <select class="custom-select" name="pet_type">
          <option value="">Choose a Pet Type...</option>
          <?php
          $categoriesResult = $con->query("SELECT * FROM categories");
          if ($categoriesResult && $categoriesResult->num_rows > 0) {
              while($catRow = $categoriesResult->fetch_assoc()) {
                  $selected = (isset($_GET['pet_type']) && $_GET['pet_type'] == $catRow["id"]) ? "selected" : "";
                  echo "<option value='" . $catRow["id"] . "' $selected>" . htmlspecialchars($catRow["categories"]) . "</option>";
              }
          } else {
              echo "Error: " . $con->error;
          }
          ?>
        </select>
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">Search</button>
        </div>
      </div>
    </form>
  </div>

  <!-- Cards Section for displaying pets -->
  <div class="container mt-3">
    <div class="row">
      <?php
      if ($result->num_rows > 0) {
          // Output data of each row
          while($row = $result->fetch_assoc()) {
              echo '<div class="col-md-3">';
              echo '  <div class="card">';
              echo '    <img src="'. PET_IMAGE_SITE_PATH.$row['image'].'" class="card-img-top" alt="Pet Image">';
              echo '    <div class="card-body">';
              echo '      <h5 class="card-title">' . htmlspecialchars($row["name"]) . '</h5>';
              echo '      <p class="card-text">Age: ' . htmlspecialchars($row["age"]) . ' </p>';
              echo '      <p class="card-text">Category: ' . htmlspecialchars($row["category_name"]) . ' </p>';
              echo '      <a href="petProfile.php?pet_id=' . $row['id'] . '" class="btn btn-success">Adopt</a>';
              echo '    </div>';
              echo '  </div>';
              echo '</div>';
          }
      } else {
          echo "0 results";
      }
      ?>
    </div>
  </div>
  </div>
</div>
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center mt-3">
      <li class="page-item disabled">
        <span class="page-link">&laquo;</span>
      </li>
      <li class="page-item active"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>
  <!-- Bootstrap JS and Popper.js (required for Bootstrap components to work) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
