<?php
include 'includes/config.php';
include 'includes/header.php';

// Check user authentication
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if booking id is provided
if (!isset($_GET['id'])) {
    echo "No booking specified.";
    exit;
}

$booking_id = $_GET['id'];

try {
    // Fetch booking details along with room info
    $stmt = $pdo->prepare("SELECT b.*, r.name AS room_name FROM bookings b JOIN rooms r ON b.room_id = r.id WHERE b.id = ? AND b.user_id = ?");
    $stmt->execute([$booking_id, $_SESSION['user_id']]);
    $booking = $stmt->fetch();
    
    if (!$booking) {
        echo "Booking not found.";
        exit;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<h2>Booking Confirmation</h2>
<div class="card">
    <h3>Room: <?php echo $booking['room_name']; ?></h3>
    <p>Check-In: <?php echo $booking['check_in']; ?></p>
    <p>Check-Out: <?php echo $booking['check_out']; ?></p>
    <p>Taxi Category: <?php echo ucfirst($booking['taxi_category']); ?></p>
    <p>Arrival Point: <?php echo $booking['arrival_point']; ?></p>
    <p>Total Price: Ksh <?php echo number_format($booking['total_price'],2); ?></p>
    <h4>Driver Details</h4>
    <p>Driver: <?php echo $booking['driver_details']; ?></p>
    <p>Car Number Plate: <?php echo $booking['car_number_plate']; ?></p>
    <p>Pickup Time: <?php echo $booking['pickup_time']; ?></p>
</div>
<?php include 'includes/footer.php'; ?>
