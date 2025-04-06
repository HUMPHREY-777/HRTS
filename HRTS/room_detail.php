<?php
include 'includes/config.php';
include 'includes/header.php';

// Ensure the room id is provided
if (!isset($_GET['id'])) {
    echo "Room not specified.";
    exit;
}

$room_id = $_GET['id'];

try {
    // Fetch specific room details from the database
    $stmt = $pdo->prepare("SELECT * FROM rooms WHERE id = ?");
    $stmt->execute([$room_id]);
    $room = $stmt->fetch();

    if (!$room) {
        echo "Room not found.";
        exit;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<div class="card">
    <?php if($room['image']): ?>
        <img src="<?php echo $room['image']; ?>" alt="<?php echo $room['name']; ?>">
    <?php endif; ?>
    <h3><?php echo $room['name']; ?> (<?php echo ucfirst($room['category']); ?>)</h3>
    <p><?php echo $room['description']; ?></p>
    <p>Price per night: Ksh <?php echo number_format($room['price'],2); ?></p>
    <!-- Link to booking page passing the room id -->
    <a href="booking.php?room_id=<?php echo $room['id']; ?>" class="button">Book Now</a>
</div>

<?php include 'includes/footer.php'; ?>
