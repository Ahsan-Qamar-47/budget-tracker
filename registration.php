<?php
include 'includes/header.php';
require_once 'db_actions.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (!$username || !$email || !$password || !$confirm_password) {
        $message = 'All fields are required.';
    } elseif ($password !== $confirm_password) {
        $message = 'Passwords do not match.';
    } else {
        $result = register_user($username, $email, $password);
        if ($result === true) {
            $message = 'Registration successful! <a href="login.php">Login here</a>.';
        } else {
            $message = $result;
        }
    }
}
?>
<main>
    <h2>Register</h2>
    <?php if ($message): ?>
        <p style="color:red;"> <?= $message ?> </p>
    <?php endif; ?>
    <form method="post" action="">
        <label>Username:<br><input type="text" name="username" required></label><br><br>
        <label>Email:<br><input type="email" name="email" required></label><br><br>
        <label>Password:<br><input type="password" name="password" required></label><br><br>
        <label>Confirm Password:<br><input type="password" name="confirm_password" required></label><br><br>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
</main>
<?php include 'includes/footer.php'; ?> 