
<div class="mail"> 
    <script> 
        // mega panic encrypting :O
        "".contact('abc',
                 '<?php echo strrev(substr($mail, 0, strlen ($mail) - 7 - 1)); ?>',
                 '<?php echo substr($mail, -7); ?>' );
    </script>    
</div>
<?php if (isset($menu)) { ?>
<ul>	
    <li>
        <a href="<?php echo site_url() ?>" <?php if ($category_id==0) echo 'class="active"';?> >
            <?php echo $top_article_info->title_menu; ?>
        </a> 
    </li>
    <?php foreach ($menu as $c) {?>
        <li>
            <a href="<?php echo $c['href']; ?>" class="<?php echo $c['class']; ?>">
                <?php if ($c["icon_path"]) { ?> 
                <img src="<?php echo $c["icon_path"]; ?>" class="icon"/>
                <?php } ?>
                <?php echo $c['title_menu']?>
            </a>
            <?php if (isset($c['articles'])) { ?>
            <ul>
                <?php foreach ($c['articles'] as $article) {?>
                    <li>
                        <a href="<?php echo site_url()."/page/{$c['id_']}/{$article['id']}"; ?>">
                            <?php echo $article['title_menu']?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <?php } ?>
        </li>
    <?php } ?>	
</ul>
<?php } ?>
