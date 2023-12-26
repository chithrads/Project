<?php
        
  require_once 'DB_Connection.php';
$username = $_POST['signupUsername'];
$password = $_POST['signupPassword'];
$cpassword = $_POST['confirmPassword'];


if ($password == $cpassword) {
    if (strlen($username) > 0 && strlen($password) > 0) {
        $select = "SELECT * FROM signupdata WHERE username = '$username'";
        $getUser = mysqli_query($conn, $select);

        if (mysqli_num_rows($getUser) == 1) {
            echo "<script>alert('Already registered with this userid');</script>";
        } else {
            $encrypted = password_hash($password, PASSWORD_BCRYPT);
            $insert = "INSERT INTO signupdata (username, password) VALUES ('$username', '$encrypted')";
            $InsertUser = mysqli_query($conn, $insert);

            if ($InsertUser) {
                echo "<script>alert('Registered Successfully!');</script>";
            } else {
                echo "<script>alert('Something went Wrong!');</script>";
            }
        }
    } else {
        echo "Fill all the fields";
    }
} else {
    echo "Passwords are not matching";
}

?>