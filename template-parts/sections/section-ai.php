<?php
/**
 * AI Lab Section Template
 *
 * @package Buzz_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

$ai_posts = buzz_get_posts_by_section('ai', 4);
?>

<!-- ═══ 5. AI LAB ═══ -->
<section class="bw-section bw-ai bw-reveal" id="ai-lab">
    <div class="bw-ai-header">
        <div class="bw-ai-prompt">initialize ai_lab module — buzzwire_daily v2.6</div>
        <h2 class="bw-ai-title">AI LAB</h2>
    </div>
    
    <div class="bw-ai-grid">
        <?php
        $term_num = 1;
        if ($ai_posts->have_posts()) :
            while ($ai_posts->have_posts() && $term_num <= 4) :
                $ai_posts->the_post();
                $term_files = array('analysis_01.sh', 'subscriptions.log', 'music_tools.sh', 'gaming_agents.log');
        ?>
            <article class="bw-ai-terminal">
                <div class="bw-term-bar">
                    <div class="bw-term-dot bw-term-dot-r"></div>
                    <div class="bw-term-dot bw-term-dot-y"></div>
                    <div class="bw-term-dot bw-term-dot-g"></div>
                    <div class="bw-term-title"><?php echo esc_html($term_files[$term_num - 1]); ?></div>
                </div>
                <div class="bw-term-body">
                    <div class="bw-term-cmd"><?php echo esc_html(get_the_title()); ?></div>
                    <h3 class="bw-term-ttl">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <p class="bw-term-ex"><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
                    <div class="bw-term-tags">
                        <span class="bw-term-tag">review</span>
                        <span class="bw-term-tag"><?php echo rand(5, 15); ?> min</span>
                    </div>
                    <div class="bw-term-loading"></div>
                </div>
            </article>
        <?php
                $term_num++;
            endwhile;
            wp_reset_postdata();
        else :
        ?>
            <article class="bw-ai-terminal">
                <div class="bw-term-bar">
                    <div class="bw-term-dot bw-term-dot-r"></div>
                    <div class="bw-term-dot bw-term-dot-y"></div>
                    <div class="bw-term-dot bw-term-dot-g"></div>
                    <div class="bw-term-title">analysis_01.sh</div>
                </div>
                <div class="bw-term-body">
                    <div class="bw-term-cmd">run --compare claude gpt-5 gemini --mode honest</div>
                    <h3 class="bw-term-ttl">
                        <a href="#">Claude vs GPT-5 vs Gemini 2.5: The Honest 2026 Tier List After 200hrs of Testing</a>
                    </h3>
                    <p class="bw-term-ex">
                        We ran 847 standardized prompts across coding, reasoning, creativity, 
                        and factual accuracy. The results contradict the marketing...
                    </p>
                    <div class="bw-term-tags">
                        <span class="bw-term-tag">review</span>
                        <span class="bw-term-tag">comparison</span>
                        <span class="bw-term-tag">12 min</span>
                    </div>
                    <div class="bw-term-loading"></div>
                </div>
            </article>
            
            <article class="bw-ai-terminal">
                <div class="bw-term-bar">
                    <div class="bw-term-dot bw-term-dot-r"></div>
                    <div class="bw-term-dot bw-term-dot-y"></div>
                    <div class="bw-term-dot bw-term-dot-g"></div>
                    <div class="bw-term-title">subscriptions.log</div>
                </div>
                <div class="bw-term-body">
                    <div class="bw-term-cmd">audit --user-subs --find-overlap --output=savings</div>
                    <h3 class="bw-term-ttl">
                        <a href="#">You're Paying $64/Month for 7 AI Subscriptions — And 4 Do the Same Thing</a>
                    </h3>
                    <p class="bw-term-ex">
                        The quiet cost creep hitting power users: ChatGPT Plus, Claude Pro, 
                        Gemini Advanced, Perplexity Pro — overlapping at 73%...
                    </p>
                    <div class="bw-term-tags">
                        <span class="bw-term-tag">finance</span>
                        <span class="bw-term-tag">5 min</span>
                    </div>
                    <div class="bw-term-loading"></div>
                </div>
            </article>
            
            <article class="bw-ai-terminal">
                <div class="bw-term-bar">
                    <div class="bw-term-dot bw-term-dot-r"></div>
                    <div class="bw-term-dot bw-term-dot-y"></div>
                    <div class="bw-term-dot bw-term-dot-g"></div>
                    <div class="bw-term-title">music_tools.sh</div>
                </div>
                <div class="bw-term-body">
                    <div class="bw-term-cmd">test --ai-music --blind --judges=50producers</div>
                    <h3 class="bw-term-ttl">
                        <a href="#">AI Music Production Tools Ranked: Which Actually Sound Human in a Blind Test?</a>
                    </h3>
                    <p class="bw-term-ex">
                        We fed 6 tools the same 16-bar prompt. 50 producers voted blind. 
                        The winner surprised everyone — including us...
                    </p>
                    <div class="bw-term-tags">
                        <span class="bw-term-tag">music</span>
                        <span class="bw-term-tag">hip-hop</span>
                        <span class="bw-term-tag">8 min</span>
                    </div>
                    <div class="bw-term-loading"></div>
                </div>
            </article>
            
            <article class="bw-ai-terminal">
                <div class="bw-term-bar">
                    <div class="bw-term-dot bw-term-dot-r"></div>
                    <div class="bw-term-dot bw-term-dot-y"></div>
                    <div class="bw-term-dot bw-term-dot-g"></div>
                    <div class="bw-term-title">gaming_agents.log</div>
                </div>
                <div class="bw-term-body">
                    <div class="bw-term-cmd">analyze --ai-npc --behavior=adaptive --realtime</div>
                    <h3 class="bw-term-ttl">
                        <a href="#">AI NPCs Are Destroying Game Balance in Real Time — And Players Are Obsessed</a>
                    </h3>
                    <p class="bw-term-ex">
                        Adaptive enemy intelligence that learns your playstyle between sessions. 
                        The future of single-player is already here...
                    </p>
                    <div class="bw-term-tags">
                        <span class="bw-term-tag">gaming</span>
                        <span class="bw-term-tag">web3</span>
                        <span class="bw-term-tag">7 min</span>
                    </div>
                    <div class="bw-term-loading"></div>
                </div>
            </article>
        <?php endif; ?>
    </div>
</section>
