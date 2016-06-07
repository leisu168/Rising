<?php get_header(); ?> 
<div class="shuoshuo">
<ul class="shuoshuo_listing">
	<?php query_posts("post_type=shuoshuo&post_status=publish&posts_per_page=-1");if (have_posts()) : while (have_posts()) : the_post(); ?>
	<li class="shuoshuo_li">
		<div class="shuoshuo_date"><?php the_time('Y年n月j日'); ?><br><?php the_time('G:H'); ?></div>
		<div class="shuoshuo_content"><i class="fa fa-quote-left fa-1x pull-left"></i><p><?php the_content(); ?></p><i class="fa fa-quote-right fa-1x pull-right" id="fa_quote_right"></i></div><?php endwhile;endif; ?>
	</li>
</ul>
</div>
<?php get_footer();?>