<?php
include 'includes/config.php';
include 'includes/header.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simple error catching and data validation
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if(empty($name) || empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        // Hash the password securely
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        try {
            // Insert user data into database
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $hashedPassword]);
            header("Location: login.php");
            exit;
        } catch (PDOException $e) {
            // Handle duplicate email or other errors
            $error = "Registration failed: " . $e->getMessage();
        }
    }
}
?>

<h2>Register</h2>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="post" action="register.php">
    <!-- Collect name, email, and password -->
    <input type="text" name="name" placeholder="Your Name" required>
    <input type="email" name="email" placeholder="Email Address" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Register</button>
</form>

<?php include 'includes/footer.php'; ?>
