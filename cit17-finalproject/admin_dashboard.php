<?php
session_start();
include 'includes/db.php';

// Security Check: Must be admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Handle Status Updates (Approve/Cancel)
if (isset($_POST['update_status'])) {
    $appt_id = $_POST['appointment_id'];
    $new_status = $_POST['status'];
    
    $conn->query("UPDATE appointments SET status='$new_status' WHERE appointment_id='$appt_id'");
    echo "<p style='color:green'>Appointment #$appt_id updated to $new_status.</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Pawlish</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        .btn-approve { background-color: #4CAF50; color: white; border: none; padding: 5px; cursor: pointer; }
        .btn-cancel { background-color: #f44336; color: white; border: none; padding: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Manager Dashboard 🐶</h1>
    <a href="logout.php">Logout</a>

    <h3>Manage All Bookings</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Service</th>
                <th>Groomer</th>
                <th>Date & Time</th>
                <th>Current Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Complex JOIN to see Customer Name, Groomer Name, and Service
            $sql = "SELECT a.appointment_id, a.appointment_date, a.start_time, a.status, 
                           s.service_name, 
                           u_cust.full_name AS customer_name,
                           u_ther.full_name AS groomer_name
                    FROM appointments a 
                    JOIN services s ON a.service_id = s.service_id 
                    JOIN users u_cust ON a.user_id = u_cust.user_id 
                    JOIN users u_ther ON a.therapist_id = u_ther.user_id 
                    ORDER BY a.appointment_date ASC";

            $result = $conn->query($sql);

            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['appointment_id'] . "</td>";
                echo "<td>" . $row['customer_name'] . "</td>";
                echo "<td>" . $row['service_name'] . "</td>";
                echo "<td>" . $row['groomer_name'] . "</td>";
                echo "<td>" . $row['appointment_date'] . " " . $row['start_time'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                
                // Action Buttons (Forms)
                echo "<td>
                        <form method='POST' style='display:inline;'>
                            <input type='hidden' name='appointment_id' value='".$row['appointment_id']."'>
                            <input type='hidden' name='status' value='confirmed'>
                            <button type='submit' name='update_status' class='btn-approve'>Approve</button>
                        </form>
                        <form method='POST' style='display:inline;'>
                            <input type='hidden' name='appointment_id' value='".$row['appointment_id']."'>
                            <input type='hidden' name='status' value='canceled'>
                            <button type='submit' name='update_status' class='btn-cancel'>Cancel</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
