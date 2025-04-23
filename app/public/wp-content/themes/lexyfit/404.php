<?php get_header();?>
<?php get_template_part('header-navi');?>	


<div class="mainVisual lower_mainVisual">
<div class="inner">
<h2>404エラー<span>- 404 ERROR -</span></h2>
</div>
</div>

</div>
<section id="main">
<div class="content law contents-inr contact" style="text-align: center;">
<h3 class="headLine01 cor01"><span class="en">Not found</span>ページが見つかりません/アクセス</h3>
<p>可能性のある原因<br>
・アドレスに入力の間違いがある可能性がある。<br>
・リンクをクリックした場合には、リンクが古い場合があります。</p>
<br>
<br>
<br>
<h3 class="headLine01 cor01"><span class="en">Approach</span>対処法/アクセス</h3>
<p>アドレスを再入力する。<br>
<a style="color:blue;" href="javascript:history.back();">前のページに戻る。</a><br>
<a style="color:red;" href="<?php echo home_url('/'); ?>">メインのサイト</a>に移動して必要な情報を探す。</p>	
<br>
<br>
</div>


</section>
<?php get_footer();?>
