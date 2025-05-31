<?php
// Start PHP
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   
    <link rel="shortcut icon" href="images/biglogo.png">

    <!-- Title Page-->
    <title>Register</title>

    <?php require 'header.php'; ?>
</head>

<body class="animsition">

<div class="page-wrapper">
    <!-- HEADER MOBILE -->
    <?php require 'nav_mobile.php'; ?>
    <?php require 'sidebar/user-sidebar.php'; ?>
    <!-- END HEADER MOBILE -->

    <!-- PAGE CONTAINER-->
    <div class="main-content" style="font-family: Times New Roman;">
        <div class="section__content section__content--p30">

            <div class="container mt-5">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <strong>Feedback / Report Issue</strong>
                    </div>
                    <div class="card-body">
                        
                        <!-- Display success or error message -->
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['feedback_submit'])) {
                            include 'connection/db_connection.php'; // Database connection

                            // Secure form input
                            $type = mysqli_real_escape_string($connection, $_POST['type']);
                            $name = mysqli_real_escape_string($connection, $_POST['name']);
                            $email = mysqli_real_escape_string($connection, $_POST['email']);
                            $subject = mysqli_real_escape_string($connection, $_POST['subject']);
                            $message = mysqli_real_escape_string($connection, $_POST['message']);

                            // Prepare statement
                            $stmt = $connection->prepare("INSERT INTO feedback (type, name, email, subject, message, date_submitted) VALUES (?, ?, ?, ?, ?, NOW())");
                            $stmt->bind_param("sssss", $type, $name, $email, $subject, $message);

                            if ($stmt->execute()) {
                                echo "<div class='alert alert-success text-center'>Thank you for your feedback!</div>";
                            } else {
                                echo "<div class='alert alert-danger text-center'>Error: " . $stmt->error . "</div>";
                            }
                            $stmt->close();
                        }
                        ?>

                        <!-- Feedback Form -->
                        <form action="" method="POST">
                            <div class="form-group mb-3">
                                <label for="type">Type:</label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="Suggestion">Suggestion</option>
                                    <option value="Problem">Problem</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="name" class="form-control" required />
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" class="form-control" required />
                            </div>

                            <div class="form-group mb-3">
                                <label for="subject">Subject:</label>
                                <input type="text" name="subject" id="subject" class="form-control" required />
                            </div>

                            <div class="form-group mb-4">
                                <label for="message">Message:</label>
                                <textarea name="message" id="message" rows="5" class="form-control" required></textarea>
                            </div>

                            <button type="submit" name="feedback_submit" class="btn btn-primary btn-block">
                                Submit
                            </button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="copyright text-center">
                <?php require 'footer.php'; ?>
            </div>
        </div>
    </div>

</div>

<!-- Scripts -->
<script type="text/javascript">
// You can add JavaScript here if needed
</script>

</body>
</html>
