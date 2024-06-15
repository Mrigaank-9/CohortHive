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