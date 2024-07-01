<?php

declare(strict_types=1);



function get_username(object $pdo, string $username) {
    $query = "SELECT username from users where username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    // bindparam = propojení s placeholderem v SQL dotazu
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    // fetch = how PDO returns the row
    return $result;
}

function get_email(object $pdo, string $email) {
    $query = "SELECT email from users where email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    // bindparam = propojení s placeholderem v SQL dotazu
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    // fetch = how PDO returns the row
    return $result;
}




function set_user(object $pdo, string $username, string $pwd, string $email) {
    $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);

    // hash pwd
    $options = [
        'cost' => 12
    ];

    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);
    

    $stmt->bindParam(":pwd", $hashedPwd);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
}




