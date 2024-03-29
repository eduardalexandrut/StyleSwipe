<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $templateParams["title"] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="style/style.css" rel="stylesheet">
</head>
<body id="registration">
    <div class="wrapper">
    <?php
        if (isset($templateParams["erroreRegistrazione"])) {
            echo '<div class="alert alert-danger" role="alert">';
            echo $templateParams["erroreRegistrazione"];
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
        }    
    ?>
        <form action="#" method="POST" enctype="multipart/form-data">
            <h1>Create Account</h1>
            <div class="input-box">
                <ul>
                    <li id="add-profile-pic">
                        <label for="profile-pic" id="profile-pic-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4"/>
                            </svg>
                            <img id="selected-image" src="#" alt="Selected Profile Picture" />
                        </label>
                        <input type="file" name="profilepic" id="profile-pic" title="profile-pic" required/>
                    </li>
                    <li>
                        <input type="text" id="username" name="username" value="" placeholder="Username" title="username" required/>
                        <i class="bi bi-person-fill"></i>
                    </li>
                    <li>
                        <input type="email" name="email" value="" id="email" placeholder="E-mail" title="email" required/>
                        <i class="bi bi-envelope"></i>
                    </li>
                    <li id="password-container">
                        <input type="password" name="password" value="" id="password" placeholder="Password" title="password" required/>
                        <i class="bi bi-lock"></i>
                        <p id="password-message"></p>
                    </li>
                    <li>
                        <input type="text" name="name" value="" id="name" placeholder="Name" title="name" required />
                        <i class="bi bi-person-fill"></i>
                    </li>
                    <li>
                        <input type="text" name="surname" value="" id="surname" placeholder="Surname" title="surname" required/>
                        <i class="bi bi-person-fill"></i>
                    </li>
                    <li>
                        <input type="date" name="dateOfBirth" id="dateOfBirth" title="dateOfBirth" required/>
                    </li>
                    <li id = "gender-wrapper">
                        <select class="select" name="gender" id="gender" title="gender" required aria-label="Gender">
                            <option value="" disabled selected hidden>Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="none">Prefer not to mention</option>
                        </select>
                    </li>
                    <li>
                        <input type="submit" value="Sign Up" class="button"/>
                    </li>
                    <li>
                        <button class="button" onclick='window.location.href="/StyleSwipe/login.php"'>Cancel</button>
                    </li>
                </ul>
            </div>
        </form>
    </div>
    <script src="js/register.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>