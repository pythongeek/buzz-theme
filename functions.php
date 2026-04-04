<?php
/**
 * Buzz Theme Functions
 *
 * @package Buzz_Theme
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme version
 */
define('BUZZ_THEME_VERSION', '1.0.0');

/**
 * Theme directory path
 */
define('BUZZ_THEME_DIR', get_template_directory());
define('BUZZ_THEME_URI', get_template_directory_uri());

/**
 * Initialize theme
 */
function buzz_theme_setup() {
    // Load text domain
    load_theme_textdomain('buzz-theme', BUZZ_THEME_DIR . '/languages');

    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // Register navigation menus
    register_nav_menus(array(
        'primary'   => esc_html__('Primary Menu', 'buzz-theme'),
        'footer'    => esc_html__('Footer Menu', 'buzz-theme'),
        'mobile'    => esc_html__('Mobile Menu', 'buzz-theme'),
    ));

    // Add support for responsive embedded content
    add_theme_support('responsive-embeds');

    // Add support for editor styles
    add_theme_support('editor-styles');

    // Add support for wide alignment
    add_theme_support('align-wide');

    // Add support for custom background
    add_theme_support('custom-background', array(
        'default-color' => '#030305',
    ));

    // Add support for custom header
    add_theme_support('custom-header', array(
        'default-image' => '',
        'flex-width'    => true,
        'flex-height'   => true,
    ));

    // Add support for Block Styles
    add_theme_support('wp-block-styles');

    // Add support for full and wide align images
    add_theme_support('align-wide');

    // Add support for editor styles
    add_theme_support('editor-styles');
}
add_action('after_setup_theme', 'buzz_theme_setup');

/**
 * Register widget areas
 */
