<?php
// Include database connection file
$conn = new mysqli("localhost", "root", "", "voters_db");
if (!$conn) {
	die('Could not connect: ' . mysqli_error($conn));
}

// Get candidate ID from URL parameter
$candidate_id = $_GET["id"];

// Delete candidate from database
$sql = "DELETE FROM candidates WHERE `candidate ID` = $candidate_id";
if ($conn->query($sql) === TRUE) {
	echo "Candidate deleted successfully.";
} else {
	echo "Error deleting candidate: " . $conn->error;
}

// Close database connection
$conn->close();
?>
