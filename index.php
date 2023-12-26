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


    <title>Signup</title>
</head>
<body>
   <img class="https://youtu.be/sn9h6-iz3Ic"/>
  
<div class="container">

        <!-- Signup Form -->
        <div id="signupForm" class="form-group";">
            <h2 style="color:black;">Sign up</h2>
            <form  method="post">
                <label for="signupUsername">Username:</label>
                <span class="symbol person-symbol">👤</span>
                <input type="text" id="signupUsername" name="Username" required>

                <label for="signupPassword">Password:</label>
                <div class="password-container">
                    <input type="password" id="signupPassword" name="Password" required>
                    <span class="password-toggle" onclick="togglePassword('signupPassword')">👁️</span>
                </div>
            
                
                <label for="confirmPassword">Confirm Password:</label>
                <div class="password-container">
                    <input type="password" id="confirmPassword" name="CPassword" required>
                    <span class="password-toggle" onclick="togglePassword('confirmPassword')">👁️</span>
                </div>
                
                <button type="submit">Sign up</button>
            </form>

            <p class="switch-form">Already have an account? <a href="login.php" onclick="toggleForm('loginForm')" style="color:green;">Login</a></p>
            <!-- link to homepage -->
            
</div>

    </body>

    </html>
<?php
// Assuming you have a database connection in DB_Connection.php
require_once 'DB_Connection.php';

// Assuming form data is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $username = isset($_POST['Username']) ? mysqli_real_escape_string($conn, $_POST['Username']) : '';
    $password = isset($_POST['Password']) ? mysqli_real_escape_string($conn, $_POST['Password']) : '';
    $confirmPassword = isset($_POST['CPassword']) ? mysqli_real_escape_string($conn, $_POST['CPassword']) : '';

    // Check if passwords match before hashing
    if ($password === $confirmPassword) {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // SQL query to insert data
        $insertQuery = "INSERT INTO signup (username, password) VALUES ('$username', '$hashedPassword')";

        // Execute the query
        $result = mysqli_query($conn, $insertQuery);

        // Check for query execution success
        if ($result) {
            // Redirect to another page after successful submission
            echo "<script>alert('Registered successful!');window.location.href='Login.php';</script>";
            
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Passwords do not match!');</script>";
    }
}

// Close the database connection
mysqli_close($conn);
?>
