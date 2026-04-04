<?php
/**
 * Streaming Section Template
 *
 * @package Buzz_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

$streaming_posts = buzz_get_posts_by_section('streaming', 3);
?>

<!-- ═══ 3. STREAMING ═══ -->
<section class="bw-section bw-stream bw-reveal" id="streaming">
    <div class="bw-stream-header">
        <div>
            <div class="bw-stream-label">Section 03 — Streaming Wars</div>
            <h2 class="bw-stream-title">THE <span>STREAM</span><br>WARS</h2>
        </div>
        <div class="bw-stream-status">● 5 platforms · 1 winner</div>
    </div>
    
    <div class="bw-stream-grid">
        <?php
        $card_num = 1;
        if ($streaming_posts->have_posts()) :
            while ($streaming_posts->have_posts() && $card_num <= 3) :
                $streaming_posts->the_post();
        ?>
            <article class="bw-stream-card">
                <div class="bw-platforms">
                    <?php
                    $platforms = array('Netflix', 'Disney+', 'Prime', 'Max', 'Hulu', 'Free');
                    $rand_plat = array_slice($platforms, 0, rand(2, 3));
                    foreach ($rand_plat as $plat) :
                        $plat_class = strtolower($plat);
                        if ($plat === 'Netflix') $plat_class = 'nf';
                        elseif ($plat === 'Disney+') $plat_class = 'di';
                        elseif ($plat === 'Prime') $plat_class = 'pr';
                        elseif ($plat === 'Max') $plat_class = 'hb';
                        elseif ($plat === 'Free') $plat_class = 'fr';
                    ?>
                        <span class="bw-platform-tag bw-<?php echo esc_attr($plat_class); ?>"><?php echo esc_html($plat); ?></span>
                    <?php endforeach; ?>
                </div>
                <h3 class="bw-stream-ttl">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <p class="bw-stream-ex"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                <div class="bw-stream-bar">
                    <div class="bw-stream-bar-fill" style="width: <?php echo rand(60, 95); ?>%"></div>
                </div>
                <div class="bw-stream-meta">
                    <span>Trending <?php echo rand(60, 95); ?>%</span>
                    <span><?php echo rand(4, 10); ?> min</span>
                </div>
            </article>
        <?php
                $card_num++;
            endwhile;
            wp_reset_postdata();
        else :
        ?>
            <article class="bw-stream-card">
                <div class="bw-platforms">
                    <span class="bw-platform-tag bw-nf">Netflix</span>
                    <span class="bw-platform-tag bw-di">Disney+</span>
                </div>
                <h3 class="bw-stream-ttl">
                    <a href="#">Netflix vs Disney+: The Q1 2026 Subscriber War Just Got Ugly</a>
                </h3>
                <p class="bw-stream-ex">
                    Netflix posted +8M subs while Disney+ lost 3M in the same quarter. 
                    The content strategy divergence is now critical mass...
                </p>
                <div class="bw-stream-bar"><div class="bw-stream-bar-fill" style="width: 78%"></div></div>
                <div class="bw-stream-meta"><span>Trending 78%</span><span>7 min</span></div>
            </article>
            
            <article class="bw-stream-card">
                <div class="bw-platforms">
                    <span class="bw-platform-tag bw-pr">Prime</span>
                    <span class="bw-platform-tag bw-fr">Free</span>
                </div>
                <h3 class="bw-stream-ttl">
                    <a href="#">The 5 Best Free Streaming Alternatives Cord-Cutters Are Hiding</a>
                </h3>
                <p class="bw-stream-ex">
                    Tubi, Pluto, Peacock Free, Plex, and one platform most people have never heard of...
                </p>
                <div class="bw-stream-bar"><div class="bw-stream-bar-fill" style="width: 65%; background: #00FF87"></div></div>
                <div class="bw-stream-meta"><span>Guide</span><span>5 min</span></div>
            </article>
            
            <article class="bw-stream-card">
                <div class="bw-platforms">
                    <span class="bw-platform-tag bw-hb">Max</span>
                    <span class="bw-platform-tag bw-nf">Netflix</span>
                </div>
                <h3 class="bw-stream-ttl">
                    <a href="#">Which Streaming Bundle Is Actually Worth It in 2026? We Did the Math</a>
                </h3>
                <p class="bw-stream-ex">
                    Price hikes hit four platforms in Q1. We modeled 12 bundle scenarios 
                    against actual watch-time data...
                </p>
                <div class="bw-stream-bar"><div class="bw-stream-bar-fill" style="width: 91%; background: #FFD700"></div></div>
                <div class="bw-stream-meta"><span>Hot 91%</span><span>9 min</span></div>
            </article>
        <?php endif; ?>
    </div>
</section>
