<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="shortcut icon" href="images/biglogo.png">

    <!-- Title Page-->
    <title>Registered</title>


  <?php require 'header.php'; ?>


<body class="animsition">



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header"><h3 style=" font-family:arial;">Information</h3>
        <button type="button" class="close" data-dismiss="modal" >&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">





                                        <form action="registered.php" method="post" enctype="multipart/form-data" class="form-horizontal">
										<div class="row form-group">

                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label">Last Name</label>
                                                </div>

                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="last_name" class="form-control">

                                                </div>
                                            </div>
											    <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label">First Name</label>
                                                </div>

                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="first_name" class="form-control">

                                                </div>
                                            </div>

												 <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label">Middle Name</label>
                                                </div>

                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="mid_name" class="form-control">

                                                </div>
                                            </div>
											                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label">Gender</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="gender" id="gender" class="form-control">
                                                        <option value="">Select Gender</option>
														<option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
												</div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label">Age</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="age" id="age" class="form-control">
                                                        <option value="">Please select</option>
                                                        <option value="7-11 years old">7-11 years old</option>
                                                        <option value="12-18 years old">12-18 years old</option>
                                                        <option value="19 and above">19 and above</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label">Sports to join</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="sports" id="sports" class="form-control">
                                                        <option value="">Please select</option>
                                                        <option value="Basketball">Basketball</option>
                                                        <option value="Volleyball">Volleyball</option>
                                                        <option value="Badminton">Badminton</option>
													                            	<option value="Table Tennis">Table Tennis</option>
													                             	<option value="Chess">Chess</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Barangay</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="barangay" id="barangay" class="form-control">
                                                        <option value="">Please select</option>
                                                        <option value="Alipit">Alipit</option>
                                                        <option value="Bagumbayan">Bagumbayan</option>
                                                        <option value="Bubukal">Bubukal</option>
														<option value="Calios">Calios</option>
														<option value="Duhat">Duhat</option>
														<option value="Gatid">Gatid</option>
														<option value="Jasaan">Jasaan</option>
														<option value="Labuin">Labuin</option>
														<option value="Malinao">Malinao</option>
														<option value="Oogong">Oogong</option>
														<option value="Pagsawitan">Pagsawitan</option>
														<option value="Palasan">Palasan</option>
														<option value="Patimbao">Patimbao</option>
														<option value="Poblacion I">Poblacion I</option>
														<option value="Poblacion II">Poblacion II</option>
														<option value="Poblacion III">Poblacion III</option>
														<option value="Poblacion IV">Poblacion IV</option>
														<option value="Poblacion V">Poblacion V</option>
														<option value="Poblacion VI">Poblacion VI</option>
														<option value="Poblacion VII">Poblacion VII</option>
														<option value="Poblacion VIII">Poblacion VIII</option>
														<option value="San Jose">San Jose</option>
														<option value="San Juan">San Juan</option>
														<option value="San Pablo Norte">San Pablo Norte</option>
														<option value="San Pablo Sur">San Pablo Sur</option>
														<option value="Santisima Cruz">Santisima Cruz</option>
														<option value="Santo Angel Central">Santo Angel Central</option>
														<option value="Santo Angel Norte">Santo Angel Norte</option>
														<option value="Santo Angel Sur">Santo Angel Sur</option>
                                                    </select>
                                                </div>
                                            </div>
											                                    <div class="card-footer">
                                        <button type="submit" name="save" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>


                                    </div>
<?php

  include 'connection/db_connection.php';

        if (isset($_POST['save'])) {


          $last_name = $_POST['last_name'];
		  $first_name = $_POST['first_name'];
		  $mid_name = $_POST['mid_name'];
          $gender = $_POST['gender'];
          $age = $_POST['age'];
          $sports = $_POST['sports'];
		  $barangay = $_POST['barangay'];

            $sql = "INSERT INTO info(registration_no,last_name,first_name,mid_name,gender,age,sports,barangay,date_register)
            VALUES('','$last_name','$first_name','$mid_name','$gender','$age','$sports','$barangay',Now())";

  $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));


            if (!$result){
              echo '<script>alert("Something Went Wrong");</script>';
            }
            else {
              echo '<script>alert("Saved");</script>';
            }

          }

          else {

        }

       ?>

											</form>


      </div>


    </div>

   </div>
   </div>




    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
<?php require 'nav_mobile.php'; ?>


        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
