<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arte crafts</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h1 class="welcome">Welcome back</h1>
            <form method="POST" action="../server/login.php">
                <div>
                    <label for="email">Email</label>
                    <input type="email" required name="email">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" required name="password">
                </div>
                <input type="submit" name="submitform">
            </form>
            <p class="sign-up">or sign-up with
            <p>
            <div>
                <ul>
                    <li>
                        <a href="#"><i class="fa fa-facebook"></i>Facebook</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-envelope"></i>G-mail</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-apple"></i>Apple</a>
                    </li>
                </ul>
            </div>
            <div class="signs-1">
                <a class="s" href="#">SIGN-IN<i class="fa fa-arrow-right"></i></a>
            </div>
            <div class="signs-2">
                <a class="s" href="./signup.php">SIGN-UP</a>
                <a class="s" href="#">Forgot password</a>
            </div>
        </div>
    </div>
</body>

</html>