<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Grab data
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];
    $email = $_POST["email"];

    try {
        require_once "dbh.inc.php";
        // link k filu s databází
        require_once "signup_model.inc.php";
        require_once "signup_contr.inc.php";

        // error handlers - fce v controleru
        $errors = [];

        if (is_input_empty($username, $pwd, $email)) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Invalid email used!";
        }
        if (is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "Username already taken";
        }
        if (is_email_registered($pdo, $email) ) {
            $errors["email_used"] = "Email is alredy registered!";
        }
        if (pwdMatch($pwd, $pwdRepeat) ) {
            $errors["pwd_not_match"] = "Passwords don't match!";
        }

        require_once "config_session.inc.php";

        if($errors) {
            $_SESSION["errors_signup"] = $errors;

            $signupData = [
                "username" => $username, 
                "email" => $email,
            ];
            $_SESSION["signup_data"] = $signupData;

            header("Location: ../index.php");
            die();
        }

        create_user($pdo, $username, $pwd, $email);

        header("Location: ../index.php?signup=success");

        $pdo = null;
        $stmt = null;

        die();




/*
        $query = "INSERT INTO users (username, pwd, email) 
        VALUES (:username, :pwd, :email);";
        //  ($username,$pwd, $email), :username etc = placeholder

        $stmt = $pdo->prepare($query);
        // submit the query to the database

        // hash pwd
        $options = [
            'cost' => 12
        ];
        
        $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);
        

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pwd", $hashedPwd);
        $stmt->bindParam(":email", $email);
        // propojení parametru s daty

        $stmt->execute();

        $pdo = null;
        $stmt = null;
        */

        header("Location: ../index.php");
        // send user back to the frontpage and kill the script

        die();
        // pro ukončení akce, která v sobě má connection, jinak jde použít exit()

    } catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}