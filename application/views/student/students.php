<?php 
/**
 * this template is used to show list of students
 * with marks for particular group
 */
if(isset($students)) { 
?>
<ul>
    <?php foreach ($students as $s) { ?>
    <li><?php echo "$s->family $s->name"; ?></li>
    <?php } ?>
</ul>
<?php } ?>
