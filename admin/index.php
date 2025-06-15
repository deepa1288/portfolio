    <?php

    include '../include/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT id, username, password FROM user WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Invalid username or password";
            }
        } else {
            $error = "Invalid username or password";
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Admin Portfolio</title>
        <link rel="stylesheet" href="css/style.css">
        <style>
            body {
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            .container {
                background: white;
                padding: 2rem;
                border-radius: 10px;
                box-shadow: 0 8px 20px rgba(0,0,0,0.1);
                width: 100%;
                max-width: 400px;
            }
            h2 {
                color: #2c3e50;
                text-align: center;
                margin-bottom: 2rem;
                font-size: 2rem;
            }
            .form-group {
                margin-bottom: 1.5rem;
            }
            label {
                display: block;
                margin-bottom: 0.5rem;
                color: #34495e;
                font-weight: 500;
            }
            input {
                width: 100%;
                padding: 0.8rem;
                border: 2px solid #e0e0e0;
                border-radius: 5px;
                font-size: 1rem;
                transition: border-color 0.3s ease;
            }
            input:focus {
                border-color: #3498db;
                outline: none;
            }
            button {
                width: 100%;
                padding: 1rem;
                background: #3498db;
                color: white;
                border: none;
                border-radius: 5px;
                font-size: 1rem;
                cursor: pointer;
                transition: background 0.3s ease;
            }
            button:hover {
                background: #2980b9;
            }
            .error {
                background: #ff6b6b;
                color: white;
                padding: 1rem;
                border-radius: 5px;
                margin-bottom: 1rem;
                text-align: center;
            }
            .signup-link {
                text-align: center;
                margin-top: 1rem;
            }
            .signup-link a {
                color: #3498db;
                text-decoration: none;
            }
            .signup-link a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Admin Login</h2>
            <?php
            if (isset($error)) {
                echo "<p class='error'>$error</p>";
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
            <div class="signup-link">
                <p>Don't have an account? <a href="signup.php">Sign up</a></p>
            </div>
        </div>
    </body>
    </html>

   
