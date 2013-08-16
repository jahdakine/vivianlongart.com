<!-- MAIN -->
<div id="main-content">	
	<section>
		<h1 class="center half-top"><?= $title; ?></h1>
		<div id="thumbs" class="wrap">
			<?php
				$count=0;
				foreach (glob("images/$title2/*.jpg") as $filename) { 
					$image = $filename;
					$name = trim(getFileInfo($filename)); 
					$dir = trim(getFileEndPath($filename));
					$title = trim(getPart($name,0));
					$media = trim(getPart($name,1));
					if(strlen($media) !== 0) {
						$media = "($media)";
					}
					$dim = trim(getPart($name,2));
					$frame = strpos($dim, "-");
					if($frame){
						$tmp = explode("-", $dim);
						$dim = "{$tmp[0]}-Framed ({$tmp[1]})";
					}
					if(strlen(trim($dim)) !== 0) {
						$dim = $dim . "&nbsp;";			
					}
					$price = trim(getPart($name,3));
					if(strlen($price) !== 0) {
						$price = "$" .$price. "&nbsp;";
					}
					if(strlen($price) !== 0 && strlen($dim) !== 0) { $br="<br/>"; } else { $br=""; }
					$sle_dim = getPart($name,4);
					$sle_frame = strpos($sle_dim, "-");
					if($sle_frame) {
						$tmp = explode("-", $sle_dim);
						$sle_dim = "{$tmp[0]}-Framed ({$tmp[1]})";
					}					
					if(strlen($sle_dim) !== 0) {
						$sle_dim = $sle_dim . "&nbsp;&nbsp;&nbsp;";
					}					
					$sle_price = "$" . trim(getPart($name,5));						
					$sle_series = getPart($name,6);
					if(strlen($sle_series) !== 0) {
						$sle_series = $sle_series . "&nbsp;";
					}						
					$description = trim(getPart($name,7));
					$hex = getPart($name,8);
					// echo "THE NAME: " . $name . "<br/>";
					// echo $image . "<br/>";	
					// echo $dir . "<br/>";					
					// echo $title . "<br/>";
					// echo $media . "<br/>";
					// echo $dim . "<br/>";
					// echo $frame . "<br/>";
					// echo $price . "<br/>";
					// echo $sle_dim . "<br/>";
					// echo $sle_price . "<br/>";
					// echo $sle_series . "<br/>";
					// echo $description . "<br/>";
					// echo $hex . "<br/>";
					$original_callout = '
						<div class="callout half-top shade1 black" style="padding: 2px 4px;" id="original-callout'.$count.'">
						<strong>Original Artwork</strong><br/>
					';	
					$limited_callout = '
						<div class="callout half-top shade3 black" style="padding: 2px 4px;" id="limited-callout'.$count.'">
						<strong>Signed Prints</strong><br/>
					';
					$prints_callout = '
						<div class="callout half-top shade5 black" style="padding: 2px 4px;" id="prints-callout'.$count.'">
						<strong>Print on Demand</strong><br/>
						Prints, posters, greeting cards, stamps and more!<br/>
					';

					$count++;

					if ($hex[0] == 0) {
						$buy_original = $original_callout . '
							' .$dim. '
							' .$price. '
							' . $br . '
							<span class="demoted">Not available</span><br/>
							</div>
						';
					} else if ($hex[0] == 1) {
						$buy_original = $original_callout . '
							' .$dim. '
							' .$price. '
							<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post" class="half-top" target="_blank">
							<input type="hidden" name="cmd" value="_xclick">
							<input type="hidden" name="business" value="vivianlongart@gmail.com">
							<input type="hidden" name="currency_code" value="USD">
							<input type="hidden" name="item_name" value="' .  $title . ' - Original">
							<input type="hidden" name="amount" value="' . $price . '">
							<button class="myButton" name="submit" title="Open PayPal shopping cart to purchase orignal artwork in a new window.">
								<img src="assets/original-icon.png" height="32" width="32" class="icon-button" alt=""/>Buy Now
							</button>
							</form>
							</div>
						';
					}	else if ($hex[0] == 2) {
						$buy_original = $original_callout . '
							' .$dim. '
							' .$price. '
							<form name="orig" method="post" action="shipping.php" class="half-top">
							<input type="hidden" name="item" value="' .$filename. '" />
							<input type="hidden" name="type" value="1" />
							<button class="myButton" onclick="submit();" title="Open contact form to request pricing information.">
							<img src="assets/dollar-icon.png" height="32" width="32" class="icon-button" alt="" />Contact for price with shipping</button>
							</form>
							</div>
						';
					}	else {
						$buy_original = '';
					}
					if ($hex[1] == 0) {
						$buy_signed = $limited_callout . '	
							<span class="demoted">Limited Edition production run sold out</span><br/>
							</div>
						'; 
					} else if ($hex[1] == 1) {
						$buy_signed = $limited_callout . '
							Gicl&#233;e Limited Edition Series of
							' .$sle_series. '
							' .$sle_dim. '
							' .$sle_price. '&nbsp;per print
							<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post" class="half-top" target="_blank">
							<input type="hidden" name="cmd" value="_xclick">
							<input type="hidden" name="business" value="vivianlongart@gmail.com">
							<input type="hidden" name="currency_code" value="USD">
							<input type="hidden" name="item_name" value="' .  $title . ' - Signed Limited Edition Print">
							<input type="hidden" name="amount" value="' .  $sle_price . '">
							<button class="myButton" name="submit" title="Open PayPal shopping cart to purchase signed limited edition in a new window.">
								<img src="assets/signature-icon.png" height="32" width="32" class="icon-button" alt=""/>Buy Now
							</button>
							</form>
							</div>
						';
					}	else if ($hex[1] == 2) {
						$buy_signed = $limited_callout . '
							Gicl&#233;e Limited Edition Series of
							' .$sle_series. '
							' .$sle_dim. '
							' .$sle_price. 'per print						
							<form name="sle" method="post" action="shipping.php" class="half-top">
							<input type="hidden" name="item" value="' .$filename. '" />
							<input type="hidden" name="type" value="2" />
							<button class="myButton" onclick="submit();" title="Open contact form to request pricing information.">
							<img src="assets/dollar-icon.png" height="32" width="32" class="icon-button" alt="" />Contact for price with shipping</button>
							</form>
							</div>
						';							
					}	else {
						$buy_signed = '';
					}
					if ($hex[2] == 0) {
						$buy_print = $prints_callout . '
							<span class="demoted">Coming soon</span><br/>
							</div>
						'; 
					} else if ($hex[2] == 1) {
						$buy_print = $prints_callout . '
							<form name="pod" method="get" action="#" class="half-top">
							<button class="myButton" onclick="JavaScript: window.open(\'http://www.zazzle.com/vivianlongart_prints/' .$title. '\', \'_newtab\'); title=\'Open print-on-demand store in a new window to shop for prints, cards, posters and more...\';">
							<img src="assets/shopping-icon.png" height="32" width="32" class="icon-button" alt="" />Shop Now</button>
							</form>
							</div>
						';
					}	else {
						$buy_print = ''; 
					}					
		      echo '
		        <div class="box">
		          <div class="boxInner">
		            <a href="#dialog'.$count.'" class="click" id="'.$count.'">
		            	<img src="' . $image . '" alt="Image of painting entitled: ' . $title . '"  border="0"/>
		            </a>
		          </div>
		          <div id="dialog'.$count.'" title="Image information" class="dialog">
								<p style = "font-size:1.1em;padding-bottom:.1em">
									' . $title . ' ' .$media. '						
								</p>
								<figure>
									<img src="'. $image . '" alt="Image of painting entitled: ' . $title . '" />
									<figcaption>
										'. $description .'
									</figcaption>
								</figure>
								<br/>
		    				'.$buy_original.'
								'.$buy_signed.'
								'.$buy_print.'
							</div>	        
						</div>
		      ';
		    }
		  ?>	
		</div>
	</section>
	<section class="no-top callout shade4">
		<? include "images/$title2/$title1.txt"; ?>	
	</section>
	<br/>
</div> <!-- end main-content -->