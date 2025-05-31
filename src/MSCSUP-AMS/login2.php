<!DOCTYPE html>
<html lang="en">
<head>
<title>User Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="assets/login_assets/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login_assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login_assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login_assets/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login_assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/login_assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login_assets/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login_assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/login_assets/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login_assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/login_assets/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
    
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/biglogo.png');">
			<div class="wrap-login100" >
				<form method="post" class="login100-form validate-form">
					<span class="login100-form-logo d-flex justify-content-center align-items-center" style="background-image: url('images/biglogo.png'); background-size:cover; border:2px solid black;">
						
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>

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
                                document.location.href = 'announcement1.php';
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


					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="user_log" placeholder="User Log" autocomplete="off" required>
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password" required>
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					

					<div class="container-login100-form-btn">
						<button class="login100-form-btn"  type="submit" id="login" name="login">
							Login
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="new_user.php">
							Don't Have an Account? 
                            Sign Up Here.
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="assets/login_assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/login_assets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/login_assets/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/login_assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/login_assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/login_assets/vendor/daterangepicker/moment.min.js"></script>
	<script src="assets/login_assets/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="assets/login_assets/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="assets/login_assets/js/main.js"></script>

</body>
</html>