<?php
session_start(); // Start session if not already started
require_once "../components/config.php";

// Check if room code parameter is set in URL
if (isset($_GET['room'])) {
    $room_code = $_GET['room'];

    // Query to fetch room details based on room code
    $stmt = $conn->prepare("SELECT r.ID, r.Name, c.Room_code FROM `rooms` r INNER JOIN `codetoroomid` c ON r.ID = c.Room_ID WHERE c.Room_code = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("s", $room_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $room_id = $row['ID'];
        $room_name = $row['Name'];
        $room_code = $row['Room_code'];
    } else {
        // Handle case where no room is found with the given room code
        echo "Room not found";
        exit;
    }

    $stmt->close();
} else {
    // Handle case where room code parameter is not set in URL
    echo "Room code parameter missing";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($room_name); ?></title>
    <link rel="stylesheet" href="../css/index.css">
    <!-- Add your additional stylesheets and scripts here -->
</head>
<body>
    <?php require_once "../components/preloader.php"; ?>
    <?php require_once "../components/header.php"; ?>

    <div class="container">
        <h1>Room Details</h1>
        <div>
            <p><strong>Room Name:</strong> <?php echo htmlspecialchars($room_name); ?></p>
            <p><strong>Room Code:</strong> <?php echo htmlspecialchars($room_code); ?></p>
            <!-- Add more details as needed -->
        </div>
    </div>

    <?php require_once "../components/footer.php"; ?>
    <!-- Add your additional scripts here -->
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
