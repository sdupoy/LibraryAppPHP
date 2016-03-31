<?php

require_once 'SqliteLibraryRepository.php';
require_once 'Book.php';

$bookRepo = new \sdupoy\fp\SqliteLibraryRepository();

session_start();


if(!isset($_SESSION['username'])){
	header("Location: login.php");
	exit;
}else if($_SESSION['role'] != 'ADMIN'){
	header("Location: index.php");
	exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['id']) && empty($_POST['confirmation'])):
	$userId = isset($_GET['id']) ? $_GET['id'] : '';
	$user = $bookRepo->getUserById($userId);	

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<link rel="stylesheet" href="css/theme.css">
	<link rel="icon" type="image/png" href="img/book.png" />
	<title>ADMIN - Delete user - LFP</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - ADMIN - Delete user</h1>
			</div>
			<div class="small-3 column">
		<p><span class='header_content'>Hello <br><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'<br>';?> <a href="logout.php" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	<div class="container">
		<p>
		Username: <?php print $user->getUsername(); ?><br/>
		First Name: <?php print $user->getFirstName(); ?><br/>
		Last Name: <?php print $user->getLastName(); ?><br/>
		Email: <?php print $user->getEmail(); ?><br/>
		Role: <?php print $user->getRole(); ?><br/>
		
		<p>Are you sure you want to delete this user from the system ?</p>
		<form action="deleteUser.php" method="POST">
			<input type="hidden" name="id" value="<?php print $user->getId();?>">
			<input type="hidden" name="confirmation" value="1">
			<input type="submit" class="small button" value="Yes, delete the user">
		</form>
		<p><a href="index.php" class="small button">No, back to index</a></p>
		</p>
	</div>
	
	<div class="footer">
		<p>
			<span class='footer_content'>Copyright S. Dupoy. All rights reserved.</span>
		</p>
	</div>
</body>
</html>

<?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['id']) && $_POST['confirmation'] == 1):
	$user = $bookRepo->getUserById($_POST['id']);
	$bookRepo->deleteUser($_POST['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<link rel="stylesheet" href="css/theme.css">
	<link rel="icon" type="image/png" href="img/book.png" />
	<title>ADMIN - Delete user - LFP</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - ADMIN - Delete user</h1>
			</div>
			<div class="small-3 column">
		<p><span class='header_content'>Hello <br><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'<br>';?> <a href="logout.php" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	<div class="container">
		<p>User deleted</p><br/>
		<p><a href="index.php" class="small button">Back to index</a></p>
	</div>
	
	<div class="footer">
		<p>
			<span class='footer_content'>Copyright S. Dupoy. All rights reserved.</span>
		</p>
	</div>
</body>
</html>

<?php else:?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<link rel="stylesheet" href="css/theme.css">
	<link rel="icon" type="image/png" href="img/book.png" />
	<title>ADMIN - Delete user - LFP</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - ADMIN - Delete user</h1>
			</div>
			<div class="small-3 column">
		<p><span class='header_content'>Hello <br><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'<br>';?> <a href="logout.php" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	<div class="container">
		<p>Sorry, no user to delete</p><br/><br/><br/>
		<p><a href="index.php" class="small button">Back to index</a></p>
	</div>
	
	<div class="footer">
		<p>
			<span class='footer_content'>Copyright S. Dupoy. All rights reserved.</span>
		</p>
	</div>
</body>
</html>
<?php endif; ?>