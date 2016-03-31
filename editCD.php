<?php
require_once 'SqliteLibraryRepository.php';
require_once 'CD.php';

$cdRepo = new \sdupoy\fp\SqliteLibraryRepository();
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['id'])){
	$cd = $cdRepo->getCDById($_POST['id']);
	
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
	<title>Edit CD - sdupoy</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - Edit CD details</h1>
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
		<form action="editCD.php" method="post">
			<input type="hidden" name="idCD" value="<?php print $_POST['id']; ?>">
			Artist : <input type="text" name="artist" value="<?php print $cd->getArtist();?>" required><br>
			Title : <input type="text" name="title" value="<?php print $cd->getTitle();?>" required><br>
			Number of tracks : <input type="text" name="nbTracks" value="<?php print $cd->getNbTracks();?>" required><br>
			Year : <input type="text" name="year" value="<?php print $cd->getYear();?>"><br>
			
			Availability :  <input type="radio" name="available" value="Yes" <?php echo ($cd->getAvailable()=='Yes')?'checked':''?>> Yes
							<input type="radio" name="available" value="No" <?php echo ($cd->getAvailable()=='No')?'checked':''?>> No
			<input type="submit" class="small button" value="Save changes">
		</form>
	</div>
	
	<?php
	} elseif($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['idCD'])){
		
		$artist = isset($_POST['artist']) ? htmlspecialchars($_POST['artist']) : '';
		$title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
		$nbTracks = isset($_POST['nbTracks']) ? htmlspecialchars($_POST['nbTracks']) : '';
		$year = isset($_POST['year']) ? htmlspecialchars($_POST['year']) : '';
		$available = isset($_POST['available']) ? $_POST['available'] : '';

		$editedCD = $cdRepo->getCDById($_POST['idCD']);
		$editedCD->setArtist(trim($artist,"\x00..\x1F"));
		$editedCD->setTitle(trim($title,"\x00..\x1F"));
		$editedCD->setNbTracks(trim($nbTracks,"\x00..\x1F"));
		$editedCD->setYear(trim($year,"\x00..\x1F"));
		$editedCD->setAvailable($available);
		$cdRepo->updateCD($editedCD);
	?>
	
	<div class="container">
		<p>CD successfuly updated<br/>
		<p>
		Artist: <?php print $editedCD->getArtist(); ?><br/>
		Title: <?php print $editedCD->getTitle(); ?><br/>
		Number of tracks: <?php print $editedCD->getNbTracks(); ?><br/>
		Year: <?php print $editedCD->getYear(); ?><br/>
		Availability: <?php print $editedCD->getAvailable(); ?><br/>
		
		<p><a href="index.php" class="button">Show all cds</a></p>
	</div>
	
	<?php }else{?>
	<div class="container">
		<p>Sorry, no CD to edit</p><br/><br/><br/>
		<p><a href="index.php" class="small button">Show all cds</a></p>
	</div>
	
	<?php } ?>
	
	<div class="footer">
		<p>
			<span class='footer_content'>Copyright S. Dupoy. All rights reserved.</span>
		</p>
	</div>
</body>
</html>
