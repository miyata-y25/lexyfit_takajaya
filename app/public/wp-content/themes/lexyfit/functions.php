<?php


/* ------------------------------------------------------------------------------
	奇数を判別
------------------------------------------------------------------------------ */
function isOdd(){
    global $wp_query;
    return ((($wp_query->current_post+1) % 2) === 1);
}

/* ------------------------------------------------------------------------------
	管理画面にCSSを適応させる
------------------------------------------------------------------------------ */
function wp_custom_admin_css() {
	echo "\n" . '<link href="' . esc_url(get_stylesheet_directory_uri()). '/css/wp-admin.css' . '" rel="stylesheet" type="text/css">' . "\n";
}
add_action('admin_head', 'wp_custom_admin_css', 100);

/* ------------------------------------------------------------------------------
	記事サムネイルを有効化
------------------------------------------------------------------------------ */
add_theme_support( 'post-thumbnails' );

/* ------------------------------------------------------------------------------
	投稿の画像を拾ってくるカスタム
------------------------------------------------------------------------------ */
function catch_that_image() {
	global $post;
	$first_img = esc_url(home_url())."/img/default.png";

	if(has_post_thumbnail()) :
		$thumbUrlArr = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large');
		$first_img = $thumbUrlArr[0];
	elseif(preg_match_all('/<img.+src=[\'"]([^\'"]+\.(jpg|jpeg|png))[\'"].*>/i', $post->post_content, $matches)) :
		$first_img = $matches [1] [0];
	endif;

	return $first_img;
}

/* ------------------------------------------------------------------------------
	アイキャッチ画像の定義と切り抜き
------------------------------------------------------------------------------ */
add_action( 'after_setup_theme', 'baw_theme_setup' );
function baw_theme_setup() {
	add_image_size('240_thumbnail', 240, 160, true );
	add_image_size('150_thumbnail', 150, 150, true );

}

/* ------------------------------------------------------------------------------
	タイトルの出力
------------------------------------------------------------------------------ */
function twentytwelve_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );

/* ------------------------------------------------------------------------------
	子ページの判定
------------------------------------------------------------------------------ */
function is_subpage() {
	global $post;								// $post には現在の固定ページの情報があります
	if ( is_page() && $post->post_parent ) {	// 現在の固定ページが親ページを持つかどうかをチェックします
		return $post->post_parent;				// 親ページの ID を返します
	} else {									// 親ページを持たないので...
		return false;							// ...false を返します
	};
};

/* ------------------------------------------------------------------------------
	管理画面ロゴ削除
------------------------------------------------------------------------------ */
function my_custom_login() { ?>
   <style type="text/css">
       body.login div#login h1 a {
           background-image: none;
           padding-bottom: 0px;
       }
   </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_custom_login' );

function hide_admin_logo() {
global $wp_admin_bar;
$wp_admin_bar->remove_menu( 'wp-logo' );
}
add_action( 'wp_before_admin_bar_render', 'hide_admin_logo' );

/* ------------------------------------------------------------------------------
	管理画面左メニューの非表示設定
------------------------------------------------------------------------------ */
function edit_admin_menus() {
	if (!current_user_can('level_10')) { //level10以下のユーザーの場合メニューをunsetする

		global $menu;
		remove_menu_page ( 'index.php' );
		remove_menu_page ( 'separator1' );
		remove_menu_page ( 'edit.php?post_type=page' );
		remove_menu_page ( 'edit-comments.php' );
		remove_menu_page ( 'separator2' );
		remove_menu_page ( 'themes.php' );
		remove_menu_page ( 'plugins.php' );
		remove_menu_page ( 'users.php' );
		remove_menu_page ( 'tools.php' );
		remove_menu_page ( 'profile.php' );
		remove_menu_page ( 'separator-last' );
		remove_menu_page ( 'edit.php?post_type=acf' );

		if (current_user_can('editor')) {
			remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
			remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
		}
	}

}
add_action( 'admin_menu', 'edit_admin_menus', 11);

/* ------------------------------------------------------------------------------
	管理バーの表示 off
------------------------------------------------------------------------------ */
add_filter( 'show_admin_bar', '__return_false' );


