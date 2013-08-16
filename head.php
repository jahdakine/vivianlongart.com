<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		echo '<title>VivianLongArt.com - '. $title .'</title>';
		if(isset($styles)) {
			foreach($styles as $style) {
				echo "\n\t"; 
				echo '<link rel="stylesheet" type="text/css" href="' . $style . '"/>'; 
			}
		}
		echo "\n"; 
	?>

	<script type="text/javascript" src="js/modernizr.custom.02678.js"></script>	
	<!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="menu-ie.min.css" /><![endif]-->
</head>

<?php
// 	if(basename($_SERVER['PHP_SELF'])[0]==='_') {
// 		echo '<body class="admin">';
// 	} else {
// 		echo '<body class="no-touch">';
// 	}	
?>
<body class="no-touch">