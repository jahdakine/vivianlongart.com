<?php 
	//Prepare vars for head.php
	$styles = array("css/menu.css","css/main.css","css/index.css","css/gallery.css","css/bootstrap.css");
	$title = "VivianLongArt.com - ADMIN - Menu";
	require_once "head.php";
	include "header.html";
	include "nav.html";	
?>

<!-- MAIN -->
<div id="main-content" style="color:black">	
	<h2 class="half-top center">Administration</h2>
	<section>
		<ul class="indent">
			<li><a href="_filename_generator.php">Filename Generator</a></li>
      <li><a href="_gallery_listing.php">Gallery Listing</a></li>
			<li><a href="_colors.php">Color chart</a></li>
		</ul>
	</section>	
	<br/>
</div> <!-- //end main-content -->
</body>
</html>