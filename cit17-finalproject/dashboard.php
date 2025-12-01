<?php
session_start(); include 'includes/db.php';
$uid = $_SESSION['user_id'];
if (isset($_GET['pay'])) {
    $conn->query("INSERT INTO payments (appointment_id, amount, payment_status, transaction_id) VALUES ('".$_GET['pay']."', '".$_GET['amt']."', 'paid', 'TXN".rand()."')");
    $conn->query("UPDATE appointments SET status='confirmed' WHERE appointment_id='".$_GET['pay']."'");
    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html>
<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="container mt-5">
    <h2>My Dashboard <a href="logout.php" class="btn btn-danger float-end">Logout</a></h2>
    <div class="mb-3">
        <a href="booking.php" class="btn btn-primary">Book New</a>
        <a href="add_pet.php" class="btn btn-secondary">Add Pet</a>
    </div>
    <table class="table table-bordered">
        <tr><th>Pet</th><th>Service</th><th>Date</th><th>Status</th><th>Action</th></tr>
        <?php
        $sql = "SELECT a.*, p.pet_name, s.service_name, s.price FROM appointments a JOIN pets p ON a.pet_id=p.pet_id JOIN services s ON a.service_id=s.service_id WHERE a.user_id='$uid'";
        $res = $conn->query($sql);
        while($r = $res->fetch_assoc()) {
            echo "<tr><td>".$r['pet_name']."</td><td>".$r['service_name']."</td><td>".$r['appointment_date']."</td><td>".$r['status']."</td>";
            echo "<td>".($r['status']=='pending' ? "<a href='dashboard.php?pay=".$r['appointment_id']."&amt=".$r['price']."' class='btn btn-warning btn-sm'>Pay ₱".$r['price']."</a>" : "Paid")."</td></tr>";
        }
        ?>
    </table>
</body>
</html>