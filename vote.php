<?php
include("connection.php"); 

// Check if the user is logged in
session_start();
if(!isset($_SESSION['ID'])){
    header("Location: login.php");
    exit();
}

// Check if the user has already voted
$voter_id = $_SESSION['ID'];
$sql_check_voted = "SELECT Voted FROM voters WHERE ID = '$voter_id'";
$result_check_voted = mysqli_query($conn, $sql_check_voted);
$row_check_voted = mysqli_fetch_assoc($result_check_voted);
if($row_check_voted['Voted'] == 1){
    echo "You had already voted! Your vote has not been counted";
      
    exit();
}

// Display the list of positions and candidates
$sql_positions = "SELECT * FROM positions";
$result_positions = mysqli_query($conn, $sql_positions);

if(mysqli_num_rows($result_positions) > 0) {
    echo "<form method='post'>";
    while($row_positions = mysqli_fetch_assoc($result_positions)){
        $position_id = $row_positions['Position ID'];
        $position_name = $row_positions['Name'];

        // Display the position name
        echo "<h3>$position_name</h3>";

        // Get the candidates for this position from the database
        $sql_candidates = "SELECT * FROM candidates WHERE 'position ID' = '$position_id'";
        $result_candidates = mysqli_query($conn, $sql_candidates);

        // Display a form to allow the user to vote for a candidate
        while($row_candidates = mysqli_fetch_assoc($result_candidates)){
            $candidate_id = $row_candidates['Candidate ID'];
            $candidate_name = $row_candidates['Name'];

            echo "<input type='radio' name='position-$position_id' value='$candidate_id'> $candidate_name<br>";
        }
    }
    echo "<input type='hidden' name='voter_id' value='$voter_id'>";
    echo "<input type='submit' name='submit_vote' value='Vote'>";
    echo "</form>";
}

// If the form is submitted, update the candidate's vote count and mark the user as having voted
if(isset($_POST['submit_vote'])){
    // Check if the user has already voted
    $voter_id = $_POST['voter_id'];
    $sql_check_voted = "SELECT Voted FROM voters WHERE ID = '$voter_id'";
    $result_check_voted = mysqli_query($conn, $sql_check_voted);
    $row_check_voted = mysqli_fetch_assoc($result_check_voted);
    if($row_check_voted['Voted'] == 1){
    echo "You have already voted!";
    } else {
    // Loop through the submitted form data to update the vote count for each candidate
    foreach($_POST as $key => $value){
    if(substr($key, 0, 9) == "position-"){
    $position_id = substr($key, 9);
    $candidate_id = $value;
             // Update the vote count for the candidate
             $sql_update_votes = "UPDATE candidates SET `number of votes` = `number of votes` + 1 WHERE `Candidate ID` = '$candidate_id'";
             mysqli_query($conn, $sql_update_votes);
         }
     }
 
     // Mark the user as having voted
     $sql_mark_voted = "UPDATE voters SET Voted = 1 WHERE ID = '$voter_id'";
     mysqli_query($conn, $sql_mark_voted);
 
     echo "Thank you for voting!";
 }
}
?>