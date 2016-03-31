<?php
require_once 'SqliteLibraryRepository.php';
require_once 'User.php';

$bookRepo = new \sdupoy\fp\SqliteLibraryRepository();

$info = isset($_GET['info']) ? $_GET['info'] : '';
$usersList = $bookRepo->searchUsers($info);

session_start();
if(!isset($_SESSION['username'])){
	header("Location: login.php");
	exit;
}else if($_SESSION['role'] != 'ADMIN'){
	header("Location: index.php");
	exit;
}


if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_GET['info'])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<link rel="stylesheet" href="css/theme.css">
	<link rel="icon" type="image/png" href="img/book.png" />
	<title>ADMIN - Search user - LFP</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - ADMIN - Search user</h1>
			</div>
			<div class="small-3 column">
		<p><span class='header_content'>Hello <br><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'<br>';?> <a href="logout.php" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	
	<div class="container">
		<h4>Please enter username, email, last name or first name.</h4>
		<form action="searchUser.php" method="get">
			Information : <input type="text" name="info"><br><br>
			<input type="submit" class="small button" value="Search">
		</form>
		
		<p><a href="index.php" class="small button">Cancel, back to the entire list</a></p>
	</div>
	
	<div class="footer">
		<p>
			<span class='footer_content'>Copyright S. Dupoy. All rights reserved.</span>
		</p>
	</div>
</body>
</html>




<?php
}elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['info'])){
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<link rel="stylesheet" href="css/theme.css">
	<link rel="icon" type="image/png" href="img/book.png" />
	<title>ADMIN - Search user - LFP</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - ADMIN - Search user</h1>
			</div>
			<div class="small-3 column">
		<p><span class='header_content'>Hello <br><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'<br>';?> <a href="logout.php" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	
	<div class="container">
		<h3>Result of the research</h3>
		
		<?php
			$users = array_filter($usersList);
			if(!empty($users)){?>
			<table>
				<tr>
					<th>Username</th>
					<th>Name</th>
					<th>Email</th>
					<th>Role</th>
					<th>Actions</th>
				</tr>
			<?php
				foreach($users as $user) {
					print '<tr>';
					print '<td>' . $user->getUsername() . '</td>';
					print '<td>' . $user->getFirstName() . ' ' . $user->getLastName() . '</td>';
					print '<td>' . $user->getEmail() . '</td>';
					print '<td>' . $user->getRole() . '</td>';
					if($user->getUsername() != $_SESSION['username']){
						print '<td> <a class="secondary button" href="updateUser.php?id=' . $user->getId() . '">Update</a>
									<a class="secondary button" href="deleteUser.php?id=' . $user->getId() . '">Delete</a>
								</td>';
					}
					print '</tr>';
				}
			?>
			</table>			
			
			 <?php }else{ ?>
			</table>
			<p>Sorry, no user found.</p>
			<?php } ?>
		
		<br>
		<p><a href="index.php" class="small button">Cancel, back to the entire list</a></p>
	</div>
	
	<div class="footer">
		<p>
			<span class='footer_content'>Copyright S. Dupoy. All rights reserved.</span>
		</p>
	</div>
</body>
</html>


<?php }else{?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<link rel="stylesheet" href="css/theme.css">
	<link rel="icon" type="image/png" href="img/book.png" />
	<title>ADMIN - Search user - LFP</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - ADMIN - Search user</h1>
			</div>
			<div class="small-3 column">
		<p><span class='header_content'>Hello <br><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'<br>';?> <a href="logout.php" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	<div class="container">
		<p>Sorry, no user to show.</p><br/><br/><br/>
		<p><a href="index.php" class="small button">Back to index</a></p>
	</div>
	
	<div class="footer">
		<p>
			<span class='footer_content'>Copyright S. Dupoy. All rights reserved.</span>
		</p>
	</div>
</body>
</html>
<?php } ?>