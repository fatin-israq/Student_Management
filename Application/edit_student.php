<?php
// Database connection
include 'config.php';

// Initialize variables
$name = $age = $grade = "";
$name_err = $age_err = $grade_err = "";

// Get student ID from URL
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Fetch existing student data
if ($id) {
    $sql = "SELECT * FROM students WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = $id;
        if ($stmt->execute()) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) == 1) {
                $row = $result->fetch_assoc();
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
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter a name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate age
    if (empty(trim($_POST["age"]))) {
        $age_err = "Please enter an age.";
    } elseif (!ctype_digit($_POST["age"])) {
        $age_err = "Please enter a valid age.";
    } else {
        $age = trim($_POST["age"]);
    }

    // Validate grade
    if (empty(trim($_POST["grade"]))) {
        $grade_err = "Please enter a grade.";
    } else {
        $grade = trim($_POST["grade"]);
    }

    // Check for errors before updating in database
    if (empty($name_err) && empty($age_err) && empty($grade_err)) {
        // Prepare an update statement
        $sql = "UPDATE students SET name = ?, age = ?, grade = ? WHERE id = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sisi", $param_name, $param_age, $param_grade, $param_id);

            // Set parameters
            $param_name = $name;
            $param_age = $age;
            $param_grade = $grade;
            $param_id = $id;

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
    }

    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <link rel="stylesheet" href="./CSS/styles_add.css">
</head>

<body>
    <h2>Edit Student</h2>
    <p>Please edit the input values and submit to update the student record.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id; ?>" method="post">
        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required>
            <span class="help-block"><?php echo $name_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($age_err)) ? 'has-error' : ''; ?>">
            <label>Age</label>
            <input type="text" name="age" class="form-control" value="<?php echo $age; ?>" required>
            <span class="help-block"><?php echo $age_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($grade_err)) ? 'has-error' : ''; ?>">
            <label>Grade</label>
            <input type="text" name="grade" class="form-control" value="<?php echo $grade; ?>" required>
            <span class="help-block"><?php echo $grade_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn" value="Submit">
            <a href="index.php" class="btn delete">Cancel</a>
        </div>
    </form>
</body>

</html>