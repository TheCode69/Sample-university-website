<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: darkgrey;
    }

    .card {
        background-image: img_src/image/1.jfif;
        border: 1px solid #ccc;
        border-radius: 8px;
        margin: 10px;
        padding: 20px;
        text-align: center;
        background-color: green;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease-in-out;
        cursor: pointer;
        background-size: cover;
        background-position: center;
        overflow: hidden;
    }

    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .btn {
        padding: 10px 20px;
        background-color: #3498db;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    .btn:hover {
        background-color: #2980b9;
    }

    #logout {
        background-color: green;
    }
    </style>
    <title>Card Example with Database Fetching</title>
</head>

<body>

    <?php
    // Database connection details
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'university';

    // Create a database connection
    $connection = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Function to fetch student data by registration number
    function fetchStudentData($registrationNumber, $connection)
    {
        $query = "SELECT * FROM students WHERE registration_number = '$registrationNumber'";
        $result = $connection->query($query);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Function to check if registration number exists in the users table
    function isValidRegistrationNumber($registrationNumber, $connection)
    {
        $query = "SELECT * FROM users WHERE registration_number = '$registrationNumber'";
        $result = $connection->query($query);

        return $result->num_rows > 0;
    }

    // Handle card clicks
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cardClicked'])) {
        $registrationNumber = $_POST['registrationNumber'];

        // Check if registration number is valid
        if (isValidRegistrationNumber($registrationNumber, $connection)) {
            // Fetch student data
            $studentData = fetchStudentData($registrationNumber, $connection);

            if ($studentData) {
                echo "<div class='card'>";
                echo "<h2>{$studentData['NAME']}</h2>";
                echo "<p>Registration Number: {$studentData['REGISTRATION_NUMBER']}</p>";
                echo "<p>Department: {$studentData['DEPARTMENT']}</p>";
                echo "<p>Year: {$studentData['YEAR']}</p>";
                echo "<button class='btn'>Click me</button>";
                echo "</div>";
            } else {
                echo "<p>No student found with the given registration number.</p>";
            }
        } else {
            echo "<p>Invalid registration number.</p>";
        }
    }

    $connection->close();
    ?>


    <div class="card">
        <h2>PROGRAMMES</h2>

        <form method="post">
            <input type="hidden" name="cardClicked" value="1">
            <input type="hidden" name="registrationNumber" value="123">
            <button class="btn" type="submit">VIEW</button>
        </form>
    </div>

    <div class="card">
        <h2>FINANCES</h2>

        <form method="post">
            <input type="hidden" name="cardClicked" value="2">
            <input type="hidden" name="registrationNumber" value="456">
            <button class="btn" type="submit">SEE</button>
        </form>
    </div>

    <div class="card">
        <h2>REPORTS</h2>

        <form method="post">
            <input type="hidden" name="cardClicked" value="3">
            <input type="hidden" name="registrationNumber" value="789">
            <button class="btn" type="submit"> VISIT </button>
        </form>
    </div>
    <div id="logout">
        <input type="submit" value="LOG OUT" onclick="student()" />
    </div>
    <script>
    function student() {
        //redirect user to the login page when they click on signout.

        return window.location = "student.html";
    }
    </script>
</body>

</html>