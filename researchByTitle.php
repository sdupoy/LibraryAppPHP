<?php
require_once 'SqliteLibraryRepository.php';
require_once 'Book.php';

$bookRepo = new \sdupoy\fp\SqliteLibraryRepository();

$title = isset($_GET['title']) ? $_GET['title'] : '';
$bookList = $bookRepo->searchBooks($title);

session_start();
if(!isset($_SESSION['username'])){
	header("Location: login.php");
	exit;
}


if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_GET['title'])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<link rel="stylesheet" href="css/theme.css">
	<link rel="icon" type="image/png" href="img/book.png" />
	<title>Research book by title - sdupoy</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - Research book by title</h1>
			</div>
			<div class="large-3 columns">
		<p><span class='header_content'>Hello <?php echo $_SESSION['username'];?> <a href="login.php?logout=yes" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	
	<div class="container">
		<h4>Please enter part or entire title.</h4>
		<form action="researchByTitle.php" method="get">
			Title : <input type="text" name="title" required><br><br>
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
}elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['title'])){
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<link rel="stylesheet" href="css/theme.css">
	<link rel="icon" type="image/png" href="img/book.png" />
	<title>Research book by title - sdupoy</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - Research book by title</h1>
			</div>
			<div class="large-3 columns">
		<p><span class='header_content'>Hello <?php echo $_SESSION['username'];?> <a href="login.php?logout=yes" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	
	<div class="container">
		<h3>Result of the research</h3>
		
		<?php
			$books = array_filter($bookList);
			if(!empty($books)){?>
			<table>
				<tr>
					<th>Title</th>
					<th>Author</th>
					<th>Year</th>
					<th>Publisher</th>
					<th>Availability</th>
				</tr>
			<?php
				foreach($bookList as $book) {
				print '<tr>';
				print '<td><a href="showBook.php?id=' . $book->getId() . '">'. $book->getTitle() .'</a></td>';
				print '<td>' . $book->getAuthor() . '</td>';
				print '<td>' . $book->getYear() . '</td>';
				print '<td>' . $book->getPublisher() . '</td>';
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
	<title>Research book by title - sdupoy</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - Research book by title</h1>
			</div>
			<div class="large-3 columns">
		<p><span class='header_content'>Hello <?php echo $_SESSION['username'];?> <a href="login.php?logout=yes" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	<div class="container">
		<p>Sorry, no book to show.</p><br/><br/><br/>
		<p><a href="index.php" class="small button">Back to all books</a></p>
	</div>
	
	<div class="footer">
		<p>
			<span class='footer_content'>Copyright S. Dupoy. All rights reserved.</span>
		</p>
	</div>
</body>
</html>
<?php } ?>