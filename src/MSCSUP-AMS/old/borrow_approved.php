<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="css/design.css">    
    <link rel="shortcut icon" href="images/biglogo.png">
    <!-- Title Page-->
    <title>Borrow Approved</title>


  <?php require 'header.php'; ?>

<body class="animsition">


    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
<?php require 'nav_mobile.php'; ?>
<?php require 'sidebar/user-sidebar.php'; ?>


</div>
        <!-- END HEADER MOBILE-->





        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">

                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->



            <!-- MAIN CONTENT-->


            <div class="main-content">
              <div class="section__content section__content--p30">
                  <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="overview-wrap">
                                <h3 class="title-1">Borrowed Item</h2>
                            </div>
                        </div>
                    </div>


                  <div class="row m-t-30">
      <div class="col-md-12">
          <!-- DATA TABLE-->
          <div class="table-responsive m-b-40">
              <table class="table table-borderless table-data3">
                                                          <thead>
                      <tr>

                          <th>Trans#</th>
                          <th>Name</th>
                          <th>Barangay</th>
                          <th>item</th>
                          <th>Date/Time</th>
                          <th>Return Date</th>
                          <th>Status</th>
                          <th></th>
                      </tr>
                  </thead>
                  <tbody>

                     <?php

                   include 'connection/db_connection.php';
                   $result = mysqli_query($connection, "SELECT * FROM `borrow`");
                   while($row = mysqli_fetch_array($result)){

                  ?>
                      <tr class="tr-shadow">


                          <td><?php echo $row['trans_id'];?></td>
                          <td><?php echo $row['fname'];?>&nbsp<?php echo $row['lname'];?> </td>
                          <td><?php echo $row['barangay'];?></td>
                          <td> <?php echo $row['item'];?>&nbsp<strong>(<?php echo $row['quantity'];?>)<strong> </td>
                          <td> <?php echo $row['date_time_borrow'];?> </td>
                          <td> <?php echo $row['date_return'];?> </td>
                          <td> <?php echo $row['status'];?> </td>

                          <td>
                          <form action="borrowed_item.php" method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="trans_id" value="<?php echo $row['trans_id'];?>">
                            <input type="hidden" name="fname" value="<?php echo $row['fname'];?>">
                            <input type="hidden" name="lname" value="<?php echo $row['lname'];?>">
                            <input type="hidden" name="barangay" value="<?php echo $row['barangay'];?>">
                            <input type="hidden" name="item" value="<?php echo $row['item'];?>">
                            <input type="hidden" name="quantity" value="<?php echo $row['quantity'];?>">
                            <input type="hidden" name="date_time_borrow" value="<?php echo $row['date_time_borrow'];?>">

                          </td>
                      </tr>
                      <?php };?>


</form>

</div>
<?php

include 'connection/db_connection.php';

if (isset($_POST['submit'])) {

$trans_id=$_POST['trans_id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$barangay = $_POST['barangay'];
$item = $_POST['item'];
$quantity = $_POST['quantity'];
$date_time_borrow = $_POST['date_time_borrow'];

$sql1 = "INSERT INTO returned_item(return_id,fname,lname,barangay,item,quantity,date_time_borrow,date_time_returned)
VALUES('$trans_id','$fname','$lname','$barangay','$item','$quantity','$date_time_borrow',Now())";

$res = mysqli_query($connection, $sql1) or die(mysqli_error($connection));

$res = mysqli_query($connection, "DELETE FROM `borrow` WHERE `trans_id` = '$trans_id'");

 if (!$res){
   echo '<script>alert("Something Went Wrong");</script>';
 }
 else {
   echo '<script>alert("Item Returned");</script>';

echo '<script>self.location="'.$place.'";</script>';
 }

}

else {

}


?>

                  </tbody>
              </table>
          </div>
          <!-- END DATA TABLE -->
      </div>

</div>



<script type="text/javascript">

</script>



<div class="row">
    <div class="col-md-12">
        <div class="copyright">
        </div>
    </div>
</div>
</div>
</div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
                    </div>

                </div>

                        <?php require 'footer.php'; ?>
