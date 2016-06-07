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

register_nav_menus();




//小工具
function widgets_init() {
  register_sidebar( array(
        'name'          => __( 'Primary Sidebar' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Main sidebar that appears on the left.' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ) );
}


//新建说说功能 

add_action('init', 'by_shuoshuo');
function by_shuoshuo()
{ $labels = array( 'name' => '说说',
'singular_name' => '说说', 
'add_new' => '发表说说', 
'add_new_item' => '发表说说',
'edit_item' => '编辑说说', 
'new_item' => '新说说',
'view_item' => '查看说说',
'search_items' => '搜索说说', 
'not_found' => '暂无说说',
'not_found_in_trash' => '没有已遗弃的说说',
'parent_item_colon' => '', 'menu_name' => '说说' );
$args = array( 'labels' => $labels,
'public' => true, 
'publicly_queryable' => true,
'show_ui' => true,
'show_in_menu' => true, 
'exclude_from_search' =>true,
'query_var' => true, 
'rewrite' => true, 
'capability_type' => 'post',
'has_archive' => true, 'hierarchical' => false, 
'menu_position' => null, 'supports' => array('editor','author','title','comments') );
register_post_type('shuoshuo',$args); 
}


//官方Gravatar头像调用ssl头像链接
function get_ssl_avatar($avatar) {
   $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
   return $avatar;
}
add_filter('get_avatar', 'get_ssl_avatar');


//WordPress去除category
add_action( 'load-themes.php',  'no_category_base_refresh_rules');   
add_action('created_category', 'no_category_base_refresh_rules');   
add_action('edited_category', 'no_category_base_refresh_rules');   
add_action('delete_category', 'no_category_base_refresh_rules');   
function no_category_base_refresh_rules() {       
    global $wp_rewrite;   
    $wp_rewrite -> flush_rules();   
}   
  
// register_deactivation_hook(__FILE__, 'no_category_base_deactivate');   
// function no_category_base_deactivate() {   
//  remove_filter('category_rewrite_rules', 'no_category_base_rewrite_rules');   
//  // We don't want to insert our custom rules again   
//  no_category_base_refresh_rules();   
// }   
  
// Remove category base   
add_action('init', 'no_category_base_permastruct');   
function no_category_base_permastruct() {   
    global $wp_rewrite, $wp_version;   
    if (version_compare($wp_version, '3.4', '<')) {   
        // For pre-3.4 support   
        $wp_rewrite -> extra_permastructs['category'][0] = '%category%';   
    } else {   
        $wp_rewrite -> extra_permastructs['category']['struct'] = '%category%';   
    }   
}   
  
// Add our custom category rewrite rules   
add_filter('category_rewrite_rules', 'no_category_base_rewrite_rules');   
function no_category_base_rewrite_rules($category_rewrite) {   
    //var_dump($category_rewrite); // For Debugging   
  
    $category_rewrite = array();   
    $categories = get_categories(array('hide_empty' => false));   
    foreach ($categories as $category) {   
        $category_nicename = $category -> slug;   
        if ($category -> parent == $category -> cat_ID)// recursive recursion   
            $category -> parent = 0;   
        elseif ($category -> parent != 0)   
            $category_nicename = get_category_parents($category -> parent, false, '/', true) . $category_nicename;   
        $category_rewrite['(' . $category_nicename . ')/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?category_name=$matches[1]&feed=$matches[2]';   
        $category_rewrite['(' . $category_nicename . ')/page/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';   
        $category_rewrite['(' . $category_nicename . ')/?$'] = 'index.php?category_name=$matches[1]';   
    }   
    // Redirect support from Old Category Base   
    global $wp_rewrite;   
    $old_category_base = get_option('category_base') ? get_option('category_base') : 'category';   
    $old_category_base = trim($old_category_base, '/');   
    $category_rewrite[$old_category_base . '/(.*)$'] = 'index.php?category_redirect=$matches[1]';   
  
    //var_dump($category_rewrite); // For Debugging   
    return $category_rewrite;   
}   
  
  
// Add 'category_redirect' query variable   
add_filter('query_vars', 'no_category_base_query_vars');   
function no_category_base_query_vars($public_query_vars) {   
    $public_query_vars[] = 'category_redirect';   
    return $public_query_vars;   
}   
  
// Redirect if 'category_redirect' is set   
add_filter('request', 'no_category_base_request');   
function no_category_base_request($query_vars) {   
    //print_r($query_vars); // For Debugging   
    if (isset($query_vars['category_redirect'])) {   
        $catlink = trailingslashit(get_option('home')) . user_trailingslashit($query_vars['category_redirect'], 'category');   
        status_header(301);   
        header("Location: $catlink");   
        exit();   
    }   
    return $query_vars;   
}

//删除评论replytocom参数链接
add_action( 'widgets_init', 'widgets_init' );

add_filter('comment_reply_link', 'add_nofollow', 420, 4);

function add_nofollow($link, $args, $comment, $post){
  return preg_replace( '/href=\'(.*(\?|&)replytocom=(\d+)#respond)/', 'href=\'#comment-$3', $link );
}


//获取文章第一张图片，如果没有图就会显示默认的图
function catch_that_image() { 
    global $post, $posts; 
    $first_img = ''; 
    ob_start(); 
    ob_end_clean(); 
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches); 
    $first_img = $matches [1] [0]; 
    if(empty($first_img)){
		$a=array("default-thumb1"=>"default-thumb1","default-thumb2"=>"default-thumb2","default-thumb3"=>"default-thumb3","default-thumb4"=>"default-thumb4","default-thumb5"=>"default_thumb5");
		$default_thumb=(array_rand($a,1));
        $first_img = bloginfo('template_url'). "/images/".$default_thumb.".jpg"; 
    } 
    return $first_img; 
}

//分页
function pagenavi( $before = '', $after = '', $p = 2 ) {   
if ( is_singular() ) return;   
global $wp_query, $paged;   
$max_page = $wp_query->max_num_pages;   
if ( $max_page == 1 ) return;   
if ( empty( $paged ) ) $paged = 1;   
echo $before.'<div id="pagenavi">'."\n";   
echo '<div class="pages">Page: ' . $paged . ' of ' . $max_page . ' </div>';   
if ( $paged > 1 ) p_link( $paged - 1, 'Previous Page', '<i class="fa fa-chevron-circle-left"></i>' );   
if ( $paged > $p + 1 ) p_link( 1, 'First Page' );   
if ( $paged > $p + 2 ) echo '... ';   
for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {   
if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current'>{$i}</span>" : p_link( $i );   
}   
if ( $paged < $max_page - $p - 1 ) echo '... ';   
if ( $paged < $max_page - $p ) p_link( $max_page, 'Last Page' );   
if ( $paged < $max_page ) p_link( $paged + 1,'Next Page', '<i class="fa fa-chevron-circle-right"></i>' );   
echo '</div>'.$after."\n";   
}   


function p_link( $i, $title = '', $linktype = '' ) {   
if ( $title == '' ) $title = "Page {$i}";   
if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }   
echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$linktext}</a>";   
} 

//文章阅读数 
function get_post_views ($post_id) {   
  
    $count_key = 'views';   
    $count = get_post_meta($post_id, $count_key, true);   
  
    if ($count == '') {   
        delete_post_meta($post_id, $count_key);   
        add_post_meta($post_id, $count_key, '0');   
        $count = '0';   
    }   
  
    echo number_format_i18n($count);   
  
}   
  
function set_post_views () {   
  
    global $post;   
  
    $post_id = $post -> ID;   
    $count_key = 'views';   
    $count = get_post_meta($post_id, $count_key, true);   
  
    if (is_single() || is_page()) {   
  
        if ($count == '') {   
            delete_post_meta($post_id, $count_key);   
            add_post_meta($post_id, $count_key, '0');   
        } else {   
            update_post_meta($post_id, $count_key, $count + 1);   
        }   
  
    }   
  
}   
add_action('get_header', 'set_post_views');  


//评论
function aurelius_comment($comment, $args, $depth) 
{
   $GLOBALS['comment'] = $comment; ?>
   <li class="comment" id="li-comment-<?php comment_ID(); ?>">
        <div class="gravatar"> <?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 48); } ?>
  </div>
        <span class="comment_content" id="comment-<?php comment_ID(); ?>">   
            <span class="clearfix">
                    <?php printf(__('<cite class="author_name">%s</cite>'), get_comment_author_link()); ?>
                    <span class="comment-meta commentmetadata">发表于：<?php echo get_comment_time('Y-m-d H:i'); ?></span>
                    &nbsp;&nbsp;&nbsp;<?php edit_comment_link('修改'); ?>
            </span>

            <div class="comment_text">
                <?php if ($comment->comment_approved == '0') : ?>
                    <em>你的评论正在审核，稍后会显示出来！</em><br />
        <?php endif; ?>
        <?php comment_text(); ?>
            </div>
        </div>
<?php } 


?>