<?php
session_start();
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    
    $result = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$pass'");
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['name'] = $row['full_name'];
        
        if ($row['role'] == 'admin') header("Location: admin_dashboard.php");
        else header("Location: dashboard.php");
    } else {
        echo "<div class='alert alert-danger'>Invalid Login</div>";
    }
}
?>
<!DOCTYPE html>
<html>
<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="container mt-5">
    <h2>Login to Pawlish</h2>
    <form method="POST">
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
        <button type="submit" class="btn btn-success">Login</button>
    </form>
    <a href="register.php">Create Account</a>
</body>
</html>