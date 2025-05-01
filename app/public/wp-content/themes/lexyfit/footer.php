		<footer id="gFooter">
			<div class="pageTop"><a href="#container" class="en"><img src="<?php echo get_template_directory_uri(); ?>/img/common/pagetop_arow.png" alt="Page Top">page top</a></div>
			<div class="fBox">
				<div class="fLogo"><a href="<?php echo home_url();?>"><img src="<?php echo get_template_directory_uri(); ?>/img/common/f_logo.png" alt="LeXy Fit"></a></div>
				<p class="taLeft">240坪のボディメイクに必要なマシンがすべて揃う究極のジム。運動初心者でも使いやすいく、上級者も納得のマシンラインナップ。スタジオではバーチャルレッスンを中心にライブレッスンも充実。アスリートや本気の挑戦者のためのアスレチック型トレーニング施設、地域初上陸。三重県津市、国道165号線沿い、中勢バイパス高茶屋小森交差点近く、駐車場50台完備。</p>
				<p>運営：ワークエル株式会社</p>
				<p style="margin-top: 10px;"><strong>レクシーフィット松阪店ではスタッフ・トレーナーを募集しております。詳しくはご連絡ください。	</strong></p>
				<p><a href="<?php echo home_url();?>/law/">特定商取引法に基づく表記</a></p>
				<p class="copyright">copyright (C) レクシーフィット All right reserved.</p>
			</div>
			<ul class="fixUl">
				<li><a href="tel:0592531236"><img src="<?php echo get_template_directory_uri(); ?>/img/common/fix_tel.png" alt="tel.059-253-1236" class="pc"><span class="sp">tel.059-253-1236</span></a></li>
				<li><a href="<?php echo home_url();?>/contact/"><img src="<?php echo get_template_directory_uri(); ?>/img/common/fix_contact.png" alt="お問い合わせ" class="pc"><span class="sp">お問い合わせ</span></a></li>
			</ul>
		</footer>

	</div>

	<script src="<?php echo get_template_directory_uri();?>/js/jquery.js"></script>
	<?php if(is_home()||is_front_page()):?>
	<script src="<?php echo get_template_directory_uri();?>/js/slick/slick.js"></script>
	<?php endif;?>
	<script src="<?php echo get_template_directory_uri();?>/js/jquery.matchHeight.js"></script>
	<script src="<?php echo get_template_directory_uri();?>/js/modernizr.custom.js"></script>
	<script src="<?php echo get_template_directory_uri();?>/js/classie.js"></script>
	<script src="<?php echo get_template_directory_uri();?>/js/common.js"></script>
	<?php if(is_home()||is_front_page()):?>
	<script src="<?php echo get_template_directory_uri();?>/js/feed.js"></script>
	<script>
	$(function() {
		$('#main .campaign .priceUl li .price .txt').matchHeight();
		$('#main .other .imgList li').matchHeight({ byRow: false });
		$('#main .security .imgUl li .pho').matchHeight();
		$('#main .security .imgUl li .txtBox').matchHeight();
		$('#main .priceWrap .comPriceUl.comming li,#main .priceWrap .comPriceUl.wid01').matchHeight();

		$('.comSlideBox .slide').each(function() {
			$(this).slick({
				slidesToShow: 3,
				autoplay: true,
				pauseOnHover: false,
				pauseOnFocus: false,
				centerPadding: '0',
				responsive: [{
					breakpoint: 768,
					settings: {
						centerMode: true,
						variableWidth: true
					}
				}],
				prevArrow: $(this).parents('.comSlideBox:first').find('.arrowList .prev'),
				nextArrow: $(this).parents('.comSlideBox:first').find('.arrowList .next'),
			});
		});
	});
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lightcase/2.5.0/js/lightcase.min.js" integrity="sha256-o/dXp1WxjpjU37PeBC5vxfc1yf/CgTCjWIzYUozOQ4Q=" crossorigin="anonymous"></script>
	<script type="text/javascript">
    jQuery(document).ready(function($) {
              $('a[data-rel^=lightcase]').lightcase();
    });
	</script>
	<?php elseif(is_page('contact')):?>
	<script src="<?php echo get_template_directory_uri();?>/js/jquery.jpostal.js"></script>
	<script>
	$(document).ready(function() {
		$(".check-postal").jpostal({
			click : ".check-postal",
			postcode: [
				":input[name='code1']",
				":input[name='code2']"
			],
			address: {
				":input[name='address']": "%3%4%5"
			}
		});
	});
	</script>
	<?php endif;?>

<?php wp_footer(); ?>
</body>
</html>