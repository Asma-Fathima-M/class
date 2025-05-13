<?php
// add_teacher.php
include 'db.php';

if (isset($_POST['submit'])) {
    $teacher_name = $_POST['teacher_name'];
    $conn->query("INSERT INTO teachers (teacher_name) VALUES ('$teacher_name')");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Teacher</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f0f4f8;
        }
        .card {
            max-width: 500px;
            margin: 100px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-weight: 700;
            color: #343a40;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <h1 class="text-center mb-4">Add Teacher</h1>
            <form method="POST">
                <div class="mb-3">
                    <label for="teacher_name" class="form-label">Teacher Name</label>
                    <input type="text" name="teacher_name" id="teacher_name" class="form-control" placeholder="Enter Teacher Name" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary w-100">Add Teacher</button>
            </form>
            <a href="index.php" class="btn btn-secondary mt-3 w-100">Back to Home</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
