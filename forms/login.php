<?php echo ""; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arte crafts</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/logo.ico" />
</head>

<body>
    <div class="container">
        <div class="form-container">
            <img src="../assets/images/logo.ico" alt="">
            <form method="POST" action="../server/login.php">
                <div>
                    <label for="email">Email</label>
                    <input type="email" required name="email">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" required name="password">
                </div>
                <input class="submit-btn-form" type="submit" name="submitform" value="Login">
            </form>
            <p>or</p>
            <div style="text-align: center;">
                <a href="./signup.php"><button class="submit-btn-form buttonform" name="buttonform">Signup</button></a>
            </div>
        </div>
    </div>
    <div class="sticky"><button><a href="../index.php"><i class="fa fa-home"></i></a></button></div>
</body>

</html>