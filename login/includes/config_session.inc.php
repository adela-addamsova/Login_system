<?php

ini_set('session.use_only_cookies', 1);

ini_set('session.use_strict_mode', 1);
/* use session id that has been created by server */

/*cookies parameter */
session_set_cookie_params([
    'lifetime' => 1800, /* po 30 min se cookie smaže */
    'domain' => 'localhost', /* funguje jen na doméně */
    'path' => '/', /* funguje na každé části stránky */
    'secure' => true, /* jen na https */
    'httponly' => true
]);


session_start();

if (isset($_SESSION['user_id'])) {
// if the user is logged up in the system
    if (!isset($_SESSION['last_regeneration'])) {
        /* if session id is not generated - generate it */
        regenerate_session_id_loggedin();  
    } else {
        /* regenerate session id after 30 minutes */
        $interval = 60 * 30;
        
        if (time() - $_SESSION['last_regeneration'] >= $interval) {
            regenerate_session_id_loggedin();
        }
    }
} else {
    /* checking if having session variable */
    if (!isset($_SESSION['last_regeneration'])) {
        /* if session id is not generated - generate it */
        regenerate_session_id();  
    } else {
        /* regenerate session id after 30 minutes */
        $interval = 60 * 30;
        
        if (time() - $_SESSION['last_regeneration'] >= $interval) {
            regenerate_session_id();
        }
    }    
}

function regenerate_session_id_loggedin() {
    session_regenerate_id(true);

    $userId = $_SESSION['user_id'];
    // take id from current session
    $newSessionId = session_create_id();
    // create new session id
    $sessionId = $newSessionId . "_" . $userId;
    // combine new session id with the user
    session_id($sessionId);
    // set new session id ergo update time earlies than after 30 min.

    $_SESSION['last_regeneration'] = time();
}

function regenerate_session_id() {
    session_regenerate_id();
    $_SESSION['last_regeneration'] = time();
}