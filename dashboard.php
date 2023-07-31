<?php
    // Start the session to access session variables
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        // Redirect the user to the login page if not logged in
        header("Location: login.php");
        exit();
    }

    // Get the username from the session variable
    $username = $_SESSION['username'];
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Dashboard</title>
        <link rel="stylesheet" href="dashboard.css">
    </head>
    <body>
        <header>
            <h1>Welcome, <?php echo $username; ?>!</h1>
            <button id="logoutBtn">Logout</button>
        </header>

        <div class="container">
            <!-- Add your user dashboard content here -->
        </div>

        <script src="dashboard.script"></script>
    </body>
</html>
