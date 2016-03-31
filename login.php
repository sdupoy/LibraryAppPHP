<?php
session_start();

require_once 'user.php';
require_once 'SqliteLibraryRepository.php';

$libRepo = new \sdupoy\fp\SqliteLibraryRepository();
$error = 0;
if(isset($_SESSION['username'])){
	header("Location: index.php");
	exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
	$username = trim($username);
	$password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
	$password = trim($password);
	
	
	if($libRepo->logUserIn($username,$password)==true){
		header("Location: index.php");
		exit;
	} else {
		$error = 1;
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<link rel="stylesheet" href="css/theme.css">
	<title>Final Project - Library</title>
</head>
<body>
	<div class="header">
		<h1>Final Project - Library - Login Page</h1>
    </div>
	<div class="container">
		<div class="login_content">
			<form action="#" method="POST">
				Username : <input type="text" name="username" required><br>
				Password : <input type="password" name="password" required><br>
				<?php
					if($error){
						$error=0;
				?>
				<span class='error'>Invalid username or password</span>
				<?php
					}
				?>
				<br><br>
				<input type="submit" class="button" value="Login">
				
			</form>
			<a href="clientRegistration.php" class="tiny button">Not registered yet ?</a>
		</div>
	</div>
	<div class="footer">
		<p>
			<span class='footer_content'>Copyright S. Dupoy. All rights reserved.</span>
		</p>
	</div>
</body>
</html>