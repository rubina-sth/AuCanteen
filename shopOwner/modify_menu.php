<?php
  session_start();
  include("../dbh/dbh.php");
  $id = $_SESSION['shop_id'];
  $result = $mysqli->query("SELECT * FROM food NATURAL JOIN shopowner NATURAL JOIN shop WHERE so_id='$id' ") or die($mysqli->error);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Orders</title>
    <style>
      body{
        background-image: url(../customer/css/images/Sback.jpg);
        background-attachment: fixed;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
      }
      .col-10{
        background-color: rgba(255,255,255,0.7);
        height: 500px;
        margin-top: 40px;
        border-radius: 20px;
        box-shadow: 0px 0px 30px 20px;
      }
      .table tr{
        border-bottom: 2px solid #5A6978;
      }
      .table > thead > tr > th{
        border-top: none;
        border-bottom: 2px solid black;
      }
      .test{
        width: 700px;
        height: 420px;
        overflow: auto;
        float: right;
        margin: 5px;
        border: none;
      }
      .scrollbar{
          width: 750px;
          height: 300px;
          margin: 0 auto;     
      }
      .test-1::-webkit-scrollbar {
        width: 5px;     
        height: 2px;
        display: none;
      }
      .test-1::-webkit-scrollbar-thumb {
              border-radius: 10px;
               -webkit-box-shadow: inset 0 0 5px rgba(0,0,0,0.2);
              background: #535353;
      }
      .test-1::-webkit-scrollbar-track {
              -webkit-box-shadow: inset 0 0 5px rgba(0,0,0,0.2);
              border-radius: 10px;
              background: #EDEDED;
      }
    </style>
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
        <div class="col-10">
          <div class="container">
            <div class="row">
              <div class="test test-1">
                <div class="scrollbar">
                  <table class="table" id="myTable">
                    <thead>
                      <tr>
                        <th hidden>Id</th>
                        <th>#</th>
                        <th>Food</th>
                        <th>Price(Baht)</th>
                        <th hidden>Type</th> 
                        <th hidden>Description</th> 
                        <th>Availability</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $count = 1;?>
                      <?php
                        while ($row = $result->fetch_assoc()): ?>
                          <tr>
                            <td hidden><b><?php echo $row['food_id'];?></b></td>
                            <td><b><?php echo $count;?></b></td>
                            <td><b><?php  echo $row['food_name'];?></b></td>
                            <td><b><?php echo $row['price'];?></b></td>
                            <td hidden><?php echo $row['type']?></td>
                            <td hidden><?php echo $row['description']?></td>
                            <td>
                              <form action="CRUDquery.php" method="POST">
                                <?php 
                                  if ($row['availability'] == 'yes'):?>
                                    <div class="row">
                                      <button type="submit" class="btn btn-link" name="availability" value="yes" style="text-decoration: none; color: black;"><span style="color: green; font-size: 20px;">&#9679;</span> Yes</button>
                                      <button type="submit" class="btn btn-link" name="availability" value="no" style="text-decoration: none; color: black;"><span style="font-size: 20px;">&#9679;</span> No</button>
                                    </div>
                                  <?php
                                    else:?>
                                      <div class="row">
                                        <button type="submit" class="btn btn-link" name="availability" value="yes" style="text-decoration: none; color: black;"><span style="font-size: 20px;">&#9679;</span> Yes</button>
                                        <button type="submit" class="btn btn-link" name="availability" value="no" style="text-decoration: none; color: black;"><span style="color: green; font-size: 20px;">&#9679;</span> No</button>
                                      </div>
                                    <?php endif;?>
                                  <input type="hidden" name="available" value="<?php echo $row['food_id'];?>">
                              </form>
                            </td>
                            <td>
                              <form action="CRUDquery.php" method="POST">
                                <button type="button" class="btn btn-primary editbtn" id="editbtn" style="border-radius: 20px; width: 60px; height: 25px;" data-toggle="modal" data-target="#update"><p style="font-size: 12px; margin-top: -5px;">Update</p></button>
                                <button type="button" class="btn btn-danger deletebtn" style="border-radius: 20px; width: 60px; height: 25px;" data-toggle="modal" id="deletebtn" data-target="#delete"><p style="font-size: 12px; margin-top: -5px;">Delete</p></button>
                              </form>
                            </td>
                          </tr>
                          <?php $count++;?>
                        <?php endwhile; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center">
            <a href="so_index.php"><button class="btn btn-primary" style="bottom: 0; border-radius: 15px;">Back</button></a>
            <button type="button" class="btn btn-success" style="bottom: 0; border-radius: 15px;" data-toggle="modal" data-target="#add_food">Add Food</button>
          </div>
        </div>
        <div class="col-1"></div>
      </div>

      <div class="modal" id="add_food">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Food</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <form action="CRUDquery.php" method="POST">
                <div class="form-group">
                  <label for="food_name"><b>Food Name:</b></label>
                  <input type="text" class="form-control" id="food_name" name="food_name" placeholder="Enter food">
                </div>
                <div class="form-group">
                  <label for="price"><b>Price:</b></label>
                  <input type="number" class="form-control" id="price" name="price" placeholder="Enter price">
                </div>
                <div class="form-group">
                  <label for="type"><b>Type:</b></label>
                  <input type="text" class="form-control" id="type" name="type" placeholder="veg or non veg">
                </div>
                <div class="form-group">
                  <label for="description"><b>Description:</b></label>
                  <input type="text" class="form-control" id="description" name="description" style="height: 100px; width: 300px;" placeholder="Short description of food...">
                </div>  
                <div class="text-center">
                  <button type="submit" class="btn btn-success" name="confirm" style="margin-left: 10px; border-radius: 10px;">Confirm</button>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-radius: 10px;">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal" id="update">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update Food Details</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <form action="CRUDquery.php" method="POST">
                <input type="hidden" name="update_id" id="update_id">
                <div class="form-group">
                  <label for="foodName"><b>Food Name:</b></label>
                  <input type="text" class="form-control" id="foodName" name="foodName" placeholder="Enter food">
                </div>
                <div class="form-group">
                  <label for="foodPrice"><b>Price:</b></label>
                  <input type="number" class="form-control" id="foodPrice" name="foodPrice" placeholder="Enter price">
                </div>
                <div class="form-group">
                  <label for="type"><b>Type:</b></label>
                  <input type="text" class="form-control" id="foodType" name="foodType" placeholder="veg or non veg">
                </div>
                <div class="form-group">
                  <label for="foodDescription"><b>Description:</b></label>
                  <input type="text" class="form-control" id="foodDescription" name="foodDescription" style="height: 100px; width: 300px;" placeholder="Short description of food...">
                </div>  
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="save" style="border-radius: 10px;">Save</button>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-radius: 10px;">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal" id="delete">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Confirmation</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="CRUDquery.php" method="POST">
              <div class="modal-body">            
                <input type="hidden" name="delete_id" id="delete_id">
                <p>Are you sure you want to delete?</p>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="deletedata" style="border-radius: 10px;">Yes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-radius: 10px;">No</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script> -->
   <!--  <script>
      $('#myTable').dataTable( {
        "pageLength": 5,
        "bFilter": false,
        "bLengthChange": false,
      });
    </script> -->
    <script type="text/javascript">
      $('.editbtn').on('click', function() {
        // $('#udpate').modal('show');
          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
            return $(this).text();
          }).get();

          console.log(data);

          $('#update_id').val(data[0]);
          $('#foodName').val(data[2]);
          $('#foodPrice').val(data[3]);
          $('#foodType').val(data[4]);
          $('#foodDescription').val(data[5]);
      });
    </script>
    <script type="text/javascript">
      $('.deletebtn').on('click', function() {
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);

        $('#delete_id').val(data[0]);
      });
    </script>
  </body>
</html>