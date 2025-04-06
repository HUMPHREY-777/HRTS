<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HRTS - Hotel & Transport Reservation System</title>
    <!-- System Favicon -->
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <!-- Link for our icons from BOXICONS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Link for all our system styles -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Defered link for js since the footer is in a different page -->
    <script src="js/main.js" defer></script>
</head>
<body>
    <!-- Navigation bar -->
    <nav>
        <div class="nav-container">
            <a href="index.php" class="logo"> <i class='bx bxs-hotel'> </i>HRTS</a> 
            <ul class="nav-links">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li><a href="dashboard.php">Rooms</a></li>
                    <li><a href="booking_history.php">Booking History</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Log In</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <!-- End of Navigation bar -->
    <main>
