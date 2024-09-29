<?php
session_start();

// Check if data is posted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rows'])) {
    // Store posted data in session
    $_SESSION['posted_data'] = $_POST['rows'];
}

// Retrieve data from session
$rows = isset($_SESSION['posted_data']) ? $_SESSION['posted_data'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Posted Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <?php if ($rows): ?>
            <h2>Posted Data:</h2>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>User ID</th>
                        <th>Selected Numbers</th>
                        <th>Powerballs</th>
                        <th>Main Numbers</th>
                        <th>Powerball Number</th>
                        <th>Generated At</th>
                        <th>To Received</th>
                        <th>Marked</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['selected_numbers']); ?></td>
                            <td><?php echo htmlspecialchars($row['powerballs']); ?></td>
                            <td><?php echo htmlspecialchars($row['main_numbers']); ?></td>
                            <td><?php echo htmlspecialchars($row['powerball_number']); ?></td>
                            <td><?php echo htmlspecialchars($row['generated_at']); ?></td>
                            <td><?php echo htmlspecialchars($row['to_received']); ?></td>
                            <td><?php echo $row['marked'] == 0 ? 'Marked' : 'Not Marked'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No data posted.</p>
        <?php endif; ?>
    </div>
</body>
</html>
