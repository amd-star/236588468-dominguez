<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Pawlish - Our Services</title>
    <style>
        .service-container { display: flex; gap: 20px; flex-wrap: wrap; }
        .card { border: 1px solid #ddd; padding: 20px; width: 300px; border-radius: 8px; }
    </style>
</head>
<body>
    <h1>Our Grooming Services</h1>
    <div class="service-container">
        <?php
        $sql = "SELECT * FROM services";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="card">';
                echo '<h2>' . $row["service_name"] . '</h2>';
                echo '<p>' . $row["description"] . '</p>';
                echo '<p><strong>Duration:</strong> ' . $row["duration"] . ' mins</p>';
                echo '<p><strong>Price:</strong> ₱' . $row["price"] . '</p>';
                echo '<a href="booking.php?service_id=' . $row["service_id"] . '"><button>Book Now</button></a>';
                echo '</div>';
            }
        } else {
            echo "No services available.";
        }
        ?>
    </div>
</body>
</html>
