<?php
require_once 'SqliteLibraryRepository.php';
require_once 'CD.php';

$cdRepo = new \sdupoy\fp\SqliteLibraryRepository();

$artist = isset($_GET['artist']) ? $_GET['artist'] : '';
$cdList = $cdRepo->getCdsByArtist($artist);

session_start();

if(!isset($_SESSION['username'])){
	header("Location: login.php");
	exit;
}


if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_GET['artist'])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<link rel="stylesheet" href="css/theme.css">
	<link rel="icon" type="image/png" href="img/book.png" />
	<title>Show artist collection - sdupoy</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - Show artist collection</h1>
			</div>
			<div class="small-3 column">
		<p><span class='header_content'>Hello <br><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'<br>';?> <a href="logout.php" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	
	<div class="container">
		<h4>Please enter an artist's name.</h4>
		<form action="showCDCollection.php" method="get">
			Artist : <input type="text" name="artist" required><br><br>
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
}elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['artist'])){
?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<link rel="stylesheet" href="css/theme.css">
	<link rel="icon" type="image/png" href="img/book.png" />
	<title>Show artist collection - sdupoy</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - Show artist collection</h1>
			</div>
			<div class="small-3 column">
		<p><span class='header_content'>Hello <br><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'<br>';?> <a href="logout.php" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	
	<div class="container">
		<h3>Artist's Books</h3>
		
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
	<title>Show artist collection - sdupoy</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - Show artist collection</h1>
			</div>
			<div class="small-3 column">
		<p><span class='header_content'>Hello <br><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'<br>';?> <a href="logout.php" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	<div class="container">
		<p>Sorry, no collection to show.</p><br/><br/><br/>
		<p><a href="index.php" class="small button">Back to all cds</a></p>
	</div>
	
	<div class="footer">
		<p>
			<span class='footer_content'>Copyright S. Dupoy. All rights reserved.</span>
		</p>
	</div>
</body>
</html>
<?php } ?>