<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Airline Booking Form</title>
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
      width : 400px;
      padding: 50px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #333;
    }

    .form-group {
      color: #333;
      margin-bottom: 15px;
    }
    .label{
      color: black;
    }

    label {
      display: block;
      margin-bottom: 5px;
      color: #555;
    }

    input, select {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      background-color: rgb(76, 202, 76);
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
  <h2>Airline Booking Form</h2>
  <form id="bookingForm" method="post" onsubmit="return validateForm()">
    <div class="form-group">
      <label class="label" for="referenceNumber">Reference Number:</label>
      <input type="text" id="referenceNumber" name="referenceNumber" placeholder="Enter reference number">
    </div>

    <div class="form-group">
      <label class="label" for="passengerName">Passenger Name:</label>
      <input type="text" id="passengerName" name="passengerName" placeholder="Enter passenger name">
    </div>

    <div class="form-group">
      <label class="label" for="passengerAge">Passenger Age:</label>
      <input type="number" id="passengerAge" name="passengerAge" placeholder="Enter passenger age">
    </div>

    <div class="form-group">
      <label class="label" for="passPort">Passport Number:</label>
      <input id="passPort" type="text" name="PassPort" placeholder="Enter passport number">
    </div>


    <div class="form-group">
      <label class="label" for="bookingType">Booking Type:</label>
      <select id="bookingType" name="bookingType">
        <option value="economy">Economy</option>
        <option value="business">Business</option>
        <option value="firstClass">First Class</option>
      </select>
    </div>

    <div>
      <button type="submit" >Book Now</button>
    </div>
  </form>
</div>

<script>
  function validateForm() {
    // Get values from form fields
    const referenceNumber = document.getElementById('referenceNumber').value;
    const passengerName = document.getElementById('passengerName').value;
    const passengerAge = document.getElementById('passengerAge').value;
    const bookingType = document.getElementById('bookingType').value;

    // Check if any of the fields is empty
    if (!referenceNumber || !passengerName || !passengerAge || !bookingType) {
      // Show an alert if any field is empty
      alert('All fields are required');
      // Return false to prevent form submission
      return false;
    }

    // Additional validation can be added here

    // If all fields are filled, return true to allow form submission
    return true;
  }
</script>

</body>
</html>
<?php

// Assuming you have a database connection in DB_Connection.php
require_once 'DB_Connection.php';

// Function to generate a unique ticket number
function generateTicketNumber() {
    // You can implement your logic here to generate a unique ticket number
    return 'TICKET-' . uniqid();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $referenceNumber = isset($_POST['referenceNumber']) ? mysqli_real_escape_string($conn, $_POST['referenceNumber']) : '';
    $passengerName = isset($_POST['passengerName']) ? mysqli_real_escape_string($conn, $_POST['passengerName']) : '';
    $passengerAge = isset($_POST['passengerAge']) ? intval($_POST['passengerAge']) : 0;
    $passPort = isset($_POST['PassPort']) ? intval($_POST['PassPort']) : 0;
    $bookingType = isset($_POST['bookingType']) ? mysqli_real_escape_string($conn, $_POST['bookingType']) : '';

    if (!$referenceNumber || !$passengerName || $passengerAge <= 0 || !$passPort || !$bookingType) {
      echo "<script>alert('All fields are required!');</script>";
        exit();
    }

    // Validate reference number against another table
    $referenceQuery = "SELECT * FROM bookings WHERE ref_number = '$referenceNumber'";
    $referenceResult = mysqli_query($conn, $referenceQuery);

    if ($referenceResult === false) {
        echo 'Error in reference query: ' . mysqli_error($conn);
        exit();
    }

    if (mysqli_num_rows($referenceResult) > 0) {
        // Reference number is valid, proceed to create a ticket number
        $ticketNumber = generateTicketNumber();

        // Insert data into the bookings table
        $insertQuery = "INSERT INTO details (ref_number, passenger_name, passenger_age, pass_port, booking_type, ticket_number) 
                        VALUES ('$referenceNumber', '$passengerName', $passengerAge, $passPort, '$bookingType', '$ticketNumber')";

        if (mysqli_query($conn, $insertQuery)) {
            // Data inserted successfully, you can redirect to the home page
            echo "<script>alert('Booked successfully!');window.location.href='Homepage.php';</script>";
            exit();
        } else {
            echo 'Error inserting data into the database: ' . mysqli_error($conn);
            exit();
        }
    } else {
        echo "<script>alert('Reference number is not correct!');</script>";
        
        exit();
    }
    mysqli_close($conn);
}
?>
