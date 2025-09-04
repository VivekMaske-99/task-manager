<?php include 'config.php'; ?>
<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM tasks WHERE user_id=$user_id ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Task Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body data-bs-theme="light">
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">My Task Manager</h2>
    <div class="d-flex gap-2">
      <button id="themeToggle" class="btn btn-outline-secondary btn-sm">🌙 Dark Mode</button>
      <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
  </div>

  <!-- Add Task -->
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <form action="add_task.php" method="POST" class="row g-3">
        <div class="col-md-10">
          <input type="text" name="title" class="form-control" placeholder="Enter new task..." required>
        </div>
        <div class="col-md-2 d-grid">
          <button type="submit" class="btn btn-primary">Add Task</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Task List -->
  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="card-title mb-3">Your Tasks</h5>
      <table class="table table-hover">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th>Task</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td>
              <span class="badge <?= $row['status']=='Done' ? 'bg-success' : 'bg-warning text-dark' ?>">
                <?= $row['status'] ?>
              </span>
            </td>
            <td>
              <?php if ($row['status'] !== 'Done'): ?>
                <a href="mark_done.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success">✔ Done</a>
              <?php endif; ?>
              <a href="edit_task.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-secondary">✏ Edit</a>
              <a href="delete_task.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                 onclick="return confirm('Delete this task?')">🗑 Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const toggleBtn = document.getElementById("themeToggle");
  const body = document.body;

  // Load saved theme
  if (localStorage.getItem("theme")) {
    body.setAttribute("data-bs-theme", localStorage.getItem("theme"));
    toggleBtn.textContent = localStorage.getItem("theme") === "dark" ? "☀ Light Mode" : "🌙 Dark Mode";
  }

  toggleBtn.addEventListener("click", () => {
    const current = body.getAttribute("data-bs-theme");
    const newTheme = current === "light" ? "dark" : "light";
    body.setAttribute("data-bs-theme", newTheme);
    localStorage.setItem("theme", newTheme);
    toggleBtn.textContent = newTheme === "dark" ? "☀ Light Mode" : "🌙 Dark Mode";
  });
</script>
</body>
</html>
