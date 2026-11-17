
<?php
session_start();
require_once "config/database.php";

// already logged in, go to home
if (isset($_SESSION["user_id"])) {
    header("Location: home.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $action = $_POST["action"];

    // CREATE ACCOUNT
    if ($action == "register") {

        $full_name = trim($_POST["full_name"]);
        $contact_number = trim($_POST["contact_number"]);
        $email = trim($_POST["email"]);
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        if ($password != $confirm_password) {
            $message = "Passwords do not match!";
        } else {

            $check = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
            $check->bind_param("s", $email);
            $check->execute();
            $result = $check->get_result();

            if ($result->num_rows > 0) {
                $message = "Email already exists!";
            } else {

                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $conn->prepare(
                    "INSERT INTO users (full_name, contact_number, email, password)
                     VALUES (?, ?, ?, ?)"
                );

                $stmt->bind_param(
                    "ssss",
                    $full_name,
                    $contact_number,
                    $email,
                    $hashed_password
                );

                if ($stmt->execute()) {
                    $message = "Account created successfully! You can now sign in.";
                } else {
                    $message = "Something went wrong. Please try again.";
                }
            }
        }
    }

    // SIGN IN
    if ($action == "login") {

        $email = trim($_POST["email"]);
        $password = $_POST["password"];

        $stmt = $conn->prepare(
            "SELECT user_id, full_name, password, role
             FROM users WHERE email = ?"
        );

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {

            $user = $result->fetch_assoc();

            if (password_verify($password, $user["password"])) {

                session_regenerate_id(true);

                $_SESSION["user_id"] = $user["user_id"];
                $_SESSION["full_name"] = $user["full_name"];
                $_SESSION["role"] = $user["role"];

                header("Location: home.php");
                exit();

            } else {
                $message = "Incorrect email or password!";
            }

        } else {
            $message = "Incorrect email or password!";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sign In - El Nido Haven</title>
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
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="signin.php">Sign In</a>
        <a href="contact.php">Contact</a>
    </nav>
</header>

<section id="account">

<?php if ($message != "") { ?>
    <p style="text-align: center;">
        <?php echo htmlspecialchars($message); ?>
    </p>
<?php } ?>

    <div id="signin-section">

        <h1>⋆｡°✩ Sign In ✩°｡⋆</h1>

        <div class="account-box">

            <form action="signin.php" method="POST">
                <input type="hidden" name="action" value="login">

                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter your email" required>

                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>

                <button type="submit" class="submit-button">
                    Sign In
                </button>
            </form>

            <div class="account-switch">
                <p>Don't have an account yet?</p>

                <button type="button" class="switch-button" onclick="showCreateAccount()">
                    Create an Account
                </button>
            </div>

        </div>

    </div>

    <div id="create-account-section" style="display: none;">

        <h1>⋆｡°✩ Create an Account ✩°｡⋆</h1>

        <div class="account-box">

            <form action="signin.php" method="POST">
                <input type="hidden" name="action" value="register">

                <label>Full Name</label>
                <input type="text" name="full_name" placeholder="Enter your full name" required>

                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter your email" required>

                <label>Contact Number</label>
                <input type="tel" name="contact_number" placeholder="Enter your contact number" required>

                <label>Password</label>
                <input type="password" name="password" placeholder="Create a password" required>

                <label>Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="Confirm your password" required>

                <button type="submit" class="submit-button">
                    Create Account
                </button>
            </form>

            <div class="account-switch">
                <p>Already have an account?</p>

                <button type="button" class="switch-button" onclick="showSignIn()">
                    Sign In
                </button>
            </div>

        </div>

    </div>

</section>

<footer>
    <p>EL NIDO HAVEN</p>
    <p>Your tropical getaway!</p>
</footer>

<script>

function showCreateAccount() {
    document.getElementById("signin-section").style.display = "none";
    document.getElementById("create-account-section").style.display = "block";
}

function showSignIn() {
    document.getElementById("create-account-section").style.display = "none";
    document.getElementById("signin-section").style.display = "block";
}

</script>

</body>
</html>
