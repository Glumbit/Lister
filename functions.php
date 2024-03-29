<?php
add_action( 'wp_enqueue_scripts', 'add_variables');
add_action( 'wp_enqueue_scripts', 'add_reseting');
add_action( 'wp_enqueue_scripts', 'add_blocks');
add_action( 'wp_enqueue_scripts', 'add_header');
add_action( 'wp_enqueue_scripts', 'page_type_validation');

add_action( 'after_setup_theme', 'register_menu' );

function add_variables ()
{
	wp_register_style('variables-style', get_template_directory_uri() . '/assets/css/variables/variables.css' );
	wp_enqueue_style( 'variables-style' );
};

function add_reseting ()
{
	wp_register_style('reseting-style', get_template_directory_uri() . '/assets/css/reseting/reseting.css' );
	wp_enqueue_style( 'reseting-style' );
};

function add_blocks ()
{
	wp_register_style('blocks-style', get_template_directory_uri() . '/assets/css/blocks/blocks.css' );
	wp_enqueue_style( 'blocks-style' );
};

function add_header ()
{
	wp_register_style('header-style', get_template_directory_uri() . '/assets/css/header/header.css' );
	wp_register_script('header-script', get_template_directory_uri() . '/assets/js/header.js');
	wp_enqueue_style( 'header-style' );
	wp_enqueue_script( 'header-script');

	$arr = new WP_Query([
		'post_type' => ['anime','games'],
	]);
	$arr = $arr -> posts; 
	$arrSend = [
		"anime" => [],
		"games" => [],
	];
	foreach ($arr as $arrItem) {
		$postId = $arrItem->ID;
		if (get_post_type($postId) == "anime") {
			$post['post_link'] = get_permalink($postId);
			$post['post_title'] = $arrItem-> post_title;
			$post['post_image']=wp_get_attachment_image_src( get_post_meta( $postId, "image", true ), [300,300])[0];
			$post['post_type'] = get_field_object( "type", $postId)["value"]["label"];
			$post['post_part'] = get_post_meta( $postId, "part", true );
			$post['post_dateCreate'] = "";
			$post['post_dateCreate'] .= substr(get_post_meta( $postId, "date-create", true ),6, 2).".";
			$post['post_dateCreate'] .= substr(get_post_meta( $postId, "date-create", true ),4, 2).".";
			$post['post_dateCreate'] .= substr(get_post_meta( $postId, "date-create", true ),0, 4);
			$post['post_category'] = get_post_type($postId);
			array_push($arrSend["anime"],$post);
		}
		if (get_post_type($postId) == "games") {
			$post['post_link'] = get_permalink($postId);
			$post['post_title'] = $arrItem-> post_title;
			$post['post_image']=wp_get_attachment_image_src( get_post_meta( $postId, "image", true ), [300,300])[0];
			$post['post_type'] = get_field_object( "type", $postId)["value"]["label"];
			$post['post_part'] = get_post_meta( $postId, "part", true );
			$post['post_dateCreate'] = "";
			$post['post_dateCreate'] .= substr(get_post_meta( $postId, "date-create", true ),6, 2).".";
			$post['post_dateCreate'] .= substr(get_post_meta( $postId, "date-create", true ),4, 2).".";
			$post['post_dateCreate'] .= substr(get_post_meta( $postId, "date-create", true ),0, 4);
			$post['post_category'] = get_post_type($postId);
			array_push($arrSend["games"],$post);
		}
	}

	wp_localize_script( 'header-script', 'searchData', $arrSend );
};

function page_type_validation() {
	if (is_home()) {
		add_home();
		return;
	}
	if (get_page_uri() == "anime-list") {
		add_anime();
		return;
	}
	if (get_page_uri() == "games-list") {
		add_games();
		return;
	}
	if (get_page_uri() == "search") {
		add_search();
		return;
	}
	if (is_single()) {
		if (get_post_type() == "games") {
			add_gamesSingle();
			return;
		}
		if (get_post_type() == "anime") {
			add_animeSingle();
			return;
		}
	}
}