/* ------------------------------------------------------------------------------
	contact form 7に確認用メールアドレスの項目を設置する
------------------------------------------------------------------------------ */
add_filter( 'wpcf7_validate_email', 'wpcf7_text_validation_filter_extend', 11, 2 );
add_filter( 'wpcf7_validate_email*', 'wpcf7_text_validation_filter_extend', 11, 2 );
function wpcf7_text_validation_filter_extend( $result, $tag ) {
global $my_email_confirm;
$tag = new WPCF7_Shortcode( $tag );
$name = $tag->name;
$value = isset( $_POST[$name] )
? trim( wp_unslash( strtr( (string) $_POST[$name], "\n", " " ) ) )
: '';
if ($name == "mail"){
$my_email_confirm=$value;
}
if ($name == "mail_confirm" && $my_email_confirm != $value){
$result->invalidate( $tag,"確認用のメールアドレスが一致していません");
}

return $result;
}


/* ------------------------------------------------------------------------------
	固定ページに表示させる画像を短いパスで出力する
------------------------------------------------------------------------------ */
function replaceImagePath($arg) {
	$content = str_replace('"img/', '"' . get_bloginfo('template_directory') . '/img/', $arg);
	return $content;
}
add_action('the_content', 'replaceImagePath');

function replaceImagePath2($arg) {
	$content = str_replace('"background-image:url(img/', '"background-image:url(' . get_bloginfo('template_directory') . '/img/', $arg);
	return $content;
}
add_action('the_content', 'replaceImagePath2');

function replaceImagePath3($arg) {
	$content = str_replace('"pdf/', '"' . get_bloginfo('template_directory') . '/pdf/', $arg);
	return $content;
}
add_action('the_content', 'replaceImagePath3');




/* ------------------------------------------------------------------------------
	投稿
------------------------------------------------------------------------------ */
function my_pre_get_posts($query) {
    if (is_category('information')) {
        $query->set('order', 'DESC');
		$query->set( 'posts_per_page', '10'); // 10件ずつ表示
    }
}
add_action('pre_get_posts', 'my_pre_get_posts');

/* ------------------------------------------------------------------------------
	ACF オプションページ
------------------------------------------------------------------------------ */

if( function_exists('acf_add_options_page') ) {
	  acf_add_options_page(array(
    'page_title' => 'メインビジュアル', // ページタイトル
    'menu_title' => 'メインビジュアル', // メニュータイトル
    'menu_slug' => 'theme-general-settings1', // メニュースラッグ
    'capability' => 'edit_posts',
    'redirect' => false
  ));
	  acf_add_options_page(array(
    'page_title' => 'CAMPAIGN', // ページタイトル
    'menu_title' => 'CAMPAIGN', // メニュータイトル
    'menu_slug' => 'theme-general-settings2', // メニュースラッグ
    'capability' => 'edit_posts',
    'redirect' => false
  ));
  acf_add_options_page(array(
    'page_title' => '料金表', // ページタイトル
    'menu_title' => '料金表', // メニュータイトル
    'menu_slug' => 'theme-general-settings3', // メニュースラッグ
    'capability' => 'edit_posts',
    'redirect' => false
  ));
}



/* ------------------------------------------------------------------------------
	リダイレクト
------------------------------------------------------------------------------ */

add_action( 'get_header', 'my_require' );
function my_require(){
    if (is_single()&&in_category('trainer')) {
        wp_redirect( home_url() );
        exit;
    }
}



/* ------------------------------------------------------------------------------
	カスタム投稿タイプ
------------------------------------------------------------------------------ */

add_action( 'init', 'create_post_type' );
function create_post_type() {

	// ----- trainer
	register_post_type('trainer ',
		array(
			'labels' => array(
			'name' => __( 'トレーナー' ), // 表示する投稿タイプ名
			'all_items' => 'trainer',
			'singular_name' => __('trainer')
		),
			'hierarchical' => true, //falseの場合、階層構造なし
			'public' => true, //通常はtrue
			'menu_position' =>4,
			'rewrite' => true,
			'has_archive' => true,
			'supports' => array('title','editor','thumbnail')
		)
	);
	
	// ----- schedule
	register_post_type('schedule',
		array(
			'labels' => array(
			'name' => __( 'レッスンスケジュール' ), // 表示する投稿タイプ名
			'all_items' => 'schedule',
			'singular_name' => __('schedule')
		),
			'hierarchical' => false, //falseの場合、階層構造なし
			'public' => true, //通常はtrue
		)
	);

}


