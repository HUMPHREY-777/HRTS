<?php
session_start();
// Destroy session and redirect to landing page
session_destroy();
header("Location: index.php");
exit;
?>
