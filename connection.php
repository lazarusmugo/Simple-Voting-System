<?php
$conn =  new mysqli("localhost", "root","", "voters_db");
if(! $conn )
{
 die('Could not connect: ' . mysqli_error($conn));
}else
echo '';
?>
