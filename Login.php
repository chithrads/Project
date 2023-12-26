<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    
    <style type="text/css">

        
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('https://i.makeagif.com/media/12-03-2015/a3ZnzB.gif') center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        
        
        
         
        .container {
            background-color:transparent;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(145, 221, 248, 0.1);
            width: 300px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input {
            width: calc(100% - 20px);
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
        }

        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
            font-size: 14px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .switch-form {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        .switch-form a {
            color: #4caf50;
            text-decoration: none;
        }

        .switch-form a:hover {
            text-decoration: underline;
        }
        
    </style>

    <title>Login</title>
</head>
<body>
   <img class="https://youtu.be/sn9h6-iz3Ic"/>

    <div class="container">
        <!-- Login Form -->
        <div id="loginForm" class="form-group">
            <h2 style="color:black;">Login</h2>
            <form method="POST">
                <label for="loginUsername">Username:</label>
                <span class="symbol person-symbol">👤</span>
                <input type="text" id="loginUsername" name="username" required placeholder="username" required>

                <label for="loginPassword">Password:</label>
                <div class="password-container">
                    <input type="password" id="loginPassword" name="password" required placeholder="password" required>
                    <span class="password-toggle" onclick="togglePassword('loginPassword')">👁️</span>
                </div>

                <button type="submit">Login</button>
            </form>

            <p class="switch-form">Don't have an account? <a href="index.php" onclick="toggleForm('signupForm')" style="color: #4caf50;">Sign up</a></p>
        </div>

    </div>
    
    </body>
    </html>

<?php
require_once 'DB_Connection.php';

// Assuming form data is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $username = isset($_POST['username']) ? trim(mysqli_real_escape_string($conn, $_POST['username'])) : '';
    $password = isset($_POST['password']) ? trim(mysqli_real_escape_string($conn, $_POST['password'])) : '';

    // SQL query to retrieve user data based on the username
    $selectQuery = "SELECT * FROM signup WHERE username = '$username'";
    $result = mysqli_query($conn, $selectQuery);

    // Check for query execution success
    if ($result) {
        // Check if a row is returned
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            // Verify the entered password against the hashed password in the database
            if (password_verify($password, $row['password'])) {
                echo "<script>alert('Login successful!');window.location.href='Homepage.php';</script>";
                // Perform any additional actions or redirect to the user's dashboard
            } else {
                echo "<script>alert('Incorrect password!');</script>";
            }
        } else {
            echo "<script>alert('User not found!');</script>";
        }
    } else {
        // Log the error for debugging purposes
        error_log("Database Error: " . mysqli_error($conn));

        // Provide a generic error message to the user
        echo "<script>alert('An unexpected error occurred. Please try again later.');</script>";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
