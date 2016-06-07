
<li class="shuoshuo_item">
<div class="shuoshuo_meta">
<div class="shuoshuo_time bg6">
<span class="day">
<?php the_time('j'); ?></span>
<span class="month">
<?php the_time('n月'); ?></span>
</div>
</div>
<div class="shuoshuo_content bor3 bg">
<b class="shuoshuo_quote_before c_tx3" style="background: url(<?php echo  plugins_url('wp_by_shuoshuo/image/before.png'); ?>) no-repeat;">
“</b>
<div class="shuoshuo_detail">
<?php the_content(); ?>
</div>
<span class="shuoshuo_more">
<a href="<?php the_permalink(); ?>#comments" title="评论"><i class="fa fa-comments"></i>评论 </a>
<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="fa fa-eye"></i>详情</a>
</span>

<b class="shuoshuo_quote_after c_tx3" style="background: url(<?php echo  plugins_url('wp_by_shuoshuo/image/after.png'); ?>) no-repeat;">
”</b>
</div>

</li>