function buzz_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'buzz-theme'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'buzz-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Area 1', 'buzz-theme'),
        'id'            => 'footer-1',
        'description'   => esc_html__('First footer widget area.', 'buzz-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Area 2', 'buzz-theme'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Second footer widget area.', 'buzz-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Area 3', 'buzz-theme'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Third footer widget area.', 'buzz-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'buzz_widgets_init');

/**
 * Enqueue scripts and styles
 */
function buzz_scripts() {
    // Enqueue Google Fonts
    wp_enqueue_style(
        'buzz-google-fonts',
        'https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Mono:ital,wght@0,300;0,400;0,500;1,400&family=Playfair+Display:ital,wght@0,700;0,900;1,700;1,900&family=Rajdhani:wght@400;500;600;700&family=Barlow+Condensed:ital,wght@0,400;0,700;0,900;1,900&display=swap',
        array(),
        null
    );

    // Enqueue Three.js from CDN
    wp_enqueue_script(
        'buzz-three-js',
        'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js',
        array(),
        'r128',
        false
    );

    // Enqueue main stylesheet
    wp_enqueue_style(
        'buzz-style',
        get_stylesheet_uri(),
        array('buzz-google-fonts'),
        BUZZ_THEME_VERSION
    );

    // Enqueue main JavaScript
    wp_enqueue_script(
        'buzz-main-js',
        BUZZ_THEME_URI . '/assets/js/main.js',
        array('jquery', 'buzz-three-js'),
        BUZZ_THEME_VERSION,
        true
    );

    // Pass PHP data to JavaScript
    wp_localize_script('buzz-main-js', 'buzzData', array(
        'ajaxUrl'   => admin_url('admin-ajax.php'),
        'homeUrl'   => home_url('/'),
        'themeUri'  => BUZZ_THEME_URI,
        'nonce'     => wp_create_nonce('buzz_nonce'),
    ));

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'buzz_scripts');

/**
 * Enqueue block editor assets
 */
function buzz_block_editor_assets() {
    wp_enqueue_style(
        'buzz-editor-style',
        BUZZ_THEME_URI . '/assets/css/editor-style.css',
        array(),
        BUZZ_THEME_VERSION
    );
}
add_action('enqueue_block_editor_assets', 'buzz_block_editor_assets');

/**
 * Register Custom Post Types
 */
function buzz_register_post_types() {
    // Main Posts (using default WordPress posts)
    // Articles are the default post type

    // App Post Type
    register_post_type('bw_app', array(
        'labels'       => array(
            'name'               => esc_html__('Apps', 'buzz-theme'),
            'singular_name'      => esc_html__('App', 'buzz-theme'),
            'add_new'           => esc_html__('Add New', 'buzz-theme'),
            'add_new_item'      => esc_html__('Add New App', 'buzz-theme'),
            'edit_item'         => esc_html__('Edit App', 'buzz-theme'),
            'new_item'          => esc_html__('New App', 'buzz-theme'),
            'view_item'         => esc_html__('View App', 'buzz-theme'),
            'search_items'      => esc_html__('Search Apps', 'buzz-theme'),
            'not_found'         => esc_html__('No apps found', 'buzz-theme'),
            'not_found_in_trash'=> esc_html__('No apps found in trash', 'buzz-theme'),
        ),
        'public'       => true,
        'has_archive'  => true,
        'show_in_rest' => true,
        'rest_base'    => 'apps',
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon'    => 'dashicons-grid-view',
        'rewrite'      => array('slug' => 'apps'),
    ));

    // Drop Alert Post Type
    register_post_type('bw_drop', array(
        'labels'       => array(
            'name'               => esc_html__('Drop Alerts', 'buzz-theme'),
            'singular_name'      => esc_html__('Drop Alert', 'buzz-theme'),
            'add_new'           => esc_html__('Add New', 'buzz-theme'),
            'add_new_item'      => esc_html__('Add New Drop', 'buzz-theme'),
            'edit_item'         => esc_html__('Edit Drop', 'buzz-theme'),
            'new_item'          => esc_html__('New Drop', 'buzz-theme'),
            'view_item'         => esc_html__('View Drop', 'buzz-theme'),
            'search_items'      => esc_html__('Search Drops', 'buzz-theme'),
            'not_found'         => esc_html__('No drops found', 'buzz-theme'),
            'not_found_in_trash'=> esc_html__('No drops found in trash', 'buzz-theme'),
        ),
        'public'       => true,
        'has_archive'  => true,
        'show_in_rest' => true,
        'rest_base'    => 'drops',
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon'    => 'dashicons-album',
        'rewrite'      => array('slug' => 'drops'),
    ));

    // Token Review Post Type
    register_post_type('bw_token', array(
        'labels'       => array(
            'name'               => esc_html__('Token Reviews', 'buzz-theme'),
            'singular_name'      => esc_html__('Token Review', 'buzz-theme'),
            'add_new'           => esc_html__('Add New', 'buzz-theme'),
            'add_new_item'      => esc_html__('Add New Token', 'buzz-theme'),
            'edit_item'         => esc_html__('Edit Token', 'buzz-theme'),
            'new_item'          => esc_html__('New Token', 'buzz-theme'),
            'view_item'         => esc_html__('View Token', 'buzz-theme'),
            'search_items'      => esc_html__('Search Tokens', 'buzz-theme'),
            'not_found'         => esc_html__('No tokens found', 'buzz-theme'),
            'not_found_in_trash'=> esc_html__('No tokens found in trash', 'buzz-theme'),
        ),
        'public'       => true,
        'has_archive'  => true,
        'show_in_rest' => true,
        'rest_base'    => 'tokens',
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon'    => 'dashicons-chart-line',
        'rewrite'      => array('slug' => 'token-reviews'),
    ));
}
add_action('init', 'buzz_register_post_types');

/**
 * Register Custom Taxonomies
 */
function buzz_register_taxonomies() {
    // Main Categories (using default WordPress categories)
    // Additional custom taxonomy for sections

    register_taxonomy('bw_section', 'post', array(
        'labels'       => array(
            'name'              => esc_html__('Sections', 'buzz-theme'),
            'singular_name'     => esc_html__('Section', 'buzz-theme'),
            'search_items'      => esc_html__('Search Sections', 'buzz-theme'),
            'all_items'         => esc_html__('All Sections', 'buzz-theme'),
            'edit_item'        => esc_html__('Edit Section', 'buzz-theme'),
            'update_item'       => esc_html__('Update Section', 'buzz-theme'),
            'add_new_item'      => esc_html__('Add New Section', 'buzz-theme'),
            'new_item_name'     => esc_html__('New Section Name', 'buzz-theme'),
            'menu_name'         => esc_html__('Sections', 'buzz-theme'),
        ),
        'hierarchical'  => true,
        'show_in_rest'  => true,
        'rest_base'     => 'bw_sections',
        'show_admin_column' => true,
        'query_var'     => true,
        'rewrite'       => array('slug' => 'section'),
    ));

    // Platform Tags
    register_taxonomy('bw_platform', 'post', array(
        'labels'       => array(
            'name'              => esc_html__('Platforms', 'buzz-theme'),
            'singular_name'     => esc_html__('Platform', 'buzz-theme'),
            'search_items'      => esc_html__('Search Platforms', 'buzz-theme'),
            'popular_items'     => esc_html__('Popular Platforms', 'buzz-theme'),
            'all_items'         => esc_html__('All Platforms', 'buzz-theme'),
            'edit_item'        => esc_html__('Edit Platform', 'buzz-theme'),
            'update_item'       => esc_html__('Update Platform', 'buzz-theme'),
            'add_new_item'      => esc_html__('Add New Platform', 'buzz-theme'),
            'new_item_name'     => esc_html__('New Platform Name', 'buzz-theme'),
            'menu_name'         => esc_html__('Platforms', 'buzz-theme'),
        ),
        'hierarchical'  => false,
        'show_in_rest'  => true,
        'rest_base'     => 'bw_platforms',
        'show_admin_column' => true,
        'query_var'     => true,
        'rewrite'       => array('slug' => 'platform'),
    ));

    // AI Tools Tags
    register_taxonomy('bw_ai_tool', 'post', array(
        'labels'       => array(
            'name'              => esc_html__('AI Tools', 'buzz-theme'),
            'singular_name'     => esc_html__('AI Tool', 'buzz-theme'),
            'search_items'      => esc_html__('Search AI Tools', 'buzz-theme'),
            'popular_items'     => esc_html__('Popular AI Tools', 'buzz-theme'),
            'all_items'         => esc_html__('All AI Tools', 'buzz-theme'),
            'edit_item'        => esc_html__('Edit AI Tool', 'buzz-theme'),
            'update_item'       => esc_html__('Update AI Tool', 'buzz-theme'),
            'add_new_item'      => esc_html__('Add New AI Tool', 'buzz-theme'),
            'new_item_name'     => esc_html__('New AI Tool Name', 'buzz-theme'),
            'menu_name'         => esc_html__('AI Tools', 'buzz-theme'),
        ),
        'hierarchical'  => false,
        'show_in_rest'  => true,
        'rest_base'     => 'bw_ai_tools',
        'show_admin_column' => true,
        'query_var'     => true,
        'rewrite'       => array('slug' => 'ai-tool'),
    ));

    // Crypto Tokens Tags
    register_taxonomy('bw_crypto_token', 'post', array(
        'labels'       => array(
            'name'              => esc_html__('Crypto Tokens', 'buzz-theme'),
            'singular_name'     => esc_html__('Crypto Token', 'buzz-theme'),
            'search_items'      => esc_html__('Search Tokens', 'buzz-theme'),
            'popular_items'     => esc_html__('Popular Tokens', 'buzz-theme'),
            'all_items'         => esc_html__('All Tokens', 'buzz-theme'),
            'edit_item'        => esc_html__('Edit Token', 'buzz-theme'),
            'update_item'       => esc_html__('Update Token', 'buzz-theme'),
            'add_new_item'      => esc_html__('Add New Token', 'buzz-theme'),
            'new_item_name'     => esc_html__('New Token Name', 'buzz-theme'),
            'menu_name'         => esc_html__('Crypto Tokens', 'buzz-theme'),
        ),
        'hierarchical'  => false,
        'show_in_rest'  => true,
        'rest_base'     => 'bw_crypto_tokens',
        'show_admin_column' => true,
        'query_var'     => true,
        'rewrite'       => array('slug' => 'crypto-token'),
    ));
}
add_action('init', 'buzz_register_taxonomies');

/**
 * Add custom image sizes
 */
function buzz_custom_image_sizes() {
    add_image_size('buzz-hero', 1920, 1080, true);
    add_image_size('buzz-card', 600, 400, true);
    add_image_size('buzz-thumb', 300, 200, true);
    add_image_size('buzz-square', 400, 400, true);
}
add_action('after_setup_theme', 'buzz_custom_image_sizes');

/**
 * Content width
 */
function buzz_content_width() {
    $GLOBALS['content_width'] = apply_filters('buzz_content_width', 1320);
}
add_action('after_setup_theme', 'buzz_content_width', 0);

/**
 * Custom excerpt length
 */
function buzz_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'buzz_excerpt_length');

