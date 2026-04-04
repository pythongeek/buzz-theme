<?php
/**
 * 404 Template
 *
 * @package Buzz_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div class="bw-container" style="padding: 120px 5vw; text-align: center;">
    
    <div class="bw-404-number" style="font-family: var(--font-display); font-size: clamp(120px, 20vw, 280px); line-height: 0.85; color: transparent; -webkit-text-stroke: 2px rgba(255,255,255,0.1); margin-bottom: 32px;">
        404
    </div>
    
    <h1 class="bw-404-title" style="font-family: var(--font-display); font-size: clamp(32px, 5vw, 56px); color: var(--bw-white); margin-bottom: 16px;">
        Signal Lost
    </h1>
    
    <p class="bw-404-desc" style="font-size: 14px; color: rgba(255,255,255,0.4); max-width: 400px; margin: 0 auto 40px; line-height: 1.7;">
        The page you're looking for has drifted into the void. 
        Let's get you back on the wire.
    </p>
    
    <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
        <a href="<?php echo esc_url(home_url('/')); ?>" style="padding: 14px 32px; background: var(--bw-red); color: #000; font-size: 10px; letter-spacing: 0.15em; text-transform: uppercase;">
            Go Home
        </a>
        <a href="<?php echo esc_url(home_url('/apps')); ?>" style="padding: 14px 32px; background: transparent; border: 1px solid rgba(255,255,255,0.2); color: var(--bw-white); font-size: 10px; letter-spacing: 0.15em; text-transform: uppercase;">
            Try Our Apps
        </a>
    </div>
    
</div>

<?php get_footer(); ?>
