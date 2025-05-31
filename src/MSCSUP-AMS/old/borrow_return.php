<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="shortcut icon" href="images/biglogo.png">
<link rel="stylesheet" href="css/design.css">
    <!-- Title Page-->
    <title>Returned Item</title>


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
                                <h3 class="title-1">Returned Item</h2>
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
                          <th>Date Return</th>
                          <th>Status</th>
                      </tr>
                  </thead>
                  <tbody>

                     <?php

                   include 'connection/db_connection.php';
                   $result = mysqli_query($connection, "SELECT * FROM `returned_item`");
                   while($row = mysqli_fetch_array($result)){

                  ?>
                      <tr class="tr-shadow">


                          <td><?php echo $row['return_id'];?></td>
                          <td><?php echo $row['fname'];?>&nbsp<?php echo $row['lname'];?> </td>
                          <td><?php echo $row['barangay'];?></td>
                          <td> <?php echo $row['item'];?>&nbsp<strong>(<?php echo $row['quantity'];?>)<strong> </td>
                          <td> <?php echo $row['date_time_borrow'];?> </td>
                          <td> <?php echo $row['date_time_returned'];?> </td>
                          <td><?php echo $row['status'];?></td>


                      </tr>
                      <?php };?>

</div>

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
