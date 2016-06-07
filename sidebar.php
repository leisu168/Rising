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
?>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
    <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    </div><!-- #primary-sidebar -->
    <?php endif; ?>