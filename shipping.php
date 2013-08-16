<?php
	if( !isset($_POST['item']) || !isset($_POST['type']) ) {
		header('Location: index.php');
	}
	//Prepare vars for head.php
	$styles = array("css/main.css","css/menu.css","css/shipping.css","css/footer.css");
	// $styles = array("css/prints_combined.css");	
	$title = "VivianLongArt.com - Shipping";
	require_once "head.php";
	require_once "funcs.php";
	include "header.html";
	include "nav.html";
	require_once "states.php";
	$image = htmlspecialchars($_POST['item']); 
	$dirpath = htmlspecialchars(getFileEndPath($_POST['item']));
	$filename = htmlspecialchars(getFileInfo($_POST['item']));
	$title = htmlspecialchars(getPart($filename,0));
	//Handle form submission
	if(isset($_POST['submit']))
	{
		extract($_POST);
		$error = "";
		//Parse form fields
		foreach($_POST as $k => $v) {
			if(($k != 'submit' && $k != 'info' && $k != 'type' && $k != 'item' && $k != 'page') && $$k == '') {
				if($k == 'option') { $k="Response Request"; }
				$error .= "<li>" .ucwords($k). " is required</li>";
			}
			$cleansed = cleanse($v);
			${$k} = $cleansed;
			// echo $k . ': ' .${$k} . '<br/>';
		}
		//Error Checking
		if(!preg_match('/^\d{5}(?:[-\s]\d{4})?$/', $zip)) {
			$error .= "<li>Zip appears invalid</li>";
		}
		if(!preg_match('/^\S+@\S+\.\S+$/', $email)) {
			$error .= "<li>Email appears invalid</li>";
		}
		if(!preg_match('/^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/', $phone)) {
			$error .= "<li>Phone appears invalid</li>";
		}		
		if($option == "info" && $info == '') {
			$error .= "<li>Request Response: I would like more information must not be blank</li>";
		}
		//SHOW ERRORS 
		if($error) {
			echo '<aside class="callout half-top" style="color:black;background-color:red;">';
			echo '<p><strong>ERROR(S)</strong>:<ul style="margin-left:25px;">' .$error. "</ul></p>";
			echo '</aside>';
		} else {
				$msg = '
				Name: ' . $name . ' <br/>
				Address: ' . $address . ' <br/>
				City: ' . $city . ' <br/>
				State: ' . $state . ' <br/>
				Zip: ' . $zip . ' <br/>
				Phone: ' . $phone . ' <br/> <br/>
				';
			if($option == 'buy') {
				$msg .= 'I would like to buy "' .$title. '" and would like a total price quote with shipping included.';
			} else if ($option == 'info') {
				$msg .= '
					I would like  more information about "' .$title. '".<br /><br />
					' . $info . '
				';
			}
			($_POST['type'] == 1) ? $type = "Original": $type = "SLE";
			$msg .= '<br/><br/>Full filename: ' .$item. '<br/>Type: ' . $type;
 			mail_send(array('to_email'=>'VivianLongArt@gmail.com', 'from_email'=>$email, 'subject'=>'Artworks Purchase and Shipping Request Form', 'message'=>$msg));
			echo '<p class="one-top">Thank you for your interest in Artworks. Your request has been sent. Please bear in mind there may be occasional times when I am not available by phone, or email. Be assured I will attend to your request as soon as possible.</p><br/>'; 
			require_once "footer.php";
			die();
		}  
	}
?>

<?php
	include "_shipping.html";
?>

<?php
	//Prepare vars for footer.php
	$scripts = array("js/jquery-v1.10.2.min.js","js/resizer.js","js/top-link.js");
	// $scripts = array("js/index_combined.js");
	require_once "footer.php";
?>	