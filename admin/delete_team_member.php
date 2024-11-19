<?php
include('includes/connection.php');
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM team_members WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: index.php"); // Redirect back to the list
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>
