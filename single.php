<?php
/**
 * Single Post Template
 *
 * @package Buzz_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<?php while (have_posts()) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <!-- Article Header -->
    <header class="bw-article-header" style="padding: 60px 5vw 40px; max-width: 900px; margin: 0 auto;">
        
        <!-- Category -->
        <div class="bw-article-category" style="font-size: 9px; letter-spacing: 0.3em; color: var(--bw-red); text-transform: uppercase; margin-bottom: 16px;">
            <?php
            $categories = get_the_category();
            if (!empty($categories)) {
                echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" style="color: inherit;">' . esc_html($categories[0]->name) . '</a>';
            }
            ?>
        </div>
        
        <!-- Title -->
        <h1 class="bw-article-title" style="font-family: var(--font-display); font-size: clamp(40px, 6vw, 72px); line-height: 0.95; color: var(--bw-white); margin-bottom: 24px;">
            <?php the_title(); ?>
        </h1>
        
        <!-- Meta -->
        <div class="bw-article-meta" style="display: flex; align-items: center; gap: 24px; font-size: 11px; color: rgba(255,255,255,0.4); margin-bottom: 32px;">
            <span>By <?php the_author(); ?></span>
            <span><?php echo get_the_date('M j, Y'); ?></span>
            <span><?php echo get_the_time('g:i A'); ?></span>
            <span><?php echo reading_time(); ?> min read</span>
        </div>
        
        <!-- Share Buttons -->
        <div class="bw-share-bar" style="display: flex; gap: 12px; padding: 16px 0; border-top: 1px solid rgba(255,255,255,0.05); border-bottom: 1px solid rgba(255,255,255,0.05); margin-bottom: 32px;">
            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener" style="font-size: 10px; padding: 8px 16px; background: rgba(255,255,255,0.05); color: var(--bw-white); letter-spacing: 0.1em;">X</a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener" style="font-size: 10px; padding: 8px 16px; background: rgba(255,255,255,0.05); color: var(--bw-white); letter-spacing: 0.1em;">FB</a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener" style="font-size: 10px; padding: 8px 16px; background: rgba(255,255,255,0.05); color: var(--bw-white); letter-spacing: 0.1em;">LI</a>
            <a href="https://wa.me/?text=<?php echo urlencode(get_the_title() . ' ' . get_permalink()); ?>" target="_blank" rel="noopener" style="font-size: 10px; padding: 8px 16px; background: rgba(255,255,255,0.05); color: var(--bw-white); letter-spacing: 0.1em;">WA</a>
        </div>
    </header>
    
    <!-- Featured Image -->
    <?php if (has_post_thumbnail()) : ?>
        <div class="bw-article-image" style="max-width: 1000px; margin: 0 auto 48px; padding: 0 5vw;">
            <?php the_post_thumbnail('bw-hero', array('style' => 'width: 100%; height: auto;')); ?>
        </div>
    <?php endif; ?>
    
    <!-- Article Content -->
    <div class="bw-article-content" style="max-width: 700px; margin: 0 auto; padding: 0 5vw 80px; font-size: 17px; line-height: 1.8; color: rgba(255,255,255,0.85);">
        <?php
        the_content();
        
        wp_link_pages(array(
            'before' => '<div class="bw-page-links" style="padding: 24px 0; border-top: 1px solid rgba(255,255,255,0.05); margin-top: 24px;">',
            'after'  => '</div>',
        ));
        ?>
    </div>
    
    <!-- Tags -->
    <?php
    $tags = get_the_tags();
    if (!empty($tags)) : ?>
        <div class="bw-article-tags" style="max-width: 700px; margin: 0 auto; padding: 0 5vw 40px; display: flex; gap: 8px; flex-wrap: wrap;">
            <?php foreach ($tags as $tag) : ?>
                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" style="font-size: 9px; padding: 4px 12px; border: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.4); letter-spacing: 0.1em;">
                    <?php echo esc_html($tag->name); ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    <!-- Author Box -->
    <div class="bw-author-box" style="max-width: 700px; margin: 0 auto; padding: 40px 5vw; border-top: 1px solid rgba(255,255,255,0.05);">
        <div style="display: flex; gap: 20px; align-items: center;">
            <?php echo get_avatar(get_the_author_meta('ID'), 64, '', '', array('style' => 'border-radius: 50%;')); ?>
            <div>
                <div style="font-size: 10px; letter-spacing: 0.2em; color: var(--bw-red); text-transform: uppercase; margin-bottom: 4px;">Written by</div>
                <div style="font-size: 18px; font-weight: 600; color: var(--bw-white); margin-bottom: 4px;"><?php the_author(); ?></div>
                <div style="font-size: 12px; color: rgba(255,255,255,0.4);"><?php the_author_meta('description'); ?></div>
            </div>
        </div>
    </div>
    
    <!-- Related Posts -->
    <?php
    $related = new WP_Query(array(
        'post__not_in' => array(get_the_ID()),
        'posts_per_page' => 3,
        'category__in' => wp_get_post_categories(get_the_ID()),
    ));
    
    if ($related->have_posts()) : ?>
        <div class="bw-related-posts" style="background: var(--bw-charcoal); padding: 60px 5vw;">
            <h3 class="bw-related-title" style="font-family: var(--font-display); font-size: 32px; color: var(--bw-white); margin-bottom: 32px;">
                Related Articles
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px;">
                <?php while ($related->have_posts()) : $related->the_post(); ?>
                    <article>
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('bw-card'); ?></a>
                        <?php endif; ?>
                        <h4 style="font-size: 16px; margin: 12px 0;">
                            <a href="<?php the_permalink(); ?>" style="color: var(--bw-white);"><?php the_title(); ?></a>
                        </h4>
                        <div style="font-size: 11px; color: rgba(255,255,255,0.3);"><?php echo get_the_date('M j, Y'); ?></div>
                    </article>
                <?php endwhile; ?>
            </div>
        </div>
        <?php wp_reset_postdata();
    endif;
    ?>
    
    <!-- Comments -->
    <?php
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;
    ?>
    
</article>

<?php endwhile; ?>

<?php get_footer(); ?>
