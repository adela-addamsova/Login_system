<?php

declare(strict_types=1);

function get_user(object $pdo, string $username) 
{
    $query = "SELECT * from users where username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    // bindparam = propojení s placeholderem v SQL dotazu
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    // fetch = how PDO returns the row
    return $result;
}