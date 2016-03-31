<?php
require_once 'Book.php';
require_once 'SqliteLibraryRepository.php';

$author = isset($_POST['author']) ? htmlspecialchars($_POST['author']) : '';
$title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
$isbn = isset($_POST['isbn']) ? htmlspecialchars($_POST['isbn']) : '';
$year = isset($_POST['year']) ? htmlspecialchars($_POST['year']) : '';
$publisher = isset($_POST['publisher']) ? htmlspecialchars($_POST['publisher']) : '';
$summary = isset($_POST['summary']) ? htmlspecialchars($_POST['summary']) : '';

session_start();

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
	<title>Add book - Library</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - Add book</h1>
			</div>
			<div class="small-3 column">
		<p><span class='header_content'>Hello <br><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'<br>';?> <a href="logout.php" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	<div class="container">
		<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): 
			$bookRepo = new \sdupoy\fp\SqliteLibraryRepository();
			$book = new \sdupoy\fp\Book();
			$book->setAuthor(trim($author,"\x00..\x1F"));
			$book->setTitle(trim($title,"\x00..\x1F"));
			$book->setIsbn(trim($isbn,"\x00..\x1F"));
			$book->setYear(trim($year,"\x00..\x1F"));
			$book->setPublisher(trim($publisher,"\x00..\x1F"));
			$book->setSummary(trim($summary,"\x00..\x1F"));
			$book->setAvailable("Yes");
			$bookRepo->createBook($book);
			?>
			<h3> New book added ! </h3>
			<p>
			Author: <?php print $author; ?><br/>
			Title: <?php print $title; ?><br/>
			ISBN: <?php print $isbn; ?><br/>
			Year: <?php print $year; ?><br/>
			Publisher: <?php print $publisher; ?><br/>
			Summary: <?php print $summary; ?><br/>
			<p><a href="index.php" class="small button">Show all books</a></p>
		<?php else: ?>
			<h3> Add a new book </h3>
			<form action="createBook.php" method="post">
				Author : <input type="text" name="author" required><br>
				Title : <input type="text" name="title" required><br>
				ISBN : <input type="text" name="isbn" required><br>
				Year : <input type="text" name="year"><br>
				Publisher : <input type="text" name="publisher"><br>
				Summary : <input type="text" name="summary"><br>
				<input type="submit" class="small button" value="Add book">
			</form>
			
			<p><a href="index.php" class="small button">Cancel, back to the list</a></p>
		<?php endif; ?>
	</div>
	
	<div class="footer">
		<p>
			<span class='footer_content'>Copyright S. Dupoy. All rights reserved.</span>
		</p>
	</div>
</body>
</html>