<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
session_unset();
session_destroy();

// Redirect to landing page (index.php)
header("Location: index.php");
exit();
?>
