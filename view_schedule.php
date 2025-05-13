<?php
// view_schedule.php
include 'db.php';

// Fetch the schedule from the database along with class, teacher, and subject information
$sql = "SELECT schedule.id, schedule.day, schedule.start_time, schedule.end_time, 
               classes.class_name, teachers.teacher_name, subjects.subject_name
        FROM schedule
        JOIN classes ON schedule.class_id = classes.id
        JOIN teachers ON schedule.teacher_id = teachers.id
        JOIN subjects ON schedule.subject_id = subjects.id
        ORDER BY schedule.day, schedule.start_time";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Schedule</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f0f4f8;
        }
        .card {
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
        }
        h1 {
            font-weight: 700;
            color: #343a40;
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .table th, .table td {
            text-align: center;
        }
        .btn {
            width: 100%;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <h1 class="text-center mb-4">View Schedule</h1>
            <?php if ($result->num_rows > 0): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Class</th>
                            <th>Subject</th>
                            <th>Teacher</th>
                            <th>Day</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $count++; ?></td>
                                <td><?= $row['class_name']; ?></td>
                                <td><?= $row['subject_name']; ?></td>
                                <td><?= $row['teacher_name']; ?></td>
                                <td><?= $row['day']; ?></td>
                                <td><?= $row['start_time']; ?></td>
                                <td><?= $row['end_time']; ?></td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="edit_schedule.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <!-- Delete Button -->
                                    <a href="delete_schedule.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this schedule?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center">No schedule found.</p>
            <?php endif; ?>
            <a href="index.php" class="btn btn-secondary">Back to Home</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
