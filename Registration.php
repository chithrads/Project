<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airline Ticket Booking</title>
    <style>
        body {
            background: url('https://i.makeagif.com/media/12-03-2015/a3ZnzB.gif') center center fixed;
            
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background: transparent;
            color: rgb(240, 120, 70);
            text-align: center;
            padding: 1em;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: grid;
            grid-gap: 20px;
        }

        label {
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
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

        #ticketNumber {
            margin-top: 20px;
            font-size: 18px;
        }
    </style>
</head>
<body>

<header>
        <h1>Airline Ticket registration</h1>
    </header>

    <main>
        <form id="bookingForm" method="post" onsubmit="return validateForm()">
            <label for="from">From:</label>
            <select name="origin" class="drop" id="origin" required>
                <option value="" disabled selected>Select...From</option>
                <option value="Mumbai">MUMBAI</option>
                <option value="Delhi">DELHI</option>
                <option value="Bangalore">BANGALORE</option>
                <option value="Kolkata">KOLKATA</option>
            </select>

            <label for="to">To:</label>
            <select name="destination" class="drop" id="destination" required>
                <option value="" disabled selected>Select...To</option>
                <option value="Mumbai">MUMBAI</option>
                <option value="Delhi">DELHI</option>
                <option value="Bangalore">BANGALORE</option>
                <option value="Kolkata">KOLKATA</option>
            </select>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>


            <button type="submit">Register Now</button>
        </form>
    </main>

    <script>
        function validateForm() {
            var origin = document.getElementById("origin").value;
            var destination = document.getElementById("destination").value;
            var date = document.getElementById("date").value;
            
            // Check if all required fields are filled
            if (origin === "" || destination === "" || date === "" || passengers === "") {
                alert("Please fill in all the required fields.");
                return false; // Prevent form submission
            }

            // You can add additional validation here if needed

            // If validation is successful, show the "Booking Done" alert
            alert('Thank You!');
            return true; // Allow form submission
        }
    </script>

</body>
</html>
<?php
// Assuming you have a database connection in DB_Connection.php
require_once 'DB_Connection.php';

// Assuming form data is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $origin = isset($_POST['origin']) ? mysqli_real_escape_string($conn, $_POST['origin']) : '';
    $destination = isset($_POST['destination']) ? mysqli_real_escape_string($conn, $_POST['destination']) : '';
    $date = isset($_POST['date']) ? mysqli_real_escape_string($conn, $_POST['date']) : '';


    // Check if all required fields are filled
    if (!empty($origin) && !empty($destination) && !empty($date)) {
        // Generate a random ticket number
        $randomTicketNumber = generateRandomTicketNumber();

        // Insert data into the database
        $insertQuery = "INSERT INTO bookings (origin, destination, dates, ref_number) 
                        VALUES ('$origin', '$destination', '$date', '$randomTicketNumber')";

        $result = mysqli_query($conn, $insertQuery);

        // Check for query execution success
        if ($result) {
            // Display the created ticket number
            echo "<script>alert('Reference Number: $randomTicketNumber  !..note for the next step');window.location.href='Homepage.php';</script>";
            
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "All fields are required!";
    }
}

// Close the database connection
mysqli_close($conn);

function generateRandomTicketNumber() {
    // Generate a random ticket number (for demonstration purposes)
    return mt_rand(1000, 9999);
}
?>

