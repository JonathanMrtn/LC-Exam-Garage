<?php
require_once('database/db.php');

if (empty($_SESSION['token']))
{
    header("Location: src/auth/login.php");
}
else
{
    if (!isTokenValid($_SESSION['token']))
    {
        header("Location: src/auth/login.php");
    }
    else
    {
        header("Location: src/home/dashboard.php");
    }
}
