<?php
session_start(); // Start the session

require_once "config.php";

$sql = "UPDATE `chat_users` SET Status='Offline' WHERE User_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['id']);
$stmt->execute();
$stmt->close();

// Destroy the session
session_destroy();

// Redirect to the homepage or login page
header("Location: ../index.php");
exit;
?>
