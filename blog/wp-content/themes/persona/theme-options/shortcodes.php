<?php 

///////////////////////////////////////////////////
// Columns
///////////////////////////////////////////////////

// 2 columns (left)
function two_col($atts, $content = null) {
	return '<div class = "two_col">'.$content.'</div>';
}

add_shortcode('two_col', 'two_col');

// 2 columns (right)
function two_col_last($atts, $content = null) {
	return '<div class = "two_col last">'.$content.'</div><div class = "clear"></div>';
}

add_shortcode('two_col_last', 'two_col_last');

// 3 columns (two on the left side)
function three_col($atts, $content = null) {
	return '<div class = "three_col"><p>'.$content.'</p></div>';
}

add_shortcode('three_col', 'three_col');

// 3 columns (last one on the right)
function three_col_last($atts, $content = null) {
	return '<div class = "three_col last"><p>'.$content.'</p></div><div class = "clear"></div>';
}

add_shortcode('three_col_last', 'three_col_last');

///////////////////////////////////////////////////
// Notification boxes
///////////////////////////////////////////////////

// Yellow (alert)
function yellow_box($atts, $content = null) {
	return '<div class = "yellow_box">'.$content.'</div>';
}

add_shortcode('yellow_box', 'yellow_box');

// Red (error)
function red_box($atts, $content = null) {
	return '<div class = "red_box">'.$content.'</div>';
}

add_shortcode('red_box', 'red_box');

// Blue (info)
function blue_box($atts, $content = null) {
	return '<div class = "blue_box">'.$content.'</div>';
}

add_shortcode('blue_box', 'blue_box');

// Green (success)
function green_box($atts, $content = null) {
	return '<div class = "green_box">'.$content.'</div>';
}

add_shortcode('green_box', 'green_box');

// Gray (simple standout message)
function gray_box($atts, $content = null) {
	return '<div class = "gray_box">'.$content.'</div>';
}

add_shortcode('gray_box', 'gray_box');

///////////////////////////////////////////////////
// Other shortcodes
///////////////////////////////////////////////////

// Splitter
function splitter($atts, $content = null) {
	return '<div class = "splitter_short">'.$content.'</div>';
}

add_shortcode('splitter', 'splitter');


 ?>