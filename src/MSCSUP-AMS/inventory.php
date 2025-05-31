<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="shortcut icon" href="images/biglogo.png">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<link rel="stylesheet" href="css/design.css">
    <!-- Title Page-->
    <title>Dashboard</title>


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
                
            <li class="active has-sub">
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
                <li>
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

            <!-- add stock -->

<div class="modal fade" id="addstock" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"
data-backdrop="static">
<div class="modal-dialog modal-sm" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="staticModalLabel">Add Stock</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
  <form action="inventory.php"method="POST" enctype="multipart/form-data">
<p>
  <div class="row form-group">
    <div class="col-3">
        <label>Stock</label>
    </div>
    <div class="col col-sm-9">
        <input type="number" name=stock class="form-control" min="0">
    </div>
</div>
<div class="row form-group">
  <div class="col-3">
      <label>Item</label>
  </div>
  <div class="col col-sm-9">
        <select name="item" id="item" class="form-control" required>
            <option value="">Please select</option>
            <option value="basketball">Basketball(Ball)</option>
            <option value="volleyBall">VolleyBall(Ball)</option>
            <option value="volleyball net">Volleyball Net</option>
            <option value="Chessboard">Chessboard</option>
            <option value="Table Tennis Ball">Table Tennis Ball</option>
            <option value="Badminton net">Badminton net</option>
            <option value="Table tennis net">Table tennis net</option>
        </select>
  </div>
</div>

</p>
</div>
<div class="modal-footer">
<button type="button" class="stock_button2" data-dismiss="modal">Cancel</button>
<button type="submit" class="stock_button1" name="add">Add</button>
</div>
</form>

<?php

include 'connection/db_connection.php';

if (isset($_POST['add'])) {

$stock = $_POST['stock'];
$item = $_POST['item'];


 $sql = "INSERT INTO inventory(stocks,item)
 VALUES('$stock','$item')";

$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));


 if (!$result){
   echo '<script>alert("Something Went Wrong");</script>';
 }
 else {
   echo '<script>alert("Added");</script>';
 }

}

else {

}

?>


</div>
</div>
</div>



<!-- end modal static -->

            <!-- MAIN CONTENT-->


            <div class="main-content">
              <div class="section__content section__content--p30">
                  <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="overview-wrap">
                                <h2 class="title-1">Dashboard</h2>
                                <button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#addstock" >
                                    <i class="zmdi zmdi-plus"></i>Add Item</button>

                            </div>
                        </div>
                    </div>
<br>

                  <!-- Table inventory-->
                  <section class="statistic statistic2">
<div class="row">
  <?php

include 'connection/db_connection.php';
$result = mysqli_query($connection, "SELECT SUM(stocks) FROM `inventory`");
$row = mysqli_fetch_array($result);
$total = $row[0];

$result1 = mysqli_query($connection, "SELECT SUM(quantity) FROM `borrow`");
$row1 = mysqli_fetch_array($result1);
$total1 = $row1[0];

$result2 = mysqli_query($connection, "SELECT SUM(quantity) FROM `returned_item`");
$row2 = mysqli_fetch_array($result2);
$total2 = $row2[0];

$result3 = mysqli_query($connection, "SELECT COUNT(registration_no) FROM `info`");
$row3 = mysqli_fetch_array($result3);
$total3 = $row3[0];


$total3 = $total-$total1;

?>
<div class="col-md-6 col-lg-3">
<div class="statistic__item statistic__item--green">
<h2 class="number"><?php echo $total; ?></h2>
<span class="desc">Total Equipment/Item</span>
<div class="icon">
<i class="zmdi zmdi-calendar-note"></i>
</div>
</div>
</div>
<div class="col-md-6 col-lg-3">
<div class="statistic__item statistic__item--orange">
<h2 class="number"><?php echo $total1; ?></h2>
<span class="desc">Total Borrowed</span>
<div class="icon">
<i class="zmdi zmdi-calendar-note"></i>
</div>
</div>
</div>
<div class="col-md-6 col-lg-3">
<div class="statistic__item statistic__item--blue">
<h2 class="number"><?php echo $total2; ?></h2>
<span class="desc">Total Returned Item</span>
<div class="icon">
<i class="zmdi zmdi-calendar-note"></i>
</div>
</div>
</div>
<div class="col-md-6 col-lg-3">
<div class="statistic__item statistic__item--red">
<h2 class="number"><?php echo $total3; ?></h2>
<span class="desc">Item Remainings</span>
<div class="icon">
<i class="zmdi zmdi-calendar-note"></i>
</div>
</div>
</div>
<div class="col-md-6 col-lg-3">
<div class="statistic__item statistic__item--orange">
<?php
                                    $sql = "SELECT * FROM info";
                                    if ($result = mysqli_query($connection, $sql)) {
                                        $rowcount = mysqli_num_rows($result);
                                        echo "<h2 class='number'>".$rowcount; "</h2>";
                                        echo "<br>";
                                        echo "<span class='desc'>Total Registered</span>";
                                    }
                                    ?>
<div class="icon">
<i class="zmdi zmdi-calendar-note"></i>
</div>
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