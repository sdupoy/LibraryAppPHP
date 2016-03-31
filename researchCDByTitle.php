<?php
require_once 'SqliteLibraryRepository.php';
require_once 'CD.php';

$cdRepo = new \sdupoy\fp\SqliteLibraryRepository();

$title = isset($_GET['title']) ? $_GET['title'] : '';
$cdList = $cdRepo->searchCds($title);

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
	<title>Research CD by title - sdupoy</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - Research CD by title</h1>
			</div>
			<div class="large-3 columns">
		<p><span class='header_content'>Hello <?php echo $_SESSION['username'];?> <a href="login.php?logout=yes" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	
	<div class="container">
		<h4>Please enter part or entire title.</h4>
		<form action="researchCDByTitle.php" method="get">
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
	<title>Research CD by title - sdupoy</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - Research CD by title</h1>
			</div>
			<div class="large-3 columns">
		<p><span class='header_content'>Hello <?php echo $_SESSION['username'];?> <a href="login.php?logout=yes" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	
	<div class="container">
		<h3>Result of the research</h3>
		
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
	<title>Research CD by title - sdupoy</title>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="large-9 columns">
				<h1>LFP - Research CD by title</h1>
			</div>
			<div class="large-3 columns">
		<p><span class='header_content'>Hello <?php echo $_SESSION['username'];?> <a href="login.php?logout=yes" class="small button">Logout</a></span></p>
    
			</div>
		</div>
	</div>
	
	<div class="container">
		<p>Sorry, no CD to show.</p><br/><br/><br/>
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