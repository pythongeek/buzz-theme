<?php
/**
 * Hip-Hop Category Template with 2Pac Animation Effects
 *
 * @package Buzz_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<!-- 2Pac Themed Animation Styles -->
<style>
/* 2Pac Hero Animation Container */
.tupac-hero-bg {
    position: absolute;
    inset: 0;
    overflow: hidden;
    pointer-events: none;
}

/* Floating Thug Life Letters */
.tupac-letter {
    position: absolute;
    font-family: 'Bebas Neue', cursive;
    color: rgba(255, 230, 0, 0.08);
    animation: floatTupac linear infinite;
    text-shadow: 0 0 20px rgba(255, 230, 0, 0.3);
}

@keyframes floatTupac {
    0% {
        transform: translateY(100vh) rotate(0deg);
        opacity: 0;
    }
    10% {
        opacity: 1;
    }
    90% {
        opacity: 1;
    }
    100% {
        transform: translateY(-100vh) rotate(360deg);
        opacity: 0;
    }
}

/* 2Pac Quote Lines */
.tupac-quote-line {
    position: absolute;
    width: 60px;
    height: 2px;
    background: linear-gradient(90deg, transparent, rgba(255, 230, 0, 0.4), transparent);
    animation: quoteSlide 3s ease-in-out infinite;
}

@keyframes quoteSlide {
    0%, 100% {
        transform: translateX(-100px);
        opacity: 0;
    }
    50% {
        transform: translateX(100vw);
        opacity: 1;
    }
}

/* Smoke Effect */
.tupac-smoke {
    position: absolute;
    width: 100px;
    height: 100px;
    background: radial-gradient(ellipse at center, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    animation: smokeRise 8s ease-in-out infinite;
    filter: blur(20px);
}

@keyframes smokeRise {
    0% {
        transform: translateY(0) scale(1);
        opacity: 0;
    }
    50% {
        opacity: 0.3;
    }
    100% {
        transform: translateY(-200px) scale(2);
        opacity: 0;
    }
}

/* Music Notes */
.tupac-note {
    position: absolute;
    font-size: 24px;
    color: rgba(255, 230, 0, 0.15);
    animation: noteFloat 6s ease-in-out infinite;
}

@keyframes noteFloat {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
        opacity: 0;
    }
    25% {
        opacity: 0.8;
    }
    50% {
        transform: translateY(-50px) rotate(15deg);
        opacity: 0.6;
    }
    75% {
        opacity: 0.4;
    }
}

/* West Coast Glow */
.tupac-glow {
    position: absolute;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(204, 0, 0, 0.15) 0%, transparent 70%);
    border-radius: 50%;
    animation: westGlow 4s ease-in-out infinite;
    filter: blur(40px);
}

@keyframes westGlow {
    0%, 100% {
        transform: scale(1);
        opacity: 0.5;
    }
    50% {
        transform: scale(1.2);
        opacity: 0.8;
    }
}

/* 2Pac Portrait Silhouette Animation */
.tupac-silhouette {
    position: absolute;
    right: 5vw;
    top: 50%;
    transform: translateY(-50%);
    width: 400px;
    height: 500px;
    opacity: 0.06;
    background: linear-gradient(180deg, transparent 0%, rgba(204, 0, 0, 0.3) 50%, transparent 100%);
    clip-path: polygon(20% 0%, 80% 0%, 100% 20%, 100% 80%, 80% 100%, 20% 100%, 0% 80%, 0% 20%);
    animation: silhouettePulse 6s ease-in-out infinite;
}

@keyframes silhouettePulse {
    0%, 100% {
        opacity: 0.04;
        transform: translateY(-50%) scale(1);
    }
    50% {
        opacity: 0.08;
        transform: translateY(-50%) scale(1.05);
    }
}

/* Microphone Animation */
.tupac-mic {
    position: absolute;
    font-size: 60px;
    opacity: 0.1;
    animation: micVibrate 0.5s ease-in-out infinite;
}

@keyframes micVibrate {
    0%, 100% {
        transform: rotate(-5deg);
    }
    50% {
        transform: rotate(5deg);
    }
}

