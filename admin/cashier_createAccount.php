<?php
  session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../customer/css/style.css">

    <title>Create Cashier Account</title>
  </head>
  <body>
    <?php
      if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?=$_SESSION['alert']?> alert-dismissable text-center">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
          ?>
        </div>
      <?php endif ?>
    <div class="container">
      <div class="row">
        <div class="col-1"></div>
        <div class="col-10 outer" style="height: 600px; margin-top: 40px;">
          <h1 class="text-center"><b>Register Cashier account</b></h1>
          <div class="row">
            <div class="col-1"></div>
            <div class="col-10" style="background-color: rgba(212, 172, 13, 0.3); height: 540px; border-radius: 20px; box-shadow: 0px 0px 40px 20px inset black;">
              <p style="color: #DAA520; padding-top: 20px;"><u><b>Please fill in the following details :</b></u></p>
              <form action="cashier_createAccountPHP.php" method="post">
                <div class="form-group">
                  <label style="font-size: 15px; margin-top: 0" for="name">Name:</label>
                  <input type="text" class="form-control" placeholder="Enter Cashier Name" id="name" name="name">
                </div>
                <div class="form-group">
                  <label style="font-size: 15px" for="id">ID:</label>
                  <input type="text" class="form-control" placeholder="Enter Id" id="id" name="id">
                </div>
                <div class="form-group">
                  <label style="font-size: 15px" for="pwd">Password:</label>
                  <input type="Password" class="form-control" placeholder="Enter Password" id="pwd" name="pwd">
                </div>
                <div class="form-group">
                  <label style="font-size: 15px" for="confirmPwd">Confirm Password:</label>
                  <input type="Password" class="form-control" placeholder="Confirm Password" id="confirmPwd" name="confirmPwd">
                </div>
                <div class="text-center">
                  <button style="border-radius: 25px; margin-top: 0; padding: 6px 30px;" type="submit" class="btn btn-danger" formaction="admin_index.php">Back</button>
                  <button style="margin-top: 0; margin-left: 50px;" type="submit" name="cashier_create" class="btn btn-primary">Register</button>
                </div>
              </form>
            </div>
            <div class="col-1"></div>
          </div>
        </div>
        <div class="col-1"></div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>