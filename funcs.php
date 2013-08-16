<?php
	//filename format: 0Title_1Dim--{FrameType}_2Media_3Price_4SLE-Dim--{FrameType}_5SLE-Price_6SLE-Series_7Description_201.jpg (where {} is optional)	
	//Returns useable string from image filename
	function getFileInfo($str) {
		$last_slash = strrpos($str, "/")+1; //strip path
		$tmp = substr($str, $last_slash, -4); // remove extension
		$tmp1 = str_replace("--", "|", $tmp); //preserve dash when double is encountered, step 1
		$tmp2 = str_replace("''", '"', $tmp1); //make dquote when 2 quotes are encountered
		$tmp3 = str_replace("-", " ", $tmp2); //replace dashes with spaces
		$tmp4 = str_replace("++", "&", $tmp3); //workaround - replace ++ with ampersand
		$tmp5 = str_replace("``", "'", $tmp4); //workaround - replace `` with '
		return str_replace("|", "-", $tmp5); //preserve dash when double is encountered, step 2 and return clean filename
	}
	function getFileEndPath($str) {
		$last_slash = strrpos($str, "/");
		$tmp = substr($str, 0, $last_slash);
		$tmp1 = explode("/", $tmp);
		return end($tmp1);
	}
	//given filename array delimited by underscores, return string at given position
	function getPart($str,$pos=0) {
		$tmp = explode("_", $str);
		if($tmp[$pos] == "!") {
			return "
			";
		} else {
			return $tmp[$pos];
		}		
	}		
	function cleanse($str) { 
		$tmp = htmlspecialchars($str);
		$cleansed = strip_tags($str);
		return $cleansed;
	}	
	function buildBooklet() {
		echo '
		<script type="text/javascript">
			$(function() {
				var windowWidth = $(window).width(),
						myBook = $("#mybook");
				if(windowWidth > 720) {
			    myBook.booklet({
			        arrows: true
			    });
				} else {
					console.log("deactivate");
				}
			});
    </script>
   ';
	}
	//Config for shipping table
	function buildShippingTable() {
		return "
			<script>
				window.onload=function(){
					var tfrow = document.getElementById('tfhover').rows.length;
					var tbRow=[];
					for (var i=1;i<tfrow;i++) {
						tbRow[i]=document.getElementById('tfhover').rows[i];
						tbRow[i].onmouseover = function() {
						  $(this).addClass('d2');
						};
						tbRow[i].onmouseout = function() {

						  $(this).removeClass('d2');
						};
					}
				};
			</script>
		";
	}
	//Config options for Galleria
	function buildGalleriaLoad() {
		return "
			<script>
			Galleria.loadTheme('galleria/themes/classic/galleria.classic.min.js');
		  	Galleria.run('#galleria', {
    		maxScaleRatio: 1,
    		imageMargin: 12,
    		thumbFit:false,
				thumbCrop:false
			});	
			</script>
		";		
	}
	//Config options for dialogs
	//maxHeight: 1000,
	function buildDialog() {
	return "
				<script>
				$(function(){
					var dialogs=$('[id^=\"dialog\"]').length;
					for (var i=1;i<=dialogs;i++) {
						$('#dialog'+i).dialog({
							resizable: true,
							width: 'auto',
							modal: true,
							autoOpen: false,
							show: {
								effect: 'blind',
								duration: 1000
							},
							hide: {
								effect: 'blind',
								duration: 1000
							}
						});
					}
					$('.click').on('click', function() {
						//IF PHONE OPEN NEW WINDOW
						var windowWidth = $(window).width();
						if(windowWidth < 480) {
							var w = window.open(),
									html = '<!DOCTYPE html> <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\"> <head> <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\"> <title>VivianLongArt.com - Purchase Art</title> <link rel=\"stylesheet\" type=\"text/css\" href=\"css/main.css\"/> <link rel=\"stylesheet\" type=\"text/css\" href=\"css/index.css\"/> <link rel=\"stylesheet\" type=\"text/css\" href=\"css/gallery.css\"/> </head> <body> <div class=\"minwidth\"> <!-- HEADER --> <div class=\"wrapper\"> <div id=\"outer\"> <div id=\"wrap-cl\"> <div id=\"center\"> <div> <h1 id=\"tag-line\" class=\"center\">VivianLongArt.com</h1> </div> <!-- end in center div --> </div> <!-- end center div --> <div id=\"left\"> <div> <img src=\"assets/header-left.jpg\" height=\"200\" class=\"center\" alt=\"Header image logo Artworks\"/> </div> <!-- end in left div --> </div> <!-- end left div --> </div> <!-- end wrap-center-left div --> <div id=\"right\"> <div> <img src=\"assets/header-right.jpg\" height=\"200\" class=\"center\" alt=\"Header image of dog in field\"/> </div>  <!-- end in right div --> </div> <!-- end right div --> <br class=\"clear\" /> </div> <!-- end outer div --> </div> <!-- end wrapper div --> <!-- MAIN --> <div id=\"main-content\">' + $('#dialog'+this.id).html() + '<div class=\"clear\"></div> </div> <!-- end main-content --> </div> <!-- end minwidth --> </body> </html>';
							w.document.open();
							w.document.write(html);
							w.document.close();
						//OTHER SCREENS OPEN MODAL
						} else {
							$('#dialog'+this.id).dialog('open');

						}
					});
				});
			</script>
		";
	}
	//Config options for image grid
	function buildMasonry() {
		return "
			<script type='text/javascript'>
		    //Masonry Grid
		    $(function(){
		      // See if this is a touch device
		      if ('ontouchstart' in window)
		      {
		        // Set the correct body class
		        $('body').removeClass('no-touch').addClass('touch');
		        
		        // Add the touch toggle to show text
		        $('div.boxInner img').click(function(){
		          $(this).closest('.boxInner').toggleClass('touchFocus');
		        });
		      }
		    });
			</script>
		";
	}
	//Config Shipping form handler
	function buildShippingHandler() {
		return "
			<script>
			(function() {
				var radio1 = $('#option1'),
						radio2 = $('#option2'),
						elem = $('#textarea');
				radio1.on('click', function() {  
					if($(this).is(':checked')) { console.log('OFF');
						elem.removeClass().addClass('off');
					}
				});
				radio2.on('click', function() {  
					if($(this).is(':checked')) {
						elem.removeClass().addClass('on');
					}		
				});
				function CountLeft(text, max) {
					if (text.val().length > max)
						text.val(text.val().substring(0, max));
					else
						$('.charLeft').html((max - text.val().length) + ' characters left');
					}
					$('#info').keyup(
					function (event) {
						CountLeft($(this), 500);
					}
				); 	
			})();
		</script>
		";
	}
	//Config Filename Gen form handler
	function buildFileNameGenHandler(){
		return "
			<script>
				(function() {
					var framed = $('#framed'),
							div = $('#frame-elem'),
							elem = $('#frame'),
							sle_framed = $('#sle_framed'),
							sle_div = $('#sle-frame-elem'),
							sle_elem = $('#sle_frame');
					framed.on('click', function() {  
						if($(this).is(':checked')) {
							div.removeClass();
							div.addClass('on');
						} else {
							div.removeClass();
							div.addClass('off');
							elem.val('');
						}
					});
					sle_framed.on('click', function() {  
						if($(this).is(':checked')) {
							sle_div.removeClass();
							sle_div.addClass('on');
						} else {
							sle_div.removeClass();
							sle_div.addClass('off');
							sle_elem.val('');
						}
					});	
					function countTotal(text) {
						$('.charCount').html((text.val().length) + ' characters');
					}
					$('#description').keyup(
						function (event) {
							countTotal($(this));
						}
					); 	
				})();
				//0Title_1Medium_2Dim{--Type}_3Price_4SLE-Dim{--Type}_5SLE-Price_6SLE-Series_7Description_101
				//30_27_7+26_5_7+18_5_4_70_3 = 210
			</script>
		";
	}

	// * Function responsible for sending unicode emails.
	// *
	// * @author Gajus Kuizinas <g.kuizinas@anuary.com>
	// * @version 1.0.1 (2012 01 11)
	function mail_send($arr)
	{
	    if (!isset($arr['to_email'], $arr['from_email'], $arr['subject'], $arr['message'])) {
	        throw new HelperException('mail(); not all parameters provided.');
	    }
	   
	    $to = empty($arr['to_name']) ? $arr['to_email'] : '"' . mb_encode_mimeheader($arr['to_name']) . '" <' . $arr['to_email'] . '>';
	    $from = empty($arr['from_name']) ? $arr['from_email'] : '"' . mb_encode_mimeheader($arr['from_name']) . '" <' . $arr['from_email'] . '>';
	   
	    $headers = array
	    (
	        'MIME-Version: 1.0',
	        'Content-Type: text/html; charset="UTF-8";',
	        'Content-Transfer-Encoding: 7bit',
	        'Date: ' . date('r', $_SERVER['REQUEST_TIME']),
	        'Message-ID: <' . $_SERVER['REQUEST_TIME'] . md5($_SERVER['REQUEST_TIME']) . '@' . $_SERVER['SERVER_NAME'] . '>',
	        'From: ' . $from,
	        'Reply-To: ' . $from,
	        'Return-Path: ' . $from,
	        'X-Mailer: PHP v' . phpversion(),
	        'X-Originating-IP: ' . $_SERVER['SERVER_ADDR'],
	    );
	   
	    mail($to, '=?UTF-8?B?' . base64_encode($arr['subject']) . '?=', $arr['message'], implode("\n", $headers));
	}
