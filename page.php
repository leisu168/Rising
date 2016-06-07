<?php
/*
*
*Theme Name: Rising
*Theme URI: http://www.risingsun.cc
*Description: Rising
*Version: 1.0
*Author: Rising Sun
*Author URI: http://www.risingsun.cc
*Tags: Rising
*
*/

get_header(); ?>

<h2 class="grid_12 caption clearfix"><?php the_title(); ?></h2>
<?php the_content(); ?>
<?php comments_template(); ?>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>



</div>
    <?php else : ?>
    <div class="grid_8">
        没有找到你想要的页面！
    </div>
    <?php endif; ?>
    <?php get_sidebar(); ?>


<?php get_footer(); ?>