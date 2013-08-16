<?php 
	//Prepare vars for head.php
	$styles = array("css/menu.css","css/main.css","css/index.css","css/footer.css");
	// $styles = array("css/index_combined.css");
	$title = "VivianLongArt.com - Home";
	require_once "head.php";
	require_once "funcs.php";
	include "header.html";
	include "nav.html";
?>

<div id="galleria" class="one-top">
	<?php
		foreach (glob("images/featured/*.jpg") as $filename) {
		  echo '<img src="' . htmlspecialchars($filename) . '" alt="' . htmlspecialchars(getPart($name,0)) . '">';
		}
  ?>
</div>

<?php include "_index.html"; ?>

<?php
	//Prepare vars for footer.php
	$scripts = array("js/jquery-v1.10.2.min.js", "galleria/js/galleria-1.2.9.min.js", "js/resizer.min.js", "js/top-link.min.js");
	// $scripts = array("js/index_combined.js", "galleria/js/galleria-1.2.9.min.js");
	require_once "footer.php";
?>
