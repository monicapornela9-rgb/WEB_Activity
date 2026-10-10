<?php
$email = "";
$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    $emailPattern = "/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/";
    $passwordPattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,20}$/";

    if ($email === "") {
        $errors[] = "Email is required.";
    } elseif (!preg_match($emailPattern, $email)) {
        $errors[] = "Please enter a valid email address.";
    }

    if ($password === "") {
        $errors[] = "Password is required.";
    } elseif (!preg_match($passwordPattern, $password)) {
        $errors[] = "Password must be 8-20 characters and include at least one uppercase letter, one lowercase letter, and one number.";
    }

    if (empty($errors)) {
        $success = "Login successful! Your email and password passed validation.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Eras Portal - Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <nav>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    </nav>

    <div class="container">
        <h1>Welcome Back, Swiftie</h1>

        <p class="description">
            Enter the portal and continue your journey through the eras.
        </p>

        <?php if (!empty($errors)): ?>
            <div class="alert-error">
                <strong>Please check the following:</strong>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert-success">
                <strong><?= htmlspecialchars($success, ENT_QUOTES, "UTF-8") ?></strong>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <label for="email">Email Address</label>
            <input
                type="email"
                id="email"
                name="email"
                placeholder="Enter your email"
                value="<?= htmlspecialchars($email, ENT_QUOTES, "UTF-8") ?>"
                required
            >

            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter your password"
                required
            >

            <button type="submit">Login</button>
        </form>

        <div class="register-link">
            Don't have an account?
            <a href="register.php">Register here</a>
        </div>
    </div>
</body>
</html>
