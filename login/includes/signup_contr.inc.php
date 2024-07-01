<?php

declare(strict_types=1);

function is_input_empty(string $username, string $pwd, string $email) {
    // check if everything is filled
    if (empty($username) || empty($pwd) || empty($email) || empty($pwdRepeat)) {
        return true;
    }
    else {
        return false;
    }
}

function is_email_invalid(string $email) {
    // check if email is valid - buildin fce
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    else {
        return false;
    }
}

function is_username_taken(object $pdo, string $username) 
{
    // check if username is already used - fce v model
    if (get_username($pdo, $username)) {
        return true;
    }
    else {
        return false;
    }
}

function is_email_registered(object $pdo, string $email) 
{
    if (get_email($pdo, $email) ) {
        return true;
    }
    else {
        return false;
    }
}

function pwdMatch(string $pwd, string $pwdRepeat) {
    if ($pwd !== $pwdRepeat) {
        return true;
    }
    else {
        return false;
    }
}

function create_user(object $pdo, string $username, string $pwd, string $email) 
{
    set_user($pdo, $username, $pwd, $email);
}

