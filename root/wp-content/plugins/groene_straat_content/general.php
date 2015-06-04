<?php 
function get_top()
{
	?> <div id="wrapper">
			<div id="content"><?php
}

function get_bottom()
{
	?></div></div><?php
}
add_shortcode("einde","get_bottom");
add_shortcode("begin","get_top");
?>