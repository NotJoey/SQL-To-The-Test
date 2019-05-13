<?php
require_once('header.php');

if(isset($_SESSION['login_user']))
{
    echo 'Welcome: ' . $_SESSION['login_user']['username'];
}
else
{
    echo 'You are not logged in!';
}