/* Beam Me Up Scotty Effect */
.tupac-beam {
    position: absolute;
    width: 4px;
    height: 100px;
    background: linear-gradient(180deg, rgba(255, 230, 0, 0.6), transparent);
    animation: beamUp 2s ease-in-out infinite;
}

@keyframes beamUp {
    0% {
        transform: translateY(50px);
        opacity: 0;
    }
    50% {
        opacity: 1;
    }
    100% {
        transform: translateY(-50px);
        opacity: 0;
    }
}
</style>

<div class="bw-container" style="padding: 0;">
    
    <!-- Hip-Hop Page Content -->
    <div class="bw-hiphop-page">
        <?php
        // Check if we have the hiphop content file and include it
        $hiphop_content_file = get_template_directory() . '/hiphop-body-content.html';
        if (file_exists($hiphop_content_file)) {
            // Read the file content
            $content = file_get_contents($hiphop_content_file);
            
            // Add 2Pac animation container before the closing </header> or page-hero
            $tupac_animation = '
            <!-- 2Pac West Coast Animation Background -->
            <div class="tupac-hero-bg" id="tupacBg">
                <div class="tupac-silhouette"></div>
                <div class="tupac-glow" style="left: 20%; top: 30%;"></div>
                <div class="tupac-glow" style="left: 60%; top: 60%; animation-delay: 2s;"></div>
                <div class="tupac-smoke" style="left: 25%; bottom: 10%;"></div>
                <div class="tupac-smoke" style="left: 55%; bottom: 5%; animation-delay: 3s;"></div>
                <div class="tupac-mic" style="left: 10%; top: 20%;">🎤</div>
                <div class="tupac-note" style="left: 80%; top: 15%; animation-delay: 0.5s;">♪</div>
                <div class="tupac-note" style="left: 15%; top: 60%; animation-delay: 1s;">♫</div>
                <div class="tupac-note" style="left: 70%; top: 70%; animation-delay: 2.5s;">🎵</div>
                <div class="tupac-beam" style="left: 30%;"></div>
                <div class="tupac-beam" style="left: 50%; animation-delay: 1s;"></div>
                <div class="tupac-beam" style="left: 70%; animation-delay: 0.5s;"></div>
            </div>
            
            <!-- 2Pac Floating Letters Container -->
            <div id="tupacLetters" style="position: absolute; inset: 0; pointer-events: none; overflow: hidden;"></div>
            ';
            
            // Insert 2Pac animation before the closing </header> tag of page-hero
            $content = str_replace('</header>', $tupac_animation . '</header>', $content);
            
            echo $content;
        } else {
            // Fallback content if file doesn't exist - with 2Pac animations
            ?>
            <header class="page-hero" style="position: relative; overflow: hidden;">
                
                <!-- 2Pac West Coast Animation Background -->
                <div class="tupac-hero-bg" id="tupacBg">
                    <div class="tupac-silhouette"></div>
                    <div class="tupac-glow" style="left: 20%; top: 30%;"></div>
                    <div class="tupac-glow" style="left: 60%; top: 60%; animation-delay: 2s;"></div>
                    <div class="tupac-smoke" style="left: 25%; bottom: 10%;"></div>
                    <div class="tupac-smoke" style="left: 55%; bottom: 5%; animation-delay: 3s;"></div>
                    <div class="tupac-mic" style="left: 10%; top: 20%;">🎤</div>
                    <div class="tupac-note" style="left: 80%; top: 15%; animation-delay: 0.5s;">♪</div>
                    <div class="tupac-note" style="left: 15%; top: 60%; animation-delay: 1s;">♫</div>
                    <div class="tupac-note" style="left: 70%; top: 70%; animation-delay: 2.5s;">🎵</div>
                </div>
                
                <div class="ph-top-bar">
                    <div class="ph-breadcrumb">
                        <a href="/">Home</a>
                        <span>Hip-Hop & Urban</span>
                    </div>
                    <div class="ph-live">
                        <div class="ph-live-dot"></div>
                        <span>LIVE</span>
                    </div>
                </div>
                
                <div class="ph-culture-tags">
                    <div class="ph-ctag mc">MC</div>
                    <div class="ph-ctag dj">DJ</div>
                    <div class="ph-ctag bb">Breakdance</div>
                    <div class="ph-ctag gr">Graffiti</div>
                    <div class="ph-ctag kn">Knowledge</div>
                </div>
                
                <h1 class="ph-title">
                    <span class="y">HIP</span><span class="r">HOP</span> & <span class="y">URBAN</span> CULTURE
                </h1>
                <p class="ph-tagline">The definitive source for hip-hop news, culture, and lifestyle</p>
                
                <div class="ph-stats">
                    <div class="ph-stat">
                        <div class="ph-stat-n">197</div>
                        <div class="ph-stat-l">Articles</div>
                    </div>
                    <div class="ph-stat">
                        <div class="ph-stat-n">42</div>
                        <div class="ph-stat-l">Exclusives</div>
                    </div>
                    <div class="ph-stat">
                        <div class="ph-stat-n">8.2M</div>
                        <div class="ph-stat-l">Monthly Readers</div>
                    </div>
                </div>
            </header>
            
            <div class="ticker" style="background: var(--red);">
                <div class="ticker-label">HIP-HOP NEWS</div>
                <div class="ticker-wrap">
                    <div class="tick-i">NEW ALBUM RELEASES</div>
                    <div class="tick-i">TOUR ANNOUNCEMENTS</div>
                    <div class="tick-i">FASHION COLLABORATIONS</div>
                    <div class="tick-i">FESTIVAL LINEUPS</div>
                    <div class="tick-i">STREAMING RECORDS</div>
                    <div class="tick-i">AWARD NOMINATIONS</div>
                    <div class="tick-i">CULTURE TRENDS</div>
                    <div class="tick-i">LEGACY ARTISTS</div>
                </div>
            </div>
            
            <section class="section">
                <div class="sec-label spray-label">FEATURED</div>
                <h2 class="sec-h">TOP <span class="y">STORIES</span> IN HIP-HOP</h2>
                
                <?php
                // Query for hiphop category posts
                $args = array(
                    'category_name' => 'hiphop',
                    'posts_per_page' => 6,
                    'orderby' => 'date',
                    'order' => 'DESC'
                );
                $hiphop_query = new WP_Query($args);
                
                if ($hiphop_query->have_posts()) :
                    ?>
                    <div class="main-grid" style="display: grid; grid-template-columns: 1fr .75fr .75fr; gap: 3px;">
                        <?php
                        $post_count = 0;
                        while ($hiphop_query->have_posts()) : $hiphop_query->the_post();
                            $post_count++;
                            $is_hero = ($post_count === 1);
                            ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class($is_hero ? 'card-hero' : 'card-std'); ?>>
                                <?php if (has_post_thumbnail()) : ?>
                                    <div style="margin-bottom: 16px;">
                                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('bw-card'); ?></a>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="card-cat rap">
                                    <div class="cat-dot"></div>
                                    <span>RAP</span>
                                </div>
                                
                                <h2 class="card-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                
                                <p class="card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                
                                <div class="freq">
                                    <div class="fb"></div>
                                    <div class="fb"></div>
                                    <div class="fb"></div>
                                    <div class="fb"></div>
                                    <div class="fb"></div>
                                </div>
                                
                                <div class="card-meta">
                                    <span><?php the_author(); ?></span>
                                    <span><?php echo get_the_date('M j, Y'); ?></span>
                                </div>
                                
                                <div class="read-link">
                                    <span>READ MORE</span>
                                    <span>→</span>
                                </div>
                            </article>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                <?php else : ?>
                    <p>No hip-hop posts found.</p>
                <?php endif; ?>
            </section>
        <?php } ?>
    </div>
