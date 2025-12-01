<?php
session_start(); include 'includes/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email']; $pass = $_POST['password'];
    $res = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$pass'");
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id']; $_SESSION['role'] = $row['role']; $_SESSION['name'] = $row['full_name'];
        header("Location: " . ($row['role'] == 'admin' ? "admin_dashboard.php" : "dashboard.php"));
    } else echo "Invalid login";
}
?>
<!DOCTYPE html>
<html>
<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="container mt-5" style="max-width:400px;">
    <h3>Login</h3>
    <form method="POST">
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
        <button class="btn btn-success w-100">Login</button>
    </form>
</body>
</html>