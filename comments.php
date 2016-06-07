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
if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ('Please do not load this page directly. Thanks!');
?>
<!--Comment’s List -->
    <div class="comments">
    <a name="#respond"></a>
    <div id="comment_title"><?php comments_popup_link('评论 0', '评论 1', '评论 %', '', '评论 0'); ?></div>
    <div class="hr dotted clearfix">&nbsp;</div>
    <ol class="commentlist">
        <?php 
    if (!empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) { 
        // if there's a password
        // and it doesn't match the cookie
    ?>
    <li class="decmt-box">
        <p><a href="#addcomment">请输入密码再查看评论内容.</a></p>
    </li>
    <?php 
        } else if ( !comments_open() ) {
    ?>
    <li class="decmt-box">
        <p><a href="#addcomment">评论功能已经关闭!</a></p>
    </li>
    <?php 
        } else if ( !have_comments() ) { 
    ?>
    <!--
    <li class="decmt-box">
        <p><a href="#addcomment">还没有任何评论，你来说两句吧</a></p>
    </li>
    -->
    <?php 
        } else {
            wp_list_comments('type=comment&');
        }
    ?>
    </ol>
    <div class="hr clearfix">&nbsp;</div>
    <?php 
if ( !comments_open() ) :
// If registration required and not logged in.
elseif ( get_option('comment_registration') && !is_user_logged_in() ) : 
?>
<p>你必须 <a href="<?php echo wp_login_url( get_permalink() ); ?>">登录</a> 才能发表评论.</p>
<?php else  : ?>
<!-- Comment Form -->
<form id="commentform" name="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
    <div id="send_comment">发表评论</div>
    <div class="hr dotted clearfix">&nbsp;</div>
    <ul>
        <?php if ( !is_user_logged_in() ) : ?>
        <li class="commenter clearfix">
            <label for="name">昵称(必填)</label>
            <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>"  tabindex="1" placeholder=" 昵称*"/>
        </li>
        <li class="commenter clearfix">
            <label for="email">邮箱(必填)</label>
            <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>"  tabindex="2" placeholder=" 邮箱*"/>
        </li>
        <li class="commenter clearfix">
            <label for="url">网址</label>
            <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3" placeholder=" 网址"/>
        </li>
        <?php else : ?>
        <li class="clearfix">您已登录:<a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="退出登录">退出 &raquo;</a></li>
        <?php endif; ?>
        <li class="commenter clearfix">
            <label for="message">评论内容</label>
            <textarea id="message comment" name="comment" tabindex="4" rows="8" cols="80" placeholder="说点什么吧~"></textarea><li class="send_out_buttom clearfix">
            <!-- Add Comment Button -->
            <a href="javascript:void(0);" onClick="Javascript:document.forms['commentform'].submit()" class="button medium black right"><i class="fa fa-send-o"></i> 发表</a>
             </li>
        </li>
          
    </ul>
    <?php comment_id_fields(); ?>
    <?php do_action('comment_form', $post->ID); ?>
</form>
    </div>
<?php endif; ?>