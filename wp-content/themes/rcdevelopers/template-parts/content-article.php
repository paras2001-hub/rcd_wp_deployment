<div class="meta-data">
    <div class="post-tags">
        <?php the_tags('<div class="body">', '</div>'); ?>
    </div>
    <div class="post-date">
        <?php the_date(); ?>
    </div>
    <div class="post-title">
        <?php the_title('<div class="title">', '</div>'); ?>
    </div>
</div>

<?php the_content(); ?>