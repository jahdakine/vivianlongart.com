<?php 
	// TO DO:
	// Add color gradations - get #hexes from Viv
	// Get content updates - H tags - from Viv
	// Check Top floater link in iphone res
	// Check footer bg in large sizes
	// 
	//Prepare vars for head.php
	$styles = array("css/menu.css","css/main.css","css/extras.css", "css/footer.css");
	// $styles = array("css/extras_combined.css");
	$title = "VivianLongArt.com - Home";
	require_once "head.php";
	require_once "funcs.php";

	include "header.html";
	include "nav.html";
?>

<?php include "_extras.html"; ?>

<?php
	//Prepare vars for footer.php
	$scripts = array("js/jquery-v1.10.2.min.js", "js/resizer.js", "js/top-link.js");
	// $scripts = array("js/index_combined.js");
	require_once "footer.php";
?>
