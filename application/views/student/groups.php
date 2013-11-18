<?php 
if(isset($groups)) { 
?>
<ul>
<?php foreach($groups as $g) { ?>
    <li><a href="<?php echo site_url()."/student/$g->id_";?>"><?php echo $g->title; ?> </li>
<?php } ?>
</ul>
<?php 
} 
?>
