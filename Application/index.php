<?php
// Database connection
include 'config.php';

// Handle Search
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Handle Pagination
$limit = 10; // Number of entries per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Handle Sorting
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'name';
$order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

// Fetch Students
$sql = "SELECT * FROM students WHERE name LIKE '%$search%' ORDER BY $sort $order LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);

// Fetch total number of students for pagination
$total_sql = "SELECT COUNT(*) FROM students WHERE name LIKE '%$search%'";
$total_result = mysqli_query($conn, $total_sql);
$total_students = mysqli_fetch_row($total_result)[0];
$total_pages = ceil($total_students / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Management</title>
    <link rel="stylesheet" href="./CSS/styles.css">
</head>

<body>
    <div class="hero">
        <h1>Student Management</h1>
    </div>
    <form method="GET" action="" class="search">
        <input type="text" name="search" placeholder="Search students" value="<?php echo $search; ?>">
        <button type="submit">Search</button>
    </form>
    <form method="POST" action="bulk_delete.php">
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox" id="select_all">Student ID</th>
                    <th>
                        <a href="?sort=name&order=<?php echo $order === 'ASC' ? 'DESC' : 'ASC'; ?>&search=<?php echo $search; ?>&page=<?php echo $page; ?>">
                            Name <?php echo $sort === 'name' ? ($order === 'ASC' ? '▲' : '▼') : ''; ?>
                        </a>
                    </th>
                    <th>
                        <a href="?sort=age&order=<?php echo $order === 'ASC' ? 'DESC' : 'ASC'; ?>&search=<?php echo $search; ?>&page=<?php echo $page; ?>">
                            Age <?php echo $sort === 'age' ? ($order === 'ASC' ? '▲' : '▼') : ''; ?>
                        </a>
                    </th>
                    <th>
                        <a href="?sort=grade&order=<?php echo $order === 'ASC' ? 'DESC' : 'ASC'; ?>&search=<?php echo $search; ?>&page=<?php echo $page; ?>">
                            Grade <?php echo $sort === 'grade' ? ($order === 'ASC' ? '▲' : '▼') : ''; ?>
                        </a>
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><input type="checkbox" name="ids[]" value="<?php echo $row['id']; ?>"><?php echo $row['id']; ?></td>
                        <td><a href="view_student.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></td>
                        <td><?php echo $row['age']; ?></td>
                        <td><?php echo $row['grade']; ?></td>
                        <td>
                            <a href="edit_student.php?id=<?php echo $row['id']; ?>" class="edit btn">Edit</a>
                            <a href="delete_student.php?id=<?php echo $row['id']; ?>" class="delete btn" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <button class="btn delete delete-all" type="submit" onclick="return confirm('Are you sure you want to delete selected students?')">Delete Selected</button>
    </form>
    <a href="add_student.php" class="btn">Add Student</a>
    <div class="pagination">
        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
            <a href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>&sort=<?php echo $sort; ?>&order=<?php echo $order; ?>" class="<?php if ($page == $i) echo 'active'; ?>"><?php echo $i; ?></a>
        <?php } ?>
    </div>
    <script>
        document.getElementById('select_all').onclick = function() {
            var checkboxes = document.getElementsByName('ids[]');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        }
    </script>
</body>

</html>