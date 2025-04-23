<?php get_header();?>
<style>
	.single p {display: block;margin-top: 1em;margin-bottom: 1em;overflow: hidden;}
	.single strong{font-weight:bold;}
	.single cite,.single em,.single i{font-style:italic;}
	.single big{font-size:131.25%;}
	.single ins{background:#ffc;text-decoration:none;}
	.single blockquote{font-style:italic;padding:03em;}
	.single blockquotecite,.single blockquoteem,.single blockquotei{font-style:normal;}
	.single pre{background:#f7f7f7;color:#222;line-height:18px;margin-bottom:18px;overflow:auto;padding:1.5em;}
	.single abbr,.single acronym{border-bottom:1px dotted #666;cursor:help;}
	.single sup,.single sub{height:0;line-height:1;position:relative;vertical-align:baseline;}
	.single sup{bottom:1ex;}
	.single sub{top:.5ex;}
	.single img, .single img.alignnone { margin-bottom: 10px; font-size: inherit;}
	img.size-auto,img.size-full,img.size-large,img.size-medium,.attachment img{
	max-width:100%; height:auto; }
	.alignleft,img.alignleft{display:inline;float:left;margin-right:24px;margin-top:4px;}
	.alignright,img.alignright{display:inline;float:right;margin-left:24px;margin-top:4px;}
	.aligncenter,img.aligncenter{clear:both;display:block;margin-left:auto;margin-right:auto;}
	img.alignleft,img.alignright,img.aligncenter{margin-bottom:12px;}
	.single table,	.single th,	.single td{border: 1px solid #000;}
	.single table{	border-collapse: separate;	border-spacing: 0;	border-width: 1px 0 0 1px;	margin: 0 0 28px;	width: 100%;}
	.single table th,	.single table caption {	border-width: 0 1px 1px 0;	padding: 7px;	text-align: left;	vertical-align: baseline;}
	.single table td {	border-width: 0 1px 1px 0;	padding: 7px;	vertical-align: baseline;}

</style>
<?php get_template_part('header-navi');?>	

<?php if(in_category('news')):?>
<div class="mainVisual lower_mainVisual">
<div class="inner">
<h2>お知らせ<span>- News -</span></h2>
</div>
</div>

</div>
<section id="main">


<div class="content news detail contents-inr contact">
<div class="editor-block single">
<h3><?php the_title();?></h3>
<p class="date"><?php the_time('Y/m/d');?></p>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php the_content(); ?>
<?php endwhile; endif; ?>		
</div>

<div class="page_nav">
<?php next_post_link('%link','« PREV',TRUE); ?>
<a href="<?php echo home_url(); ?>/news/">一覧へ戻る</a>
<?php previous_post_link('%link','NEXT »',TRUE); ?>
</div>	

</div>

</section>



<?php elseif(is_single()):?>
<?php endif;?>

<?php get_footer();?>