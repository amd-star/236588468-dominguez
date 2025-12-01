<?php
session_start(); include 'includes/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_SESSION['user_id']; $pet = $_POST['pet']; $srv = $_POST['service']; $ther = $_POST['therapist']; $date = $_POST['date']; $time = $_POST['time'];
    $conn->query("INSERT INTO appointments (user_id, pet_id, service_id, therapist_id, appointment_date, start_time) VALUES ('$uid','$pet','$srv','$ther','$date','$time')");
    header("Location: dashboard.php");
}
$pets = $conn->query("SELECT * FROM pets WHERE owner_id=".$_SESSION['user_id']);
$srvs = $conn->query("SELECT * FROM services");
$thers = $conn->query("SELECT * FROM users WHERE role='therapist'");
?>
<!DOCTYPE html>
<html>
<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="container mt-5" style="max-width:500px;">
    <h3>Book Appointment</h3>
    <form method="POST">
        <label>Pet:</label>
        <select name="pet" class="form-control mb-2"><?php while($r=$pets->fetch_assoc()) echo "<option value='".$r['pet_id']."'>".$r['pet_name']."</option>"; ?></select>
        <label>Service:</label>
        <select name="service" class="form-control mb-2"><?php while($r=$srvs->fetch_assoc()) echo "<option value='".$r['service_id']."'>".$r['service_name']." (₱".$r['price'].")</option>"; ?></select>
        <label>Groomer:</label>
        <select name="therapist" class="form-control mb-2"><?php while($r=$thers->fetch_assoc()) echo "<option value='".$r['user_id']."'>".$r['full_name']."</option>"; ?></select>
        <input type="date" name="date" class="form-control mb-2" required>
        <input type="time" name="time" class="form-control mb-2" required>
        <button class="btn btn-primary w-100">Book</button>
    </form>
</body>
</html>