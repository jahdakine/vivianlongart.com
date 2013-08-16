<?php 
	//Prepare vars for head.php
	$styles = array("css/main.css","css/menu.css","css/footer.css");
	$title = "VivianLongArt.com - ADMIN - Gallery Listing";
	require_once "head.php";
	require_once "admin_funcs.php";
	include "header.html";
	include "nav.html";
?>

<!-- MAIN -->
<div id="main-content">	
	<section>
		<h1 class="center half-top">Administration</h1>
		<h2 class="center half-top">Image Gallery Generator</h2>
		<h3>Current Gallery Structure</h3>
		<div>
			<?php
				$imageFolders = dirToArray('images',1);
				//echo "<pre>";var_dump($imageFolders);echo "</pre>";
				foreach ($imageFolders as $dirname => $dir) {
					$indentCount = 0;
					echo "<strong>" . $dirname . "</strong><br>";
					printArray($dir, $indentCount);
				}
		  ?>	
		  <br>
		 <button onclick="location=href='_administrator.php';">Cancel</button>
		</div>
	</section>
	<br/>
</div> <!-- //end main-content -->

<?php
	//Prepare vars for footer.php
	$scripts = array("js/jquery-v1.10.2.min.js", "js/jquery-ui-1.9.2.custom.min.js", "js/resizer.js", "js/top-link.js");
	require_once "footer.php";
?>