<?php
/**
 * Hip-Hop Section Template
 *
 * @package Buzz_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

// Get posts for this section
$hiphop_posts = buzz_get_posts_by_section('hiphop', 5);
?>

<!-- ═══ 1. HIP-HOP ═══ -->
<section class="bw-section bw-hiphop bw-reveal" id="hiphop">
    <div class="bw-hiphop-header">
        <div class="bw-hiphop-label">Section 01 — Urban Culture</div>
        <h2 class="bw-hiphop-title">
            <span class="bw-white">HIP</span><br>
            HOP<br>
            <span class="bw-white">& URBAN</span>
        </h2>
        <p class="bw-hiphop-sub">// Beats. Culture. Streets. Truth.</p>
    </div>
    
    <div class="bw-hiphop-grid">
        <?php
        $card_num = 1;
        $max_cards = 5;
        
        if ($hiphop_posts->have_posts()) :
            while ($hiphop_posts->have_posts() && $card_num <= $max_cards) :
                $hiphop_posts->the_post();
                $is_main = ($card_num === 1);
                $card_class = $is_main ? 'bw-main' : '';
        ?>
            <article class="bw-hiphop-card <?php echo esc_attr($card_class); ?>">
                <div class="bw-hiphop-big-num"><?php echo str_pad($card_num, 2, '0', STR_PAD_LEFT); ?></div>
                <div class="bw-hiphop-cat">
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) {
                        echo esc_html($categories[0]->name);
                    }
                    ?>
                </div>
                <h3 class="bw-hiphop-ttl">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                
                <?php if ($is_main) : ?>
                    <p class="bw-hiphop-ex"><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
                    
                    <!-- Frequency bar animation -->
                    <div class="bw-freq-bar">
                        <?php for ($i = 0; $i < 7; $i++) : ?>
                            <div class="bw-freq-b" style="height: <?php echo rand(16, 28); ?>px; animation-delay: <?php echo ($i * 0.1); ?>s"></div>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
                
                <div class="bw-hiphop-meta">
                    <span><?php the_author(); ?> · <?php echo get_the_date('M j'); ?></span>
                    <?php if ($is_main) : ?>
                        <span class="bw-hiphop-fire">🔥 <?php echo rand(30, 50); ?>K shares</span>
                    <?php else : ?>
                        <span><?php echo rand(2, 6); ?> min read</span>
                    <?php endif; ?>
                </div>
            </article>
        <?php
                $card_num++;
            endwhile;
            wp_reset_postdata();
        else :
        ?>
            <!-- Fallback static content if no posts -->
            <article class="bw-hiphop-card bw-main">
                <div class="bw-hiphop-big-num">01</div>
                <div class="bw-hiphop-cat">🔥 Exclusive</div>
                <h3 class="bw-hiphop-ttl">
                    <a href="#">The AI-Generated Rap Problem: How Bots Are Gaming the Charts</a>
                </h3>
                <p class="bw-hiphop-ex">
                    A deep investigation into bot-driven stream manipulation — and the artists 
                    fighting back with raw authenticity. The underground response is building...
                </p>
                <div class="bw-freq-bar">
                    <div class="bw-freq-b" style="height: 20px; animation-delay: 0s"></div>
                    <div class="bw-freq-b" style="height: 26px; animation-delay: 0.1s"></div>
                    <div class="bw-freq-b" style="height: 16px; animation-delay: 0.2s"></div>
                    <div class="bw-freq-b" style="height: 28px; animation-delay: 0.3s"></div>
                    <div class="bw-freq-b" style="height: 22px; animation-delay: 0.4s"></div>
                    <div class="bw-freq-b" style="height: 18px; animation-delay: 0.05s"></div>
                    <div class="bw-freq-b" style="height: 24px; animation-delay: 0.15s"></div>
                </div>
                <div class="bw-hiphop-meta">
                    <span>Marcus Webb · 8 min</span>
                    <span class="bw-hiphop-fire">🔥 42K shares</span>
                </div>
            </article>
            
            <article class="bw-hiphop-card">
                <div class="bw-hiphop-big-num">02</div>
                <div class="bw-hiphop-cat">Rap Culture</div>
                <h3 class="bw-hiphop-ttl">
                    <a href="#">Kdot × Pharrell: The Collab Redefining West Coast Sound</a>
                </h3>
                <p class="bw-hiphop-ex">Studio sessions confirmed since February. Sources say the sound is "nothing like either of them separately."</p>
                <div class="bw-hiphop-meta"><span>5 min</span><span class="bw-up">Trending</span></div>
            </article>
            
            <article class="bw-hiphop-card">
                <div class="bw-hiphop-big-num">03</div>
                <div class="bw-hiphop-cat">R&B</div>
                <h3 class="bw-hiphop-ttl">
                    <a href="#">SZA's Unreleased Vault: Everything We Know About LANA II</a>
                </h3>
                <p class="bw-hiphop-ex">Feature confirmations, production credits, and why this could be her most personal work.</p>
                <div class="bw-hiphop-meta"><span>4 min</span><span style="color: #FFE600">Hot</span></div>
            </article>
            
            <article class="bw-hiphop-card">
                <div class="bw-hiphop-big-num">04</div>
                <div class="bw-hiphop-cat">Celebrity</div>
                <h3 class="bw-hiphop-ttl">
                    <a href="#">Travis Scott's $40M Utopia II Tour Stage Production Specs Revealed</a>
                </h3>
                <div class="bw-hiphop-meta"><span>3 min</span><span>Industry</span></div>
            </article>
            
            <article class="bw-hiphop-card">
                <div class="bw-hiphop-big-num">05</div>
                <div class="bw-hiphop-cat">Battle Rap</div>
                <h3 class="bw-hiphop-ttl">
                    <a href="#">Battle Rap Leagues Thrive While Labels Struggle — The Numbers Tell a Story</a>
                </h3>
                <div class="bw-hiphop-meta"><span>6 min</span><span class="bw-hiphop-fire">Breaking</span></div>
            </article>
        <?php endif; ?>
    </div>
</section>
