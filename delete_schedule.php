<?php
// delete_schedule.php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete the schedule by ID
    $conn->query("DELETE FROM schedule WHERE id = $id");
    
    // Redirect to the view_schedule.php after deletion
    header("Location: view_schedule.php");
    exit;
}
?>
