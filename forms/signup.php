<?php echo ""; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arte crafts</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h1>Create Account</h1>
            <form action="../server/signup.php" method="POST">
                <div>
                    <label for="Name">Name</label>
                    <input type="text" required name="name">
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" required name="email">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" required name="password">
                </div>
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
                <div class="signs">
                    <a class="s" href="#">LOG IN</a>
                    <a class="s" href="#"><input type="submit" value="SIGN-UP" name="submitform"><i
                            class="fa fa-arrow-right"></i></a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>