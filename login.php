<?php
session_start();
include 'includes/header.php';
require_once 'db_actions.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$username || !$password) {
        $message = 'Both fields are required.';
    } else {
        $user = login_user($username, $password);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: dashboard.php');
            exit();
        } else {
            $message = 'Invalid username or password.';
        }
    }
}
?>
<main>
    <h2>Login</h2>
    <?php if ($message): ?>
        <p style="color:red;"> <?= $message ?> </p>
    <?php endif; ?>
    <form method="post" action="">
        <label>Username or Email:<br><input type="text" name="username" required></label><br><br>
        <label>Password:<br><input type="password" name="password" required></label><br><br>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="registration.php">Register here</a>.</p>
</main>
<?php include 'includes/footer.php'; ?> 