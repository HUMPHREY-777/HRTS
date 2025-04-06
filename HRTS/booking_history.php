<?php
// booking_history.php - Display a history of user's bookings

include 'includes/config.php';
include 'includes/header.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

try {
    // Fetch all bookings for the logged-in user with room details, ordered by latest booking first
    $stmt = $pdo->prepare("SELECT b.*, r.name AS room_name FROM bookings b JOIN rooms r ON b.room_id = r.id WHERE b.user_id = ? ORDER BY b.booking_date DESC");
    $stmt->execute([$_SESSION['user_id']]);
    $bookings = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error fetching booking history: " . $e->getMessage();
}
?>

<h2>Booking History</h2>
<div class="booking-history">
    <?php if (!empty($bookings)): ?>
        <?php foreach ($bookings as $booking): ?>
            <div class="card">
                <!-- Display basic booking information -->
                <h3>Room: <?php echo htmlspecialchars($booking['room_name']); ?></h3>
                <p>Booking Date: <?php echo htmlspecialchars($booking['booking_date']); ?></p>
                <p>Check-In: <?php echo htmlspecialchars($booking['check_in']); ?></p>
                <p>Check-Out: <?php echo htmlspecialchars($booking['check_out']); ?></p>
                <p>Total Price: Ksh <?php echo number_format($booking['total_price'], 2); ?></p>
                <!-- Button linking to the booking confirmation page -->
                <a href="booking_confirmation.php?id=<?php echo $booking['id']; ?>" class="button">View Confirmation</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You have not made any bookings yet.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
