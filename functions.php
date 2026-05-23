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
define('BUZZ_THEME_VERSION', '1.0.1');

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

    // Enqueue compiled CSS from Node.js build
    wp_enqueue_style(
        'buzz-style',
        BUZZ_THEME_URI . '/assets/css/style.css',
        array('buzz-google-fonts'),
        BUZZ_THEME_VERSION
    );

    // Enqueue compiled JS from Node.js build
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
    // Apps Post Type
    register_post_type('bw_app', array(
        'labels' => array(
            'name'                  => esc_html__('Apps', 'buzz-theme'),
            'singular_name'         => esc_html__('App', 'buzz-theme'),
            'add_new'               => esc_html__('Add New', 'buzz-theme'),
            'add_new_item'          => esc_html__('Add New App', 'buzz-theme'),
            'edit_item'             => esc_html__('Edit App', 'buzz-theme'),
            'new_item'              => esc_html__('New App', 'buzz-theme'),
            'view_item'             => esc_html__('View App', 'buzz-theme'),
            'search_items'          => esc_html__('Search Apps', 'buzz-theme'),
            'not_found'             => esc_html__('No apps found', 'buzz-theme'),
            'not_found_in_trash'    => esc_html__('No apps found in Trash', 'buzz-theme'),
        ),
        'public'                => true,
        'has_archive'           => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_rest'          => true,
        'menu_icon'             => 'dashicons-smartphone',
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'rewrite'               => array('slug' => 'apps'),
    ));

    // Drops Post Type
    register_post_type('bw_drop', array(
        'labels' => array(
            'name'                  => esc_html__('Drops', 'buzz-theme'),
            'singular_name'         => esc_html__('Drop', 'buzz-theme'),
            'add_new'               => esc_html__('Add New', 'buzz-theme'),
            'add_new_item'          => esc_html__('Add New Drop', 'buzz-theme'),
            'edit_item'             => esc_html__('Edit Drop', 'buzz-theme'),
            'new_item'              => esc_html__('New Drop', 'buzz-theme'),
            'view_item'             => esc_html__('View Drop', 'buzz-theme'),
            'search_items'          => esc_html__('Search Drops', 'buzz-theme'),
            'not_found'             => esc_html__('No drops found', 'buzz-theme'),
            'not_found_in_trash'    => esc_html__('No drops found in Trash', 'buzz-theme'),
        ),
        'public'                => true,
        'has_archive'           => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_rest'          => true,
        'menu_icon'             => 'dashicons-calendar-alt',
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'rewrite'               => array('slug' => 'drops'),
    ));

    // Tokens Post Type
    register_post_type('bw_token', array(
        'labels' => array(
            'name'                  => esc_html__('Tokens', 'buzz-theme'),
            'singular_name'         => esc_html__('Token', 'buzz-theme'),
            'add_new'               => esc_html__('Add New', 'buzz-theme'),
            'add_new_item'          => esc_html__('Add New Token', 'buzz-theme'),
            'edit_item'             => esc_html__('Edit Token', 'buzz-theme'),
            'new_item'              => esc_html__('New Token', 'buzz-theme'),
            'view_item'             => esc_html__('View Token', 'buzz-theme'),
            'search_items'          => esc_html__('Search Tokens', 'buzz-theme'),
            'not_found'             => esc_html__('No tokens found', 'buzz-theme'),
            'not_found_in_trash'    => esc_html__('No tokens found in Trash', 'buzz-theme'),
        ),
        'public'                => true,
        'has_archive'           => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_rest'          => true,
        'menu_icon'             => 'dashicons-money-alt',
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'rewrite'               => array('slug' => 'tokens'),
    ));
}
add_action('init', 'buzz_register_post_types');

/**
 * Register Custom Taxonomies
 */