/**
 * Custom excerpt more
 */
function buzz_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'buzz_excerpt_more');

/**
 * Add classes to body
 */
function buzz_body_classes($classes) {
    if (is_singular('post')) {
        $classes[] = 'single-post';
    }
    
    if (is_front_page()) {
        $classes[] = 'front-page';
    }

    if (is_active_sidebar('sidebar-1')) {
        $classes[] = 'has-sidebar';
    }

    return $classes;
}
add_filter('body_class', 'buzz_body_classes');

/**
 * Custom read more text
 */
function buzz_read_more_text($translated_text, $text, $domain) {
    if ($domain === 'buzz-theme') {
        return 'Read More →';
    }
    return $translated_text;
}
add_filter('gettext', 'buzz_read_more_text', 10, 3);

/**
 * Get section name by category
 */
function buzz_get_section_name($section_id) {
    $sections = array(
        'hiphop'     => 'Hip-Hop & Urban',
        'movies-tv'  => 'Movies & TV',
        'streaming'  => 'Streaming Wars',
        'creators'   => 'Creators',
        'ai-lab'     => 'AI Lab',
        'crypto'     => 'Crypto & Web3',
        'viral'      => 'Viral & Social',
    );
    
    return isset($sections[$section_id]) ? $sections[$section_id] : '';
}

