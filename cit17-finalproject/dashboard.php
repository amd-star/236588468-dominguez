<?php
session_start();
include 'includes/db.php';

// Security Check: If not logged in, kick them out
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Dashboard - Pawlish</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['name']; ?>! 🐾</h1>
    <a href="services.php">Book New Appointment</a> | <a href="logout.php">Logout</a>
    
    <h3>Your Appointment History</h3>
    <table>
        <thead>
            <tr>
                <th>Service</th>
                <th>Groomer</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // SQL JOIN to get names instead of IDs
            $sql = "SELECT a.appointment_date, a.start_time, a.status, 
                           s.service_name, u.full_name AS groomer_name 
                    FROM appointments a 
                    JOIN services s ON a.service_id = s.service_id 
                    JOIN users u ON a.therapist_id = u.user_id 
                    WHERE a.user_id = '$user_id'
                    ORDER BY a.appointment_date DESC";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['service_name'] . "</td>";
                    echo "<td>" . $row['groomer_name'] . "</td>";
                    echo "<td>" . $row['appointment_date'] . "</td>";
                    echo "<td>" . $row['start_time'] . "</td>";
                    
                    // Color code the status
                    $statusColor = ($row['status'] == 'confirmed') ? 'green' : 'orange';
                    echo "<td style='color:$statusColor; font-weight:bold;'>" . strtoupper($row['status']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No appointments found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