function add_home ()
{
	wp_register_style('home-style', get_template_directory_uri() . '/assets/css/home/home.css' );
	wp_enqueue_style( 'home-style' );
};

function add_anime ()
{
	wp_register_style('anime-style', get_template_directory_uri() . '/assets/css/anime/anime.css' );
	wp_register_script('anime-script', get_template_directory_uri() . '/assets/js/anime.js');
	wp_enqueue_style( 'anime-style' );
	wp_enqueue_script( 'anime-script');
};

function add_games ()
{
	wp_register_style('games-style', get_template_directory_uri() . '/assets/css/games/games.css' );
	wp_register_script('games-script', get_template_directory_uri() . '/assets/js/games.js');
	wp_enqueue_style( 'games-style' );
	wp_enqueue_script( 'games-script');
};

function add_search ()
{
	wp_register_style('search-style', get_template_directory_uri() . '/assets/css/search/search.css' );
	wp_register_script('search-script', get_template_directory_uri() . '/assets/js/search.js');
	wp_enqueue_style( 'search-style' );
	wp_enqueue_script( 'search-script');
};

function add_animeSingle ()
{
	wp_register_style('animeSingle-style', get_template_directory_uri() . '/assets/css/single-anime/single-anime.css' );
	wp_register_script('animeSingle-script', get_template_directory_uri() . '/assets/js/single.js');
	wp_enqueue_style( 'animeSingle-style' );
	wp_enqueue_script( 'animeSingle-script');
};

function add_gamesSingle ()
{
	wp_register_style('gamesSingle-style', get_template_directory_uri() . '/assets/css/single-games/single-games.css' );
	wp_register_script('gamesSingle-script', get_template_directory_uri() . '/assets/js/single.js');
	wp_enqueue_style( 'gamesSingle-style' );
	wp_enqueue_script( 'gamesSingle-script');
};

add_action('init', function(){
	register_post_type( 'anime', [
		'label'  => null,
		'labels' => [
			'name'               => 'Аниме', // основное название для типа записи
			'singular_name'      => 'Аниме', // название для одной записи этого типа
			'add_new'            => 'Добавить аниме', // для добавления новой записи
			'add_new_item'       => 'Добавление аниме', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование аниме', // для редактирования типа записи
			'new_item'           => 'Новое аниме', // текст новой записи
			'view_item'          => 'Смотреть аниме', // для просмотра записи этого типа.
			'search_items'       => 'Искать аниме', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Аниме', // название меню
		],
		'description'            => 'Аниме которые я посмотрел',
		'public'                 => true,
		'publicly_queryable'  => true, // зависит от public
		'exclude_from_search' => false, // зависит от public
		'show_ui'             => true, // зависит от public
		'show_in_nav_menus'   => true, // зависит от public
		'show_in_menu'           => true, // показывать ли в меню админки
		'show_in_admin_bar'   => true, // зависит от show_in_menu
		'show_in_rest'        => true, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => 4,
		'menu_icon'           => null,
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor','author', 'thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => ['genres'],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	] );
});

add_action('init', function(){
	register_taxonomy( 'genres-anime', array( 'anime'), array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Жанры',
			'singular_name'     => 'Жанр',
			'search_items'      => 'Найти жанр',
			'all_items'         => 'Все жанры',
			'view_item '        => 'Показать жанр',
			'parent_item'       => 'Родительский жанр',
			'parent_item_colon' => 'Родительский жанр:',
			'edit_item'         => 'Редактировать жанр',
			'update_item'       => 'Обнрвить жанр',
			'add_new_item'      => 'Добавить жанр',
			'new_item_name'     => 'Новое название жанра',
			'menu_name'         => 'Жанр',
			'back_to_items'     => '← Вернуться жанрам',
		],
		'description'           => 'Жанры аниме', // описание таксономии
		'public'                => true,
		'publicly_queryable'    => true, // равен аргументу public
		// 'show_in_nav_menus'     => true, // равен аргументу public
		// 'show_ui'               => true, // равен аргументу public
		// 'show_in_menu'          => true, // равен аргументу show_ui
		// 'show_tagcloud'         => true, // равен аргументу show_ui
		// 'show_in_quick_edit'    => true, // равен аргументу show_ui
		'hierarchical'          => false,

		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		// 'capabilities'          => array(),
		// 'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		// 'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => true, // добавить в REST API
		// 'rest_base'             => true, // $taxonomy
		// '_builtin'              => false,
		//'update_count_callback' => '_update_post_term_count',
	 ) );
});

