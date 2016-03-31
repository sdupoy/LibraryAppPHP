<?php
require_once 'SqliteLibraryRepository.php';
require_once 'CD.php';

$cdRepo = new \sdupoy\fp\SqliteLibraryRepository();

$cdId = isset($_GET['id']) ? $_GET['id'] : '';
$cd = $cdRepo->getCDById($cdId);

session_start();

if(!isset($_SESSION['username'])){
	header("Location: login.php");
	exit;
}

if($cd):
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<link rel="stylesheet" href="css/theme.css">
	<link rel="icon" type="image/png" href="img/book.png" />
	<title>Show CD - sdupoy</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - Show cd details</h1>
			</div>
			<div class="small-3 column">
		<p><span class='header_content'>Hello <br><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'<br>';?> <a href="logout.php" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	
	<div class="container">
			Artist: <?php print $cd->getArtist(); ?><br/>
			Title: <?php print $cd->getTitle(); ?><br/>
			Number of tracks: <?php print $cd->getNbTracks(); ?><br/>
			Year: <?php print $cd->getYear(); ?><br/>
			Availability: <?php print $cd->getAvailable(); ?><br/>
		<a href="index.php" class="button">Show all cds</a>
		<?php if($_SESSION['role']=='LIBRARIAN' || $_SESSION['role']=='ADMIN'){ ?>
		<form action="editCD.php" method="POST">
			<input type="hidden" name="id" value="<?php print $cd->getId();?>">
			<input type="submit" class="small button" value="Edit the cd">
		</form>
		<form action="deleteCD.php" method="POST">
			<input type="hidden" name="id" value="<?php print $cd->getId();?>">
			<input type="submit" class="small button" value="Delete the cd">
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
	<title>Show cd - sdupoy</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - Show cd details</h1>
			</div>
			<div class="small-3 column">
		<p><span class='header_content'>Hello <br><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'<br>';?> <a href="logout.php" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	<div class="container">
		<p>Sorry, no cd to show</p><br/><br/><br/>
		<p><a href="index.php" class="small button">Show all cds</a></p>
	</div>
	
	<div class="footer">
		<p>
			<span class='footer_content'>Copyright S. Dupoy. All rights reserved.</span>
		</p>
	</div>
</body>
</html>
<?php endif;?>