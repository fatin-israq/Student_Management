<?php
// Database connection
include 'config.php';

// Get student ID from URL
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Fetch student data
if ($id) {
    $sql = "SELECT * FROM students WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = $id;
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $name = $row['name'];
                $age = $row['age'];
                $grade = $row['grade'];
            } else {
                echo "Student not found.";
                exit();
            }
        } else {
            echo "Something went wrong. Please try again later.";
            exit();
        }
        mysqli_stmt_close($stmt);
    }
} else {
    echo "Invalid student ID.";
    exit();
}

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Student Info</title>
    <link rel="stylesheet" href="./CSS/style_view.css">
</head>

<body>
    <div class="container">
        <h2>Student Information</h2>
        <div>
            <p><strong>Name:</strong> <?php echo $name; ?></p>
            <p><strong>Age:</strong> <?php echo $age; ?></p>
            <p><strong>Grade:</strong> <?php echo $grade; ?></p>
        </div>
        <a href="index.php" class="btn">Back to List</a>
    </div>
</body>

</html>