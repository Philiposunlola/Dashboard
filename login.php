<?php
    // Include the database connection
    // Include the database connection
    include 'conf.php';

    // Initialize an array to store login errors
    $errors = [];

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Validate input fields
        if (empty($username) || empty($password)) {
            $errors[] = "Both username and password are required.";
        }

        // Proceed with login if there are no errors
        if (empty($errors)) {
            // Use prepared statements to fetch user data from the database
            $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // User with the provided username exists, check the password
                $stmt->bind_result($hashedPassword);
                $stmt->fetch();

                if (password_verify($password, $hashedPassword)) {
                    // Password is correct, set session variables and redirect to a protected page
                    session_start();
                    $_SESSION['username'] = $username;
                    header("Location: dashboard.php"); // Replace welcome.php with your protected page
                    exit();
                } else {
                    $errors[] = "Incorrect password.";
                }
            } else {
                $errors[] = "User with the provided username does not exist.";
            }
            
            $stmt->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Login</h2>
            <?php if (!empty($errors)): ?>
                <div class="error-message">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="login.php" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