<img src="images/msc_logo.png" alt="logo" />
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        
                    <li>
                            <a href="inventory.php">
                              <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li>
                            <a class="js-arrow" href="index.php">
                                <i class="fas fa-book"></i>Game Schedule</a>

                        </li>


                        <li class="active has-sub">
                            <a href="registered.php">
                              <i class="fas fa-pencil-square-o"></i> Registered</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-table"></i>Inventory</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                      <li>
                          <a href="item_request.php"><i class="fas fa-book"></i>Item Request</a>
                      </li>
                        <li>
                            <a href="borrowed_item.php"><i class="fas fa-check"></i>Borrowed Item</a>
                        </li>
                        <li>
                            <a href="returned_item.php"><i class="fas fa-arrow-left"></i>Returned Item</a>
                        </li>
                            </ul>
                        </li>
                        <li>
                            <a href="announcement.php">
                              <i class="fas fa-book"></i>Announcement</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-undo"></i>Archives</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                            <li>
                            <a href="archives.php">
                              <i class="fas fa-undo"></i>Sports Archives</a>
                        </li>
                        <li>
                            <a href="archivesitemreq.php">
                              <i class="fas fa-undo"></i>Borrow Archives</a>
                        </li>
                            </ul>
                        <li>
                            <a href="logout.php">
                              <i class="fas fa-power-off"></i>Logout</a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

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

                      <!-- Table inventory-->
                      <div class="top-campaign">
                          <h3 class="title-3 m-b-30">Total Registered</h3>
                          <div class="table-responsive">
                              <table class="table table-top-campaign">
                                  <tbody>
                                    <?php

                 include 'connection/db_connection.php';
                 $result = mysqli_query($connection, "SELECT COUNT(1) FROM `info` WHERE sports='Basketball'");
                 $row = mysqli_fetch_array($result);
                 $total = $row[0];

                 $result1 = mysqli_query($connection, "SELECT COUNT(1) FROM `info` WHERE sports='Volleyball'");
                 $row1 = mysqli_fetch_array($result1);
                 $total1 = $row1[0];

                 $result2 = mysqli_query($connection, "SELECT COUNT(1) FROM `info` WHERE sports='Badminton'");
                 $row2 = mysqli_fetch_array($result2);
                 $total2 = $row2[0];

                 $result3 = mysqli_query($connection, "SELECT COUNT(1) FROM `info` WHERE sports='Table Tennis'");
                 $row3 = mysqli_fetch_array($result3);
                 $total3 = $row3[0];

                 $result4 = mysqli_query($connection, "SELECT COUNT(1) FROM `info` WHERE sports='Chess'");
                 $row4 = mysqli_fetch_array($result4);
                 $total4 = $row4[0];

                 $result5 = mysqli_query($connection, "SELECT COUNT(*) FROM `info`");
                 $row5 = mysqli_fetch_array($result5);
                 $total5 = $row5[0];
                ?>

                                      <tr>
                                          <td>Basketball</td>
                                          <td><?php echo $total; ?></td>
                                      </tr>
                                      <tr>
                                          <td>Volleball</td>
                                          <td><?php echo $total1; ?></td>
                                      </tr>
                                      <tr>
                                          <td>Badminton</td>
                                          <td><?php echo $total2; ?></td>
                                      </tr>
                                      <tr>
                                          <td>Table Tennis</td>
                                          <td><?php echo $total3; ?></td>
                                      </tr>
                                      <tr>
                                          <td>Chess</td>
                                          <td><?php echo $total4; ?></td>
                                      </tr>
                                      <tr>
                                          <td><strong>Total Registered</strong></td>
                                          <td><strong><?php echo $total5; ?></strong></td>
                                      </tr>

                                  </tbody>
                              </table>
                          </div>
                      </div>
                      <!--  END of table inventory-->



 <div class="row">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->


                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
									<form class="" action="registered.php" method="post">

                                      
											</form>
                                    </div>
                                 <div class="table-data__tool-right">
                                    <button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#myModal" >
                                        <i class="zmdi zmdi-plus"></i>Add</button>
                                    </div>
                                </div>
								                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                                                                <thead>
                                            <tr>

                                                <th>Regis#</th>
                                                <th>Name</th>
                                                <th>Gender</th>
                                                <th>Age</th>
												<th>Sports</th>
                                                <th>Barangay</th>
                                                <th>Date Registered</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                           <?php

                                         include 'connection/db_connection.php';
                                         $result = mysqli_query($connection, "SELECT * FROM `info`");
                                         while($row = mysqli_fetch_array($result)){

                                        ?>
                                            <tr class="tr-shadow">


                                                <td><?php echo $row['registration_no'];?></td>
                                                <td><?php echo $row['last_name'];?>,&nbsp;<?php echo $row['first_name'];?>&nbsp;<?php echo $row['mid_name'];?></td>
                                                <td><?php echo $row['gender'];?></td>
                                                <td> <?php echo $row['age'];?> </td>
												<td> <?php echo $row['sports'];?> </td>
												<td> <?php echo $row['barangay'];?> </td>
												<td> <?php echo $row['date_register'];?> </td>

                                            </tr>
                                            <?php };?>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>

						</div>


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
