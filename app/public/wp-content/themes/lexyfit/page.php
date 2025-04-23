<?php get_header();?>
<?php get_template_part('header-navi');?>	
<?php
$page = get_post( get_the_ID() );
$slug = $page->post_name;
?>

<div class="mainVisual lower_mainVisual">
<div class="inner">
<?php if(is_page('law')):?><h2>特定商取引法に基づく表記<span>- Law notation -</span></h2>
<?php else:?><h2><?php the_title();?><span>- <?php echo $slug;?> -</span></h2>
<?php endif;?>
</div>
</div>

</div>
<section id="main">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php remove_filter ('the_content', 'wpautop'); ?>
<?php the_content(); ?>
<?php endwhile; endif; ?>

</section>
<?php get_footer();?>