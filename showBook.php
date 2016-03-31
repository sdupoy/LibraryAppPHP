<?php
require_once 'SqliteLibraryRepository.php';
require_once 'Book.php';

$bookRepo = new \sdupoy\fp\SqliteLibraryRepository();

$bookId = isset($_GET['id']) ? $_GET['id'] : '';
$book = $bookRepo->getBookById($bookId);

session_start();

if(!isset($_SESSION['username'])){
	header("Location: login.php");
	exit;
}

if($book):
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<link rel="stylesheet" href="css/theme.css">
	<link rel="icon" type="image/png" href="img/book.png" />
	<title>Show Book - sdupoy</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - Show book details</h1>
			</div>
			<div class="small-3 column">
		<p><span class='header_content'>Hello <br><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'<br>';?> <a href="logout.php" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	
	<div class="container">
		Author: <?php print $book->getAuthor(); ?><br/>
			Title: <?php print $book->getTitle(); ?><br/>
			ISBN: <?php print $book->getIsbn(); ?><br/>
			Year: <?php print $book->getYear(); ?><br/>
			Publisher: <?php print $book->getPublisher(); ?><br/>
			Summary: <?php print $book->getSummary(); ?><br/>	
			Availability: <?php print $book->getAvailable(); ?><br/>
		<a href="index.php" class="button">Show all books</a>
		<?php if($_SESSION['role']=='LIBRARIAN' || $_SESSION['role']=='ADMIN'){ ?>
		<form action="editBook.php" method="POST">
			<input type="hidden" name="id" value="<?php print $book->getId();?>">
			<input type="submit" class="small button" value="Edit the book">
		</form>
		<form action="deleteBook.php" method="POST">
			<input type="hidden" name="id" value="<?php print $book->getId();?>">
			<input type="submit" class="small button" value="Delete the book">
		</form>
		<?php } ?>
		
		</p>
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
	<title>Show book - sdupoy</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - Show book details</h1>
			</div>
			<div class="small-3 column">
		<p><span class='header_content'>Hello <br><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'<br>';?> <a href="logout.php" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	<div class="container">
		<p>Sorry, no book to show</p><br/><br/><br/>
		<p><a href="index.php" class="small button">Show all books</a></p>
	</div>
	
	<div class="footer">
		<p>
			<span class='footer_content'>Copyright S. Dupoy. All rights reserved.</span>
		</p>
	</div>
</body>
</html>
<?php endif;?>