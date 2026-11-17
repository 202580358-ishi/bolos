
<?php
session_start();

// Clear all sess info
session_unset();

// End the session
session_destroy();

// Return sa the sign in page
header("Location: signin.php");
exit();
?>
