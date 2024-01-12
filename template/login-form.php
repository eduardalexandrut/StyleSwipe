<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $templateParams["titolo"];?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="style/style.css" rel="stylesheet">
</head>
<body id="login">
    <div class="wrapper">
        <img src="img/logo.png" alt="logo" class="logo">
        <form action="">
            <h1>Login</h1>
            <div class="input-box">
                <ul>
                    <li>
                        <input type="email" value="" id="email" placeholder="E-mail" required/>
                        <i class="bi bi-envelope"></i>
                    </li>
                    <li>
                        <input type="password" value="" id="password1" placeholder="Password" required/>
                        <i class="bi bi-lock"></i>
                    </li>
                    <li>
                        <input type="submit" value="Sign In" class="button"/>
                    </li>
                    <li>
                        <button class="button" onclick='window.location.href="/StyleSwipe/register.php"'>Sign Up</button>
                    </li>
                </ul>
            </div>
        </form>
    </div>           
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>