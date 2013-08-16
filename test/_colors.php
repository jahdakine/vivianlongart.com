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
	<div style="color:black">
		<h1 class="half-top center">Colors</h1>
		<span class="center shade0">Shade 0 - #e5eed4</span>
		<span class="center shade1">Shade 1 - #ebe9ec</span>
		<span class="center shade2">Shade 2 - #dcd3e0</span>
		<span class="center shade3">Shade 3 - #d0d8c0</span>
		<span class="center shade4">Shade 4 - #d4e7b0</span>
		<span class="center shade5">Shade 5 - #bdd88b</span>
		<span class="center shade6">Shade 6 - #759043</span>		
	</div> 
	<div class="clear"></div>
</div> <!-- end main-content -->

<!-- <span id="taot" style="background-color:#a1a1a1;padding-top:2px;">&nbsp;<span style="color:#d0d8c0;">t</span><span style="color:#d1dbbd;">h</span><span style="color:#d1ddbb;">e</span><span style="color:#d2e0b8;"> </span><span style="color:#d3e2b5;">a</span><span style="color:#d3e5b3;">r</span><span style="color:#d4e7b0;">t</span><span style="color:#d1e5ab;"> </span><span style="color:#cde3a5;">o</span><span style="color:#cae1a0;">f</span><span style="color:#c7de9b;"> </span><span style="color:#c4dc96;">t</span><span style="color:#c0da90;">e</span><span style="color:#bdd88b;">c</span><span style="color:#b1cc7f;">h</span><span style="color:#a5c073;">,</span><span style="color:#99b467;"> </span><span style="color:#8da85b;">l</span><span style="color:#819c4f;">l</span><span style="color:#759043;">c</span>&nbsp;</span> -->
<!-- <span id="taot" style="background-color:#a1a1a1;padding-top:2px;">&nbsp;<span style="color:#ff0000;">w</span><span style="color:#ff1200;">e</span><span style="color:#ff2400;">b</span><span style="color:#ff3600;">s</span><span style="color:#ff4900;">i</span><span style="color:#ff5b00;">t</span><span style="color:#ff6d00;">e</span><span style="color:#ff7f00;"> </span><span style="color:#ff9100;">d</span><span style="color:#ffa400;">e</span><span style="color:#ffb600;">v</span><span style="color:#ffc800;">e</span><span style="color:#ffda00;">l</span><span style="color:#ffed00;">o</span><span style="color:#ffff00;">p</span><span style="color:#dbff00;">e</span><span style="color:#b6ff00;">d</span><span style="color:#92ff00;"> </span><span style="color:#6dff00;">b</span><span style="color:#49ff00;">y</span><span style="color:#24ff00;"> </span><span style="color:#00ff00;">"</span><span style="color:#00ff24;">t</span><span style="color:#00ff49;">h</span><span style="color:#00ff6d;">e</span><span style="color:#00ff92;"> </span><span style="color:#00ffb6;">a</span><span style="color:#00ffdb;">r</span><span style="color:#00ffff;">t</span><span style="color:#00dbff;"> </span><span style="color:#00b6ff;">o</span><span style="color:#0092ff;">f</span><span style="color:#006dff;"> </span><span style="color:#0049ff;">t</span><span style="color:#0024ff;">e</span><span style="color:#0000ff;">c</span><span style="color:#1400ff;">h</span><span style="color:#2800ff;">,</span><span style="color:#3c00ff;"> </span><span style="color:#4f00ff;">l</span><span style="color:#6300ff;">l</span><span style="color:#7700ff;">c</span><span style="color:#8b00ff;">"</span>&nbsp;</span> -->
<!-- website developed by <span id="taot" style="background-color:#a1a1a1;padding-top:2px;">&nbsp;<span style="color:#ff0000;">t</span><span style="color:#ff2a00;">h</span><span style="color:#ff5500;">e</span><span style="color:#ff7f00;"> </span><span style="color:#ffbf00;">a</span><span style="color:#ffff00;">r</span><span style="color:#aaff00;">t</span><span style="color:#55ff00;"> </span><span style="color:#00ff00;">o</span><span style="color:#00ff55;">f</span><span style="color:#00ffaa;"> </span><span style="color:#00ffff;">t</span><span style="color:#00aaff;">e</span><span style="color:#0055ff;">c</span><span style="color:#0000ff;">h</span><span style="color:#4600ff;">,</span><span style="color:#8b00ff;"> </span><span style="color:#b200aa;">l</span><span style="color:#d80055;">l</span><span style="color:#ff0000;">c</span>&nbsp;</span> -->

<?php
  //Prepare vars for footer.php
  $scripts = array("js/jquery-v1.10.2.min.js", "js/jquery-ui-1.9.2.custom.min.js", "js/resizer.js", "js/top-link.js");
  require_once "footer.php";
?>