<?php
include 'includes/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password']; // In real life, use password_hash()
    
    $sql = "INSERT INTO users (full_name, email, password, role) VALUES ('$name', '$email', '$pass', 'customer')";
    if ($conn->query($sql)) { header("Location: login.php"); } 
    else { echo "Error: " . $conn->error; }
}
?>
<!DOCTYPE html>
<html>
<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="container mt-5">
    <h2>Register</h2>
    <form method="POST">
        <input type="text" name="name" class="form-control mb-2" placeholder="Full Name" required>
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
        <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
    <a href="login.php">Already have an account? Login</a>
</body>
</html>