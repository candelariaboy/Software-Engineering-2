<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="shortcut icon" href="images/biglogo.png">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" href="css/design.css">
<style>
    .return_button1{
	
	color:  white;
	border:2px solid #FFF;
	background-color:red;
	padding:5px;
	border-radius:10%;
	
}

.return_button1:hover{
	background-color:red;
}
</style>
    <!-- Title Page-->
    <title>Item Request</title>


  <?php require 'header.php'; ?>

<body class="animsition">


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


                        <li>
                            <a href="registered.php">
                              <i class="fas fa-pencil-square-o"></i> Registered</a>
                        </li>
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-table"></i>Inventory</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                              <li class="active has-sub">
                                  <a href="item_request.php">Item Request</a>
                              </li>
                                <li>
                                    <a href="borrowed_item.php">Borrowed Item</a>
                                </li>
                                <li>
                                    <a href="returned_item.php">Returned Item</a>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="overview-wrap">
                                <h2 class="title-1">Borrow Archives</h2>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
	<div class="col-md-6 well">
                    <form class="form-inline" method="POST" action="">
			<label style="margin-left:10px;" >Date:</label>
			<input style="margin-left:10px;"  type="date"  class="form-control" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
			<label style="margin-left:10px;" >To</label>
			<input style="margin-left:10px;"  type="date" class="form-control" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>"/>
			<button style="margin-left:10px;" class="btn btn-primary" name="search">Search</button> <a style="margin-left:10px;"  href="archivesitemreq.php" type="button" class="btn btn-success">Refresh</a>
		</form>
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
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php
	
    include 'connection/db_connection.php';
    if(ISSET($_POST['search'])){
        $date1 = date("Y-m-d", strtotime($_POST['date1']));
        $date2 = date("Y-m-d", strtotime($_POST['date2']));
        $query=mysqli_query($connection, "SELECT * FROM `Item_request` WHERE  date(`date_return`)  BETWEEN '$date1' AND '$date2' ") or die(mysqli_error());
        $row=mysqli_num_rows($query);
        if($row>0){
            while($fetch=mysqli_fetch_array($query)){
?>
                                                                     <tr class="tr-shadow">

<form action="#" method="POST" enctype="multipart/form-data">

<input type="hidden" name="trans_id" value="<?php echo $fetch['trans_id'];?>">
<input type="hidden" name="fname" value="<?php echo $fetch['fname'];?>">
<input type="hidden" name="lname" value="<?php echo $fetch['lname'];?>">
<input type="hidden" name="barangay" value="<?php echo $fetch['barangay'];?>">
<input type="hidden" name="item" value="<?php echo $fetch['item'];?>">
<input type="hidden" name="quantity" value="<?php echo $fetch['quantity'];?>">
<input type="hidden" name="date_time_borrow" value="<?php echo $fetch['date_time_borrow'];?>">
<input type="hidden" name="date_return" value="<?php echo $fetch['date_return'];?>">

  <td><?php echo $fetch['trans_id'];?></td>
  <td><?php echo $fetch['fname'];?>&nbsp<?php echo $fetch['lname'];?> </td>
  <td><?php echo $fetch['barangay'];?></td>
  <td> <?php echo $fetch['item'];?>&nbsp<strong>(<?php echo $fetch['quantity'];?>)<strong> </td>
  <td> <?php echo $fetch['date_time_borrow'];?> </td>
  <td> <?php echo $fetch['date_return'];?> </td>

  <td>

      <a name="submit" href="undo-itemrequest.php?id=<?php echo $fetch['trans_id']; ?> "type="submit" class="return_button2" title="Approve">Undo</a>
      <a name="submit"href="deletereq.php?id=<?php echo $fetch['trans_id']; ?> " type="submit" class="return_button1" title="Approve">Delete</a>

  </td>
</tr>
</form>

                                                
<?php
            }
        }else{
            echo'
            <tr>
                <td colspan = "4"><center>Record Not Found</center></td>
            </tr>';
        }
    }else{
        $query=mysqli_query($connection, "SELECT * FROM `Item_request`  where status = 'Unreturned items'") or die(mysqli_error());
        while($fetch=mysqli_fetch_array($query)){
?>
                        <tr class="tr-shadow">

<form action="#" method="POST" enctype="multipart/form-data">

<input type="hidden" name="trans_id" value="<?php echo $fetch['trans_id'];?>">
<input type="hidden" name="fname" value="<?php echo $fetch['fname'];?>">
<input type="hidden" name="lname" value="<?php echo $fetch['lname'];?>">
<input type="hidden" name="barangay" value="<?php echo $fetch['barangay'];?>">
<input type="hidden" name="item" value="<?php echo $fetch['item'];?>">
<input type="hidden" name="quantity" value="<?php echo $fetch['quantity'];?>">
<input type="hidden" name="date_time_borrow" value="<?php echo $fetch['date_time_borrow'];?>">
<input type="hidden" name="date_return" value="<?php echo $fetch['date_return'];?>">

  <td><?php echo $fetch['trans_id'];?></td>
  <td><?php echo $fetch['fname'];?>&nbsp<?php echo $fetch['lname'];?> </td>
  <td><?php echo $fetch['barangay'];?></td>
  <td> <?php echo $fetch['item'];?>&nbsp<strong>(<?php echo $fetch['quantity'];?>)<strong> </td>
  <td> <?php echo $fetch['date_time_borrow'];?> </td>
  <td> <?php echo $fetch['date_return'];?> </td>

  <td>

      <a name="submit" href="undo-itemrequest.php?id=<?php echo $fetch['trans_id']; ?> "type="submit" class="return_button2" title="Approve">Undo</a>
      <a name="submit"href="deletereq.php?id=<?php echo $fetch['trans_id']; ?> " type="submit" class="return_button1" title="Approve">Delete</a>

  </td>
</tr>
</form>

<?php
        }
    }
?>

<?php

include 'connection/db_connection.php';

if (isset($_POST['submit'])) {

$trans_id=$_POST['trans_id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$barangay = $_POST['barangay'];
$item = $_POST['item'];
$quantity = $_POST['quantity'];
$date_return = $_POST['date_return'];

 $sql1 = "INSERT INTO borrow(trans_id,fname,lname,barangay,item,quantity,date_time_borrow,date_return)
 VALUES('$trans_id','$fname','$lname','$barangay','$item','$quantity',Now(),'$date_return')";

$res = mysqli_query($connection, $sql1) or die(mysqli_error($connection));

 if (!$res){
   echo '<script>alert("Something Went Wrong");</script>';
 }
 else {
   echo '<script>alert("Approved!");</script>';

   $res2 = mysqli_query($connection, "DELETE FROM `item_request` WHERE `trans_id` = '$trans_id'");
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
