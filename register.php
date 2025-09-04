<?php include 'config.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        $error = "User already exists!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body data-bs-theme="light">
<div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="card shadow-sm p-4" style="width: 350px;">
    <div class="text-end mb-3">
      <button id="themeToggle" class="btn btn-outline-secondary btn-sm">🌙 Dark Mode</button>
    </div>
    <h3 class="text-center mb-3">Register</h3>
    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-success w-100">Register</button>
    </form>
    <?php if (isset($error)) echo "<p class='text-danger mt-2'>$error</p>"; ?>
    <p class="text-center mt-3">
      <a href="login.php">Already have an account?</a>
    </p>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const toggleBtn = document.getElementById("themeToggle");
  const body = document.body;

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
