<?php
require('connection.inc.php');
require('functions.inc.php');

isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']!=''

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <style>
      @font-face {
      font-family: 'Catchy Mager Regular';
      src: url('path/to/font/Catchy_Mager_Regular.ttf') format('truetype');
      font-weight: normal;
      font-style: normal;
    }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
   
      background-color: #f5f5f5;
      color: #333;
      line-height: 1.6;
    }
    /*nav*/
    nav{
      background-color: #EEF0E5;

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


    /*-- hero container --*/

    .hero-container {
      position: relative;
      width: 100%;
      height: 70vh; /* Adjust the height as needed */
      background: url('img/header.jpg') center/cover no-repeat;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: #fff;
    }

    .hero-header {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100px ;
      margin-bottom: 20px;
    }

    .hero-button {
      background-color: #3559E0;
      color: white;
      padding: 10px 20px;
      font-size: 1.2em;
      border: none;
      cursor: pointer;
      border-radius: 10px;
      transition: background-color 0.3s;
    }

    .hero-button:hover {
      background-color: #38419D;
    }

    /*wecome container -------------*/

    .welcome-container h2 {
      font-family: 'Catchy Mager Regular', sans-serif;
      font-size: 2.5em;
      margin-bottom: 20px;
      text-align: center;
      color: #333;
    }

    .welcome-container {
     
      max-width: 800px;
      margin: 40px auto;
      padding: 20px;
      background-color: #EEF0E5;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: justify;
      border-radius: 10px;
      text-align: center;
    }

    .container-video {
      display: flex;
      justify-content: space-around;
      align-items: center;
      max-width: 100%;
      margin: 50px auto;
      background-color: #EEF0E5;
      overflow: hidden;
      border-radius: 10px;
    }

    .video-container {
      flex: 1;
      padding: 3%;
    }

    video {
      width: 100%;
      height: auto;
      border-radius: 10px;
      object-fit: cover;
    }

    .text-container {
      flex: 1;
      padding: 30px;
    }

    .text-container h2 {
      font-size: 2em;
      margin-bottom: 20px;
      color: #333;
    }

    .text-container p {
      color: #555;
    }

    .animal-cards-container {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      text-align: center;
      margin-bottom: 20px;
    }

    .animal-cards-container img {
      height: 200px;
      width : 100;
      
    }

    .animal-search-card {
      border: 1px solid #ddd;
      border-radius: 16px;
      padding: 10px;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      width: 250px;
      transition: transform 0.3s ease-in-out;
      cursor: pointer;
      margin: 16px;
    }

    .animal-search-card:hover {
      transform: scale(1.1);
    }

    .animal-search-card img {
      max-width: 100%;
      border-radius: 8px;
    }

    .animal-search-card h2 {
      font-size: 1.8em;
      margin-bottom: 10px;
      color: #333;
    }

    .animal-search-card p {
      color: #555;
      font-weight: bold;
      margin-top: 10px;
    }
  
 /* Carousel styles */
 .adoption-stories-container {
      max-width: 100%;
      margin: 40px 0;
      padding: 40px;
      background-color: #EEF0E5;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      text-align: center;
    }
    .adoption-stories-container h1
    {
      font-family: 'Catchy Mager Regular', sans-serif;

    }

    .carousel-inner {
      padding: 40px;
      display: flex;
      overflow: hidden;
      border-radius: 20px; /* Rounded edges */
      margin: 0 -10px; /* Add some negative margin for rounded edges */

    }

    .carousel-item {
      flex: 0 0 calc(100% - 20px); /* Make the items a bit smaller */
      margin: 0 10px; /* Add some margin for rounded edges */
    }

    .inner-container {
      display: flex;
      width: 100%;
    }

    .carousel-image {
      width: 50%;
      max-height: 500px;
      object-fit: cover;
      border-radius: 10px 0 0 10px;
    }

    .carousel-text {
      background-color: #fff;
      padding: 20px;
      border-radius: 0 10px 10px 0;
      width: 50%;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
  /* stat container */
  .statistics-container {
    display: flex;
    justify-content: space-around;
    margin: 60px auto;
    max-width: 800px;
  }

  .statistics-card {
    margin: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 25px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 400px;
    transition: transform 0.3s ease-in-out;
    cursor: pointer;
    color: rgb(255, 255, 255);
    background-color: #739072;
  }

  .statistics-card:hover {
    transform: scale(1.05);
  }

  .statistics-card h3 {
    font-size: 1.5em;
    margin-bottom: 10px;
  }

  .statistics-card p {
    font-size: 1.2em;
    font-weight: bold;
  }

  .statistics-card img
  {
    width: 60px;
    height: 60px;

  }

  .text-image-section {
    display: flex;
    justify-content: space-around;
    align-items: center;
    margin: 40px auto;
    max-width: 800px;
  }

  .text-content {
    flex: 1;
    padding: 20px;
  }

  .text-content h2 {
    font-size: 2.5em;
    margin-bottom: 20px;
    color: #333;
  }

  .text-content p {
    font-size: 1.2em;
    color: #555;
  }

  .image-content {
    flex: 1;
    padding: 20px;
  }

  .image-content img {
    width: 100%;
    max-height: 300px; /* Adjust the maximum height as needed */
    object-fit: cover;
    border-radius: 10px;
  }
  /* vet display*/

  .center-image-container {
    text-align: center;
    margin: 40px auto;
  }

  .center-image-container img {
    width: 60%; 
    max-height: 500px; 
    border-radius: 10px;
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

  <div class="hero-container">
    <img src="img/headr logo.png" class="hero-header">
    <a href="adoptpage.php"><button class="hero-button" onclick="checkUserLoggedIn()"  >Adopt Now</button></a>
  </div>

  <!--welcome container-->
  <div class="welcome-container">
    <h2>Welcome to HappyPaws</h2>
    <p>Welcome to our Pet Adoption website, where the journey of love and companionship begins. <br>
      We are thrilled to welcome you to our community, where countless furry friends are eagerly waiting for their forever homes.
      At our heart, we believe in creating meaningful connections between animals and loving families.
      As you explore our platform, you'll discover heartwarming stories, adorable faces, and the opportunity to make a profound difference in the lives of these wonderful creatures.
      Whether you're considering adoption or simply seeking to connect with fellow animal enthusiasts, we're delighted to have you with us.
      Join us on this incredible adventure, and let's embark on a journey of compassion, joy, and the transformative power of pet adoption.
      Welcome to a world where every pawprint tells a unique story, and together,<br> we make a difference—one adoption at a time.</p>
  </div>

  <!--video-->
  <div class="container-video">
    <div class="video-container">
      <video controls>
        <source src="img/adoptionvid.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    </div>
    <!-- video text -->
    <div class="text-container">
      <h2>Adopting a Pet: Unleashing Joy, One Furry Friend at a Time!</h2>
      <p>In a heartwarming tale of compassion and companionship, the Johnson family embarked on a journey that would forever change their lives.</p>
      <p>Faced with an empty space in their home and hearts, the decision to adopt a furry friend became the catalyst for an abundance of joy and love.</p>
    </div>
  </div>

  <!-- Animal card video -->
  <div class="animal-cards-container">
    <img src="img/dislognew.png" alt="display">
    
    <a href="adoptpage.php?pet_type=2" style="text-decoration: none; color: inherit;">
    <div class="animal-search-card">
      <h2>Cat</h2>
      <img src="img/cat-card.jpg" alt="Cat">
      <p>Meet our adorable cats waiting for a loving home.</p>
      
    </div>
    </a>
    
    <a href="adoptpage.php?pet_type=1" style="text-decoration: none; color: inherit; ">
    <div class="animal-search-card">
      <h2>Dog</h2>
      <img src="img/dog-card.jpg" alt="Dog">
      <p>Explore our selection of friendly dogs.</p>
    </div>
    </a>
    
    <a href="adoptpage.php?pet_type=3" style="text-decoration: none; color: inherit;">
    <div class="animal-search-card">
      <h2>Bunny</h2>
      <img src="img/bunny card.jpg" alt="Bunny">
      <p>Adopt a cute bunny and bring joy to your home.</p>
    </div>
    </a>
  </div>

   <!-- Adoption Stories container with Carousel section -->
  <div class="adoption-stories-container">
    <h1>Adoption Stories</h1>
    <div id="carouselExample" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item  active">
          <div class="inner-container">
            <img src="img/dog-story.jpg" class="d-block w-100 carousel-image" alt="Dog Story">
            <div class="carousel-text">
              <blockquote class="blockquote text-center">
                <p class="mb-0">Max the dog made life better with his boundless energy, unwavering loyalty, 
                  and heartwarming companionship, turning ordinary moments into extraordinary memories.</p>
                <cite title="Source Title">- John</cite>
              </blockquote>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="inner-container">
            <img src="img/cat-story.jpg" class="d-block w-100 carousel-image" alt="Dog Story">
            <div class="carousel-text">
              <blockquote class="blockquote text-center">
                <p class="mb-0">Toby the cat made life better with his boundless energy, unwavering loyalty, 
                  and heartwarming companionship, turning ordinary moments into extraordinary memories.</p>
                <cite title="Source Title">- Kumti</cite>
              </blockquote>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="inner-container">
            <img src="img/bunny-story.jpg" class="d-block w-100 carousel-image" alt="Dog Story">
            <div class="carousel-text">
              <blockquote class="blockquote text-center">
                <p class="mb-0">Bunbun the bunny made life better with his boundless energy, unwavering loyalty, 
                  and heartwarming companionship, turning ordinary moments into extraordinary memories.</p>
                <cite title="Source Title">- Josh</cite>
              </blockquote>
            </div>
          </div>
        </div>
        <!-- Add more carousel items as needed -->
      </div>
      <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>

 <!-- Numbers  -->
<div class="statistics-container">
  <div class="statistics-card">
    <img src="icons/pet-house.png" alt="pet-icon">
    <h3>Animals in Shelter</h3>
     <h2>250</h2>
  </div>
  <div class="statistics-card">
    <img src="icons/pet adop icon.png" alt="pet-icon">
    <h3>Animals Adopted</h3>
    <h2>150</h2>
  </div>
  <div class="statistics-card">
    <img src="icons/people-icon.png" alt="pet-icon">
    <h3>Volunteers</h3>
    <h2>20</h2>
  </div>
</div>

<hr>

  <!-- vet display -->
<div class="center-image-container">
  <img src="img\meet our vet.png" alt="Centered Image">
</div>
<hr>
  <!-- footer -->
  <footer>
    &copy; HappyPaws. All rights reserved.
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  function checkUserLoggedIn() {
    fetch('check_login_status.php')
    .then(response => response.json())
    .then(data => {
        if (data.isLoggedIn) {
            window.location.href = 'adoptpage.php'; // Redirect to adoption page
        } else {
            alert('Please sign in to adopt a pet.');
            window.location.href = 'LoginUser.php'; // Redirect to sign-in page
        }
    })
    .catch(error => console.error('Error:', error));
  }
  </script>

</body>
</html>

  