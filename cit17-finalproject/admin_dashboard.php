<?php
session_start(); include 'includes/db.php';
if ($_SESSION['role'] != 'admin') header("Location: login.php");
if (isset($_GET['approve'])) $conn->query("UPDATE appointments SET status='confirmed' WHERE appointment_id='".$_GET['approve']."'");
?>
<!DOCTYPE html>
<html>
<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="container mt-5">
    <h2>Admin Manager <a href="logout.php" class="btn btn-danger float-end">Logout</a></h2>
    <table class="table table-bordered mt-3">
        <tr><th>ID</th><th>User</th><th>Pet</th><th>Service</th><th>Status</th><th>Action</th></tr>
        <?php
        $sql = "SELECT a.*, u.full_name, p.pet_name, s.service_name FROM appointments a JOIN users u ON a.user_id=u.user_id JOIN pets p ON a.pet_id=p.pet_id JOIN services s ON a.service_id=s.service_id";
        $res = $conn->query($sql);
        while($r = $res->fetch_assoc()) {
            echo "<tr><td>".$r['appointment_id']."</td><td>".$r['full_name']."</td><td>".$r['pet_name']."</td><td>".$r['service_name']."</td><td>".$r['status']."</td>";
            echo "<td><a href='admin_dashboard.php?approve=".$r['appointment_id']."' class='btn btn-success btn-sm'>Approve</a></td></tr>";
        }
        ?>
    </table>
</body>
</html>