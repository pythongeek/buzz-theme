<?php
/**
 * Header template
 *
 * @package Buzz_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div id="bw-cursor"></div>
<div id="bw-cursor-ring"></div>

<!-- Vertical Navigation -->
<nav class="bw-v-nav">
    <div class="bw-v-logo">Buzz<span>Wire</span></div>
    <div class="bw-v-divider"></div>
    
    <div class="bw-v-links">
        <?php
        $nav_items = array(
            'hiphop'    => '🎤',
            'movies-tv' => '🎬',
            'streaming' => '📺',
            'creators'  => '🌟',
            'ai-lab'    => '🤖',
            'crypto'    => '₿',
            'viral'     => '📱',
        );
        
        foreach ($nav_items as $slug => $emoji) :
            $section_name = buzz_get_section_name($slug);
        ?>
            <a href="#<?php echo esc_attr($slug); ?>" class="bw-v-link" title="<?php echo esc_attr($section_name); ?>">
                <?php echo $emoji; ?>
                <span class="bw-v-tooltip"><?php echo esc_html($section_name); ?></span>
            </a>
        <?php endforeach; ?>
    </div>
    
    <div class="bw-v-live">
        <div class="bw-v-dot"></div>
        <span style="writing-mode: vertical-rl; font-size: 7px; letter-spacing: 0.2em">LIVE</span>
    </div>
</nav>

<main class="bw-main">
