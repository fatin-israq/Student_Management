<?php
// Include the database connection file
include 'config.php';

// Check if the id parameter is set in the URL
if (isset($_GET['id'])) {
    // Get the student id from the URL
    $id = $_GET['id'];

    // Prepare the SQL delete statement
    $sql = "DELETE FROM students WHERE id = ?";

    // Prepare the statement using mysqli
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind the id parameter to the prepared statement
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set the parameter
        $param_id = $id;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to index page after successful deletion
            header("location: index.php");
            exit();
        } else {
            echo "Something went wrong. Please try again later.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    }
}

// Close the connection
mysqli_close($conn);
?>