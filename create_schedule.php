<?php
// create_schedule.php
include 'db.php';

if (isset($_POST['submit'])) {
    $class_id = $_POST['class_id'];
    $teacher_id = $_POST['teacher_id'];
    $subject_id = $_POST['subject_id'];
    $day = $_POST['day'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Check for schedule conflict: no same class, teacher, subject, and day with overlapping periods
    $query = "
        SELECT * FROM schedule
        WHERE class_id = '$class_id' AND day = '$day' 
        AND ((start_time < '$end_time' AND end_time > '$start_time') OR start_time = '$start_time' OR end_time = '$end_time')
    ";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // There is a schedule conflict
        echo "<script>alert('Schedule conflict: The selected time overlaps with an existing schedule for this class.'); window.history.back();</script>";
        exit;
    } else {
        // No conflict, insert the new schedule
        $conn->query("INSERT INTO schedule (class_id, teacher_id, subject_id, day, start_time, end_time)
                      VALUES ('$class_id', '$teacher_id', '$subject_id', '$day', '$start_time', '$end_time')");

        // Redirect to index.php after successful insertion
        header("Location: view_schedule.php");
        exit;
    }
}

// Fetch classes, teachers, and subjects from the database
$classes = $conn->query("SELECT * FROM classes");
$teachers = $conn->query("SELECT * FROM teachers");
$subjects = $conn->query("SELECT * FROM subjects");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Schedule</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f0f4f8;
        }
        .card {
            max-width: 600px;
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
            <h1 class="text-center mb-4">Create Schedule</h1>
            <form method="POST">
                <div class="mb-3">
                    <label for="class_id" class="form-label">Select Class</label>
                    <select name="class_id" id="class_id" class="form-select" required>
                        <?php while ($row = $classes->fetch_assoc()): ?>
                            <option value="<?= $row['id'] ?>"><?= $row['class_name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="teacher_id" class="form-label">Select Teacher</label>
                    <select name="teacher_id" id="teacher_id" class="form-select" required>
                        <?php while ($row = $teachers->fetch_assoc()): ?>
                            <option value="<?= $row['id'] ?>"><?= $row['teacher_name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="subject_id" class="form-label">Select Subject</label>
                    <select name="subject_id" id="subject_id" class="form-select" required>
                        <?php while ($row = $subjects->fetch_assoc()): ?>
                            <option value="<?= $row['id'] ?>"><?= $row['subject_name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="day" class="form-label">Day</label>
                    <input type="text" name="day" id="day" class="form-control" placeholder="Enter Day (e.g., Monday)" required>
                </div>

                <div class="mb-3">
                    <label for="start_time" class="form-label">Start Time</label>
                    <input type="time" name="start_time" id="start_time" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="end_time" class="form-label">End Time</label>
                    <input type="time" name="end_time" id="end_time" class="form-control" required>
                </div>

                <button type="submit" name="submit" class="btn btn-primary w-100">Create Schedule</button>
            </form>
            <a href="view_schedule.php" class="btn btn-secondary mt-3 w-100">View Schedule</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
