<?php if(isset ($list_array) ) {?>
<ul>
<?php 
/*
 * itterate over list items
 * each item is an array of
 * 
 * $item['title'] - title of item
 * $item['current'] - true if current item
 * $item['href'] - hyperlink
 * $item['style'] - some extra style, if has
 * 
 * one should define $item_view parameter, without extension
 */ 
if (!isset($item_view)) {
	// use default if none was defined
	$item_view = "list_item"; 
}
foreach($list_array as $item) {
	include($item_view.".php");
}
 ?>
</ul>
<?php } ?>
