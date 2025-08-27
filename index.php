<?php

session_start();

$name = $_SESSION['name'] ?? null;
$alerts = $_SESSION['alerts'] ?? [];
$active_form = $_SESSION['active_form'] ?? '';

session_unset();

if ($name !== null) $_SESSION['name'] = $name;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Full stack website</title>
    <link rel="stylesheet" href="styles.css" />
    <link
      href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css"
      rel="stylesheet"
    />
    <script src="script.js" defer></script>
  </head>
  <body>
    <header>
      <a href="#" class="logo">Logo</a>
      <nav>
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Collection</a>
        <a href="#">Contact</a>
      </nav>
      <div class="user-auth">
        <?php if (!empty($name)): ?>
        <div class="profile-box">
          <div class="avatar-circle"><?= strtoupper($name[0]); ?></div>
          <div class="dropdown">
            <a href="#">My account</a>
            <a href="logout.php">Logout</a>
          </div>
        </div>
        <?php else: ?>
        <button type="button" class="login-btn-modal">Login</button>
        <?php endif; ?>
      </div>
    </header>
    <section>
      <h1>Hey <?= $name ?? 'Developer'?>!</h1>
    </section>
    <?php if (!empty($alerts)): ?>
    <div class="alert-box">
      <?php foreach ($alerts as $alert): ?>
      <div class="alert <?= $alert['type']; ?>">
        <i class="bx <?= $alert['type'] === 'success' ? 'bxs-check-circle' : 'bxs-x-circle'; ?>"></i>
        <span><?= $alert['message']; ?></span>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <div class="auth-modal <?= $active_form === 'register' ? 'show slide' : ($active_form === 'login' ? 'show' : ''); ?>">
      <button type="button" class="close-btn-modal">
        <i class="bx bx-x"></i>
      </button>
      <div class="form-box login">
        <h2>Login</h2>
        <form action="auth.process.php" method="POST">
          <div class="input-box">
            <input type="email" name="email" placeholder="Email" required />
            <i class="bx bxs-envelope-alt"></i>
          </div>
          <div class="input-box">
            <input
              type="password"
              name="password"
              placeholder="Password"
              required
            />
            <i class="bx bxs-lock-keyhole"></i>
          </div>
          <button type="submit" name="login_btn" class="btn">Login</button>
          <p>
            Don't have an account?
            <a href="#" class="register-link">Register</a>
          </p>
        </form>
      </div>
      <div class="form-box register">
        <h2>Register</h2>
        <form action="auth.process.php" method="POST">
          <div class="input-box">
            <input type="text" name="name" placeholder="Name" required />
            <i class="bx bxs-user"></i>
          </div>
          <div class="input-box">
            <input type="email" name="email" placeholder="Email" required />
            <i class="bx bxs-envelope-alt"></i>
          </div>
          <div class="input-box">
            <input
              type="password"
              name="password"
              placeholder="Password"
              required
            />
            <i class="bx bxs-lock-keyhole"></i>
          </div>
          <button type="submit" name="register_btn" class="btn">
            Register
          </button>
          <p>
            Already have an account?
            <a href="#" class="login-link">Login</a>
          </p>
        </form>
      </div>
    </div>
  </body>
</html>
