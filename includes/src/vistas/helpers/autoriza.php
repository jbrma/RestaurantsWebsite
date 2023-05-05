<?php

function isLogged()
{
    return isset($_SESSION['username']);
}

function sameUser($username)
{
    return isLogged() && $_SESSION['username'] == $username;
}

function usernameLogged()
{
    return $_SESSION['username'] ?? false;
}

function verifLogged($urlNoLog)
{
    if (! isLogged()) {
        Utils::redirige($urlNoLog);
    }
}
