
<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: signin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Nido Haven</title>
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

<section id="home">
    <h1>⋆.˚𓇼 𖦹⋆ Welcome to <span>El Nido Haven! ⋆⋅ ଳ ‧₊˚ ⋅</span></h1>
</section>

<section id="rooms">
    <h2>Our Rooms</h2>

    <div class="room-container">

        <div class="room-card" onclick="window.location.href='deluxe.php'">
            <img src="images/IMG_6205.jpeg" alt="Tropical Garden Deluxe">

            <div class="room-info">
                <h3>Tropical Garden Deluxe</h3>
                <p>A cozy tropical room with a comfortable king-size bed, relaxing interiors, and a beautiful garden view.</p>
                <div class="price">₱12,000 / night</div>
                <a href="deluxe.php" class="book-button" onclick="event.stopPropagation()">Book Now</a>
            </div>
        </div>

        <div class="room-card" onclick="window.location.href='vip.php'">
            <img src="images/4paxrm.png" alt="VIP Beachfront Suite">

            <div class="room-info">
                <h3>VIP Beachfront Suite</h3>
                <p>A spacious and elegant suite with a king-size bed, private balcony, and beautiful beachfront view.</p>
                <div class="price">₱20,000 / night</div>
                <a href="vip.php" class="book-button" onclick="event.stopPropagation()">Book Now</a>
            </div>
        </div>

        <div class="room-card" onclick="window.location.href='standard.php'">
            <img src="images/room2.jpg" alt="Cozy Garden Standard">

            <div class="room-info">
                <h3>Cozy Garden Standard</h3>
                <p>A simple and comfortable room with a cozy bed, relaxing interiors, and a peaceful garden view.</p>
                <div class="price">₱8,000 / night</div>
                <a href="standard.php" class="book-button" onclick="event.stopPropagation()">Book Now</a>
            </div>
        </div>

    </div>
</section>

<footer>
    <strong>EL NIDO HAVEN</strong>
    <p>Your tropical getaway!</p>
</footer>

</body>
</html>
