<?php require_once('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .register-form {
            width: 340px;
            margin: 50px auto;
        }
        .register-form form {
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }
        .register-form h2 {
            margin: 0 0 15px;
        }
        .form-control, .btn {
            min-height: 38px;
            border-radius: 2px;
        }
        .btn {
            font-size: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php
if (isset($_SESSION['errMsg'])):
?>
    <div class="alert alert-warning" role="alert">
        <?php echo $_SESSION['errMsg']; ?>
    </div>
<?php
    unset($_SESSION["errMsg"]);
endif;
?>
<div class="register-form">
    <form action="auth.php" method="post">
        <h2 class="text-center">Register</h2>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" name="username">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="First name" name="firstname">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Last name" name="lastname">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" placeholder="Email" name="email">
        </div>
        <div class="form-group">
            <input pattern=".{6,}" type="password" class="form-control" placeholder="Password" name="password">
        </div>
        <div class="form-group">
            <input pattern=".{6,}" type="password" class="form-control" placeholder="Confirm password" name="passwordconfirm">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" name="register">Register</button>
        </div>
    </form>
    <p class="text-center"><a href="login.php">Already have an account?</a></p>
</div>
</body>