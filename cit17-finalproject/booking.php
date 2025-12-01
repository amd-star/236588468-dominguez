<?php
session_start();
include 'includes/db.php';
if (!isset($_SESSION['user_id'])) header("Location: login.php");

$user_id = $_SESSION['user_id'];
$message = "";

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pet_id = $_POST['pet_id'];
    $service_id = $_POST['service_id'];
    $therapist_id = $_POST['therapist_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $end_time = date("H:i:s", strtotime($time) + 3600); // Dummy 1 hour duration

    $sql = "INSERT INTO appointments (user_id, pet_id, service_id, therapist_id, appointment_date, start_time, end_time) 
            VALUES ('$user_id', '$pet_id', '$service_id', '$therapist_id', '$date', '$time', '$end_time')";
    
    if ($conn->query($sql)) {
        header("Location: dashboard.php");
    } else {
        $message = "Error: " . $conn->error;
    }
}

// Fetch Data for Dropdowns
$pets = $conn->query("SELECT * FROM pets WHERE owner_id = '$user_id'");
$services = $conn->query("SELECT * FROM services");
$groomers = $conn->query("SELECT * FROM users WHERE role = 'therapist'");
?>

<!DOCTYPE html>
<html>
<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="container mt-5">
    <h2>Book an Appointment</h2>
    <?php if($message) echo "<div class='alert alert-danger'>$message</div>"; ?>
    
    <form method="POST">
        <label>Select Your Pet:</label>
        <select name="pet_id" class="form-control mb-3" required>
            <?php while($row = $pets->fetch_assoc()) { echo "<option value='".$row['pet_id']."'>".$row['pet_name']."</option>"; } ?>
        </select>

        <label>Select Service:</label>
        <select name="service_id" class="form-control mb-3">
            <?php while($row = $services->fetch_assoc()) { echo "<option value='".$row['service_id']."'>".$row['service_name']." (₱".$row['price'].")</option>"; } ?>
        </select>

        <label>Select Groomer:</label>
        <select name="therapist_id" class="form-control mb-3">
            <?php while($row = $groomers->fetch_assoc()) { echo "<option value='".$row['user_id']."'>".$row['full_name']."</option>"; } ?>
        </select>

        <label>Date:</label>
        <input type="date" name="date" class="form-control mb-3" required>
        <label>Time:</label>
        <input type="time" name="time" class="form-control mb-3" required>

        <button type="submit" class="btn btn-primary">Confirm Booking</button>
        <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
    </form>
</body>
</html>