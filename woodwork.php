<?php 
	//Prepare vars for head.php
	$styles = array("css/menu.css","css/main.css","css/gallery.css","css/jquery.ui.all.css","css/footer.css");	
	// $styles = array("css/gallery_combined.css","css/jquery.ui.all.css","css/footer.min.css");
	$title = "Woodwork";
	$title1 = strtolower(str_replace(" ", "-", $title));
	$title2 = $title1;

	require_once "head.php";
	require_once "funcs.php";
	
	include "header.html";
	include "nav.html";
?>

<?php include "_gallery.php"; ?>

<?php
	//Prepare vars for footer.php
	$scripts = array("js/jquery-v1.10.2.min.js","js/jquery-ui-1.9.2.custom.min.js","js/jquery.ui.core.min.js","js/jquery.ui.widget.min.js","js/jquery.ui.mouse.min.js","js/jquery.ui.draggable.min.js","js/jquery.ui.position.min.js","js/jquery.ui.resizable.min.js","js/jquery.ui.button.min.js","js/jquery.ui.dialog.min.js","js/jquery.ui.effect.min.js","js/jquery.ui.effect-blind.min.js","js/resizer.js","js/top-link.js");
	// $scripts = array("js/index_combined.js","js/jquery_combined.js");
	require_once "footer.php";
?>
