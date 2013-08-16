<?php 
	//Prepare vars for head.php
	$styles = array("css/menu.css","css/main.css","css/book.css","css/footer.css","css/jquery.booklet.latest.css");
	// $styles = array("css/prints_combined.css");	
	$title = "VivianLongArt.com - Book";
	require_once "head.php";
	require_once "funcs.php";

	include "header.html";
	include "nav.html";
?>

<?php include "_book.html"; ?>

<?php
	//Prepare vars for footer.php
	$scripts = array("js/jquery-v1.10.2.min.js", "js/jquery-ui-1.9.2.custom.min.js", "js/resizer.js", "js/top-link.js","js/jquery.easing.1.3.js","js/jquery.booklet.latest.min.js");
	// $scripts = array("js/index_combined.js");
	require_once "footer.php";
?>
