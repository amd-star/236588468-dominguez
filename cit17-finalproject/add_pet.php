<?php
session_start();
include 'includes/db.php';
if (!isset($_SESSION['user_id'])) header("Location: login.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $owner_id = $_SESSION['user_id'];
    $name = $_POST['pet_name'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];

    $conn->query("INSERT INTO pets (owner_id, pet_name, breed, age) VALUES ('$owner_id', '$name', '$breed', '$age')");
    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html>
<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="container mt-5">
    <h2>Add a New Pet</h2>
    <form method="POST">
        <input type="text" name="pet_name" class="form-control mb-2" placeholder="Pet Name" required>
        <input type="text" name="breed" class="form-control mb-2" placeholder="Breed">
        <input type="number" name="age" class="form-control mb-2" placeholder="Age">
        <button type="submit" class="btn btn-success">Save Pet</button>
    </form>
</body>
</html>