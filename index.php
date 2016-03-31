<?php
require_once 'SqliteLibraryRepository.php';
require_once 'Book.php';

session_start();

$bookRepo = new \sdupoy\fp\SqliteLibraryRepository();
$bookList = $bookRepo->getAllBooks();
$cdList = $bookRepo->getAllCds();
$userList = $bookRepo->getAllUsers();

if(!isset($_SESSION['username'])){
	header("Location: login.php");
	exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<link rel="stylesheet" href="css/theme.css">
	<link rel="icon" type="image/png" href="img/book.png" />
	<title>Home - Library</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="small-9 column">
				<h1>Library Final Project</h1>
			</div>
			<div class="small-3 column">
		<p><span class='header_content'>Hello <br><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'<br>';?> <a href="logout.php" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	<div class="container">
		
		<div class="row">
			<div class="small-5 column">
				<?php if($_SESSION['role']=='LIBRARIAN' || $_SESSION['role']=='ADMIN'){ ?>
					<a href="createBook.php" class="small button">Add a new book</a>
				<?php } ?>
					<a href="showAuthorCollection.php" class="small button">Research by author</a>
					<a href="researchByTitle.php" class="small button">Research by title</a>
				<h3>All Books</h3>
				<?php
				$books = array_filter($bookList);
				if(!empty($books)){?>
				<table>
					<tr>
						<th>Title</th>
						<th>Author</th>
						<th>Year</th>
						<th>Availability</th>
					</tr>
				<?php
					foreach($bookList as $book) {
					print '<tr>';
					print '<td><a href="showBook.php?id=' . $book->getId() . '">'. $book->getTitle() .'</a></td>';
					print '<td>' . $book->getAuthor() . '</td>';
					print '<td>' . $book->getYear() . '</td>';
					print '<td>' . $book->getAvailable() . '</td>';
					print '</tr>';
					}
				?>
				</table>			
			
				<?php }else{ ?>
				</table>
				<p>Sorry, no book found.</p>
				<?php } ?>
				<br>
				<?php if($_SESSION['role']=='ADMIN'){ ?>
				<br><br><br>
					<a href="createCD.php" class="small button">Add a new CD</a>
							<a href="showCDCollection.php" class="small button">Research by author</a>
							<a href="researchCDByTitle.php" class="small button">Research by title</a>
						<h3>All CDs</h3>
						
						<?php
						$cds = array_filter($cdList);
						if(!empty($cds)){?>
						<table>
						<tr>
							<th>Title</th>
							<th>Artist</th>
							<th>Year</th>
							<th>Availability</th>
						</tr>
						<?php
							foreach($cdList as $cd) {
								print '<tr>';
								print '<td><a href="showCD.php?id=' . $cd->getId() . '">'. $cd->getTitle() .'</a></td>';
								print '<td>' . $cd->getArtist() . '</td>';
								print '<td>' . $cd->getYear() . '</td>';
								print '<td>' . $cd->getAvailable() . '</td>';
								print '</tr>';
							}
						?>
						</table>			
					
						<?php }else{ ?>
						</table>
						<p>Sorry, no cd found.</p>
						<?php } ?>
						<br>
				
				<?php }?>
			</div>
			
			<div class="small-6 column">
				<?php if($_SESSION['role']=='ADMIN'){ ?>
					<a href="createUser.php" class="small button">Create a new user</a>	
					<a href="searchUser.php" class="small button">Search user</a>	
					<h3>All Users</h3>
				<table>
				<tr>
					<th>Username</th>
					<th>Name</th>
					<th>Email</th>
					<th>Role</th>
					<th>Actions</th>
				</tr>
				<?php
					foreach($userList as $user) {
						print '<tr>';
						print '<td>' . $user->getUsername() . '</td>';
						print '<td>' . $user->getFirstName() . ' ' . $user->getLastName() . '</td>';
						print '<td>' . $user->getEmail() . '</td>';
						print '<td>' . $user->getRole() . '</td>';
						if($user->getUsername() != $_SESSION['username']){
							print '<td> <a class="alert button" href="updateUser.php?id=' . $user->getId() . '">Update</a>
										<a class="alert button" href="deleteUser.php?id=' . $user->getId() . '">Delete</a>
									</td>';
						}
						print '</tr>';
					}
				?>
				</table>
					
				<?php } else {
					if($_SESSION['role']=='LIBRARIAN'){ ?>
						<a href="createCD.php" class="small button">Add a new CD</a>
						<?php } ?>
							<a href="showCDCollection.php" class="small button">Research by author</a>
							<a href="researchCDByTitle.php" class="small button">Research by title</a>
						<h3>All CDs</h3>
						
						<?php
						$cds = array_filter($cdList);
						if(!empty($cds)){?>
						<table>
						<tr>
							<th>Title</th>
							<th>Artist</th>
							<th>Year</th>
							<th>Availability</th>
						</tr>
						<?php
							foreach($cdList as $cd) {
								print '<tr>';
								print '<td><a href="showCD.php?id=' . $cd->getId() . '">'. $cd->getTitle() .'</a></td>';
								print '<td>' . $cd->getArtist() . '</td>';
								print '<td>' . $cd->getYear() . '</td>';
								print '<td>' . $cd->getAvailable() . '</td>';
								print '</tr>';
							}
						?>
						</table>			
					
						<?php }else{ ?>
						</table>
						<p>Sorry, no cd found.</p>
						<?php } ?>
						<br>
				
				<?php }?>
			</div>
		</div>
	</div>
	
	<div class="footer">
		<p>
			<span class='footer_content'>Copyright S. Dupoy. All rights reserved.</span>
		</p>
	</div>
</body>
</html>