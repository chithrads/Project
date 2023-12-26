<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
            height: 200vh;
        }

        .container {
            background-color: transparent;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 800px;
            text-align: center;
        }

        h1 {
            color: #ce1d1d;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 30px;
        }

        .booking-section {
            background-color: transparent;
            color: #1a1818;
            padding: 20px;
            border-radius: 8px;
        }

        .ticket-section {
            background-color: transparent;
            color: #151414;
            padding: 20px;
            border-radius: 8px;
        }

        .passenger-section {
            background-color: transparent;
            color: #161515;
            padding: 20px;
            border-radius: 8px;
        }

        .has-section {
            background-color: transparent;
            color: #181616;
            padding: 20px;
            border-radius: 8px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }
        
        
    </style>
    <title>Home Page</title>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Airline Reservation System</h1>

        <!-- registration Section -->
        <div class="section booking-section">
            <h2>Airline Registration</h2>
            <p>Register to book your flights with ease.</p>
            <button onclick="location.href='Registration.php'">Register</button>
        </div>

        <!-- Ticket Booking Section -->
        <div class="section ticket-section">
            <h2>Ticket Booking</h2>
            <p>Book your tickets to explore your self</p>
            <button onclick="location.href='new Booking.php'">Book Tickets</button>
        </div>

        <!-- Ticket View Section -->
        <div class="section passenger-section">
            <h2>Ticket Information</h2>
            <p>Provide or update your passenger details for a seamless travel experience.</p>
            <button onclick="location.href='new Ticket info.php'">View Ticket</button>
        </div>

        <!-- HAS (Relationship) Section -->
        <div class="section has-section">
            <h2>Booking-Passenger Relationship</h2>
            <p>View and manage the relationship between bookings and passengers.</p>
            <button onclick="location.href='has-relationship.php'">View Relationships</button>
        </div>
        <!-- Link back to the Homepage -->
    <a href="index.php">Go to signup page</a>
    </div>

</body>
</html>
