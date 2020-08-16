<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../customer/css/style.css">

    <title>Customer Login</title>
  </head>
  <body>
    <?php require_once 'cus_loginPHP.php' ?>
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
        <div class="col-2"></div>
        <div class="col-8 outer">
          <h1 class="text-center">WELCOME TO AU CANTEEN</h1>
          <div class="row">
            <div class="col-1"></div>
            <div class="col-10" style="background-color: rgba(212, 172, 13, 0.3); height: 380px; border-radius: 20px; box-shadow: 0px 0px 40px 20px inset black;">
              <h1 class="text-center" style="color: #3498DB;">Login</h1>
              <form action="cus_loginPHP.php" method="post" style="margin-left: 10px;">
                <div class="form-group">
                  <label for="id">ID:</label>
                  <input type="text" class="form-control" placeholder="Enter your Id" id="id" name="id">
                </div>
                <div class="form-group">
                  <label for="pwd">Password:</label>
                  <input type="Password" class="form-control" placeholder="Enter your password" id="pwd" name="pwd">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="cus_login" style="margin-left: 0px;">Login</button>
                </div>
                <div>
                  <span style="color: white;">Don't have an account?</span><br>
                  <button class="btn btn-link" formaction="cus_createAccount.php"><u>Create Account</u></button>
                </div>
              </form>
            </div>
            <div class="col-1"></div>
          </div>
        </div>
        <div class="col-2"></div>
      </div>
    </div>
  
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
