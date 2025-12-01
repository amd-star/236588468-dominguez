<?php
include 'includes/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name']; $email = $_POST['email']; $pass = $_POST['password'];
    $conn->query("INSERT INTO users (full_name, email, password) VALUES ('$name', '$email', '$pass')");
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="container mt-5" style="max-width:400px;">
    <h3>Register</h3>
    <form method="POST">
        <input type="text" name="name" class="form-control mb-2" placeholder="Full Name" required>
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
        <button class="btn btn-primary w-100">Sign Up</button>
    </form>
</body>
</html>