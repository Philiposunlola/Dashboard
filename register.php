<?php
    // Include the database connection
    include 'conf.php';

    // Initialize an array to store errors
    $errors = [];

    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        // Validate input fields
        if (empty($username)) {
            $errors[] = "Username is required.";
        }

        if (empty($password)) {
            $errors[] = "Password is required.";
        }

        if (empty($email)) {
            $errors[] = "Email is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        // Proceed with registration if there are no errors
        if (empty($errors)) {
            // Replace this with a secure password hashing function (e.g., bcrypt)
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Use prepared statements to insert data into the database
            $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $hashedPassword, $email);

            if ($stmt->execute()) {
                header("Location: login.php"); // Redirect back to the login page after successful registration
                exit();
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
            
            $stmt->close();
        }
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Register</h2>
            <?php if (!empty($errors)): ?>
                <div class="error-message">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="" method="post">
                <input type="text" name="userName" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="email" name="email" placeholder="Email" required>
                <button type="submit" name="register">Register</button>
            </form>
        </div>
    </div>
</body>
</html>
