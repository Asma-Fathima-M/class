<?php
// index.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Scheduling System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #dfe9f3, #ffffff);
            min-height: 100vh;
        }
        .card {
            max-width: 500px;
            margin: 100px auto;
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        h1 {
            font-weight: 700;
            color: #343a40;
        }
        .list-group-item {
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card p-4">
            <h1 class="text-center mb-4">Class Scheduling System</h1>
            <div class="list-group">
                <a href="add_class.php" class="list-group-item list-group-item-action">➕ Add Class</a>
                <a href="add_teacher.php" class="list-group-item list-group-item-action">➕ Add Teacher</a>
                <a href="add_subject.php" class="list-group-item list-group-item-action">➕ Add Subject</a>
                <a href="create_schedule.php" class="list-group-item list-group-item-action">📅 Create Schedule</a>
                <a href="view_schedule.php" class="list-group-item list-group-item-action">👀 View Schedule</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
