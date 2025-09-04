<?php include 'config.php'; ?>
<?php
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM tasks WHERE id=? AND user_id=?");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$task = $stmt->get_result()->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $stmt = $conn->prepare("UPDATE tasks SET title=? WHERE id=? AND user_id=?");
    $stmt->bind_param("sii", $title, $id, $user_id);
    $stmt->execute();
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Task</title></head>
<body>
<h2>Edit Task</h2>
<form method="POST">
    <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" required>
    <button type="submit">Update</button>
</form>
</body>
</html>
