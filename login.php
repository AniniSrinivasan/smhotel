<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S&M Login</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400" rel="stylesheet" />
    <!-- using google fonts -->
</head>

<body class="login-body">
    <div class="login-container">
        <img id="logo" src="./img/s&mhotel_logov2.png" alt="Logo of S&M Hotels">
        <h2>Welcome Back!</h2>
        <h4>Sign in to your S&M account</h4>
        <form id="login-form" autocomplete="on" action="./dashboard.php" method="post">
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
                <input type="submit" class="submit-btn-login" name="submit" value="Submit">
            </fieldset>
        </form>
    </div>
</body>

</html>