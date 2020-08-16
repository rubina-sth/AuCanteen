<?php
  session_start();
  include('../dbh/dbh.php');
  $id = $_SESSION['shop_id'];
  $result = $mysqli->query("SELECT * FROM orders NATURAL JOIN orderdetails NATURAL JOIN food NATURAL JOIN shop WHERE so_id='$id'") or die($mysqli->error);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Orders</title>
    <style>
      body{
        background-image: url(../customer/css/images/Sback.jpg);
        background-attachment: fixed;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
      }
      .col-12{
        background-color: rgba(255,255,255,0.6);
        height: 500px;
        margin-top: 40px;
        border-radius: 20px;
        box-shadow: 0px 0px 30px 20px;
      }
      .table tr{
        border-bottom: 2px solid #5A6978;
      }
      .table th{
        border-top: none;
      }
      .test{
        width: 1000px;
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
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="container">
             <div class="row">
              <div class="test test-1">
                <div class="scrollbar">
                  <table class="table" id="myTable">  
                    <thead>
                      <tr>
                        <th style="text-align: center;">Order #</th>
                        <th style="text-align: center;">Items</th>
                        <th style="text-align: center;">Quantity</th>
                        <th style="text-align: center;">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        while ($row = $result->fetch_assoc()){?>
                          <?php $date = date("Y-m-d");?>
                          <?php $food_id = $row['food_id'];?>
                          <?php $food_name = $mysqli->query("SELECT * FROM food WHERE food_id='$food_id';")?>
                          <?php if ($row['order_date'] == $date && $row['order_status'] != 'pickedup'):?>
                            <tr>
                              <td style="text-align: center;"><b><?php echo $row['orderID']?></b></td>
                              <td style="text-align: center;"><b><?php while($row1 = $food_name->fetch_assoc()){ echo $row1['food_name'];}?></b></td>
                              <td style="text-align: center; border-right: 2px solid #5A6978;"><b><?php echo $row['quantity'];?></b></td>
                              <td style="text-align: center;">
                                <form action="CRUDquery.php" method="post">
                                  <?php if($row['order_status'] == 'preparing'):?>
                	                  <div class="row">
                	                  	<button type="submit" class="btn btn-link" name="status" value="preparing" style="text-decoration: none; color: black;"><span style="color: green; font-size: 20px;">&#9679;</span> Preparing</button>
                	                    <button type="submit" class="btn btn-link" name="status" value="finished" style="text-decoration: none; color: black;"><span style="font-size: 20px;">&#9679;</span> Finished</button>
                	                    <button type="submit" class="btn btn-link" name="status" value="pickedup" style="text-decoration: none; color: black;"><span style="font-size: 20px;">&#9679;</span> Picked Up</button>
                	                  </div>
                                  <?php elseif($row['order_status'] == 'finished'):?>
                                    <div class="row">
                                      <button type="submit" class="btn btn-link" name="status" value="preparing" style="text-decoration: none; color: black;"><span style="color: black; font-size: 20px;">&#9679;</span> Preparing</button>
                                      <button type="submit" class="btn btn-link" name="status" value="finished" style="text-decoration: none; color: black;"><span style="font-size: 20px; color: green;">&#9679;</span> Finished</button>
                                      <button type="submit" class="btn btn-link" name="status" value="pickedup" style="text-decoration: none; color: black;"><span style="font-size: 20px;">&#9679;</span> Picked Up</button>
                                    </div>
                                  <?php else:?>
                                    <div class="row">
                                      <button type="submit" class="btn btn-link" name="status" value="preparing" style="text-decoration: none; color: black;"><span style="color: green; font-size: 20px;">&#9679;</span> Preparing</button>
                                      <button type="submit" class="btn btn-link" name="status" value="finished" style="text-decoration: none; color: black;"><span style="font-size: 20px;">&#9679;</span> Finished</button>
                                      <button type="submit" class="btn btn-link" name="status" value="pickedup" style="text-decoration: none; color: black;"><span style="font-size: 20px;">&#9679;</span> Picked Up</button>
                                    </div>
                                  <?php endif;?>
                                  <input type="hidden" name="order_id" value="<?php echo $row['orderID'];?>">
                                  <input type="hidden" name="food_id" value="<?php echo $row['food_id'];?>">
                                </form>
                              </td>
                            </tr>
                          <?php endif;?>
                        <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center">
            <a href="so_index.php"><button class="btn btn-primary" style="position: absolute; bottom: 0; border-radius: 15px;">Back</button></a>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

  </body>
</html>