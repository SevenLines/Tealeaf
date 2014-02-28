<?php

namespace Netcarver\Textile;

include_once 'Textile/Parser.php';
include_once 'Textile/DataBag.php';
include_once 'Textile/Tag.php';

?>
<div class="plain_text">
<?php 
	
        $parser = new Parser(); 
	if (isset($text))  {
		$output = $parser->textileThis($text);
		echo $output;
	} 
?>
</div>