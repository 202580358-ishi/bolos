<?php
session_start();

// need to log in first
if (!isset($_SESSION["user_id"])) {
    header("Location: signin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>El Nido Haven</title>
    
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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

<section id="standard-details" class="room-details-section">

    <div class="details">

        <h2>Cozy Garden Standard</h2>

        <h3>Room Information</h3>

        <div class="room-details">

            <div class="room-detail-item"><strong>Room Type:</strong> Cozy Garden Standard</div>
            <div class="room-detail-item"><strong>Maximum Capacity:</strong> 1-2 PAX</div>
            <div class="room-detail-item"><strong>Bed:</strong> Double bed</div>
            <div class="room-detail-item"><strong>Amenities:</strong> Air conditioning, pool access, flat-screen TV, and a comfortable stay.</div>
            <div class="room-detail-item"><strong>Price:</strong> ₱8,000 / night</div>

        </div>

        <p class="room-description">
            A simple and comfortable room with a cozy bed, relaxing interiors, and a peaceful beach and garden view.
        </p>

        <h3>Room Images</h3>

        <div class="room-images">
            <img src="images/room3.jpg" alt="Cozy Garden Standard" onclick="zoomImage(this)">
            <img src="images/cr2.jpg" alt="CR Image" onclick="zoomImage(this)">
            <img src="images/beachview.png" alt="Beach View Image" onclick="zoomImage(this)">
            <img src="images/poolgardenview.png" alt="Pool and Garden View Image" onclick="zoomImage(this)">
        </div>

        <h3>Booking Schedule</h3>

        <form action="book.php" method="POST">
            <input type="hidden" name="room_id" value="2">

            <div class="booking">

                <p>
                    <strong>Check-in:</strong>
                    <input type="date" name="check_in" required>
                </p>

                <p>
                    <strong>Check-out:</strong>
                    <input type="date" name="check_out" required>
                </p>

            </div>

            <br>

            <button type="submit" class="book-button">Book Now</button>
        </form>

        <br>

        <a href="home.php" class="back-button">Back to Rooms</a>

    </div>

</section>

<footer>
    <p>EL NIDO HAVEN</p>
    <p>Your tropical getaway!</p>
</footer>

<div id="image-popup" class="image-popup" onclick="closeImage()">
    <img id="zoomed-image" src="" alt="Zoomed Room Image">
</div>

<script>

function zoomImage(image) {
    document.getElementById("zoomed-image").src = image.src;
    document.getElementById("image-popup").style.display = "flex";
}

function closeImage() {
    document.getElementById("image-popup").style.display = "none";
}

</script>

</body>
</html>