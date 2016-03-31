<?php
require_once 'SqliteLibraryRepository.php';
require_once 'User.php';

$bookRepo = new \sdupoy\fp\SqliteLibraryRepository();
session_start();
if(!isset($_SESSION['username'])){
	header("Location: login.php");
	exit;
}else if($_SESSION['role'] != 'ADMIN'){
	header("Location: index.php");
	exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['id'])){
	$userId = isset($_GET['id']) ? $_GET['id'] : '';
	$user = $bookRepo->getUserById($userId);
}
	

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<link rel="stylesheet" href="css/theme.css">
	<link rel="icon" type="image/png" href="img/book.png" />
	<title>ADMIN - Edit user - LFP</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - ADMIN - Edit user details</h1>
			</div>
			<div class="small-3 column">
		<p><span class='header_content'>Hello <br><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'<br>';?> <a href="logout.php" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	<?php
		if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['id'])){
	?>
	<div class="container">
		<form action="updateUser.php" method="post">
			<input type="hidden" name="idUser" value="<?php print $_GET['id']; ?>">
			Username : <input type="text" name="username" value="<?php print $user->getUsername();?>" required><br>
			First Name : <input type="text" name="firstName" value="<?php print $user->getFirstName();?>" required><br>
			Last Name : <input type="text" name="lastName" value="<?php print $user->getLastName();?>" required><br>
			Password : <input type="text" name="password1"><br>
			Password confirmation : <input type="text" name="password2"><br>
			Role : <div class="styled-select">
						<select name="role">
							<option <?php echo ($user->getRole()=='ADMIN')?'selected':''?>>ADMIN</option>
							<option <?php echo ($user->getRole()=='LIBRARIAN')?'selected':''?>>LIBRARIAN</option>
							<option <?php echo ($user->getRole()=='CLIENT')?'selected':''?>>CLIENT</option>
						</select>
					</div>
			Email : <input type="text" name="email" value="<?php print $user->getEmail();?>"><br><br>
			<input type="submit" class="small button" value="Save changes">
		</form>
	</div>
	
	<?php
	} elseif($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['idUser']) && $_POST['password1'] == $_POST['password2']){
			$username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
			$firstName = isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '';
			$lastName = isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '';
			$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
			$password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
			$role = isset($_POST['role']) ? $_POST['role'] : '';
			
			$editedUser = $bookRepo->getUserById($_POST['idUser']);
	
			$editedUser->setUsername(trim($username,"\x00..\x1F"));
			$editedUser->setPassword(trim($password,"\x00..\x1F"));
			$editedUser->setFirstName(trim($firstName,"\x00..\x1F"));
			$editedUser->setLastName(trim($lastName,"\x00..\x1F"));
			$editedUser->setEmail(trim($email,"\x00..\x1F"));
			$editedUser->setRole($role);
			$bookRepo->updateUser($editedUser);
			
	?>
	
	<div class="container">
		<p>User successfuly updated<br/>
		<p>
		Username: <?php print $username; ?><br/>
		First Name: <?php print $firstName; ?><br/>
		Last Name: <?php print $lastName; ?><br/>
		Password: <?php print $password; ?><br/>
		Role: <?php print $role; ?><br/>
		Email: <?php print $email; ?><br/>
		<p><a href="index.php" class="small button">Back to index</a></p>
	</div>
	
	<?php }else{?>
	<div class="container">
		<p>Sorry, no user to edit</p><br/><br/><br/>
		<p><a href="index.php" class="small button">Back to index</a></p>
	</div>
	
	<?php } ?>
	
	<div class="footer">
		<p>
			<span class='footer_content'>Copyright S. Dupoy. All rights reserved.</span>
		</p>
	</div>
</body>
</html>
