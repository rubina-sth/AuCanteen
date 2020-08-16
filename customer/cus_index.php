<?php
  include("nav.php");
  $result = $mysqli->query("SELECT * FROM customer WHERE cus_id='$id'") or die($mysqli->error);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Berkshire+Swash&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Courgette&display=swap" rel="stylesheet">

    <title>Home</title>
    <style>
      .carousel-inner img {
          width: 100%;
          height: auto;
      }

      .carousel-caption{
        top: auto;
        bottom: 40%;
      }
    </style>
  </head>

  <body>
    <?php while ($row = $result->fetch_assoc()){?>
      <div id="demo" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ul class="carousel-indicators">
          <li data-target="#demo" data-slide-to="0" class="active"></li>
          <li data-target="#demo" data-slide-to="1"></li>
          <li data-target="#demo" data-slide-to="2"></li>
        </ul>     
        <!-- The slideshow -->
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="css/images/1.jpg" width="1100" height="400">
            <div class="carousel-caption">
              <h1 style="color: white; font-family: 'Courgette', cursive; font-size: 50px;">Welcome, <?php echo $row['cus_name'];?></h1>
            </div>
          </div>
          <div class="carousel-item">
            <img src="css/images/2.jpg" width="1100" height="400">
            <div class="carousel-caption">
              <p style="color: white; font-family: 'Courgette', cursive; font-size: 50px;">Explore all the delicious delicacies.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="css/images/4.jpg" width="1100" height="400">
            <div class="carousel-caption" style="bottom: 30%;">
              <p style="color: white; font-family: 'Courgette', cursive; font-size: 50px;">Straight from the pan.</p>
            </div>
          </div>
        </div> 
        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
          <span class="carousel-control-next-icon"></span>
        </a>
      </div>
    <?php }?>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>