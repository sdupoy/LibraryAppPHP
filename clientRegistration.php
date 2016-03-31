<?php
require_once 'User.php';
require_once 'SqliteLibraryRepository.php';

$username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
$firstName = isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '';
$lastName = isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '';
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
session_start();
$mismatch = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['password'] != $_POST['password2']){
	$mismatch = 1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<link rel="stylesheet" href="css/theme.css">
	<link rel="icon" type="image/png" href="img/book.png" />
	<title>Create an account - LFP</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - Create an account</h1>
			</div>
			<div class="small-3 column">
		
			</div>
		</div>
	</div>
	
	<div class="registration_container">
		<?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['password'] == $_POST['password2']):
			$libRepo = new \sdupoy\fp\SqliteLibraryRepository();
			$user = new \sdupoy\fp\User();
			$user->setUsername(trim($username,"\x00..\x1F"));
			$user->setPassword(trim($password,"\x00..\x1F"));
			$user->setFirstName(trim($firstName,"\x00..\x1F"));
			$user->setLastName(trim($lastName,"\x00..\x1F"));
			$user->setEmail(trim($email,"\x00..\x1F"));
			$user->setRole("CLIENT");
			if(!($libRepo->isUserInDatabase($user->getUsername(), $user->getEmail()))){
				$libRepo->createUser($user)
			
			?>
			<h3> New user created ! </h3>
			<p>
			Username: <?php print $username; ?><br/>
			First Name: <?php print $firstName; ?><br/>
			Last Name: <?php print $lastName; ?><br/>
			Email: <?php print $email; ?><br/>
			<p><a href="login.php" class="small button">Back to log in page</a></p>
			<?php 
			}else{ ?>
			<div class="registration_error">
				<span class='error'>An error occurred, please try again.</span><br><br>
				<a href="clientRegistration.php" class="tiny button">Not registered yet ?</a>
			</div>
			<?php	
			}
			else: ?>
			<h3> Create a new account </h3>
			<form action="clientRegistration.php" method="post">
				Username : <input type="text" name="username" required><br>
				First Name : <input type="text" name="firstName" required><br>
				Last Name : <input type="text" name="lastName" required><br>
				Password : <input type="password" name="password" required><br>
				Password confirmation : <input type="password" name="password2" required><br>
				Email : <input type="text" name="email" required><br><br>
				<input type="submit" class="small button" value="Create your account">
			</form>
			<?php
			if ($mismatch){
				$mismatch=0;
			?>
			<span class='error'>Password mismatch</span>
			<?php
			}
			?>
			<a href="login.php" class="small button">Cancel, back to the login page</a>
		<?php endif; ?>
	</div>
	
	<div class="footer">
		<p>
			<span class='footer_content'>Copyright S. Dupoy. All rights reserved.</span>
		</p>
	</div>
</body>
</html>