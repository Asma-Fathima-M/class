<?php
// add_class.php
include 'db.php';

if (isset($_POST['submit'])) {
    $class_name = $_POST['class_name'];

    // Check if the class name already exists in the database
    $result = $conn->query("SELECT * FROM classes WHERE class_name = '$class_name'");

    // If the class name exists, show an error message and prevent insertion
    if ($result->num_rows > 0) {
        $error_message = "Class name already exists. Please choose a different name.";
    } else {
        // Insert the class name if it doesn't exist
        $conn->query("INSERT INTO classes (class_name) VALUES ('$class_name')");
        header("Location: index.php"); // Redirect to the homepage
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Class</title>
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
        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <h1 class="text-center mb-4">Add Class</h1>
            
            <!-- Show error message if class name already exists -->
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger">
                    <?= $error_message ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label for="class_name" class="form-label">Class Name</label>
                    <input type="text" name="class_name" id="class_name" class="form-control" placeholder="Enter Class Name" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary w-100">Add Class</button>
            </form>
            <a href="index.php" class="btn btn-secondary mt-3 w-100">Back to Home</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