function buzz_register_taxonomies() {
    // Section Taxonomy
    register_taxonomy('bw_section', array('post', 'bw_app', 'bw_drop', 'bw_token'), array(
        'labels' => array(
            'name'                  => esc_html__('Sections', 'buzz-theme'),
            'singular_name'         => esc_html__('Section', 'buzz-theme'),
            'search_items'          => esc_html__('Search Sections', 'buzz-theme'),
            'all_items'             => esc_html__('All Sections', 'buzz-theme'),
            'parent_item'           => esc_html__('Parent Section', 'buzz-theme'),
            'parent_item_colon'     => esc_html__('Parent Section:', 'buzz-theme'),
            'edit_item'             => esc_html__('Edit Section', 'buzz-theme'),
            'update_item'           => esc_html__('Update Section', 'buzz-theme'),
            'add_new_item'          => esc_html__('Add New Section', 'buzz-theme'),
            'new_item_name'         => esc_html__('New Section Name', 'buzz-theme'),
            'menu_name'             => esc_html__('Sections', 'buzz-theme'),
        ),
        'hierarchical'          => true,
        'public'                  => true,
        'show_ui'                 => true,
        'show_admin_column'       => true,
        'show_in_rest'            => true,
        'rewrite'                 => array('slug' => 'section'),
    ));

    // Platform Taxonomy
    register_taxonomy('bw_platform', array('post', 'bw_app'), array(
        'labels' => array(
            'name'                  => esc_html__('Platforms', 'buzz-theme'),
            'singular_name'         => esc_html__('Platform', 'buzz-theme'),
            'search_items'          => esc_html__('Search Platforms', 'buzz-theme'),
            'all_items'             => esc_html__('All Platforms', 'buzz-theme'),
            'edit_item'             => esc_html__('Edit Platform', 'buzz-theme'),
            'update_item'           => esc_html__('Update Platform', 'buzz-theme'),
            'add_new_item'          => esc_html__('Add New Platform', 'buzz-theme'),
            'new_item_name'         => esc_html__('New Platform Name', 'buzz-theme'),
            'menu_name'             => esc_html__('Platforms', 'buzz-theme'),
        ),
        'hierarchical'          => false,
        'public'                  => true,
        'show_ui'                 => true,
        'show_admin_column'       => true,
        'show_in_rest'            => true,
        'rewrite'                 => array('slug' => 'platform'),
    ));

    // AI Tool Taxonomy
    register_taxonomy('bw_ai_tool', array('post', 'bw_app'), array(
        'labels' => array(
            'name'                  => esc_html__('AI Tools', 'buzz-theme'),
            'singular_name'         => esc_html__('AI Tool', 'buzz-theme'),
            'search_items'          => esc_html__('Search AI Tools', 'buzz-theme'),
            'all_items'             => esc_html__('All AI Tools', 'buzz-theme'),
            'edit_item'             => esc_html__('Edit AI Tool', 'buzz-theme'),
            'update_item'           => esc_html__('Update AI Tool', 'buzz-theme'),
            'add_new_item'          => esc_html__('Add New AI Tool', 'buzz-theme'),
            'new_item_name'         => esc_html__('New AI Tool Name', 'buzz-theme'),
            'menu_name'             => esc_html__('AI Tools', 'buzz-theme'),
        ),
        'hierarchical'          => false,
        'public'                  => true,
        'show_ui'                 => true,
        'show_admin_column'       => true,
        'show_in_rest'            => true,
        'rewrite'                 => array('slug' => 'ai-tool'),
    ));

    // Crypto Token Taxonomy
    register_taxonomy('bw_crypto_token', array('post', 'bw_token'), array(
        'labels' => array(
            'name'                  => esc_html__('Crypto Tokens', 'buzz-theme'),
            'singular_name'         => esc_html__('Crypto Token', 'buzz-theme'),
            'search_items'          => esc_html__('Search Crypto Tokens', 'buzz-theme'),
            'all_items'             => esc_html__('All Crypto Tokens', 'buzz-theme'),
            'edit_item'             => esc_html__('Edit Crypto Token', 'buzz-theme'),
            'update_item'           => esc_html__('Update Crypto Token', 'buzz-theme'),
            'add_new_item'          => esc_html__('Add New Crypto Token', 'buzz-theme'),
            'new_item_name'         => esc_html__('New Crypto Token Name', 'buzz-theme'),
            'menu_name'             => esc_html__('Crypto Tokens', 'buzz-theme'),
        ),
        'hierarchical'          => false,
        'public'                  => true,
        'show_ui'                 => true,
        'show_admin_column'       => true,
        'show_in_rest'            => true,
        'rewrite'                 => array('slug' => 'crypto-token'),
    ));
}
add_action('init', 'buzz_register_taxonomies');

/**
 * AJAX handler for newsletter signup
 */
