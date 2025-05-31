<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="images/biglogo.png">
    <title>Registration Prediction</title>

    <?php require 'header.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #chartContainer {
            width: 100%;
            min-height: 500px;
            padding: 20px;
        }

        #registrationChart {
            width: 100% !important;
            height: 100% !important;
        }
    </style>
</head>

<body class="animsition">

<div class="page-wrapper">
    <?php require 'nav_mobile.php'; ?>
    <?php require 'sidebar/user-sidebar.php'; ?>

    <div class="main-content" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <div class="section__content section__content--p30">

            <div class="container mt-5">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white">
                        <strong>📈 Registration Predictions</strong>
                    </div>
                    <div class="card-body">

                        <?php
                        // Run the Python script to generate predictions
                        shell_exec("C:\xampp\htdocs\MSCSUP-AMSpredict_registration.py");

                        $jsonFile = "predicted_registrations.json";
                        if (file_exists($jsonFile)) {
                            $json = file_get_contents($jsonFile);
                            $data = json_decode($json, true);
                            $dates = $data["dates"];
                            $predictions = $data["predictions"];
                        } else {
                            $dates = [];
                            $predictions = [];
                            echo "<p style='color:red;'>❌ Error: Prediction file not found. Please check Python script.</p>";
                        }
                        ?>

                        <?php if (!empty($dates) && !empty($predictions)) : ?>
                        <div id="chartContainer">
                            <canvas id="registrationChart"></canvas>
                        </div>

                        <script>
                            const canvas = document.getElementById('registrationChart');
                            const ctx = canvas.getContext('2d');

                            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                            gradient.addColorStop(0, 'rgba(75,192,192,0.4)');
                            gradient.addColorStop(1, 'rgba(255,255,255,0)');

                            new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: <?= json_encode($dates); ?>,
                                    datasets: [{
                                        label: 'Predicted Registrations',
                                        data: <?= json_encode($predictions); ?>,
                                        fill: true,
                                        backgroundColor: gradient,
                                        borderColor: '#4bc0c0',
                                        tension: 0.4,
                                        borderWidth: 3,
                                        pointBackgroundColor: '#4bc0c0',
                                        pointBorderColor: '#fff',
                                        pointHoverBackgroundColor: '#fff',
                                        pointHoverBorderColor: '#4bc0c0',
                                        pointRadius: 6
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    plugins: {
                                        legend: {
                                            display: true,
                                            labels: {
                                                color: '#333',
                                                font: {
                                                    size: 14,
                                                    family: "'Segoe UI', sans-serif"
                                                }
                                            }
                                        },
                                        title: {
                                            display: true,
                                            text: 'Predicted Registrations Over Time',
                                            color: '#111',
                                            font: {
                                                size: 20,
                                                family: "'Segoe UI', sans-serif",
                                                weight: 'bold'
                                            },
                                            padding: {
                                                top: 10,
                                                bottom: 30
                                            }
                                        },
                                        tooltip: {
                                            backgroundColor: '#f9f9f9',
                                            titleColor: '#000',
                                            bodyColor: '#000',
                                            borderColor: '#4bc0c0',
                                            borderWidth: 1,
                                            cornerRadius: 6
                                        }
                                    },
                                    scales: {
                                        x: {
                                            ticks: {
                                                color: '#444',
                                                font: {
                                                    family: "'Segoe UI', sans-serif"
                                                }
                                            },
                                            grid: {
                                                color: 'rgba(0, 0, 0, 0.05)'
                                            }
                                        },
                                        y: {
                                            ticks: {
                                                color: '#444',
                                                font: {
                                                    family: "'Segoe UI', sans-serif"
                                                }
                                            },
                                            grid: {
                                                color: 'rgba(0, 0, 0, 0.05)'
                                            }
                                        }
                                    }
                                }
                            });
                        </script>
                        <?php else : ?>
                            <p>No prediction data available.</p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="copyright text-center">
                <?php require 'footer.php'; ?>
            </div>
        </div>
    </div>

</div>

</body>
</html>
