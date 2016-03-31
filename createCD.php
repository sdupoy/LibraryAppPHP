<?php
require_once 'CD.php';
require_once 'SqliteLibraryRepository.php';

$artist = isset($_POST['artist']) ? htmlspecialchars($_POST['artist']) : '';
$title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
$nbTracks = isset($_POST['nbTracks']) ? htmlspecialchars($_POST['nbTracks']) : '';
$year = isset($_POST['year']) ? htmlspecialchars($_POST['year']) : '';

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
	<title>Add CD - Library</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - Add CD</h1>
			</div>
			<div class="small-3 column">
		<p><span class='header_content'>Hello <br><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'<br>';?> <a href="logout.php" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	<div class="container">
		<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): 
			$bookRepo = new \sdupoy\fp\SqliteLibraryRepository();
			$cd = new \sdupoy\fp\CD();
			$cd->setArtist(trim($artist,"\x00..\x1F"));
			$cd->setTitle(trim($title,"\x00..\x1F"));
			$cd->setNbTracks(trim($nbTracks,"\x00..\x1F"));
			$cd->setYear(trim($year,"\x00..\x1F"));
			$cd->setAvailable("Yes");
			$bookRepo->createCD($cd);
			?>
			<h3> New CD added ! </h3>
			<p>
			Artist: <?php print $artist; ?><br/>
			Title: <?php print $title; ?><br/>
			Number of tracks: <?php print $nbTracks; ?><br/>
			Year: <?php print $year; ?><br/>
			<p><a href="index.php" class="small button">Show all CD</a></p>
		<?php else: ?>
			<h3> Add a new CD </h3>
			<form action="createCD.php" method="post">
				Artist : <input type="text" name="artist" required><br>
				Title : <input type="text" name="title" required><br>
				Number of tracks : <input type="int" name="nbTracks" required><br>
				Year : <input type="text" name="year"><br>
				<input type="submit" class="small button" value="Add CD">
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