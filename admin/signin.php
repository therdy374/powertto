<?php
session_start();
require_once("./inc/connect.php");

if (isset($_POST["btn_signin"])) {
    // $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // $sql = "SELECT * FROM admins WHERE email = '$email'";
    $sql = "SELECT * FROM admins WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($user) {
        if (password_verify($password, $user["password"])) {

            $_SESSION['id'] = $user['id'];
            // $_SESSION['email'] = $user['email'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['admin_level'] = $user['admin_level'];
            $_SESSION['referal_code'] = $user['referal_code'];
            $_SESSION['parent_name'] = $user['parent_name'];

            // if ($user['email']) {
            //     echo "<script>window.location.href='index.php';</script>";
            // }
            // die();

            if ($user['admin_level']) {
                switch ($user['admin_level']) {
                    case 1:
                        echo "<script>alert('Welcome Admin! Level: 1'); window.location.href = './admin_level1/index_L1.php';</script>";
                        break;
                    case 2:
                        echo "<script>alert('Welcome Admin! Level: 2'); window.location.href = './admin_level2/index_L2.php';</script>";
                        break;
                    case 3:
                        echo "<script>alert('Welcome Admin! Level: 3'); window.location.href = './admin_level3/index_L3.php';</script>";
                        break;
                    case 4:
                        echo "<script>alert('Welcome Admin! Level: 4'); window.location.href = './admin_level4/index_L4.php';</script>";
                        break;
                    case 5:
                        echo "<script>alert('Welcome Admin! Level: 5'); window.location.href = 'index.php';</script>";
                        break;
                    default:
                        echo "<script>alert('Invalid admin level!'); window.location.href = 'index.php';</script>";
                        break;
                }
            }
            die();
            
            
        } else {
            echo "<script>alert('Password does not match!')</script>";
        }
    } else {
        echo "<script>alert('Username does not exist in database!')</script>";
    }
}

if (isset($_SESSION['id'])) {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #282222;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
        }

        .login-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        .login-form button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .login-form button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Admin-Login</h2>
        <form class="login-form" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="btn_signin">Login</button>
        </form>
    </div>
</body>

</html>