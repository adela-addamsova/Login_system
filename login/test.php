<?php
// require_once 'config_session.inc.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/reset.css">
</head>
<body>
<h1> Form</h1>
        <form action="includes/formhandler.php" method="post">
            <label for="firstname">What is your firstname?</label>
            <input id="firstname" type="text" name="firstname"
            placeholder="Firstname...">
            <label for="lastname">What is your lastname?</label>
            <input id="lastname" type="text" name="lastname"
            placeholder="Lastname...">
            <label for="favouritepet">What is your favourite pet?</label>
            <select name="favouritepet" id="favouritepet">
                <option value="Frog">Frog</option>
                <option value="Squirell">Squirell</option>
                <option value="Elephant">Elephant</option>
                <option value="Vulture">Vulture</option>
            </select>

            <button type="submit">Submit</button>
        </form> 


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);
                        ?>" method="post">
            <h1>Calculator</h1>
            <input type="number" name="num01" placeholder="Number 1">
            <select name="operator">
                <option value="add">+</option>
                <option value="subtract">-</option>
                <option value="multiply">*</option>
                <option value="devide">/</option>
                <option value="power">^</option>
                <input type="number" name="num02" placeholder="Number 2">
                <button>Calculate</button>
            </select>
        </form>

        <?php
        // Grab data
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $num01 = filter_input(
                INPUT_POST,
                "num01",
                FILTER_SANITIZE_NUMBER_FLOAT
            ); /* security */
            $num02 = filter_input(
                INPUT_POST,
                "num02",
                FILTER_SANITIZE_NUMBER_FLOAT
            );
            $operator = htmlspecialchars($_POST["operator"]);

            //Error handlers
            $errors = false;

            if (empty($num01) || empty($num02) || empty($operator)) {
                echo "<p class='calc-error'>Fill in all fields!</p>";
                $errors = true;
            }

            else if (!is_numeric($num01) || !is_numeric($num02)) {
                // if value is NOT numeric
                echo "<p class='calc-error'>Only write numbers!</p>";
                $errors = true;
            }

            // Calculate the numbers if no errors
            else if (!$errors) {
                $value = 0; 
                switch ($operator) {
                    case "add":
                        $value = $num01 + $num02;
                        echo "<p class='calc-result'>Result = " . $value . "</p>";
                        break;
                    case "subtract":
                        $value = $num01 - $num02;
                        echo "<p class='calc-result'>Result = " . $value . "</p>";
                        break;
                    case "multiply":
                        $value = $num01 * $num02;
                        echo "<p class='calc-result'>Result = " . $value . "</p>";
                        break;
                    case "divide":
                        $value = $num01 / $num02;
                        echo "<p class='calc-result'>Result = " . $value . "</p>";
                        break;
                    case "power":
                        $value = pow($num01, $num02);
                        echo "<p class='calc-result'>Result = " . $value . "</p>";
                        break; 
                    default:
                        echo "<p class='calc-error'>Something went wrong</p>";
                    
                }
                                
            
               
            }
        }

        ?>

    <h1> Random rubbish sentences </h1>
        <?php

      /*  $colors = array("green","black","yellow"); */
        // VALUES

        $colors = array(
            "green" => "grass",
            "black" => "dog",
            "yellow" => "sun");
            // KEY => VALUE

       
       
      /*  foreach ($colors as $color) {
            echo "This is " . $color . "<br>"; // volá value
        }  */

        foreach ($colors as $color => $random_word) {
            echo "This is " . $random_word . " that is " . $color .
            "<br>"; // volá value => key
        }      
        ?>


    <form action="includes/logout.inc.php" method="post">
        <button>Logout</button>
    </form> 
    
</body>
</html>