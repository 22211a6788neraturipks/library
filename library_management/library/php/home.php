<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/carousel.css">
</head>
<body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll('.location-button');
        
        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const bookId = this.getAttribute('data-book-id');
                
                // Send AJAX request to fetch locations for the book_id
                fetch(`get_locations.php?book_id=${bookId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.locations.length > 0) {
                            let locationList = "Locations for this book:\n";
                            data.locations.forEach(location => {
                                locationList += `Floor: ${location.floor}, Rack: ${location.rack}, Direction: ${location.direction}, Serial No: ${location.serial_no}\n`;
                            });
                            alert(locationList);
                        } else {
                            alert("No locations found for this book.");
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching locations:", error);
                        alert("An error occurred while fetching locations.");
                    });
            });
        });
    });
</script>

<div class="main">
    <div class="header">
        <div class="content">
            <h1 class="h1">Book</h1>
            <h1 class="h2">Quest</h1>
        </div>
    </div>
    <div class="search">
        <form method="GET" action="">
            <input type="text" name="search" class="search_input" placeholder="Find by Book Name, Book Author" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit" class="search_button">
                <img src="./images/search_ic.png" alt="search_b" class="search_icon">
            </button>
        </form>
    </div>
</div>

<?php
    // Check if the 'search' input exists in the query string
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $searchTerm = $_GET['search'];
        
        // Database connection
        $dbServername = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "book_quest";

        $conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName, 3307);
        
        if ($conn->connect_error) {
            die("Connection Failed: " . $conn->connect_error);
        }

        // Prepare the SQL query to search for the book by name
        $sql = "SELECT book_id,book_name, book_author FROM book WHERE book_name LIKE ? OR book_author LIKE ?";
        $stmt = $conn->prepare($sql);
        $searchTerm = "%" . $searchTerm . "%";  // Adding wildcards for partial matching
        $stmt->bind_param("ss", $searchTerm, $searchTerm); // Bind both parameters (book_name and book_author)
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any results were found
        if ($result->num_rows > 0) {
            echo '<div class="search-results" style="margin:20px 0px 20px 20px;border:none; width:300px; padding: 1px 10px 1px 10px ; ">';
            while ($row = $result->fetch_assoc()) {
                $book_id = $row["book_id"];
                $book_name = $row["book_name"];
                $book_author = $row["book_author"];
                echo '<div style = "margin-bottom:10px;border:none; background-color:#edfcff; border-radius:10px; padding: 1px 10px 1px 10px ; ">';
                echo '<p style=""><strong>' . htmlspecialchars($book_name) . '</strong></p>';
                echo '<div>';
                echo '<p style="display:inline-block">' . htmlspecialchars($book_author) . '</p>';
                echo '<button class="location-button" data-book-id="' . $book_id . '" style="background:none;border:none;padding:5px;margin-left:10px;text-decoration:underline">
                        Book Locations
                    </button>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<div class="search-results no-results"><p>No results found</p></div>';
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    }
?>

<h3 class="popular_heading">Most Liked Books 💓:</h3>
    <?php 
            $dbServername = "localhost";
            $dbUsername = "root";
            $dbPassword = "";
            $dbName = "book_quest";
            
            $conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName,3307);
            if($conn->connect_error){
                die("Connection Failed: "+ $conn->connect_error);
            }
            //select the number of top most liked books
            $sql = "SELECT book_name, book_author, book_like, book_image FROM book ORDER BY book_like DESC LIMIT 6";
            $result = $conn->query($sql);
            
            if($result->num_rows>0){
                ?>
                    <ul class="gallery">
                <?php
                while($row = $result->fetch_assoc()){
                    $book_image = $row["book_image"];
                    $book_name = $row["book_name"];
                    $book_author = $row["book_author"];
                    $book_like = $row["book_like"];

                    $imageData = base64_encode($book_image);
                    $imageSrc = 'data:image/jpg;base64,' . $imageData;
                    ?>
                        <li>
                            <img src="<?php echo $imageSrc; ?>" alt="<?php echo htmlspecialchars($book_name); ?>">
                            <div class="book-info">
                                <h4><?php echo htmlspecialchars($book_name); ?></h4>
                                <p><?php echo htmlspecialchars($book_author); ?></p>
                                <span>Likes: <?php echo htmlspecialchars($book_like); ?></span>
                            </div>
                            <p class="book_name"><?php echo $book_name ?></p>
                        </li>
                    <?php
                }
                
            }
            ?>
            </ul>

    <h3 class="popular_heading">Available Books 📚:</h3>
    <?php 
            $dbServername = "localhost";
            $dbUsername = "root";
            $dbPassword = "";
            $dbName = "book_quest";
            
            $conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName,3307);
            if($conn->connect_error){
                die("Connection Failed: "+ $conn->connect_error);
            }
            $sql = "Select book_name,book_author,book_like,book_image from book";
            $result = $conn->query($sql);
            if($result->num_rows>0){
                ?>
                    <ul class="gallery">
                <?php
                while($row = $result->fetch_assoc()){
                    $book_image = $row["book_image"];
                    $book_name = $row["book_name"];
                    $book_author = $row["book_author"];
                    $book_like = $row["book_like"];

                    $imageData = base64_encode($book_image);
                    $imageSrc = 'data:image/jpg;base64,' . $imageData;
                    ?>
                        <li>
                            <img src="<?php echo $imageSrc; ?>" alt="<?php echo htmlspecialchars($book_name); ?>">
                            <div class="book-info">
                                <h4><?php echo htmlspecialchars($book_name); ?></h4>
                                <p><?php echo htmlspecialchars($book_author); ?></p>
                                <span>Likes: <?php echo htmlspecialchars($book_like); ?></span>
                            </div>
                            <p class="book_name"><?php echo $book_name ?></p>
                        </li>
                    <?php
                }
                
            }
            ?>
            </ul>
<?php
        $dbServername = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
                $dbName = "book_quest";
            
        $conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName,3307);
        if($conn->connect_error){
                die("Connection Failed: "+ $conn->connect_error);
        }
        $sql = "SELECT DISTINCT book_type FROM book";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $book_type = $row['book_type'];
                ?>
                    <h3 class="popular_heading"><?php echo $book_type ?> Books:</h3>
                <?php
                $sql_book = "SELECT  book_image FROM book WHERE book_type = ?";
                $stmt = $conn->prepare($sql_book);
                $stmt->bind_param("s", $book_type); // Bind the book_type parameter
                $stmt->execute();
                $result1 = $stmt->get_result();
                if ($result1->num_rows > 0) {
                    ?>
                        <ul class="gallery">
                    <?php
                    while ($row = $result1->fetch_assoc()) {
                        $book_image = $row["book_image"];
    
                        $imageData = base64_encode($book_image);
                        $imageSrc = 'data:image/jpg;base64,' . $imageData;
                        ?>
                            <li>
                                <img src="<?php echo $imageSrc; ?>">
                            </li>
                        <?php
                    }
                    ?>
                        </ul>
                    <?php
                }
                ?>
                    
                <?php
            }
        } else {
            echo "No results found";
        }
?>
</body>
<script src="./js/carousel.js"></script>
</html>