<?php

require_once 'SqliteLibraryRepository.php';
require_once 'Book.php';

$bookRepo = new \sdupoy\fp\SqliteLibraryRepository();

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['id']) && empty($_POST['confirmation'])): 

$book = $bookRepo->getBookById($_POST['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<link rel="stylesheet" href="css/theme.css">
	<link rel="icon" type="image/png" href="img/book.png" />
	<title>Delete book - LFP - sdupoy</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - Delete a book</h1>
			</div>
			<div class="small-3 column">
		<p><span class='header_content'>Hello <br><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'<br>';?> <a href="logout.php" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	<div class="container">
		<p>
		Author: <?php print $book->getAuthor(); ?><br/>
		Title: <?php print $book->getTitle(); ?><br/>
		ISBN: <?php print $book->getIsbn(); ?><br/>
		Year: <?php print $book->getYear(); ?><br/>
		Publisher: <?php print $book->getPublisher(); ?><br/>
		
		<p>Are you sure you want to delete this book from the system ?</p>
		<form action="deleteBook.php" method="POST">
			<input type="hidden" name="id" value="<?php print $book->getId();?>">
			<input type="hidden" name="confirmation" value="1">
			<input type="submit" class="small button" value="Yes, delete the book">
		</form>
		<p><a href="index.php" class="small button">No, back to the list</a></p>
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
	$bookRepo->deleteBook($_POST['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<link rel="stylesheet" href="css/theme.css">
	<link rel="icon" type="image/png" href="img/book.png" />
	<title>Delete book - LFP - sdupoy</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - Delete a book</h1>
			</div>
			<div class="small-3 column">
		<p><span class='header_content'>Hello <br><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'<br>';?> <a href="logout.php" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	<div class="container">
		<p>Book deleted</p><br/>
		<p><a href="index.php" class="small button">Show all books</a></p>
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
	<title>Delete book - sdupoy</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - Delete book</h1>
			</div>
			<div class="small-3 column">
		<p><span class='header_content'>Hello <br><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'<br>';?> <a href="logout.php" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	<div class="container">
		<p>Sorry, no book to delete</p><br/><br/><br/>
		<p><a href="index.php" class="small button">Show all books</a></p>
	</div>
	
	<div class="footer">
		<p>
			<span class='footer_content'>Copyright S. Dupoy. All rights reserved.</span>
		</p>
	</div>
</body>
</html>
<?php endif; ?>