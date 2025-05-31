
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="shortcut icon" href="images/biglogo.png">


    <!-- Title Page-->
    <title>User Login</title>
    

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">

    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">

                        <div class="login-logo">
                            <a href="#">
                                <img src="images/biglogo.png" alt="Admin" class="admin">
                            </a>
                        </div>
                        <div class="login-form">
                        <?php
    include_once 'connection/db_connection.php';
    $msg = "";
    if (isset($_POST['login'])) {
      $email = mysqli_real_escape_string($connection, $_POST['user_log']);
      $password = mysqli_real_escape_string($connection, $_POST['pass']);
      $sql = mysqli_query($connection, "select * from users where user_log='$email' && pass='" . md5($password) . "'");
      $user_log = $_POST['user_log'];

      $num = mysqli_num_rows($sql);
      if ($num > 0) {
        //echo "found";  
        $row = mysqli_fetch_assoc($sql);
        $_SESSION['user_log'] = $user_log;

        if ($row['role'] == "admin") {

          $sqlget51 = "SELECT * FROM users where user_log = '$user_log'";
          $sqldata51 = mysqli_query($connection, $sqlget51) or die('Error Displaying Data' . mysqli_connect_error());
          while ($row51 = mysqli_fetch_assoc($sqldata51)) {

            $_SESSION['users_id'] = $row51['users_id'];
          }


          echo
          "<script>
          alert('Successfully Login!!');
          document.location.href = 'inVENTORY.php';
          </script>
          ";
        } else if ($row['role'] == "barangay") {

          $sqlget51 = "SELECT * FROM users where user_log = '$user_log'";
          $sqldata51 = mysqli_query($connection, $sqlget51) or die('Error Displaying Data' . mysqli_connect_error());
          while ($row51 = mysqli_fetch_assoc($sqldata51)) {

            $_SESSION['users_id'] = $row51['users_id'];
          }

          echo
          "<script>
          alert('Successfully Login!!');
          document.location.href = 'INDEX2.php';
          </script>
          ";
        }
      } else {
        echo
        "<script>
        alert('Invalid User_log or Password!!');
        document.location.href = 'login2.php';
        </script>
        ";
      }
    }
    ?>

                            <form  method="post">
                                <div class="form-group">
                                    <label>User Log</label>
                                    <input class="au-input au-input--full" type="text" name="user_log" placeholder="User Log" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full form control" type="password" name="pass" placeholder="Password" required>
                                </div>

                                <button class="au-btn au-btn--block au-btn--blue m-b-20" type="submit" id="login" name="login">Login</button>

                            </form>
                            <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="new_user.php" name="new_user">Sign Up Here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
