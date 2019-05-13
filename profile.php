<?php
require_once('header.php');

if(isset($_SESSION['login_user']))
{
    echo 'Username: ' . $_SESSION['login_user']['username'] . '<br>';
    echo 'First name: ' . $_SESSION['login_user']['firstname'] . '<br>';
    echo 'Last name: ' . $_SESSION['login_user']['lastname'] . '<br>';
    echo 'Email: ' . $_SESSION['login_user']['email'];
}
else
{
    echo 'You are not logged in!';
}
?>
<form action="auth.php" method="post">
    <button type="submit" name="delete">Delete account</button>
</form>