add_action('init', function(){
	register_post_type( 'games', [
		'label'  => null,
		'labels' => [
			'name'               => 'Игры', // основное название для типа записи
			'singular_name'      => 'Игра', // название для одной записи этого типа
			'add_new'            => 'Добавить игру', // для добавления новой записи
			'add_new_item'       => 'Добавление игру', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование игры', // для редактирования типа записи
			'new_item'           => 'Новое игра', // текст новой записи
			'view_item'          => 'Смотреть игру', // для просмотра записи этого типа.
			'search_items'       => 'Искать игру', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Игры', // название меню
		],
		'description'            => 'Игры которые я посмотрел',
		'public'                 => true,
		'publicly_queryable'  => true, // зависит от public
		'exclude_from_search' => false, // зависит от public
		'show_ui'             => true, // зависит от public
		'show_in_nav_menus'   => true, // зависит от public
		'show_in_menu'           => true, // показывать ли в меню админки
		'show_in_admin_bar'   => true, // зависит от show_in_menu
		'show_in_rest'        => true, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => 4,
		'menu_icon'           => null,
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor','author', 'thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => ['genres'],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	] );
});

add_action('init', function(){
	register_taxonomy( 'genres-games', array( 'games'), array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Жанры',
			'singular_name'     => 'Жанр',
			'search_items'      => 'Найти жанр',
			'all_items'         => 'Все жанры',
			'view_item '        => 'Показать жанр',
			'parent_item'       => 'Родительский жанр',
			'parent_item_colon' => 'Родительский жанр:',
			'edit_item'         => 'Редактировать жанр',
			'update_item'       => 'Обнрвить жанр',
			'add_new_item'      => 'Добавить жанр',
			'new_item_name'     => 'Новое название жанра',
			'menu_name'         => 'Жанр',
			'back_to_items'     => '← Вернуться жанрам',
		],
		'description'           => 'Жанры аниме', // описание таксономии
		'public'                => true,
		'publicly_queryable'    => true, // равен аргументу public
		// 'show_in_nav_menus'     => true, // равен аргументу public
		// 'show_ui'               => true, // равен аргументу public
		// 'show_in_menu'          => true, // равен аргументу show_ui
		// 'show_tagcloud'         => true, // равен аргументу show_ui
		// 'show_in_quick_edit'    => true, // равен аргументу show_ui
		'hierarchical'          => false,

		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		// 'capabilities'          => array(),
		// 'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		// 'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => true, // добавить в REST API
		// 'rest_base'             => true, // $taxonomy
		// '_builtin'              => false,
		//'update_count_callback' => '_update_post_term_count',
	 ) );
});

function register_menu(){
	register_nav_menu( 'top', 'Шапка' );
}


add_filter('show_admin_bar', '__return_false');
add_filter( 'nav_menu_item_id', 'filter_menu_item_id', 10, 4 );

function filter_menu_item_id($menu_id, $item, $args, $depth){
	return '';
}

add_filter( 'nav_menu_css_class', 'filter_menu_item_class', 10, 4 );

function filter_menu_item_class($classes, $item, $args, $depth){
	$classes = array(
		'nav__item',
	);

	if($item -> current){
		$classes [] ='nav__item--active';
	}
	return $classes;
}
add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('custom-logo');
add_theme_support( 'title-tag' );
?>