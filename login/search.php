<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userSearch = $_POST["usersearch"];

    try {
        require_once "includes/dbh.inc.php";

        $query = "SELECT * FROM comments where username = :usersearch;";  

        $stmt = $pdo->prepare($query);
    
        $stmt->bindParam(":usersearch", $userSearch);
        
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // associative array

        $pdo = null;
        $stmt = null;
      
    } catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/reset.css">
</head>

<body>

    <section>

        <h3>Search results:</h3>

        <?php

        if (empty($results)) {
            echo "<div>";
            echo "<p>There were no results.</p>";
            echo "</div>";
        } else {
            foreach($results as $row) {
                echo "<div>";
                echo "<h4>" . htmlspecialchars($row["username"]) . "</h4>";
                echo "<p>" . htmlspecialchars($row["comment_text"]) . "</p>";
                echo "<p>" . htmlspecialchars($row["date_created"]) . "</p>";
                echo "</div>";
            }
        }

        ?>

    </section>

</body>

</html>