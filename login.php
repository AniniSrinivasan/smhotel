<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S&M Login</title>
    <link rel="stylesheet" href="login.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400" rel="stylesheet" />
    <!-- using google fonts -->
</head>

<?php
require_once("functions.php");

session_start();

$error = "";

if (isset($_POST["login"])) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $user = validateUser($username, $password, $error);

    if ($user) {
        $_SESSION["USER_ID"] = $user["USER_ID"];
        $_SESSION["USERNAME"] = $user["USERNAME"];
        $_SESSION["ROLE"] = $user["ROLE"];
        $_SESSION["EMAIL"] = $user["USER_EMAIL"];
        header("Location: dashboard.php");
        exit;
    }
}
?>

<body class="login-body">
    <div class="login-container">
        <img id="logo" src="./img/s&mhotel_logov2.png" alt="Logo of S&M Hotels">
        <h2>Welcome Back!</h2>

        <h4>Sign in to your S&M account</h4>
        <?php if (!empty($error))
            echo "<p style='color:red;'>$error</p>"; ?>
        <form id="login-form" autocomplete="off" action="login.php" method="post">
            <fieldset>
                <div class="group">
                    <label for="username">Username: </label>
                    <input type="text" id="username" name="username" minlength="5" maxlength="15" required
                        placeholder="Enter your username">
                </div>

                <div class="group">
                    <label for="password"> Password: </label>
                    <input type="password" id="password" name="password" minlength="8" required
                        placeholder="Enter your password">
                </div>
                
                <input type="submit" class="submit-btn-login" name="login" value="Login">
                <br/>
                <div class="auth-links">
                    <span>•</span>
                    <a href="login.php" class="forgot">Forgot Password?</a>
                    <span>•</span>
                    <a href="signup.php" class="signup">Register</a>
                    <span>•</span>
                </div>
            </fieldset>
        </form>
    </div>
</body>

</html>