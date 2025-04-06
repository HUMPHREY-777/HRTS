<?php
include 'includes/config.php';
include 'includes/functions.php';
include 'includes/header.php';

// Check user authentication
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['room_id'])) {
    echo "No room selected.";
    exit;
}

$room_id = $_GET['room_id'];

try {
    // Fetch the selected room details
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

// Handle form submission for booking
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $taxi_category = $_POST['taxi_category'];
    $arrival_point = $_POST['arrival_point'];

    // Calculate number of nights
    $nights = (strtotime($check_out) - strtotime($check_in)) / (60 * 60 * 24);
    if ($nights <= 0) {
        $error = "Check-out date must be after check-in date.";
    } else {
        // Calculate room cost
        $room_cost = $nights * $room['price'];
        // Set taxi fares based on category (example fares)
        $taxi_fares = [
            'medium' => 1000,
            'large' => 1500,
            'luxury' => 2500
        ];
        $taxi_cost = $taxi_fares[$taxi_category];
        // Total price is sum of room and taxi cost
        $total_price = $room_cost + $taxi_cost;

        // Get simulated driver details
        $driver = getDriverDetails();
        
        try {
            // Insert booking into database
            $stmt = $pdo->prepare("INSERT INTO bookings (user_id, room_id, check_in, check_out, taxi_category, arrival_point, total_price, driver_details, car_number_plate, pickup_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $_SESSION['user_id'],
                $room_id,
                $check_in,
                $check_out,
                $taxi_category,
                $arrival_point,
                $total_price,
                $driver['name'],
                $driver['car_plate'],
                $driver['pickup_time']
            ]);
            // Redirect to confirmation page with booking id
            $booking_id = $pdo->lastInsertId();
            header("Location: booking_confirmation.php?id=" . $booking_id);
            exit;
        } catch (PDOException $e) {
            $error = "Booking failed: " . $e->getMessage();
        }
    }
}
?>

<h2>Booking for <?php echo $room['name']; ?></h2>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="post" action="booking.php?room_id=<?php echo $room_id; ?>">
    <label>Check-In Date:</label>
    <input type="date" name="check_in" required>
    
    <label>Check-Out Date:</label>
    <input type="date" name="check_out" required>
    
    <!-- For simplicity, assume booking form uses logged in user name/email -->
    
    <!-- Taxi transport options -->
    <label>Select Taxi Category:</label>
    <select name="taxi_category" required>
        <option value="medium">Medium Taxi (Ksh 1000)</option>
        <option value="large">Large Taxi (Ksh 1500)</option>
        <option value="luxury">Luxury Taxi (Ksh 2500)</option>
    </select>
    
    <label>Select Your Arrival Point in Mombasa:</label>
    <select name="arrival_point" required>
        <option value="Moi International Airport">Moi International Airport</option>
        <option value="Mombasa Bus Station">Mombasa Bus Station</option>
        <option value="Mombasa Railway Station">Mombasa Railway Station</option>
    </select>
    
    <!-- Simulated Pay button -->
    <button type="submit">Pay & Book</button>
</form>

<?php include 'includes/footer.php'; ?>