function buzz_newsletter_signup() {
    check_ajax_referer('buzz_nonce', 'nonce');
    
    $email = sanitize_email($_POST['email']);
    
    if (!is_email($email)) {
        wp_send_json_error('Invalid email address');
    }
    
    // Here you would typically add the email to your newsletter service
    // For now, we'll just log it
    $subscribers = get_option('buzz_newsletter_subscribers', array());
    $subscribers[] = array(
        'email' => $email,
        'date'  => current_time('mysql'),
    );
    update_option('buzz_newsletter_subscribers', $subscribers);
    
    wp_send_json_success('Successfully subscribed!');
}
add_action('wp_ajax_buzz_newsletter_signup', 'buzz_newsletter_signup');
add_action('wp_ajax_nopriv_buzz_newsletter_signup', 'buzz_newsletter_signup');

/**
 * Custom excerpt length
 */
function buzz_excerpt_length($length) {
    return 20;
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
 * Add custom image sizes
 */
function buzz_add_image_sizes() {
    add_image_size('buzz-card', 400, 300, true);
    add_image_size('buzz-hero', 1200, 600, true);
    add_image_size('buzz-thumbnail', 150, 150, true);
}
add_action('after_setup_theme', 'buzz_add_image_sizes');

/**
 * Remove WordPress version from head
 */
function buzz_remove_version() {
    return '';
}
add_filter('the_generator', 'buzz_remove_version');

/**
 * Cleanup WordPress head
 */
function buzz_cleanup_head() {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    
    add_filter('the_generator', '__return_empty_string');
}
add_action('init', 'buzz_cleanup_head');

/**
 * Add custom body classes
 */
function buzz_body_classes($classes) {
    if (is_singular()) {
        $classes[] = 'singular';
    }
    
    if (is_front_page()) {
        $classes[] = 'front-page';
    }
    
    return $classes;
}
add_filter('body_class', 'buzz_body_classes');

/**
 * Custom template tags
 */
function buzz_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    
    $time_string = sprintf(
        $time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date())
    );
    
    printf(
        '<span class="posted-on">%1$s <a href="%2$s" rel="bookmark">%3$s</a></span>',
        esc_html__('Posted on', 'buzz-theme'),
        esc_url(get_permalink()),
        $time_string
    );
}

/**
 * Custom pagination
 */
function buzz_pagination() {
    the_posts_pagination(array(
        'mid_size'  => 2,
        'prev_text' => esc_html__('Previous', 'buzz-theme'),
        'next_text' => esc_html__('Next', 'buzz-theme'),
    ));
}

/**
 * Social share buttons
 */
function buzz_social_share() {
    $url   = urlencode(get_permalink());
    $title = urlencode(get_the_title());
    
    $share_links = array(
        'twitter'   => "https://twitter.com/intent/tweet?url={$url}&text={$title}",
        'facebook'  => "https://www.facebook.com/sharer/sharer.php?u={$url}",
        'linkedin'  => "https://www.linkedin.com/shareArticle?mini=true&url={$url}&title={$title}",
        'reddit'    => "https://reddit.com/submit?url={$url}&title={$title}",
    );
    
    echo '<div class="share-bar">';
    echo '<span class="share-label">' . esc_html__('Share:', 'buzz-theme') . '</span>';
    
    foreach ($share_links as $platform => $link) {
        printf(
            '<a href="%s" target="_blank" rel="noopener noreferrer" class="share-link share-%s">%s</a>',
            esc_url($link),
            esc_attr($platform),
            esc_html(ucfirst($platform))
        );
    }
    
    echo '</div>';
}

/**
 * Reaction buttons
 */
function buzz_reaction_buttons() {
    $reactions = array(
        'wow'    => array('emoji' => '😮', 'label' => 'Wow'),
        'sad'    => array('emoji' => '😭', 'label' => 'Sad'),
        'funny'  => array('emoji' => '😂', 'label' => 'Funny'),
        'fire'   => array('emoji' => '🔥', 'label' => 'Fire'),
        'useful' => array('emoji' => '💡', 'label' => 'Useful'),
    );
    
    echo '<div class="reaction-bar">';
    
    foreach ($reactions as $key => $reaction) {
        printf(
            '<button class="reaction-btn" data-reaction="%s"><span class="reaction-emoji">%s</span> <span class="reaction-label">%s</span></button>',
            esc_attr($key),
            esc_html($reaction['emoji']),
            esc_html($reaction['label'])
        );
    }
    
    echo '</div>';
}

/**
 * Load Jetpack compatibility file
 */
if (defined('JETPACK__VERSION')) {
    require BUZZ_THEME_DIR . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file
 */
if (class_exists('WooCommerce')) {
    require BUZZ_THEME_DIR . '/inc/woocommerce.php';
}
