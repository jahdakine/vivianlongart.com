	<a href="#top" id="top-link"><i class="icon-circle-arrow-up"></i>&nbsp;Top</a>
	<footer>
		<ul class="foot">
			<li id="sharediv" class="footpad">
				<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-51dbe0cf60c12378"></script>
				<button onclick="Javascript:window.location.href='http://www.addthis.com/bookmark.php';" class="addthis_button footpad" id="share"><img src="http://s7.addthis.com/static/btn/sm-plus.gif" width="16" height="16" alt="Share" id="shareimg" />&nbsp;share</button>							
			</li>				
			<li>
				<a href="http://www.theartoftechllc.com" title="Visit TheArtOfTechLLC.com for all your website development and design needs" target="_blank">website developed by "the art of tech, llc"</a>
			</li>
			<li class="footpad">
				&copy; 2013 Vivian Long
			</li>
		</ul>
	</footer>

</div> <!-- end minwidth -->

<?php 	
	//Load appropriate passed in scripts
	if(isset($scripts)) {
		foreach($scripts as $script) {
			echo "\n\t"; 
			echo '<script type="text/javascript" src="' . $script . '"></script>'; 
		}
	}
	echo "\n";
	require_once "admin_funcs.php";
	$imgFiles = array("");
	$imageFolders = dirToArray('images');
	foreach ($imageFolders as $dirname => $dir) {
		$indentCount = 0;
		array_push($imgFiles, $dirname . ".php");
		makeArray($dir, $imgFiles);
	}
	//Build js based on current template	
	foreach($imgFiles as $dir) {
		if (basename($_SERVER['PHP_SELF']) == $dir || basename($_SERVER['PHP_SELF']) == "butterfly-series2.php") {
			echo buildMasonry();
			echo buildDialog();
		}
	}
	if (basename($_SERVER['PHP_SELF'])=="index.php") {
		echo buildGalleriaLoad();
	} 
	if(basename($_SERVER['PHP_SELF'])=="shipping.php") {
		echo buildShippingHandler();
	}
	if(basename($_SERVER['PHP_SELF'])=="_filename_generator.php") {
		echo buildFileNameGenHandler();
	}
	if(basename($_SERVER['PHP_SELF'])=="orders-and-shipping.php") {
		echo buildShippingTable();
	}
	if (basename($_SERVER['PHP_SELF'])=="book.php") {
		echo buildBooklet();
	}
?>

</body>
</html>