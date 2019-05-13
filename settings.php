<?php
require_once('header.php');
if(isset($_SESSION['login_user']['username'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Change Form</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style type="text/css">
            .change-form {
                width: 340px;
                margin: 50px auto;
            }

            .change-form form {
                margin-bottom: 15px;
                background: #f7f7f7;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                padding: 30px;
            }

            .change-form h2 {
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
    <div class="change-form">
        <form action="auth.php" method="post">
            <h2 class="text-center">Change</h2>
            <div class="form-group">
                <input type="text" class="form-control" value="<?php echo $_SESSION['login_user']['username']; ?>" placeholder="Username" name="username">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" value="<?php echo $_SESSION['login_user']['firstname']; ?>" placeholder="First name" name="firstname">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" value="<?php echo $_SESSION['login_user']['lastname']; ?>" placeholder="Last name"name="lastname">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" value="<?php echo $_SESSION['login_user']['email']; ?>" placeholder="Email" name="email">
            </div>
            <div class="form-group">
                <input pattern=".{6,}" type="password" class="form-control" placeholder="Old password" name="oldpassword">
            </div>
            <div class="form-group">
                <input pattern=".{6,}" type="password" class="form-control" placeholder="New password" name="newpassword">
            </div>
            <div class="form-group">
                <input pattern=".{6,}" type="password" class="form-control" placeholder="Confirm new password" name="newpasswordconfirm">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="change">Change</button>
            </div>
        </form>
    </div>
    </body>
    <?php
}
else
{
    echo 'You are not logged in!';
}
?>