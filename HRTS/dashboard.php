<?php
include 'includes/config.php';
include 'includes/header.php';

// Redirect to login if user is not authenticated
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

try {
    // Fetch rooms from the database
    $stmt = $pdo->query("SELECT * FROM rooms");
    $rooms = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error fetching rooms: " . $e->getMessage();
}
?>

<h2>Available Rooms</h2>
<div class="room-list">
    <?php foreach($rooms as $room): ?>
        <div class="card">
            <!-- Display room image if exists -->
            <?php if($room['image']): ?>
                <img src="<?php echo $room['image']; ?>" alt="<?php echo $room['name']; ?>">
            <?php endif; ?>
            <h3><?php echo $room['name']; ?> (<?php echo ucfirst($room['category']); ?>)</h3>
            <p><?php echo $room['description']; ?></p>
            <p>Price per night: Ksh <?php echo number_format($room['price'],2); ?></p>
            <!-- Button to view detailed room info and proceed to booking -->
            <a href="room_detail.php?id=<?php echo $room['id']; ?>" class="button">View Details</a>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'includes/footer.php'; ?>
