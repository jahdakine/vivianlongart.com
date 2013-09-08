<?php
	function dirToArray($dir, $inc_files = false) {
    $contents = array();
    foreach (scandir($dir) as $node) {
      if ($node == '.' || $node == '..') continue;
      if (is_dir($dir . '/' . $node)) {
        $contents[$node] = dirToArray($dir . '/' . $node, $inc_files);
      } else {
      	if($inc_files) {
	       	if($node == '.DS_Store') continue;
	       	$contents[] = $node;
	      }
      }
    }
    return $contents;
	}	
	function padSpaces($count) {
		for ($i=0;$i<$count;$i++) { echo "&nbsp;"; }
	}
	function printArray($dir, $count) {
		foreach ($dir as $filename => $file) {
			if(is_array($file)) { 
				$count+=5;
				padSpaces($count);
				echo "<strong>" . $filename . "</strong>";
				if(count($file)<=2) { echo " - no file"; }
				echo "<br>";
				printArray($file, $count);
				$count-=5;
			} else {
				padSpaces(5+$count);
				echo $file . "<br>";
			}
			
		}
	}
	function makeArray($dir, &$arr) {
		foreach ($dir as $filename => $file) {
			if(is_array($file)) { 
				// echo "<strong>" . $filename . "</strong><br/>";
				array_push($arr, $filename . ".php");
				makeArray($file, $arr);
			} else {
				// echo $file . "<br>";
				array_push($arr, $file . ".php");
			}
			
		}
	}	
	function concatDirs($v, $k, &$parent) {
		global $folderList;
		if(count($v)) {
			getDirs($v,$parent.'/'.$k);
		} 
		$folderList[] .= "$parent/$k";
	}
	function getDirs($array, $parent=false) {
		array_walk($array, 'concatDirs', $parent);
	}
	function stripFolderStr($str) {
		$last_slash = strrpos($str, "/")+1;
		$tmp = substr($str, $last_slash);
		$tmp1 = str_replace(" and ", " &amp; ", $tmp);
		$stripped = ucwords(str_replace("-", " ", $tmp1));
		return $stripped;
	}
?>