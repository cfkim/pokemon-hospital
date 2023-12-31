<?php
session_start();
//echo "password_hash =" . password_hash("password1", PASSWORD_BCRYPT);
require("connect-db.php");
global $db;

//when login button is clicked
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    //$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $password = $_POST['password'];
    //echo $password;
    $query = $db->prepare("select * from account WHERE username=:username");
    $query->bindParam("username", $username, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        //checking if username exists
        echo '<p class="error">Username and/or password is incorrect</p>';
    } else {
        //checking if password matches
        if (password_verify($password, $result['password'])) {
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['user'] = $result;
            //echo '<p class="success">Congratulations, you are logged in!</p>';
            header("Location: pokemonform.php");
        } else {
            echo '<p class="error">Username and/or password is incorrect</p>';
        }
    }
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Pokemon Hospital</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="css/styles.css">
    </head>
	<body>
		<div class="login">
			<h1>Pokemon Hospital</h1>
            <div style="text-align: center;">
                <img src="photos/pokemon-center.png" height="150">
            </div>
			<form action="login.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" name="login" value="Login">
			</form>
		</div>
	</body>


    <style>
        * {
            box-sizing: border-box;
            font-size: 16px;
        }
        body {
            /*background-color: #ffffff;*/
            background-image: url('photos/bg.png');
            margin: 50px auto;
            text-align: center;
            width: 800px;
        }
        .login {
            width: 400px;
            background-color: #ffffff;
            box-shadow: 0 0 9px 0 rgba(0, 0, 0, 0.3);
            margin: 100px auto;
        }
        .login h1 {
            text-align: center;
            color: #5b6574;
            font-size: 24px;
            padding: 20px 0 20px 0;
            border-bottom: 1px solid #dee0e4;
        }
        .login form {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding-top: 20px;
        }
        .login form label {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 50px;
            background-color: #3274d6;
            color: #ffffff;
        }
        .login form input[type="password"], .login form input[type="text"] {
            width: 310px;
            height: 50px;
            border: 1px solid #dee0e4;
            margin-bottom: 20px;
            padding: 0 15px;
        }
        .login form input[type="submit"] {
            width: 100%;
            padding: 15px;
            margin-top: 20px;
            background-color: #3274d6;
            border: 0;
            cursor: pointer;
            font-weight: bold;
            color: #ffffff;
            transition: background-color 0.2s;
        }
        .login form input[type="submit"]:hover {
            background-color: #2868c7;
            transition: background-color 0.2s;
        }
        p.success,
        p.error {
            color: white;
            font-family: lato;
            background: green;
            display: inline-block;
            padding: 2px 10px;
        }
        p.error {
            background: #8b0000;
        }
    </style>
</html>
