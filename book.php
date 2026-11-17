<?php
session_start();
require_once "config/database.php";

// need to log in first
if (!isset($_SESSION["user_id"])) {
    header("Location: signin.php");
    exit();
}

// only accept the form
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: home.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$room_id = $_POST["room_id"];
$check_in = $_POST["check_in"];
$check_out = $_POST["check_out"];

if ($check_out <= $check_in) {
    $message = "Check-out date must be after the check-in date.";
} else {

    // check if the room is already booked on those dates
    $check = $conn->prepare(
        "SELECT booking_id FROM bookings
         WHERE room_id = ? AND status != 'Cancelled'
         AND check_in < ? AND check_out > ?"
    );
    $check->bind_param("iss", $room_id, $check_out, $check_in);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $message = "Sorry, this room is already booked on those dates.";
    } else {

        // save the booking
        $stmt = $conn->prepare(
            "INSERT INTO bookings (user_id, room_id, check_in, check_out)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("iiss", $user_id, $room_id, $check_in, $check_out);

        if ($stmt->execute()) {
            $message = "Booking saved! Check-in: " . $check_in . ", Check-out: " . $check_out . ". Status: Pending";
        } else {
            $message = "Something went wrong. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking - El Nido Haven</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <div class="logo-container">
        <img class="logo" src="images/logo.png" alt="El Nido Haven Logo">
        <div class="name">EL NIDO HAVEN ❀</div>
    </div>

    <nav>
        <a href="home.php">Home</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<section class="room-details-section">
    <div class="details">
        <h2>Booking</h2>
        <p><?php echo htmlspecialchars($message); ?></p>
        <br>
        <a href="home.php" class="back-button">Back to Rooms</a>
    </div>
</section>

<footer>
    <p>EL NIDO HAVEN</p>
    <p>Your tropical getaway!</p>
</footer>

</body>
</html>
