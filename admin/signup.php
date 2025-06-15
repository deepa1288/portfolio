<?php
    session_start();
    include '../include/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $email = $_POST['email'];

        // Initialize error array
        $errors = array();

        // Validate username
        if (empty($username)) {
            $errors[] = "Username is required";
        } elseif (strlen($username) < 3) {
            $errors[] = "Username must be at least 3 characters long";
        }

        // Validate email
        if (empty($email)) {
            $errors[] = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }

        // Validate password
        if (empty($password)) {
            $errors[] = "Password is required";
        } elseif (strlen($password) < 6) {
            $errors[] = "Password must be at least 6 characters long";
        }

        // Validate password match
        if ($password !== $confirm_password) {
            $errors[] = "Passwords do not match";
        }

        if (empty($errors)) {
            // Check if username already exists
            $check_sql = "SELECT id FROM user WHERE username = ?";
            $check_stmt = $conn->prepare($check_sql);
            $check_stmt->bind_param("s", $username);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();

            if ($check_result->num_rows > 0) {
                $errors[] = "Username already exists";
            } else {
                // Check if email already exists
                $check_email_sql = "SELECT id FROM user WHERE email = ?";
                $check_email_stmt = $conn->prepare($check_email_sql);
                $check_email_stmt->bind_param("s", $email);
                $check_email_stmt->execute();
                $check_email_result = $check_email_stmt->get_result();

                if ($check_email_result->num_rows > 0) {
                    $errors[] = "Email already exists";
                } else {
                    // Hash password and insert new user
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $insert_sql = "INSERT INTO user (username, password, email) VALUES (?, ?, ?)";
                    $insert_stmt = $conn->prepare($insert_sql);
                    $insert_stmt->bind_param("sss", $username, $hashed_password, $email);

                    if ($insert_stmt->execute()) {
                        $_SESSION['success'] = "Registration successful! Please login.";
                        header("Location: index.php");
                        exit();
                    } else {
                        $errors[] = "Registration failed. Please try again.";
                    }
                }
            }
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up - Admin Portfolio</title>
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
            .login-link {
                text-align: center;
                margin-top: 1rem;
            }
            .login-link a {
                color: #3498db;
                text-decoration: none;
            }
            .login-link a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Admin Sign Up</h2>
            <?php
            if (!empty($errors)) {
                foreach($errors as $error) {
                    echo "<p class='error'>$error</p>";
                }
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit">Sign Up</button>
            </form>
            <div class="login-link">
                <p>Already have an account? <a href="index.php">Login</a></p>
            </div>
        </div>
    </body>
    </html>