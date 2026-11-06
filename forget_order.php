<?php
session_start();

// Clear the order variables before destroying the session.
unset($_SESSION['dessert'], $_SESSION['drink'], $_SESSION['drinkSize']);
session_destroy();

// Back to a clean dining room.
header('Location: index.php');
exit;
?>