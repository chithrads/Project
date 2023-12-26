<!-- ticket_display.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Information</title>
    <!-- Add your styling here -->
</head>
<body>

<?php
require_once 'DB_Connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $referenceNumber = isset($_POST['referenceNumber']) ? mysqli_real_escape_string($conn, $_POST['referenceNumber']) : '';

    if (!$referenceNumber) {
        echo '<p style="text-align: center; color: red;">Reference number is required.</p>';
    } else {
        $referenceQuery = "SELECT * FROM details WHERE ref_number = '$referenceNumber'";
        $referenceResult = mysqli_query($conn, $referenceQuery);

        if ($referenceResult === false) {
            echo '<p style="text-align: center; color: red;">Error in reference query: ' . mysqli_error($conn) . '</p>';
        } elseif (mysqli_num_rows($referenceResult) > 0) {
            // Reference number is correct, display all data
            echo '<div style="text-align: center; margin-bottom: 20px;">';
            echo '<h2 style="color: #333; border-bottom: 2px solid #333; padding-bottom: 5px;">Ticket Information</h2>';
            echo '</div>';

            echo '<table style="width: 100%; border-collapse: collapse; border: 1px solid #333; margin-bottom: 20px;">';
            echo '<tr style="background-color: #f2f2f2;">';
            echo '<th style="padding: 10px; border: 1px solid #333;">Ticket Number</th>';
            echo '<th style="padding: 10px; border: 1px solid #333;">Passenger Name</th>';
            echo '<th style="padding: 10px; border: 1px solid #333;">PassPort Number</th>';
            echo '<th style="padding: 10px; border: 1px solid #333;">Passenger Age</th>';
            // Add more fields as needed
            echo '</tr>';

            while ($row = mysqli_fetch_assoc($referenceResult)) {
                echo '<tr>';
                echo '<td style="padding: 10px; border: 1px solid #333;">' . $row['ticket_number'] . '</td>';
                echo '<td style="padding: 10px; border: 1px solid #333;">' . $row['passenger_name'] . '</td>';
                echo '<td style="padding: 10px; border: 1px solid #333;">' . $row['pass_port'] . '</td>';
                echo '<td style="padding: 10px; border: 1px solid #333;">' . $row['passenger_age'] . '</td>';
                // Add more fields as needed
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo '<p style="text-align: center; color: red;">Reference number is not correct.</p>';
        }
    }
} else {
    echo '<p style="text-align: center; color: red;">Invalid request method.</p>';
}

?>

</body>
</html>
