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
<div id="main">
	<div class="index-posts clearfix">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="index-post clearfix">
	<!--文章分类-->
	<span id="index-post-category"><?php echo the_category(', '); ?></span>
	<!--文章标题-->
	<div class="index-post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo get_the_title();?>"><?php echo mb_strimwidth(strip_tags(apply_filters('the_title', get_the_title())), 0, 33,…); ?></a></div>
		<div class="clearfix">&nbsp;</div>
	<!--文章日期-->
	<div class="index-post-date"><?php the_time('Y-n-j') ?></div>
	<div class="clearfix">&nbsp;</div>
	<!--文章摘要 限制字数substr($str,0,200);  清除html格式 strip_tags($str)  -->
	<div class="index-post-zhaiyao"><?php echo mb_strimwidth(strip_tags(apply_filters(‘the_content’, $post->post_content)), 0, 168,……); ?></div>

	<div class="index-post-photo clearfix">
		<a href="<?php the_permalink(); ?>"><div id="p_alpha" class="alpha_div"></div><img src="<?php echo catch_that_image() ?>" alt="<?php the_title(); ?>" class="clearfix" width=450px height=200px/></a>
	</div>
	<div class="clearfix">&nbsp;</div>

	<div id="index-post-bottom">
	<!--文章标签-->
	<span id="index-post-tags"><?php echo "标签："; ?>
	<?php if ( get_the_tags() ) { 
	$posttags = get_the_tags();  
	$count=0;  
	if($posttags) {  
		foreach($posttags as $tag) {  
			$count++;  
			if($count<5){  
				echo '<a href="' . get_tag_link( $tag ) . '" rel="tag" target="_blank" title="查看关于 ' . $tag->name . ' 的文章">' . $tag->name . '</a>/  ';    
			}  
		}  
	} } else{ echo '暂无标签';  } 
	?>
	</span>

	<span id="index-post-comandedit">
	<!--文章评论数-->
	<?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?>
	<!--编辑按钮-->
	<?php edit_post_link('编辑', ' &bull; ', ''); ?></span>
	</div>
	<span id="index-post-readall">
	<a href="<?php the_permalink(); ?>" class="button right">阅读全文</a></span>
	
	</div>
	<?php endwhile; ?>
	<?php endif; ?>
	</div>
	<div class="clearfix">&nbsp;</div>


</div>
<div class="clearfix"><?php pagenavi(); ?></div>
<?php get_footer(); ?>