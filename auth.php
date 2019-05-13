<?php
require_once('header.php');
if(isset($_POST['register']))
{
    if(!empty($_POST['username']) || !empty($_POST['firstname']) || !empty($_POST['lastname']) || !empty($_POST['email']) || !empty($_POST['password']) || !empty($_POST['passwordconfirm']))
    {
        if($_POST['password'] == $_POST['passwordconfirm'])
        {
            require_once('database.php');

            $stmt = $conn->prepare("SELECT * FROM users WHERE username=:username");
            $stmt->execute(['username' => $_POST['username']]);
            $user = $stmt->fetch();

            if(!$user)
            {
                $password = hash('sha256', $_POST['password']);
                $sql = "INSERT INTO users (id, username, firstname, lastname, email, password) VALUES (?,?,?,?,?,?)";
                $conn->prepare($sql)->execute([NULL, $_POST['username'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $password]);
                header("Location: index.php");
            }
            else
            {
                $_SESSION['errMsg'] = 'Username already exists';
                header("Location: register.php");
            }
        }
        else
        {
            $_SESSION['errMsg'] = 'Passwords do not match';
            header("Location: register.php");
        }
    }
    else
    {
        $_SESSION['errMsg'] = 'Please fill in all fields!';
        header("Location: register.php");
    }

}
if(isset($_POST['login']))
{
    if(!empty($_POST['username']) || !empty($_POST['password']))
    {
        require_once('database.php');
        $password = hash('sha256', $_POST['password']);
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
        $stmt->execute([$_POST['username'], $password]);
        $user = $stmt->fetch();
        if($user)
        {
            $_SESSION['login_user'] = $user;
            header("Location: home.php");
        }
        else
        {
            $_SESSION['errMsg'] = 'Invalid login!';
            header("Location: login.php");
        }
    }
}

if(isset($_POST['change']))
{
    require_once('database.php');
    if(!empty($_POST['username']) || !empty($_POST['firstname']) || !empty($_POST['lastname']) || !empty($_POST['email']))
    {
        if(empty($_POST['oldpassword']) || empty($_POST['newpassword'])|| empty($_POST['newpasswordconfirm']))
        {
            $sql = "UPDATE users SET username=?, firstname=?, lastname=?, email=? WHERE id=?";
            $conn->prepare($sql)->execute([$_POST['username'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_SESSION['login_user']['id']]);
            $_SESSION['errMsg'] = 'Your changes have been saved!';
            header("Location: settings.php");
        }
        else
        {
            if($_POST['newpassword'] == $_POST['newpasswordconfirm'])
            {
                $stmt = $conn->prepare("SELECT password FROM users WHERE id=:id");
                $stmt->execute(['id' => $_SESSION['login_user']['id']]);
                $getpass = $stmt->fetch();
                if(hash('sha256', $_POST['oldpassword']) == $getpass['password'])
                {
                    $sql = "UPDATE users SET username=?, firstname=?, lastname=?, email=?, password=? WHERE id=?";
                    $conn->prepare($sql)->execute([$_POST['username'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], hash('sha256', $_POST['newpassword']), $_SESSION['login_user']['id']]);
                    $_SESSION['errMsg'] = 'Your changes have been saved!';
                    header("Location: settings.php");
                }
                else
                {
                    $_SESSION['errMsg'] = 'Invalid password!';
                    header("Location: settings.php");
                }
            }
            else
            {
                $_SESSION['errMsg'] = 'Your passwords dont match!';
                header("Location: settings.php");
            }

        }
    }
}

if(isset($_POST['delete']))
{
    require_once('database.php');
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['login_user']['id']]);
    $deleted = $stmt->rowCount();
    session_destroy();
    header('Location: index.php');
}