<?php
session_start();
include 'includes/db.php';
if (!isset($_SESSION['user_id'])) header("Location: login.php");
$user_id = $_SESSION['user_id'];

// Handle Mock Payment Logic
if (isset($_GET['pay_appt_id'])) {
    $appt_id = $_GET['pay_appt_id'];
    $amount = $_GET['amount'];
    $txn = "TXN" . rand(1000,9999);
    
    // Insert Payment
    $conn->query("INSERT INTO payments (appointment_id, amount, payment_method, payment_status, transaction_id) VALUES ('$appt_id', '$amount', 'credit_card', 'paid', '$txn')");
    // Update Appointment Status
    $conn->query("UPDATE appointments SET status='confirmed' WHERE appointment_id='$appt_id'");
    
    echo "<script>alert('Payment Successful!'); window.location.href='dashboard.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="container mt-5">
    <h1>Welcome, <?php echo $_SESSION['name']; ?></h1>
    <a href="booking.php" class="btn btn-primary">Book Appointment</a>
    <a href="add_pet.php" class="btn btn-info">Add Pet</a>
    <a href="logout.php" class="btn btn-danger float-end">Logout</a>

    <h3 class="mt-4">My Appointments</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pet</th>
                <th>Service</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // JOIN 4 Tables: Appointments, Services, Pets, Users(Therapist)
            $sql = "SELECT a.*, s.service_name, s.price, p.pet_name 
                    FROM appointments a 
                    JOIN services s ON a.service_id = s.service_id
                    JOIN pets p ON a.pet_id = p.pet_id
                    WHERE a.user_id = '$user_id'";
            $result = $conn->query($sql);

            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['pet_name'] . "</td>";
                echo "<td>" . $row['service_name'] . "</td>";
                echo "<td>" . $row['appointment_date'] . " @ " . $row['start_time'] . "</td>";
                echo "<td>" . strtoupper($row['status']) . "</td>";
                
                // Payment Button Logic
                echo "<td>";
                if ($row['status'] == 'pending') {
                    echo "<a href='dashboard.php?pay_appt_id=".$row['appointment_id']."&amount=".$row['price']."' class='btn btn-warning btn-sm'>Pay ₱".$row['price']."</a>";
                } else {
                    echo "<span class='badge bg-success'>Paid/Confirmed</span>";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>