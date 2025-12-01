<?php
session_start(); include 'includes/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_SESSION['user_id']; $name = $_POST['name']; $breed = $_POST['breed']; $age = $_POST['age'];
    $conn->query("INSERT INTO pets (owner_id, pet_name, breed, age) VALUES ('$uid', '$name', '$breed', '$age')");
    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html>
<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="container mt-5" style="max-width:400px;">
    <h3>Add a Pet</h3>
    <form method="POST">
        <input type="text" name="name" class="form-control mb-2" placeholder="Pet Name" required>
        <input type="text" name="breed" class="form-control mb-2" placeholder="Breed">
        <input type="number" name="age" class="form-control mb-2" placeholder="Age">
        <button class="btn btn-primary w-100">Save Pet</button>
    </form>
</body>
</html>