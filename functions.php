<?php
require_once get_template_directory() . '/widgets/home-page-widget.php';

function index_of_get_primary_category_id( $post_id = null ) {
	if ( empty( $post_id ) ) {
		$post_id = get_the_id();
	}
	// Total Hack
	foreach( ( get_the_category() ) as $cat ) {
		$category_id = $cat->cat_ID;
	}
	return $category_id;
}

function index_of_add_screen_cast_post_type() {
	$args = [
		'public' => true,
		'label'  => 'Screencasts',
		'exclude_from_search' => true,
		'hierarchical' => 'false',
	];
	register_post_type( 'screencast', $args );
}
add_action( 'init', 'index_of_add_screen_cast_post_type' );

function index_of_page_structure_links( $post_id = null) {
	if ( empty( $post_id ) ) {
		$post_id = get_the_id();
	}
	$page_links = [];
	$post = get_post( $post_id );
	while ( ! empty( $post->post_parent ) ) {
		$post = get_post( $post->post_parent );
		$page_links[] = sprintf( '<a href="%s">%s</a>',
			get_permalink( $post->ID ),
			get_the_title( $post->ID )
		);
	}
	asort( $page_links );
	return $page_links;
}

function index_of_blog_page_link() {
	$blog_page_id = get_option( 'page_for_posts', true );
	if ( empty( $blog_page_id ) ) {
		return sprintf( '<a href="%s">%s</a>', home_url(), bloginfo( 'name' ) );
	} else {
		return sprintf( '<a href="%s">%s</a>', get_permalink( $blog_page_id ), get_the_title( $blog_page_id ) );
	}
}

function index_of_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'index_of_setup' );

function index_of_widgets_init() {
    register_sidebar( [
        'name' => 'Home Page',
        'id' => 'home-page',
        'description' => 'Widgets in this area will be shown on the home page',
        'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
    ] );
}
add_action( 'widgets_init', 'index_of_widgets_init' );

function index_of_enqueue_script() {
	wp_enqueue_script( 'sortable-js', get_template_directory_uri() . '/js/sortable_us.js', false );
}
add_action( 'wp_enqueue_scripts', 'index_of_enqueue_script' );

function index_of_enqueue_style() {
	wp_enqueue_style( 'core', get_template_directory_uri() . '/style.css', false );
}
add_action( 'wp_enqueue_scripts', 'index_of_enqueue_style' );

function index_of_page_parent( $post_id = null ) {
	if ( empty( $post_id ) ) {
		$post_id = get_the_id();
	}
	$post = get_post( $post_id );
	if ( empty( $post->post_parent ) ) {
		return home_url();
	} else {
		return get_permalink( $post->post_parent );
	}
}
