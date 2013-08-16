<?php 
	//Prepare vars for head.php
	$styles = array("css/main.css","css/nav.css","css/menu.css","css/footer.css","css/admin.css");
	$title = "VivianLongArt.com - ADMIN - Filename Generator";
	require_once "head.php";
	require_once "admin_funcs.php";
	require_once "funcs.php";
	include "header.html";
	include "nav.html";
	//return string with spaces and line breaks replaced with dashes			
	function convertSpaces($str) {
		return str_replace(array("\r\n", "\r", "\n", " "), "-", $str); 
	}
	//Handle form submission
	if(isset($_POST['submit'])) {
		extract($_POST);
		$error = "";
		$count = 0;
		function check4BadChars($str,$elem) {
			global $error;
			$element = str_replace("sle_", "SLE - ", $elem);
			$element = str_replace("img_", "", $elem);
			if(preg_match_all("/[^a-z0-9\^\(\)\*\+\.\$\s`~!@={};,-]/i",$str,$matches)) { //~ ` ! @ $ ' ^ * ( ) + = { } ; ’ 
				//echo "<pre>";print_r($matches);echo "</pre>";
				$error .= '<li>Illegal character(s) detected in ' .(ucwords($element)). ':<ul class="indent">';
				foreach ($matches[0] as $match) {
					$error .= "<li>" . $match . "</li>";
				}
				$error .= "</ul></li>";
			}
		}
		function countChars($str) {
			global $count;
			$count += strlen($str);
			//echo "$count<br/>";
			return true;
		}
		//Parse good values, look for bad chars
		foreach($_POST as $k => $v) {
			//echo $k .":". $v ." - ";
			check4BadChars($v,$k); //Look for illegal characters in every field
			countChars($v); //Add up all fields
			if ($v != '') { 
				$parsed = convertSpaces($v);
			} else {
				$parsed = "!";
			}	
			${$k} = htmlspecialchars($parsed);
			// echo "$$k ${$k}<br/>";
		}		
		//original
		if($height==0 || $width==0) {
			$dim = "!";
		} else {
			$dim = $height ."x". $width;
		}
		if ($framed =='on') {
			$frame = convertSpaces($frame);
			$f_separator = "--";
		} else {
			$frame = "";
			$f_separator = "";
		}		
		//signed limited edition
		if($sle_height==0 || $sle_width==0) {
			$sle_dim = "!";
		} else {
			$sle_dim = $sle_height ."x". $sle_width;
		}
		if ($sle_framed =='on') {
			$sle_frame = convertSpaces($sle_frame);
			$sle_f_separator = "--";
		} else {
			$sle_frame = "";
			$sle_f_separator = "";
		}						
		//hex 	
		$hex = $otype . $stype . $ptype;

		//Error Checking
		if ($img_title == '!') {
			$error .= "<li>GENERAL: Title cannot be blank</li>";
		}
		if($height != '!' && !is_numeric($height)) {
			$error .= "<li>ORIGINAL: Height must be numeric</li>";
		}
		if($width != '!' && !is_numeric($width)) {
			$error .= "<li>ORIGINAL: Width must be numeric</li>";
		}
		if ($framed =='on' && $frame =='') {
			$error .= "<li>ORIGINAL: Frame must not be blank if Includes frame is checked</li>";
		}
		if ($framed =='on' && $frame =='!') {
			$error .= "<li>ORIGINAL: Frame must not be blank if Includes frame is checked</li>";
		}				
		if($price != '!' && !is_numeric($price)) {
			$error .= "<li>ORIGINAL: Price must be numeric</li>";
		} else if (strstr($price,".")) {
			$error .= "<li>ORIGINAL: Price must be a whole number (no decimal)</li>";
		}	
		if ($otype =='off' || $otype ==' ') {
			$error .= "<li>ORIGINAL: Button must be selected</li>";
		}						
		if($sle_height != '!' && !is_numeric($sle_height)) {
			$error .= "<li>SLE: Height must be numeric</li>";
		}
		if($sle_width != '!' && !is_numeric($sle_width)) {
			$error .= "<li>SLE: Width must be numeric</li>";
		}		
		if ($sle_framed =='on' && $sle_frame =='!') {
			$error .= "<li>SLE: Frame must not be blank if Includes frame is checked</li>";
		}		
		if($sle_price != '!' && !is_numeric($sle_price)) {
			$error .= "<li>SLE: Price must be numeric</li>";
		} else if (strstr($sle_price,".")) {
			$error .= "<li>SLE: Price must be a whole number (no decimal)</li>";
		}
		if($sle_series != '!' && !is_numeric($sle_series)) {
			$error .= "<li>SLE: Series must be numeric</li>";
		} else if (strstr($sle_series,".")) {
			$error .= "<li>SLE: Series must be a whole number (no decimal)</li>";
		}
		if ($stype =='off' || $stype ==' ') {
			$error .= "<li>SLE: Button must be selected</li>";
		}			
		if ($ptype =='off' || $ptype ==' ') {
			$error .= "<li>Prints/Posters: Button must be selected</li>";
		}				
		if($count > 210) {
			$error .= "<li>GENERAL: Total input is $count characters. Filename must not exceed 210 (includes dashes and underscores). Reduce one or more field inputs.</li>";
		}			
		//SHOW ERRORS 
		if($error) {
			echo '<aside class="callout half-top" style="color:black;background-color:red;">';
			echo '<p><strong>ERROR(S)</strong>:<ul class="indent">' .$error. "</ul></p>";
		// or BUILD STRING
		} else {
			echo '<aside class="callout shade1 half-top" style="color:black">';
			
			//generated filename:		
			$copytext = $img_title .'_'. $medium .'_'. $dim . $f_separator . $frame .'_'. $price .'_'. $sle_dim  . $sle_f_separator . $sle_frame .'_'. $sle_price .'_'. $sle_series .'_'. $description .'_'. $hex; 			
			$filename =  '<span class="_title">'. $img_title .'</span><br/><span class="_medium">'. $medium .'</span><br/><span class="_dim">'. $dim . $f_separator . $frame .'</span><br/><span class="_price">'. $price .'</span><br/><span class="_sle-dim">'. $sle_dim . $sle_f_separator . $sle_frame .'</span><br/><span class="_sle-price">'. $sle_price .'</span><br/><span class="_sle-series">'. $sle_series .'</span><br/><span class="_description">'. $description .'</span><br/><span class="_hex">'. $hex . "</span>"; 
			echo '<div id="copy"><span class="_title">Title</span>_<span class="_medium">Medium</span>_<span class="_dim">Original-Dimensions{--FrameType}</span>_<span class="_price">Price</span>_<span class="_sle-dim">SLE-Dimensions{--FrameType}</span>_<span class="_sle-price">Price</span>_<span class="_sle-series">Series</span>_<span class="_description">Description</span>_<span class="_hex">Original?SLE?Prints?</span></div>';
			echo "<br/><strong>$filename</strong><br/><br/>";
			echo '<button onclick="window.prompt (\'Copy to clipboard: Ctrl+C, Enter\', \'' . $copytext . '\');">Copy to clipboard</button>';
		}  
		echo '</aside>';
		//var_dump( get_defined_vars( ) );
	}
