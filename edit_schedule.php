<?php
// edit_schedule.php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch schedule details by id
    $sql = "SELECT * FROM schedule WHERE id = $id";
    $result = $conn->query($sql);
    $schedule = $result->fetch_assoc();
    
    if (isset($_POST['submit'])) {
        // Get updated values from the form
        $class_id = $_POST['class_id'];
        $teacher_id = $_POST['teacher_id'];
        $subject_id = $_POST['subject_id'];
        $day = $_POST['day'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        
        // Update schedule in the database
        $conn->query("UPDATE schedule 
                      SET class_id = '$class_id', teacher_id = '$teacher_id', subject_id = '$subject_id', day = '$day', start_time = '$start_time', end_time = '$end_time' 
                      WHERE id = $id");
        
        // Redirect back to view_schedule.php after updating
        header("Location: view_schedule.php");
        exit;
    }
}

// Fetch classes, teachers, and subjects for the form
$classes = $conn->query("SELECT * FROM classes");
$teachers = $conn->query("SELECT * FROM teachers");
$subjects = $conn->query("SELECT * FROM subjects");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Schedule</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container">
        <div class="card" style="max-width: 600px; margin-top: 50px;">
            <h1 class="text-center mb-4">Edit Schedule</h1>
            <form method="POST">
                <div class="mb-3">
                    <label for="class_id" class="form-label">Select Class</label>
                    <select name="class_id" id="class_id" class="form-select" required>
                        <?php while ($row = $classes->fetch_assoc()): ?>
                            <option value="<?= $row['id']; ?>" <?= $schedule['class_id'] == $row['id'] ? 'selected' : ''; ?>><?= $row['class_name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="teacher_id" class="form-label">Select Teacher</label>
                    <select name="teacher_id" id="teacher_id" class="form-select" required>
                        <?php while ($row = $teachers->fetch_assoc()): ?>
                            <option value="<?= $row['id']; ?>" <?= $schedule['teacher_id'] == $row['id'] ? 'selected' : ''; ?>><?= $row['teacher_name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="subject_id" class="form-label">Select Subject</label>
                    <select name="subject_id" id="subject_id" class="form-select" required>
                        <?php while ($row = $subjects->fetch_assoc()): ?>
                            <option value="<?= $row['id']; ?>" <?= $schedule['subject_id'] == $row['id'] ? 'selected' : ''; ?>><?= $row['subject_name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="day" class="form-label">Day</label>
                    <input type="text" name="day" id="day" class="form-control" value="<?= $schedule['day']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="start_time" class="form-label">Start Time</label>
                    <input type="time" name="start_time" id="start_time" class="form-control" value="<?= $schedule['start_time']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="end_time" class="form-label">End Time</label>
                    <input type="time" name="end_time" id="end_time" class="form-control" value="<?= $schedule['end_time']; ?>" required>
                </div>

                <button type="submit" name="submit" class="btn btn-primary w-100">Update Schedule</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
