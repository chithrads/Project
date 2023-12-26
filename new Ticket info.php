<?php
// Assuming you have a database connection in DB_Connection.php
require_once 'DB_Connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $referenceNumber = isset($_POST['referenceNumber']) ? mysqli_real_escape_string($conn, $_POST['referenceNumber']) : '';

    if (!$referenceNumber) {
        echo '<p style="text-align: center; color: red;">Reference number is required.</p>';
    } else {
        $referenceQuery = "SELECT * FROM details WHERE ref_number = '$referenceNumber'";
        $referenceResult = mysqli_query($conn, $referenceQuery);

        if ($referenceResult === false) {
            echo '<p style="text-align: center; color: red;">Error in reference query: ' . mysqli_error($conn) . '</p>';
        } elseif (mysqli_num_rows($referenceResult) > 0) {
            // Reference number is correct, display all data in a table
            echo '<div style="text-align: center; margin-bottom: 20px;">';
            echo '<h2 style="color: #333; border-bottom: 2px solid #333; padding-bottom: 5px;">Ticket Information</h2>';
            echo '</div>';

            echo '<table style="width: 50%; margin: 0 auto; border-collapse: collapse; border: 1px solid #fff; background-color: #fff;">';
            echo '<tr style="background-color: #f2f2f2;">';
            echo '<th style="padding: 10px; border: 1px solid #fff;">Ticket Number</th>';
            echo '<th style="padding: 10px; border: 1px solid #fff;">Passenger Name</th>';
            echo '<th style="padding: 10px; border: 1px solid #fff;">PassPort Number</th>';
            echo '<th style="padding: 10px; border: 1px solid #fff;">Passenger Age</th>';
            // Add more fields as needed
            echo '</tr>';

            while ($row = mysqli_fetch_assoc($referenceResult)) {
                echo '<tr>';
                echo '<td style="padding: 10px; border: 1px solid #fff;">' . $row['ticket_number'] . '</td>';
                echo '<td style="padding: 10px; border: 1px solid #fff;">' . $row['passenger_name'] . '</td>';
                echo '<td style="padding: 10px; border: 1px solid #fff;">' . $row['pass_port'] . '</td>';
                echo '<td style="padding: 10px; border: 1px solid #fff;">' . $row['passenger_age'] . '</td>';
                // Add more fields as needed
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo '<p style="text-align: center; color: red;">Reference number is not correct.</p>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Information Form</title>
    <style>
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

        .form-container {
            background-color: transparent;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .form-group {
            color: #333;
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: rgb(88, 196, 88);
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Ticket Information Form</h2>
    <form id="ticketForm" method="post" onsubmit="return validateForm()">
        <div class="form-group">
            <label for="referenceNumber" style="color: black;">Reference Number:</label>
            <input type="text" id="referenceNumber" name="referenceNumber" placeholder="Enter reference number">
        </div>

        <div class="form-group">
            <button type="submit">Submit</button>
        </div>
    </form>
    <a href="Homepage.php">Homepage</a>
</div>

<script>
    function validateForm() {
        const referenceNumber = document.getElementById('referenceNumber').value;

        if (!referenceNumber) {
            alert('Reference number is required');
            return false;
        }

        // Additional validation can be added here

        return true;
    }
</script>

</body>
</html>
