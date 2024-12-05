<?php
    if (isset($_GET['book_id'])) {
        $bookId = $_GET['book_id'];
        
        // Database connection
        $dbServername = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "book_quest";

        $conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName, 3307);

        if ($conn->connect_error) {
            die("Connection Failed: " . $conn->connect_error);
        }

        // Prepare the SQL query to fetch locations based on book_id
        $sql = "SELECT floor, rack, direction, serial_no FROM location WHERE book_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $bookId);  // Bind book_id parameter
        $stmt->execute();
        $result = $stmt->get_result();

        // Prepare the response array
        $locations = [];
        while ($row = $result->fetch_assoc()) {
            $locations[] = $row;
        }

        // Return the data as a JSON response
        echo json_encode(["locations" => $locations]);

        // Close the database connection
        $stmt->close();
        $conn->close();
    }
?>
