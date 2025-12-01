<?php 
include 'includes/db.php'; 
session_start(); // meaningful if you have a login system

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // In a real app, get user_id from Session. Here we hardcode '3' (Customer Cathy) for testing.
    $user_id = 3; 
    $service_id = $_POST['service_id'];
    $therapist_id = $_POST['therapist_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    
    // Calculate end_time based on service duration (simplified logic for now)
    // For this example, we just add 1 hour to the start time
    $end_time = date("H:i:s", strtotime($time) + 3600);

    $sql = "INSERT INTO appointments (user_id, therapist_id, service_id, appointment_date, start_time, end_time, status)
            VALUES ('$user_id', '$therapist_id', '$service_id', '$date', '$time', '$end_time', 'pending')";

    if ($conn->query($sql) === TRUE) {
        echo "Booking successful! <a href='dashboard.php'>View Dashboard</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<form method="POST" action="booking.php">
    <label>Choose Service ID:</label>
    <input type="number" name="service_id" required> <br>
    
    <label>Choose Groomer (Therapist ID):</label>
    <input type="number" name="therapist_id" required> <br>
    
    <label>Date:</label>
    <input type="date" name="date" required> <br>
    
    <label>Time:</label>
    <input type="time" name="time" required> <br>
    
    <button type="submit">Confirm Booking</button>
</form>
