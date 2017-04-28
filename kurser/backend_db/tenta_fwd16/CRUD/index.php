<?php

include_once 'config.php';

session_start();

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);
    
    if (empty($name) || empty($email) || empty($pass)) {
        echo '<p class="fail">* All fields are required</p>';
    }else {
        $sqlStatement = "INSERT INTO users(name, email, pass) VALUES(:name, :email, :pass)";
        $sqlQuery = $pdo->prepare($sqlStatement);
        $sqlQuery->bindParam(':name', $name);
        $sqlQuery->bindParam(':email', $email);
        $sqlQuery->bindParam(':pass', $pass);
        $sqlQuery->execute();
    }
}else if (isset ($_POST['login'])) {
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);
    
    $select = $pdo->prepare("SELECT * FROM users WHERE email='$email' and pass='$pass'");
    $select->setFetchMode();
    $select->execute();
    $row=$select->fetch();
    
    if($row['email']!=$email and $row['pass']!=$pass)
    {
        echo '<p class="fail">Invalid email or password</p>';
    } else if($row['email']==$email and $row['pass']==$pass)
    {
        $_SESSION['email']=$row['email'];
        $_SESSION['name']=$row['name'];
        header("location: aeroplane.php");
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Log in</title>
        <link rel="stylesheet" href="style.css" />
        
        <style>
            body {
                height: 95vh;
                display: flex;
                flex-flow: row wrap;
                justify-content: space-between;
                align-items: center;
            }

            #registerForm, #loginForm {
                padding: 85px;
            }
        </style>
    </head>
    <body>
        <div id="registerForm">
            <h2>Register</h2>
            <form method="post">
                <input type="text" name="name" placeholder="User Name"><br>
                <input type="text" name="email" placeholder="example@example.com"><br>
                <input type="password" name="pass" placeholder="password"><br>
                <input type="submit" name="register" value="register">
            </form>
        </div>
        
        <div id="loginForm">
            <h2>Log in</h2>
            <form method="post">
                <input type="text" name="email" placeholder="example@example.com"><br>
                <input type="password" name="pass" placeholder="password"><br>
                <input type="submit" name="login" value="login">
            </form>
        </div>
    </body>
</html>