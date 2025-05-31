<?php
// Load clustering results JSON file
$inputFile = 'clustering_result.json';

if (!file_exists($inputFile)) {
    die("Error: File 'clustering_results.json' not found.");
}

$data = json_decode(file_get_contents($inputFile), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error: Invalid JSON data in 'clustering_results.json'.");
}

$clusters = $data['clusters'] ?? [];
$interest = $data['interest'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/biglogo.png">
    <title>Clustering and Interest Analysis</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php require 'header.php'; ?>
</head>
<body class="animsition">
<div class="page-wrapper">
    <?php require 'nav_mobile.php'; ?>
    <?php require 'sidebar/user-sidebar.php'; ?>
    <div class="main-content" style="font-family: Times New Roman;">
        <div class="section__content section__content--p30">
            <div class="container mt-5">
                <div class="card shadow-lg mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>Clustering Results</strong>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($clusters)) : ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Gender</th>
                                            <th>Age</th>
                                            <th>Barangay</th>
                                            <th>Sports</th>
                                            <th>Cluster</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($clusters as $entry) : ?>
                                            <tr>
                                                <td><?= htmlspecialchars($entry['gender']) ?></td>
                                                <td><?= htmlspecialchars($entry['age']) ?></td>
                                                <td><?= htmlspecialchars($entry['barangay']) ?></td>
                                                <td><?= htmlspecialchars($entry['sports']) ?></td>
                                                <td><?= htmlspecialchars($entry['cluster']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <h5 class="text-center mb-3">Clustering Results Chart</h5>
                            <canvas id="clusteringChart" height="100"></canvas> <!-- New clustering chart -->
                            <script>
                                const clusteringData = <?= json_encode($clusters); ?>;
                                const ageLabels = [...new Set(clusteringData.map(item => item.age))];
                                const barangayLabels = [...new Set(clusteringData.map(item => item.barangay))];
                                const sportsLabels = [...new Set(clusteringData.map(item => item.sports))];

                                const ageCounts = ageLabels.map(age => Math.floor(clusteringData.filter(item => item.age === age).length));
                                const barangayCounts = barangayLabels.map(barangay => Math.floor(clusteringData.filter(item => item.barangay === barangay).length));
                                const sportsCounts = sportsLabels.map(sports => Math.floor(clusteringData.filter(item => item.sports === sports).length));

                                const ctxClustering = document.getElementById('clusteringChart').getContext('2d');
                                new Chart(ctxClustering, {
                                    type: 'bar',
                                    data: {
                                        labels: ageLabels, // You can change this to barangayLabels or sportsLabels as needed
                                        datasets: [{
                                            label: 'Number of Entries by Age',
                                            data: ageCounts,
                                            backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: {
                                                position: 'top',
                                            },
                                            tooltip: {
                                                callbacks: {
                                                    label: function(context) {
                                                        return `${context.label}: ${context.raw}`;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                });
                            </script>
                        <?php else : ?>
                            <div class="alert alert-warning">No clustering data available.</div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <strong>Interest Analysis</strong>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($interest)) : ?>
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Barangay</th>
                                            <th>Sports</th>
                                            <th>Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($interest as $entry) : ?>
                                            <tr>
                                                <td><?= htmlspecialchars($entry['barangay']) ?></td>
                                                <td><?= htmlspecialchars($entry['sports']) ?></td>
                                                <td><?= htmlspecialchars($entry['count']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <h5 class="text-center mb-3">Interest Chart</h5>
                            <canvas id="interestChart" height="50"></canvas> <!-- Adjusted height -->
                            <script>
                                const interestData = <?= json_encode($interest); ?>;
                                const labels = interestData.map(item => `${item.barangay} - ${item.sports}`);
                                const counts = interestData.map(item => item.count);

                                const ctx = document.getElementById('interestChart').getContext('2d');
                                new Chart(ctx, {
                                    type: 'doughnut',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Interest Count',
                                            data: counts,
                                            backgroundColor: [
                                                'rgba(255, 99, 132, 0.6)',
                                                'rgba(54, 162, 235, 0.6)',
                                                'rgba(255, 206, 86, 0.6)',
                                                'rgba(75, 192, 192, 0.6)',
                                                'rgba(153, 102, 255, 0.6)',
                                                'rgba(255, 159, 64, 0.6)',
                                                'rgba(201, 203, 207, 0.6)'
                                            ],
                                            borderColor: [
                                                'rgba(255, 99, 132, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 206, 86, 1)',
                                                'rgba(75, 192, 192, 1)',
                                                'rgba(153, 102, 255, 1)',
                                                'rgba(255, 159, 64, 1)',
                                                'rgba(201, 203, 207, 1)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: {
                                                position: 'top',
                                            },
                                            tooltip: {
                                                callbacks: {
                                                    label: function(context) {
                                                        return `${context.label}: ${context.raw}`;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                });
                            </script>
                        <?php else : ?>
                            <div class="alert alert-warning">No interest data available.</div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php require 'footer.php'; ?>
</body>
</html>
