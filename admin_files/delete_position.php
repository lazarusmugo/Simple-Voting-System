<?php
// Include database connection file
$conn = new mysqli("localhost", "root", "", "voters_db");
if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

// Check if position ID is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete position from database
    $sql = "DELETE FROM positions WHERE `Position ID` = $id";
    $result = $conn->query($sql);

    if ($result) {
        // Redirect to manage positions page
        header("Location: manage_positions.php");
        exit();
    } else {
        echo "Error deleting position: " . mysqli_error($conn);
    }
} else {
    echo "Position ID not specified.";
}

// Close database connection
$conn->close();
?>
