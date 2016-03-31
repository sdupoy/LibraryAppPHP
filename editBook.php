<?php
require_once 'SqliteLibraryRepository.php';
require_once 'Book.php';

$bookRepo = new \sdupoy\fp\SqliteLibraryRepository();
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['id'])){
	$book = $bookRepo->getBookById($_POST['id']);
	
	if(!isset($_SESSION['username'])){
		header("Location: login.php");
		exit;
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<link rel="stylesheet" href="css/theme.css">
	<link rel="icon" type="image/png" href="img/book.png" />
	<title>Edit book - sdupoy</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - Edit book details</h1>
			</div>
			<div class="small-3 column">
		<p><span class='header_content'>Hello <br><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'<br>';?> <a href="logout.php" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['id'])){
	?>
	<div class="container">
		<form action="editBook.php" method="post">
			<input type="hidden" name="idBook" value="<?php print $_POST['id']; ?>">
			Author : <input type="text" name="author" value="<?php print $book->getAuthor();?>" required><br>
			Title : <input type="text" name="title" value="<?php print $book->getTitle();?>" required><br>
			ISBN : <input type="text" name="isbn" value="<?php print $book->getIsbn();?>" required><br>
			Year : <input type="text" name="year" value="<?php print $book->getYear();?>"><br>
			Publisher : <input type="text" name="publisher" value="<?php print $book->getPublisher();?>"><br>
			Summary : <input type="text" name="summary" value="<?php print $book->getSummary();?>"><br>
			
			Availability :  <input type="radio" name="available" value="Yes" <?php echo ($book->getAvailable()=='Yes')?'checked':''?>> Yes
							<input type="radio" name="available" value="No" <?php echo ($book->getAvailable()=='No')?'checked':''?>> No
			<input type="submit" class="small button" value="Save changes">
		</form>
	</div>
	
	<?php
	} elseif($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['idBook'])){
		
		$author = isset($_POST['author']) ? htmlspecialchars($_POST['author']) : '';
		$title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
		$isbn = isset($_POST['isbn']) ? htmlspecialchars($_POST['isbn']) : '';
		$year = isset($_POST['year']) ? htmlspecialchars($_POST['year']) : '';
		$publisher = isset($_POST['publisher']) ? htmlspecialchars($_POST['publisher']) : '';
		$summary = isset($_POST['summary']) ? htmlspecialchars($_POST['summary']) : '';
		$available = isset($_POST['available']) ? $_POST['available'] : '';

		$editedBook = $bookRepo->getBookById($_POST['idBook']);
		$editedBook->setAuthor(trim($author,"\x00..\x1F"));
		$editedBook->setTitle(trim($title,"\x00..\x1F"));
		$editedBook->setIsbn(trim($isbn,"\x00..\x1F"));
		$editedBook->setYear(trim($year,"\x00..\x1F"));
		$editedBook->setPublisher(trim($publisher,"\x00..\x1F"));
		$editedBook->setSummary(trim($summary,"\x00..\x1F"));
		$editedBook->setAvailable($available);
		$bookRepo->updateBook($editedBook);
	?>
	
	<div class="container">
		<p>Book successfuly updated<br/>
		<p>
		Author: <?php print $editedBook->getAuthor(); ?><br/>
		Title: <?php print $editedBook->getTitle(); ?><br/>
		ISBN: <?php print $editedBook->getIsbn(); ?><br/>
		Year: <?php print $editedBook->getYear(); ?><br/>
		Publisher: <?php print $editedBook->getPublisher(); ?><br/>
		Summary: <?php print $editedBook->getSummary(); ?><br/>
		Availability: <?php print $editedBook->getAvailable(); ?><br/>
		
		<p><a href="index.php" class="button">Show all books</a></p>
	</div>
	
	<?php }else{?>
	<div class="container">
		<p>Sorry, no book to edit</p><br/><br/><br/>
		<p><a href="index.php" class="small button">Show all books</a></p>
	</div>
	
	<?php } ?>
	
	<div class="footer">
		<p>
			<span class='footer_content'>Copyright S. Dupoy. All rights reserved.</span>
		</p>
	</div>
</body>
</html>