?>
<!-- MAIN -->
<div id="main-content" style="color:black">	
	<h2 class="half-top center">Filename Generator</h2>
	<section>
		<p class="no-top">Ensures proper formatting of filenames for images in gallery pages. All dashes and underscores will be added automagically. Check color codes to verify fields prior to copy/paste.</p>
		<aside class="callout shade5 half-top">
			<h3 class="center">Rules</h3>
			<strong>Legal characters</strong>:
			<ul class="indent">
				<li>All alphanumerics</li>
				<li>~ ` ! @ $ ^ * ( ) + = { } ; , .</li>
			</ul>
			<strong>Illegal</strong>:
			<ul style="margin-left:25px;color:red">
				<li>Copied symbols e.g. &copy; &reg; &trade; etc.</li>
				<li>[ ] &amp; &lt; &gt; \ / # % _ : | ” ' ? </li>
			</ul>
			<strong>Conversions</strong>:
			<ul class="indent">
				<li>Dashes will be stripped and replaced with spaces. To include a dash, double it (--).</li>
				<li>For an &amp;, use double plus signs (++).
				<li>For apostrophes ('), use double back-ticks (upper left on keyboard, next to ! (``)).</li>
			</ul>
			<strong>Workarounds</strong>:
			<ul class="indent">
				<li>Use No1, No2, etc instead of #1, #2.</li>
			</ul>	
			<strong>Hex Codes</strong>
			<ul class="indent">
				<li>0 = Not available</li>
				<li>1 = Buy Now</li>
				<li>2 = Contact for shipping</li>
			</ul>						
		</aside>
		<form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="one-top">
			<section class="callout shade1">
				<h3 class="half-top center">General</h3>
				<p class="demoted center">*Required</p>
				<div>
					<label for="img_title">*Title</label>:<br/>
					<input type="text" name="img_title" id="img_title" size="30" maxlength="30" value="<?= isset($img_title) && $img_title != "!" ? $img_title : ''; ?>"/>&nbsp;<span class="demoted">30 Max</span><br/>
				</div>
				<div class="one-top">			
					<label for="medium">Medium</label>:<br/>
					<input type="text" name="medium" id="medium" size="30" maxlength="30" value="<?= isset($medium) && $medium != "!" ? $medium : ''; ?>"/>&nbsp;<span class="demoted">30 Max</span><br/>
				</div>
				<section class="callout one-top">
					<h3 class="center">Original</h3>
					<p class="demoted center">&ordm;Optional</p>
					<div>
						<label for="height">Height</label>:<br/>
						<input type="text" name="height" id="height" size="5" maxlength="5" value="<?= isset($height) && $height != "!" ? $height : ''; ?>"/>&nbsp;<span class="demoted">May use decimal format (nn.nn)</span><br/>
					</div>
					<div class="one-top">
						<label for="width">Width</label>:<br/>
						<input type="text" name="width" id="width" size="5" maxlength="5" value="<?= isset($width) && $width != "!" ? $width : ''; ?>"/>&nbsp;<span class="demoted">May use decimal format (nn.nn)</span><br/>
					</div>
					<div class="one-top">
						<input type="checkbox" name="framed" id="framed" <?= isset($framed) && $framed == "on" ? 'checked="checked"' : ''; ?>/>
						<label for="framed">&ordm;Includes frame</label><br/>				
					</div>
					<div <?= isset($framed) && $framed == "on" ? 'class="on"' : 'class="off"'; ?> id="frame-elem">
						<label for="frame">Frame</label>:<br/>
						<input type="text" name="frame" id="frame" size="30" maxlength="30" value="<?= isset($frame) && $frame != "!" ? $frame : ''; ?>"/>&nbsp;<span class="demoted">30 Max</span>
					</div>
					<div class="one-top">			
						<label for="price">Price</label>:<br/>
						$<input type="text" name="price" id="price" size="4" maxlength="5" value="<?= isset($price) && $price != "!" ? $price : ''; ?>"/>&nbsp;<span class="demoted">5 Max, no decimal (leave blank if pricing unavailable)</span><br/>
					</div>
					<div class="one-top">
						*Button:<br/>
						<input type="radio" name="otype" id="otype0" value="0" <?= (isset($otype) && $otype == "0") ? 'checked="checked"' : ''; ?>/>
						<label for="otype">Not Available</label><br/>				
						<input type="radio" name="otype" id="otype1" value="1" <?= (isset($otype) && $otype == "1") ? 'checked="checked"' : ''; ?>/>
						<label for="otype">Buy Now</label><br/>				
						<input type="radio" name="otype" id="otype2" value="2" <?= (isset($otype) && $otype == "2") ? 'checked="checked"' : ''; ?>/>
						<label for="otype">Contact for Shipping</label><br/>				
						<input type="radio" name="otype" id="otype3" value="3" <?= !isset($otype) || (isset($otype) && $otype == "3") ? 'checked="checked"' : ''; ?>/>
						<label for="otype">No Button</label><br/>				
					</div>					
			  </section>
				<section class="callout one-top">
					<h3 class="half-top center">Signed Limited Edition</h3>
					<p class="demoted center">&ordm;Optional</p>
					<div>
						<label for="sle_height">Height</label>:<br/>
						<input type="text" name="sle_height" id="sle_height" size="5" maxlength="5" value="<?= isset($sle_height) && $sle_height != "!" ? $sle_height : ''; ?>"/>&nbsp;<span class="demoted">May use decimal format (nn.nn)</span><br/>
					</div>
					<div class="one-top">
						<label for="sle_width">Width</label>:<br/>
						<input type="text" name="sle_width" id="sle_width" size="5" maxlength="5" value="<?= isset($sle_width) && $sle_width != "!" ? $sle_width : ''; ?>"/>&nbsp;<span class="demoted">May use decimal format (nn.nn)</span><br/>
					</div>
					<div class="one-top">
						<input type="checkbox" name="sle_framed" id="sle_framed" <?= isset($sle_framed) && $sle_framed == "on" ? 'checked="checked"' : ''; ?>/>
						<label for="framed">&ordm;Includes frame</label><br/>				
					</div>
					<div <?= isset($sle_framed) && $sle_framed == "on" ? 'class="on"' : 'class="off"'; ?> id="sle-frame-elem">
						<label for="sle_frame">Frame</label>:<br/>
						<input type="text" name="sle_frame" id="sle_frame" size="30" maxlength="30" value="<?= isset($sle_frame) && $sle_frame != "!" ? $sle_frame : ''; ?>"/>&nbsp;<span class="demoted">30 Max</span>
					</div>					
					<div class="one-top">			
						<label for="sle_price">Price</label>:<br/>
						$<input type="text" name="sle_price" id="sle_price" size="4" maxlength="5" value="<?= isset($sle_price) && $sle_price != "!" ? $sle_price : ''; ?>"/>&nbsp;<span class="demoted">5 Max, no decimal</span><br/>
					</div>	
					<div class="one-top">			
						<label for="sle_series">Series Total</label>:<br/>
						<input type="text" name="sle_series" id="sle_series" size="3" maxlength="3" value="<?= isset($sle_series) && $sle_series != "!" ? $sle_series : ''; ?>"/>&nbsp;<span class="demoted">3 Max, no decimal</span><br/>
					</div>		
					<div class="one-top">
						*Button:<br/>
						<input type="radio" name="stype" id="stype0" value="0" <?= (isset($stype) && $stype == "0") ? 'checked="checked"' : ''; ?>/>
						<label for="stype">Not Available</label><br/>				
						<input type="radio" name="stype" id="stype1" value="1" <?= (isset($stype) && $stype == "1") ? 'checked="checked"' : ''; ?>/>
						<label for="stype">Buy Now</label><br/>				
						<input type="radio" name="stype" id="stype2" value="2" <?= (isset($stype) && $stype == "2") ? 'checked="checked"' : ''; ?>/>
						<label for="stype">Contact for Shipping</label><br/>				
						<input type="radio" name="stype" id="stype3" value="3" <?= !isset($stype) || (isset($stype) && $stype == "3") ? 'checked="checked"' : ''; ?>/>
						<label for="stype">No Button</label><br/>				
					</div>																				
				</section>
				<section class="callout one-top">
					<h3 class="half-top center">Prints/Posters</h3>
					<div class="one-top">
						*Button:<br/>
						<input type="radio" name="ptype" id="ptype0" value="0" <?= (isset($ptype) && $ptype == "0") ? 'checked="checked"' : ''; ?>/>
						<label for="ptype">Not Available</label><br/>				
						<input type="radio" name="ptype" id="ptype1" value="1" <?= (isset($ptype) && $ptype == "1") ? 'checked="checked"' : ''; ?>/>
						<label for="ptype">Buy Now</label><br/>								
						<input type="radio" name="ptype" id="ptype3" value="3" <?= !isset($ptype) || (isset($ptype) && $ptype == "3") ? 'checked="checked"' : ''; ?>/>
						<label for="ptype">No Button</label><br/>				
					</div>									
				</section>	
				<div class="one-top">			
					<label for="description">Description</label>:<br/>
					<textarea name="description" id="description" rows="3" cols="60"><?= isset($description) && $description != "!" ? $description : ''; ?></textarea><br/>
					<div class="charCount" id="countCharacter"><?= isset($description) && $description != "!" ? strlen($description) : 0; ?> characters</div>
				</div>		
				<div class="one-top">
					<button type="submit" name="submit">Generate</button>
					<button type="reset" onclick="location=href='<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>?<?= date('c')?>'">Reset Form</button>
				</div>
			</section>
		</form>
	</section>	
	<br/>
</div> <!-- //end main-content -->

<?php
	//Prepare vars for footer.php
	$scripts = array("js/jquery-v1.10.2.min.js", "js/jquery-ui-1.9.2.custom.min.js", "js/resizer.js", "js/top-link.js");
	require_once "footer.php";
?>


