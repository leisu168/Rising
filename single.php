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
<single>
	<article>
		<h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<div class="post_info">
			<span class="post_info_date">发布于<?php the_time('Y-n-j') ?></span>
			<span class="post_info_catetory"><?php echo "分类：";echo the_category(' / '); ?></span>
			<span class="post_info_comments_num"><?php comments_popup_link('评论(0)', '评论(1)', '评论(%)', '', '评论(0)'); ?></span>
			<span class="post_info_read_num">阅读(<?php get_post_views($post -> ID); ?>)</span>
			<span class="post_info_edit">
			<?php edit_post_link('[编辑]', ' &bull; ', ''); ?></span>
		</div>

		<div class="post_content">
			<?php echo $post->post_content;?>
		</div>

		<div id="post_alert">未经允许不得转载：<a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a> » <?php echo "";echo the_category(' / '); ?> » <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>

		<div id="post_info_tags">标签：<?php the_tags('', '   ', ''); ?></div>
		
	</article>
</single>
<?php comments_template(); ?>

<?php get_footer(); ?>
