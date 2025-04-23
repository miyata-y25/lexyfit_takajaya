<?php
/*
Template Name: page-news
*/
?>
<?php get_header();?>
<?php get_template_part('header-navi');?>	

<div class="mainVisual lower_mainVisual">
<div class="inner">
<h2>お知らせ<span>- News -</span></h2>
</div>
</div>

</div>
<section id="main">


<div class="content news contents-inr contact">
<div id="news" class="information">
<div class="news_list">
<ul>
<?php
$paged = get_query_var('paged') ? get_query_var('paged') : 1 ; 
$args = array(
'category_name' => 'news', 
'paged' => $paged,
'posts_per_page' => 10,
'post_type' =>'post',
);
$the_query = new WP_Query($args);
?>
<?php if($the_query->have_posts()): ?>
<?php while($the_query->have_posts()) : $the_query->the_post(); ?>

<li>
<div class="photo"><?php the_post_thumbnail('150_thumbnail', array('alt' => get_the_title()));?></div>
<a href="<?php the_permalink();?>">
<?php the_time('Y/m/d');?><span><?php the_title();?></span>
<p><?php
$str = get_the_content();
$str = strip_tags( strip_shortcodes( $str ) );//各種タグとショートコードを削除
$num = 204; // 制限する文字数を指定
if(mb_strlen($str)>$num ) { 
$str = mb_substr($str,0,$num); 
echo str_replace(array("　", " ", "\r\n","\n","\r"), '', $str).''; 
} else {
echo str_replace(array("　", " ", "\r\n","\n","\r"), '', $str); 
}
?></p>
</a>
</li>
<?php endwhile; else: ?>
<li class="post_none">現在投稿はありません</li>
<?php endif; ?>
</ul>
<!--wp-pagenavi-->
<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(array('query'=>$the_query)); } ?>
<?php wp_reset_postdata(); ?>


</div>
</div>
</div>


</section>
<?php get_footer();?>