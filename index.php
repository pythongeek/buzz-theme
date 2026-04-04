<?php
/**
 * Index Template
 *
 * @package Buzz_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div class="bw-container" style="padding: 80px 5vw;">
    <?php if (have_posts()) : ?>
        
        <div class="bw-section-header" style="margin-bottom: 48px;">
            <h1 class="bw-section-title" style="font-family: var(--font-display); font-size: clamp(48px, 6vw, 80px); color: var(--bw-white);">
                <?php
                if (is_category()) {
                    single_cat_title('Category: ');
                } elseif (is_tag()) {
                    single_tag_title('Tag: ');
                } elseif (is_author()) {
                    echo 'Posts by ' . get_the_author();
                } elseif (is_archive()) {
                    the_archive_title();
                } else {
                    echo 'Latest News';
                }
                ?>
            </h1>
        </div>

        <div class="bw-posts-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 24px;">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('bw-post-card'); ?> style="background: var(--bw-charcoal); padding: 24px; border: 1px solid rgba(255,255,255,0.05);">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="bw-post-thumb" style="margin-bottom: 16px;">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('bw-card'); ?></a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="bw-post-category" style="font-size: 8px; letter-spacing: 0.2em; color: var(--bw-red); text-transform: uppercase; margin-bottom: 8px;">
                        <?php
                        $categories = get_the_category();
                        if (!empty($categories)) {
                            echo esc_html($categories[0]->name);
                        }
                        ?>
                    </div>
                    
                    <h2 class="bw-post-title" style="font-family: var(--font-condensed); font-size: 22px; font-weight: 700; line-height: 1.2; margin-bottom: 12px;">
                        <a href="<?php the_permalink(); ?>" style="color: var(--bw-white);"><?php the_title(); ?></a>
                    </h2>
                    
                    <p class="bw-post-excerpt" style="font-size: 12px; color: rgba(255,255,255,0.5); line-height: 1.6; margin-bottom: 16px;">
                        <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                    </p>
                    
                    <div class="bw-post-meta" style="font-size: 10px; color: rgba(255,255,255,0.3); display: flex; justify-content: space-between;">
                        <span><?php the_author(); ?></span>
                        <span><?php echo get_the_date('M j, Y'); ?></span>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <div class="bw-pagination" style="margin-top: 64px; text-align: center;">
            <?php
            the_posts_pagination(array(
                'prev_text' => '← Previous',
                'next_text' => 'Next →',
                'mid_size'  => 2,
            ));
            ?>
        </div>

    <?php else : ?>
        
        <div style="text-align: center; padding: 120px 0;">
            <h1 style="font-family: var(--font-display); font-size: 64px; color: var(--bw-white); margin-bottom: 16px;">
                No Posts Found
            </h1>
            <p style="font-size: 14px; color: rgba(255,255,255,0.4);">
                There are no posts to display at this time.
            </p>
            <a href="<?php echo esc_url(home_url('/')); ?>" style="display: inline-block; margin-top: 24px; padding: 14px 32px; background: var(--bw-red); color: #000; font-size: 10px; letter-spacing: 0.15em; text-transform: uppercase;">
                Go Home
            </a>
        </div>

    <?php endif; ?>
</div>

<?php get_footer(); ?>