/**
 * Get section color by category
 */
function buzz_get_section_color($section_id) {
    $colors = array(
        'hiphop'    => '#FFE600',
        'movies-tv' => '#8B1A1A',
        'streaming' => '#4488FF',
        'creators'  => '#FF006E',
        'ai-lab'    => '#00FF41',
        'crypto'    => '#00FF87',
        'viral'     => '#FF6B00',
    );
    
    return isset($colors[$section_id]) ? $colors[$section_id] : '#FF2D55';
}

/**
 * Get posts by section
 */
function buzz_get_posts_by_section($section, $posts_per_page = 4) {
    $args = array(
        'post_type'      => 'post',
        'posts_per_page'  => $posts_per_page,
        'category_name'   => $section,
        'orderby'         => 'date',
        'order'           => 'DESC',
    );
    
    return new WP_Query($args);
}

/**
 * Newsletter AJAX handler
 */
function buzz_newsletter_subscribe() {
    check_ajax_referer('buzz_nonce', 'nonce');
    
    $email = sanitize_email($_POST['email']);
    
    if (!is_email($email)) {
        wp_send_json_error(array('message' => 'Invalid email address'));
    }
    
    // Here you would integrate with your email service
    // For now, we'll just return success
    wp_send_json_success(array('message' => 'Successfully subscribed!'));
}
add_action('wp_ajax_buzz_newsletter_subscribe', 'buzz_newsletter_subscribe');
add_action('wp_ajax_nopriv_buzz_newsletter_subscribe', 'buzz_newsletter_subscribe');

/**
 * Share count AJAX handler
 */
function buzz_get_share_count() {
    $post_id = intval($_POST['post_id']);
    
    if (!$post_id) {
        wp_send_json_error(array('message' => 'Invalid post ID'));
    }
    
    $count = get_post_meta($post_id, 'bw_share_count', true) ?: 0;
    
    wp_send_json_success(array('count' => $count));
}
add_action('wp_ajax_buzz_get_share_count', 'buzz_get_share_count');
add_action('wp_ajax_nopriv_buzz_get_share_count', 'buzz_get_share_count');

/**
 * Security: Remove WordPress version from head
 */
remove_action('wp_head', 'wp_generator');

/**
 * Security: Remove Windows Live Writer manifest
 */
remove_action('wp_head', 'wlwmanifest_link');

/**
 * Security: Remove shortlink
 */
remove_action('wp_head', 'wp_shortlink_wp_head');

/**
 * Remove recent comments style
 */
function buzz_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
add_action('wp_head', 'buzz_remove_recent_comments_style', 1);

/**
 * SVG Icons helper function
 */
function buzz_get_icon($icon_name) {
    $icons = array(
        'menu'       => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>',
        'close'      => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>',
        'search'     => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        'arrow-right' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
    );
    
    return isset($icons[$icon_name]) ? $icons[$icon_name] : '';
}
