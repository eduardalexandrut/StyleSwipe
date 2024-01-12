<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $templateParams["title"] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" />
    <link href="style/style.css" rel="stylesheet">
</head>
<body>
    <header>
        <h2>Style Swipe</h2>
        <a href="login.php">Log Out</a>
    </header>
    <nav>
        <ul>
            <li>
                <i data-name="active" class="bi-house"></i>
                <a data-name="active" href="home.php">Home</a>
            </li>
            <li >
                <i class="bi-search" onclick="openNav()"></i>
                <a href="#" onclick="openNav()">Search</a>
            </li>
            <li>
                <i class="bi-plus-circle"></i>
                <a href="create.php">New Outfit</a>
            </li>
            <li data-name="hidden">
                <i class="bi-bell"></i>
                <a data-bs-toggle="modal" data-bs-target="#notifyModal" href="#">Notifications</a>
            </li>
            <li>
                <i class="bi-person"></i>
                <a href="profile.php">Profile</a>
            </li>
        </ul>
    </nav>
    <?php
    if(isset($templateParams["name"])) {
        require($templateParams["name"]);
    }
    ?>
</body>
</html>
