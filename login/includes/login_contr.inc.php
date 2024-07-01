<?php

declare(strict_types=1);

function is_input_empty(string $username, string $pwd) {
    // check if everything is filled
    if (empty($username) || empty($pwd)) {
        return true;
    }
    else {
        return false;
    }
}

function is_username_wrong(bool|array $result) 
 /* pokud je result fce get_user array = existující 
    nebo bool = false, pokud username neexistuje */
{
   if (!$result) {
    return true;
   } else {
    return false;
   }
}

function is_password_wrong(string $pwd, string $hashedPwd)
{
   if (!password_verify($pwd, $hashedPwd)) {
    return true;
   } else {
    return false;
   }
}
