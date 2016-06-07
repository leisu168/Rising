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
<!-- Header -->
<!DOCTYPE html>
<html>
	<meta charset="utf-8">
	<title><?php if ( is_home() ) {
        wp_title('&raquo;',true,'right');$paged = get_query_var('paged'); if ( $paged > 1 ) {printf('第 %s 页',$paged);echo "-";}bloginfo('name'); echo " - "; bloginfo('description');
    } elseif ( is_category() ) {
        	$paged = get_query_var('paged'); if ( $paged > 1 ){ printf('第 %s 页',$paged);echo "-";}single_cat_title(); echo " - "; bloginfo('name');
    }
	elseif ( is_tag() ){
		single_tag_title();echo " - "; bloginfo('name');
		
	}elseif (is_single() || is_page() ) {
        single_post_title();echo " - "; bloginfo('name');
    } elseif (is_search() ) {
        echo "搜索结果"; echo " - "; bloginfo('name');
    } elseif (is_404() ) {
        echo '页面未找到!';
    } else {
        wp_title('',true);
    } ?></title>
	
	<?php 
	if (is_home()){ 
		$description = "Rising Sun&apos;s Blog，关注IT技术，记录在学习过程中总结出来的一些小经验以及个人的一些感悟。";
		$keywords = "risingsun,html,html5,css,javascript,js,jquery,web,前端";
	} elseif (is_single() || is_page()){    
		$description1 =  $post->post_excerpt ;
		$description2 = mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200, "…");
		$description = $description1 ? $description1 : $description2;
		$tags = wp_get_post_tags($post->ID);
		foreach ($tags as $tag){
		$keywords = $keywords.$tag->name.",";
		}
		$keywords = rtrim($keywords, ', ');
		
	} elseif(is_category()){
		$keywords = single_cat_title('', false);
		$description = category_description();
	}
	elseif (is_tag()){
		$keywords = single_tag_title('', false);
		$description = tag_description();
	}
	?>
	<meta name="keywords" content="<?php echo $keywords ?>" />
	<meta name="description" content="<?php echo $description ?>" />
	

	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/highlight.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/font-awesome-4.5.0/css/font-awesome.min.css" type="text/css" media="screen" />

	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/main.js" type="text/javascript"></script>

</head>

<body>
 <header>
 	<!--logo、问候语-->
	<div id="logo"><a href="<?php echo get_option('home'); ?>/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>logo" width=258rem height=86rem></a>
	</div>
	<div id="wenhou" class="clearfix">
		<?php 
			date_default_timezone_set('Asia/Shanghai');
			$hour=date("H");
			$wenhouyu_color=("wenhouyu_normal");
			if($hour>2 && $hour<=6) {$wenhouyu_color="#wenhouyu_red";$wenhouyu="Hey,天还没亮，夜猫子，要注意身体哦！";}
			else if($hour>6 && $hour<=11) {$wenhouyu="Hi~上午好！";}
			else if($hour>11 && $hour<=12) {$wenhouyu="中午好！吃午饭了吧~";}
			else if($hour>12 && $hour<=14) {$wenhouyu="中午好！午休时间哦，朋友一定是不习惯午睡的吧？！";}
			else if($hour>14 && $hour<=16) {$wenhouyu="下午茶的时间到了，休息一下吧！";}
			else if($hour>16 && $hour<=18) {$wenhouyu="经常对着电脑不好，快去锻炼吧！";}
			else if($hour>18 && $hour<=22) {$wenhouyu="Hey,吃完饭多陪陪家人吧！";}
			else if($hour>22 || $hour<=2) {$wenhouyu_color="#wenhouyu_red";$wenhouyu="很晚了哦，注意休息呀！";}
			else {echo "Hi~";}
		?>
		<div id="<?php echo $wenhouyu_color; ?>"><?php echo $wenhouyu; ?></div>
		<div id="searchbar">
			<a id="search_logo"><i class="fa fa-search fa-2x" ></i></a>
			<div id="searchform" class="clearfix"><form action="<?php echo get_option('home'); ?>/"><input type="text" name="s" id="s" placeholder="输入关键字"/><input type="submit" value="搜索" /></form></div>
		</div>
	</div>

	
	<!--分类导航-->
	<div id="nav">
	<ul>
	<?php 
    // 列出顶部导航菜单，菜单名称为mymenu，只列出一级菜单
    wp_nav_menu( array( 'menu' => 'mymenu', 'depth' => 1) );
	?>

	</ul>

	</div>
 </header>
<!-- Header -->
	



