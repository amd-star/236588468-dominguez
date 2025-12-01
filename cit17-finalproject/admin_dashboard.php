<?php
session_start();
include 'includes/db.php';
if ($_SESSION['role'] != 'admin') header("Location: login.php");

// Approve/Cancel Logic
if (isset($_GET['action']) && isset($_GET['id'])) {
    $status = $_GET['action']; // 'confirmed' or 'canceled'
    $id = $_GET['id'];
    $conn->query("UPDATE appointments SET status='$status' WHERE appointment_id='$id'");
    header("Location: admin_dashboard.php");
}
?>
<!DOCTYPE html>
<html>
<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="container mt-5">
    <h1>Admin Panel</h1>
    <a href="logout.php" class="btn btn-danger">Logout</a>
    
    <table class="table mt-3">
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Pet</th>
            <th>Service</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php
        $sql = "SELECT a.*, u.full_name, p.pet_name, s.service_name 
                FROM appointments a 
                JOIN users u ON a.user_id = u.user_id
                JOIN pets p ON a.pet_id = p.pet_id
                JOIN services s ON a.service_id = s.service_id";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['appointment_id']."</td>";
            echo "<td>".$row['full_name']."</td>";
            echo "<td>".$row['pet_name']."</td>";
            echo "<td>".$row['service_name']."</td>";
            echo "<td>".$row['status']."</td>";
            echo "<td>
                <a href='admin_dashboard.php?action=confirmed&id=".$row['appointment_id']."' class='btn btn-sm btn-success'>Approve</a>
                <a href='admin_dashboard.php?action=canceled&id=".$row['appointment_id']."' class='btn btn-sm btn-danger'>Cancel</a>
            </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>