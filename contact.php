<?php 
	//Prepare vars for head.php
	$styles = array("css/menu.css","css/main.css","css/footer.css");
	// $styles = array("css/prints_combined.css");
	$title = "VivianLongArt.com - Contact";
	require_once "head.php";
	require_once "funcs.php";

	include "header.html";
	include "nav.html";
?>

<?php include "_contact.html"; ?>

<?php
	//Prepare vars for footer.php
	$scripts = array("js/jquery-v1.10.2.min.js", "js/resizer.js", "js/top-link.js");
	// $scripts = array("js/index_combined.js");
	require_once "footer.php";
?>
