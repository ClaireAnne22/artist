<?php
include('./dbconnect.php');

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    try {
        // Prepare the DELETE statement
        $sql = "DELETE FROM artist WHERE artist_id = :delete_id";
        $stmt = $conn->prepare($sql);

        // Bind the parameter
        $stmt->bindValue(':delete_id', $delete_id, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            echo "<script>alert('Artist deleted successfully.'); window.location.href='view_artist.php';</script>";
        } else {
            echo "<script>alert('Error: Unable to delete the artist. Please try again.'); window.location.href='view_arist.php';</script>";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='view_artist.php';</script>";
}
?>