</div>

<!-- 2Pac Floating Letters JavaScript Animation -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Create floating thug life letters
    const lettersContainer = document.getElementById('tupacLetters');
    if (lettersContainer) {
        const letters = ['T', 'H', 'U', 'G', 'L', 'I', 'F', 'E', '2', 'P', 'A', 'C', '✦', '☮', '★'];
        const colors = [
            'rgba(255, 230, 0, 0.08)',
            'rgba(204, 0, 0, 0.06)',
            'rgba(57, 255, 20, 0.05)',
            'rgba(255, 255, 255, 0.04)'
        ];
        
        function createLetter() {
            const letter = document.createElement('div');
            letter.className = 'tupac-letter';
            letter.textContent = letters[Math.floor(Math.random() * letters.length)];
            letter.style.left = Math.random() * 100 + '%';
            letter.style.fontSize = (Math.random() * 60 + 40) + 'px';
            letter.style.color = colors[Math.floor(Math.random() * colors.length)];
            letter.style.animationDuration = (Math.random() * 10 + 10) + 's';
            letter.style.animationDelay = Math.random() * 5 + 's';
            
            lettersContainer.appendChild(letter);
            
            // Remove letter after animation
            setTimeout(() => {
                letter.remove();
            }, 20000);
        }
        
        // Create initial letters
        for (let i = 0; i < 8; i++) {
            setTimeout(createLetter, i * 500);
        }
        
        // Keep creating letters
        setInterval(createLetter, 2000);
    }
    
    // Canvas animation for hero background
    const canvas = document.getElementById('heroCanvas');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        
        function resizeCanvas() {
            canvas.width = canvas.offsetWidth;
            canvas.height = canvas.offsetHeight;
        }
        
        resizeCanvas();
        window.addEventListener('resize', resizeCanvas);
        
        // Particle system
        const particles = [];
        const particleCount = 50;
        
        class Particle {
            constructor() {
                this.reset();
            }
            
            reset() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 3 + 1;
                this.speedX = (Math.random() - 0.5) * 0.5;
                this.speedY = Math.random() * -1 - 0.5;
                this.opacity = Math.random() * 0.5 + 0.2;
                this.color = ['rgba(255, 230, 0, ', 'rgba(204, 0, 0, ', 'rgba(57, 255, 20, '][Math.floor(Math.random() * 3)];
            }
            
            update() {
                this.x += this.speedX;
                this.y += this.speedY;
                
                if (this.y < 0) {
                    this.y = canvas.height;
                    this.x = Math.random() * canvas.width;
                }
                if (this.x < 0) this.x = canvas.width;
                if (this.x > canvas.width) this.x = 0;
            }
            
            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fillStyle = this.color + this.opacity + ')';
                ctx.fill();
            }
        }
        
        // Initialize particles
        for (let i = 0; i < particleCount; i++) {
            particles.push(new Particle());
        }
        
        // Gold dust particles
        class GoldDust {
            constructor() {
                this.reset();
            }
            
            reset() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 2 + 0.5;
                this.speedX = (Math.random() - 0.5) * 0.3;
                this.speedY = (Math.random() - 0.5) * 0.3;
                this.pulse = Math.random() * Math.PI * 2;
                this.opacity = Math.random() * 0.3 + 0.1;
            }
            
            update() {
                this.x += this.speedX;
                this.y += this.speedY;
                this.pulse += 0.02;
                
                if (this.x < 0 || this.x > canvas.width) this.speedX *= -1;
                if (this.y < 0 || this.y > canvas.height) this.speedY *= -1;
            }
            
            draw() {
                const opacity = this.opacity * (0.5 + 0.5 * Math.sin(this.pulse));
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fillStyle = 'rgba(255, 230, 0, ' + opacity + ')';
                ctx.fill();
            }
        }
        
        const goldDusts = [];
        for (let i = 0; i < 30; i++) {
            goldDusts.push(new GoldDust());
        }
        
        // Animate
        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            // Draw particles
            particles.forEach(p => {
                p.update();
                p.draw();
            });
            
            // Draw gold dust
            goldDusts.forEach(d => {
                d.update();
                d.draw();
            });
            
            // Draw connections
            particles.forEach((p1, i) => {
                particles.slice(i + 1).forEach(p2 => {
                    const dx = p1.x - p2.x;
                    const dy = p1.y - p2.y;
                    const distance = Math.sqrt(dx * dx + dy * dy);
                    
                    if (distance < 100) {
                        ctx.beginPath();
                        ctx.moveTo(p1.x, p1.y);
                        ctx.lineTo(p2.x, p2.y);
                        ctx.strokeStyle = 'rgba(255, 230, 0, ' + (0.1 * (1 - distance / 100)) + ')';
                        ctx.lineWidth = 0.5;
                        ctx.stroke();
                    }
                });
            });
            
            requestAnimationFrame(animate);
        }
        
        animate();
    }
});
</script>

<?php get_footer(); ?>