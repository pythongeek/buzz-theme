<?php
/**
 * Movies & TV Section Template
 *
 * @package Buzz_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

$movies_posts = buzz_get_posts_by_section('movies', 3);
?>

<!-- ═══ 2. MOVIES & TV ═══ -->
<section class="bw-section bw-movies bw-reveal" id="movies-tv">
    <div class="bw-film-grain"></div>
    <div class="bw-film-strip">
        <?php for ($i = 0; $i < 12; $i++) : ?>
            <div class="bw-sprocket"></div>
        <?php endfor; ?>
    </div>
    
    <div class="bw-movies-content">
        <div class="bw-mv-label">Section 02 — Cinema & Television</div>
        <h2 class="bw-mv-title">Movies<br>&amp; <span>TV</span></h2>
        
        <div class="bw-mv-row">
            <?php
            $card_num = 1;
            if ($movies_posts->have_posts()) :
                while ($movies_posts->have_posts() && $card_num <= 3) :
                    $movies_posts->the_post();
            ?>
                <article class="bw-mv-card">
                    <div class="bw-mv-frame">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="bw-mv-img"><?php the_post_thumbnail('bw-card'); ?></div>
                        <?php else : ?>
                            <div class="bw-mv-img" style="background: linear-gradient(135deg, #0a0010, #1a0a00)"></div>
                        <?php endif; ?>
                        <div class="bw-mv-lb bw-mv-lb-top"></div>
                        <div class="bw-mv-lb bw-mv-lb-bot"></div>
                    </div>
                    <div class="bw-mv-card-body">
                        <div class="bw-mv-score">★★★★½ — Critic Pick</div>
                        <h3 class="bw-mv-ttl">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <p class="bw-mv-ex"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        <div class="bw-mv-meta">
                            <span><?php echo get_the_date('M j'); ?></span>
                            <span><?php echo rand(4, 10); ?> min</span>
                        </div>
                    </div>
                </article>
            <?php
                    $card_num++;
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <!-- Fallback static content -->
                <article class="bw-mv-card">
                    <div class="bw-mv-frame">
                        <div class="bw-mv-img" style="background: linear-gradient(135deg, #0a0010, #1a0a00)"></div>
                        <div class="bw-mv-lb bw-mv-lb-top"></div>
                        <div class="bw-mv-lb bw-mv-lb-bot"></div>
                    </div>
                    <div class="bw-mv-card-body">
                        <div class="bw-mv-score">★★★★½ — Critic Pick</div>
                        <h3 class="bw-mv-ttl">
                            <a href="#">Peaky Blinders: The Feature Film — Everything We Know About the Production</a>
                        </h3>
                        <p class="bw-mv-ex">
                            Cillian Murphy confirmed. 1920s Birmingham. A story the series couldn't tell 
                            in six seasons. Production begins April 2026...
                        </p>
                        <div class="bw-mv-meta"><span>Film News</span><span>6 min</span><span style="color: #8B1A1A">Exclusive</span></div>
                    </div>
                </article>
                
                <article class="bw-mv-card">
                    <div class="bw-mv-frame">
                        <div class="bw-mv-img" style="background: linear-gradient(135deg, #000814, #001a14)"></div>
                        <div class="bw-mv-lb bw-mv-lb-top"></div>
                        <div class="bw-mv-lb bw-mv-lb-bot"></div>
                    </div>
                    <div class="bw-mv-card-body">
                        <div class="bw-mv-score">Anime — Rising</div>
                        <h3 class="bw-mv-ttl">
                            <a href="#">Why Anime Is Outselling Hollywood at the Global Box Office in 2026</a>
                        </h3>
                        <p class="bw-mv-ex">
                            The data is undeniable. Three of the top five global box office films 
                            this quarter are anime productions...
                        </p>
                        <div class="bw-mv-meta"><span>Analysis</span><span>8 min</span></div>
                    </div>
                </article>
                
                <article class="bw-mv-card">
                    <div class="bw-mv-frame">
                        <div class="bw-mv-img" style="background: linear-gradient(135deg, #100005, #00050f)"></div>
                        <div class="bw-mv-lb bw-mv-lb-top"></div>
                        <div class="bw-mv-lb bw-mv-lb-bot"></div>
                    </div>
                    <div class="bw-mv-card-body">
                        <div class="bw-mv-score">Streaming</div>
                        <h3 class="bw-mv-ttl">
                            <a href="#">Netflix Cancellation Pattern: The Algorithm Killing Prestige TV Before Season 3</a>
                        </h3>
                        <p class="bw-mv-ex">
                            We analyzed 200 cancelled shows. The formula emerges — and it has nothing 
                            to do with quality...
                        </p>
                        <div class="bw-mv-meta"><span>Industry</span><span>10 min</span></div>
                    </div>
                </article>
            <?php endif; ?>
        </div>
    </div>
</section>
