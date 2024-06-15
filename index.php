<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once "components/config.php";

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$errors = [];
if(isset($_POST['signup'])){
    $id = create_unique_id();
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if(empty($name)){
        $errors[] = "Name is required";
    }
    if(empty($username)){
        $errors[] = "Username is required";
    } else {
        $stmt = $conn->prepare("SELECT * FROM `users` WHERE username = ?");
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0){
            $errors[] = "Username already taken";
        }
        $stmt->close();
    }
    
    if(empty($email)){
        $errors[] = "Email is required";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Invalid email format";
    } else {
        $stmt = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0){
            $errors[] = "Email already taken";
        }
        $stmt->close();
    }
    if(empty($password)){
        $errors[] = "Password is required";
    }
    if($password !== $confirm_password){
        $errors[] = "Passwords do not match";
    }

    if(empty($errors)){
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into database
        $stmt = $conn->prepare("INSERT INTO `users` (ID, Name, Username, Email, Password) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("sssss", $id, $name, $username, $email, $hashed_password);

        if($stmt->execute()){
            echo '<script>window.alert("Registration successful!")</script>';
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['loggedin']=true;
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Display errors
        foreach($errors as $error){
            echo '<script>window.alert("'.$error.'")</script>';
        }
    }
    $conn->close();
}
if (isset($_POST['signin'])) {
    $usernameOrEmail = $_POST['username_or_email'];
    $password = $_POST['password'];

    if (empty($usernameOrEmail)) {
        $errors[] = "Username or Email is required";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
    }

    if (empty($errors)) {
        // Check if the username/email exists
        $stmt = $conn->prepare("SELECT ID, Name, Username, Email, Password FROM `users` WHERE username = ? OR email = ?");
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id,$name,$username,$email, $hashed_password);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                echo '<script>window.alert("Sign-in successful!")</script>';
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['loggedin']=true;
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header("Location:index.php");
                exit;
            } else {
                $errors[] = "Incorrect password";
            }
        } else {
            $errors[] = "Username or Email not found";
        }
        $stmt->close();
    }

    if (!empty($errors)) {
        // Display errors
        foreach ($errors as $error) {
            echo '<script>window.alert("' . $error . '")</script>';
        }
    }
    $conn->close();
}

?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cohort Hive</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/index_login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <?php 
    // Include header
    include 'components/header.php';
    ?>

    <!-- Main content -->
    <div class="container">
        <div class="startSec">
            <div class="intro">
                <div class="title">Cohort Hive</div>
                <p class="subTitle">Where Developers Unite and Innovate Together</p>
            </div>
            <div class="meeting">
                <button class="btn btn-outline-secondary btn-lg btn-dark create" style="--bs-btn-font-size: 1.5rem; --bs-btn-color: white">Create a Room</button>
                <span class="midEle">or</span>
                <button class="btn btn-outline-secondary btn-lg btn-dark join" style="--bs-btn-font-size: 1.5rem; --bs-btn-color: white">Join a Room</button>
            </div>
        </div>
        <div class="createMsg meeting hide">
            <button class="close-btn">&times;</button>
            <form method="POST">
                <div class="mb-3">
                    <label for="roomName" class="form-label">Room Name</label>
                    <input type="text" class="form-control" id="roomName" name="room_name" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                </div>
                <button type="submit" name="create_room" class="btn btn-outline-secondary btn-lg btn-dark" style="--bs-btn-font-size: 1.1rem; --bs-btn-color: white">Submit</button>
            </form>
        </div>

        <div class="joinMsg meeting hide">
            <button class="close-btn">&times;</button>
            <form>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Room Name</label>
                    <input type="text" class="form-control" id="roomName" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-outline-secondary btn-lg btn-dark" style="--bs-btn-font-size: 1.1rem; --bs-btn-color: white">Submit</button>
            </form>
        </div>
        <div class="historySec"></div>
    </div>
    <?php 
    // Include footer
    include 'components/footer.php';
    ?>

    <!-- Other scripts -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="js/index.js"></script>
    <script src="js/index_login.js"></script>
</body>
</html>
