<?php
$firstName = "";
$lastName = "";
$username = "";
$email = "";
$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = trim($_POST["firstName"] ?? "");
    $lastName = trim($_POST["lastName"] ?? "");
    $username = trim($_POST["username"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirmPassword = $_POST["confirmPassword"] ?? "";

    $namePattern = "/^[A-Za-z ]{2,30}$/";
    $usernamePattern = "/^[A-Za-z0-9_]{3,20}$/";
    $emailPattern = "/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/";
    $passwordPattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,20}$/";

    if ($firstName === "") {
        $errors[] = "First name is required.";
    } elseif (!preg_match($namePattern, $firstName)) {
        $errors[] = "First name must contain 2-30 letters.";
    }

    if ($lastName === "") {
        $errors[] = "Last name is required.";
    } elseif (!preg_match($namePattern, $lastName)) {
        $errors[] = "Last name must contain 2-30 letters.";
    }

    if ($username === "") {
        $errors[] = "Username is required.";
    } elseif (!preg_match($usernamePattern, $username)) {
        $errors[] = "Username must be 3-20 characters using letters, numbers, or underscores.";
    }

    if ($email === "") {
        $errors[] = "Email is required.";
    } elseif (!preg_match($emailPattern, $email)) {
        $errors[] = "Please enter a valid email address.";
    }

    if ($password === "") {
        $errors[] = "Password is required.";
    } elseif (!preg_match($passwordPattern, $password)) {
        $errors[] = "Password must be 8-20 characters with uppercase, lowercase, and a number.";
    }

    if ($confirmPassword === "") {
        $errors[] = "Please confirm your password.";
    } elseif ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        $success = "Registration form validation successful!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Eras Portal - Register</title>
    <link rel="stylesheet" href="css/register.css">
</head>

<body>
<main>
    <section class="register-section">
        <h1 class="site-title">The Eras Tour</h1>

        <p class="site-subtitle">
            Join the journey through every era.
        </p>

        <nav>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </nav>

        <h2>Create Your Account</h2>

        <p class="register-description">
            Sign up and become part of the Swiftie community.
        </p>

        <?php if (!empty($errors)): ?>
            <div class="error-box">
                <strong>Please correct the following:</strong>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="success-box">
                <?= htmlspecialchars($success, ENT_QUOTES, "UTF-8") ?>
            </div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <label for="firstName">First Name</label>
            <input
                type="text"
                id="firstName"
                name="firstName"
                placeholder="Enter your first name"
                value="<?= htmlspecialchars($firstName, ENT_QUOTES, "UTF-8") ?>"
                required
            >

            <label for="lastName">Last Name</label>
            <input
                type="text"
                id="lastName"
                name="lastName"
                placeholder="Enter your last name"
                value="<?= htmlspecialchars($lastName, ENT_QUOTES, "UTF-8") ?>"
                required
            >

            <label for="username">Username</label>
            <input
                type="text"
                id="username"
                name="username"
                placeholder="Choose a username"
                value="<?= htmlspecialchars($username, ENT_QUOTES, "UTF-8") ?>"
                required
            >

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
                placeholder="Create a password"
                required
            >

            <label for="confirmPassword">Confirm Password</label>
            <input
                type="password"
                id="confirmPassword"
                name="confirmPassword"
                placeholder="Confirm your password"
                required
            >

            <button type="submit">Register</button>
        </form>

        <p class="login-link">
            Already have an account?
            <a href="login.php">Login here</a>
        </p>
    </section>
</main>
</body>
</html>
