<?php

// var_dump($_SERVER["REQUEST_METHOD"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // if user access page using post method run code
    
    $firstname = htmlspecialchars($_POST["firstname"]);
    // htmlspecialchars - security
    // udělá ze zadaných dat html entity - nejde do nich ze strany uživatele nacpat vlastní kod
    $lastname = htmlspecialchars($_POST["lastname"]);
    $favouritepet = htmlspecialchars($_POST["favouritepet"]);
   
    /*
    echo "These are the date that the user submited:";
    echo "<br>";
    echo $firstname;
    echo "<br>";
    echo $lastname;
    echo "<br>";
    echo $favouritepet; 
    */

    if (empty($firstname)) {
        exit();
        // exit if user doesn't fill and submit
        // jde použít i input required v html, ale to jde v prohlížeči obejít tím,
        // že se required odstraní (php z prohlížeče měnit nejde)
        header("Location: ../index.php");
        // returns back to the frontpage
    }

    header("Location: ../index.php");
    // returns back to the frontpage after submitting
    

}

else {
    header("Location: ../index.php");
    // returns back to the frontpage if user does anything else but filling the form
    // security
}
