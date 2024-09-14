<?php
// Database connection
include 'config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the list of student IDs
    $ids = isset($_POST['ids']) ? $_POST['ids'] : [];

    if (!empty($ids)) {
        // Prepare a delete statement
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $sql = "DELETE FROM students WHERE id IN ($placeholders)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, str_repeat('i', count($ids)), ...$ids);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to index page
                header("location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    } else {
        echo "No students selected for deletion.";
    }
}

// Close connection
mysqli_close($conn);
?>