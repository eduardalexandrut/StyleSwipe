<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $templateParams["titolo"] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="style/style.css" rel="stylesheet">
</head>
<body>
    <header>
        <h2>Style Swipe</h2>
        <a href="login.html">Log Out</a>
    </header>
    <nav>
        <ul>
            <li>
                <i data-name="active" class="bi-house"></i>
                <a data-name="active" href="home.html">Home</a>
            </li>
            <li >
                <i class="bi-search"></i>
                <a  href="#">Search</a>
            </li>
            <li>
                <i class="bi-plus-circle"></i>
                <a href="create.html">New Outfit</a>
            </li>
            <li data-name="hidden">
                <i class="bi-bell"></i>
                <a data-bs-toggle="modal" data-bs-target="#notifyModal" href="#">Notifications</a>
            </li>
            <li>
                <i class="bi-person"></i>
                <a href="profile.html">Profile</a>
            </li>
        </ul>
    </nav>
    <?php
    if(isset($templateParams["name"])) {
        require($templateParams["nome"]);
    }
    ?>
    
</body>
</html>
