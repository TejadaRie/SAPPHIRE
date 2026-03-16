<?php include 'header.php'; ?>

<!-- Page-specific styles for events page - aligned with blue theme -->
<style>
/* Script text - matching index.php style */
.script-text {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 2.5rem;
    color: #60a5fa !important;
    letter-spacing: -1px;
    line-height: 1.15;
}

/* Event & Blog Cards - matching product.php card style */
.event-card, .blog-card {
    background: rgba(255,255,255,0.03);
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,0.1);
    transition: transform 0.4s cubic-bezier(0.4,0,0.2,1), box-shadow 0.4s ease, border-color 0.3s ease;
    overflow: hidden;
    backdrop-filter: blur(8px);
    height: 100%;
    display: flex;
    flex-direction: column;
}
.event-card:hover, .blog-card:hover {
    transform: translateY(-5px);
    border-color: rgba(59,130,246,0.4);
    background: rgba(59,130,246,0.07);
    box-shadow: 0 16px 48px rgba(0,0,0,0.5);
}
.event-card-body, .blog-card-body {
    padding: 1.5rem 1.2rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.event-card .badge, .blog-card .badge {
    font-family: 'Montserrat', sans-serif;
    font-size: 0.75rem;
    font-weight: 700;
    padding: 0.4rem 0.9rem;
    border-radius: 30px;
    background: #3b82f6 !important;
    color: #fff;
    letter-spacing: 1px;
    text-transform: uppercase;
    align-self: flex-start;
    margin-bottom: 0.8rem;
}
.event-card h4, .blog-card h4 {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    color: #ffffff;
    font-size: 1.25rem;
    margin: 0.5rem 0 0.5rem;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.event-card .card-text, .blog-card .card-text {
    font-family: 'Open Sans', sans-serif;
    color: rgba(255,255,255,0.7);
    font-size: 1rem !important;
    line-height: 1.6;
    margin-bottom: 1rem;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    flex: 1;
}
.event-card .btn-outline-primary,
.blog-card .btn-outline-primary {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 0.8rem;
    letter-spacing: 0.5px;
    color: #60a5fa;
    border-color: #3b82f6;
    border-radius: 30px;
    padding: 0.4rem 1.2rem;
    text-transform: uppercase;
    transition: all 0.3s ease;
    align-self: flex-start;
    margin-top: auto;
}
.event-card .btn-outline-primary:hover,
.blog-card .btn-outline-primary:hover {
    background-color: #3b82f6;
    color: #fff;
    border-color: #3b82f6;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59,130,246,0.3);
}

/* Card Media - Fixed aspect ratio container for consistent sizing */
.card-media {
    width: 100%;
    aspect-ratio: 16 / 9;
    overflow: hidden;
    border-radius: 12px 12px 0 0;
    background: rgba(255,255,255,0.04);
    position: relative;
}

/* For Facebook embedded posts */
.card-media .fb-post,
.card-media .fb-video,
.card-media iframe[src*="facebook"] {
    width: 100%;
    height: 100%;
    border: none;
    overflow: hidden;
    position: absolute;
    top: 0;
    left: 0;
}

/* Fallback for when Facebook embed fails */
.card-media .fb-embed-fallback {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #1e3a8a, #1e40af);
    color: white;
    font-family: 'Montserrat', sans-serif;
    font-size: 0.9rem;
    text-align: center;
    padding: 1rem;
}

.card-media img,
.card-media video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.7s cubic-bezier(0.4,0,0.2,1);
}

/* For portrait orientation media, we maintain cover to fill the space evenly */
.card-media img.portrait,
.card-media video.portrait {
    object-fit: cover;
}

.event-card:hover .card-media img,
.blog-card:hover .card-media video:not(.fb-post) {
    transform: scale(1.05);
}

/* Hero section - matching product.php hero style */
.page-hero {
    position: relative;
    display: grid;
    grid-template-columns: 1fr 1fr;
    min-height: 88vh;
    overflow: hidden;
    background: linear-gradient(135deg, #1c3b6e 0%, #0f2044 100%);
    border-bottom: 1px solid rgba(255,255,255,0.08);
    margin-bottom: 0;
}

/* Add these pseudo-elements for the grid and glow effects */
.page-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 60% 50% at 80% 50%, rgba(59,130,246,0.18) 0%, transparent 70%),
        radial-gradient(ellipse 40% 60% at 10% 80%, rgba(45,212,191,0.1) 0%, transparent 70%);
    pointer-events: none;
    z-index: 0;
}

.page-hero::after {
    content: '';
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px);
    background-size: 60px 60px;
    mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 40%, transparent 100%);
    pointer-events: none;
    z-index: 0;
}

/* Update hero-copy and hero-visual to appear above the effects */
.hero-copy, .hero-visual {
    position: relative;
    z-index: 2;
}
.hero-visual {
    position: relative;
    background: #0f2044;
    overflow: hidden;
}
.hero-visual-img {
    width: 100%; height: 100%;
    object-fit: cover;
    filter: grayscale(8%) brightness(0.7);
    transform: scale(1.06);
    animation: heroImgReveal 1.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
@keyframes heroImgReveal {
    from { transform: scale(1.14); opacity: 0; }
    to   { transform: scale(1.06); opacity: 1; }
}
.hero-visual-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(120deg, transparent 55%, rgba(10,15,26,0.8) 100%);
}
.hero-copy {
    display: flex; flex-direction: column;
    justify-content: center; padding: 3rem 4rem;
    animation: heroCopyIn 1s 0.2s cubic-bezier(0.16, 1, 0.3, 1) both;
}
@keyframes heroCopyIn {
    from { opacity: 0; transform: translateY(32px); }
    to   { opacity: 1; transform: translateY(0); }
}
.hero-eyebrow {
    font-family: 'Montserrat', sans-serif;
    font-size: 0.75rem;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: #3b82f6;
    margin-bottom: 1.2rem;
    display: flex;
    align-items: center;
    gap: 0.7rem;
}
.hero-eyebrow::before {
    content: ''; display: block; width: 28px; height: 1px;
    background: #3b82f6;
}
.hero-heading {
    font-family: 'Montserrat', sans-serif;
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.02em;
    color: #ffffff;
    margin-bottom: 1.2rem;
}
.hero-heading em {
    font-style: italic;
    color: #60a5fa;
    font-weight: 700;
}
.hero-subtext {
    font-size: 1rem;
    line-height: 1.75;
    color: rgba(255,255,255,0.7);
    max-width: 400px;
    margin-bottom: 1.5rem;
}

/* Ticker strip */
.hero-ticker {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 36px;
    background: rgba(59,130,246,0.18);
    border-top: 1px solid rgba(59,130,246,0.3);
    color: #93c5fd;
    display: flex; align-items: center;
    overflow: hidden;
    font-family: 'Montserrat', sans-serif;
    font-size: 0.7rem; letter-spacing: 0.18em;
    text-transform: uppercase;
    backdrop-filter: blur(8px);
}
.ticker-track {
    display: flex; gap: 3rem;
    white-space: nowrap;
    animation: ticker 22s linear infinite;
}
.ticker-track span::before { content: '— '; opacity: 0.4; }
@keyframes ticker { from { transform: translateX(0); } to { transform: translateX(-50%); } }

/* Section backgrounds - UPDATED: Removed black background */
body {
    background: #0a0f1a;
}

/* EVENTS Section - Now with blue gradient background */
.events-section {
    background: linear-gradient(rgba(28, 47, 125, 0.92), rgba(8, 15, 40, 0.95)),
                url('assets/images/sapphire-background.jpg') center/cover no-repeat;
    background-attachment: fixed;
    padding: 50px 0;
    border-top: 1px solid rgba(255,255,255,0.08);
    border-bottom: 1px solid rgba(255,255,255,0.08);
}

.blog-section {
    background: linear-gradient(rgba(28, 47, 125, 0.92), rgba(8, 15, 40, 0.95)),
                url('assets/images/sapphire-background.jpg') center/cover no-repeat;
    background-attachment: fixed;
    padding: 50px 0;
    border-top: 1px solid rgba(255,255,255,0.08);
    border-bottom: none;
}

/* Page Header - with blue gradient to match */
.page-header-section {
    background: linear-gradient(rgba(28, 47, 125, 0.92), rgba(8, 15, 40, 0.95)),
                url('assets/images/') center/cover no-repeat;
    background-attachment: fixed;
    padding: 40px 0;
    border-top: 1px solid rgba(255,255,255,0.08);
    border-bottom: 1px solid rgba(255,255,255,0.08);
}

.page-header {
    padding: 40px 0 20px;
}
.page-header h1 {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 3rem;
    color: #ffffff;
    letter-spacing: -1px;
    margin-bottom: 10px;
}
.page-header p {
    color: rgba(255,255,255,0.7);
    font-size: 1.1rem;
}

/* Section Headers */
.section-header {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 2.2rem;
    color: #ffffff;
    letter-spacing: -1px;
    margin-bottom: 1.5rem;
    text-align: center;
}

@media (max-width: 768px) {
    .section-header {
        font-size: 1.8rem;
    }
}

/* Animation delays */
[data-delay="200"] { animation-delay: 0.2s; }
[data-delay="300"] { animation-delay: 0.3s; }
[data-delay="400"] { animation-delay: 0.4s; }
[data-delay="500"] { animation-delay: 0.5s; }
[data-delay="350"] { animation-delay: 0.35s; }
[data-delay="450"] { animation-delay: 0.45s; }
[data-delay="550"] { animation-delay: 0.55s; }
[data-delay="600"] { animation-delay: 0.6s; }
[data-delay="650"] { animation-delay: 0.65s; }
[data-delay="700"] { animation-delay: 0.7s; }
[data-delay="750"] { animation-delay: 0.75s; }

/* Ensure no extra spacing before footer */
section:last-of-type {
    margin-bottom: 0;
}
.py-5:last-of-type {
    padding-bottom: 3rem;
}

/* Responsive */
@media (max-width: 992px) {
    .col-lg-3 {
        width: 50%;
    }
}
@media (max-width: 768px) {
    .page-hero { grid-template-columns: 1fr; min-height: auto; }
    .hero-visual { height: 200px; }
    .hero-copy { padding: 2rem; }
    .hero-heading { font-size: 2.2rem; }
    .col-md-6 {
        width: 100%;
    }
}
</style>

<!-- Load Facebook JavaScript SDK -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0"></script>

<!-- HERO SECTION - matching product.php style -->
<div class="page-hero">
    <div class="hero-visual">
        <img class="hero-visual-img"
             src="assets/images/sapphire-background.jpg"
             alt="Events and Blog"
             onerror="this.style.display='none'">
        <div class="hero-visual-overlay"></div>
        <div class="hero-ticker" aria-hidden="true">
            <div class="ticker-track">
                <?php $items = ['EVENTS', 'BLOG', 'COMMUNITY', 'RIDERS', 'MEETUPS', 'LAUNCHES', 'SEMINARS', 'STORIES']; ?>
                <?php for ($r = 0; $r < 3; $r++): foreach ($items as $it): ?>
                    <span><?= $it ?></span>
                <?php endforeach; endfor; ?>
            </div>
        </div>
    </div>

    <div class="hero-copy">
        <div class="hero-eyebrow">Stay Connected</div>
        <h1 class="hero-heading">
            Events & <em>Blog</em>
        </h1>
        <p class="hero-subtext">
            Join our community events, product launches, and read inspiring stories from riders like you.
        </p>
    </div>
</div>

<!-- EVENTS Section - With 4 cards now -->
<section class="events-section">
    <div class="container">
        <h3 class="section-header" data-animate="fade-up" data-delay="200">EVENTS</h3>
        <div class="row g-4">
            <!-- Event Card 1 -->
            <div class="col-lg-3 col-md-6" data-animate="scale-in" data-delay="300">
                <div class="event-card h-100">
                    <div class="card-media">
                        <img src="assets/images/sample1.png" class="media-image" alt="Event image" onerror="this.style.background='#1c3b6e';this.removeAttribute('src')">
                    </div>
                    <div class="event-card-body">
                        <span class="badge bg-primary">June 15, 2026</span>
                        <h4>Summer Rider Meetup</h4>
                        <p class="card-text">Join us at the Carmona track for a day of fun, demos, and free tire checks. Meet fellow riders and enjoy the day!</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Learn More</a>
                    </div>
                </div>
            </div>
            <!-- Event Card 2 -->
            <div class="col-lg-3 col-md-6" data-animate="scale-in" data-delay="400">
                <div class="event-card h-100">
                    <div class="card-media">
                        <img src="assets/images/sample1.png" class="media-image" alt="Event image" onerror="this.style.background='#1c3b6e';this.removeAttribute('src')">
                    </div>
                    <div class="event-card-body">
                        <span class="badge bg-primary">July 22, 2026</span>
                        <h4>New Product Launch: E907</h4>
                        <p class="card-text">Be the first to test our latest adventure tire at the launch event in Manila. Exclusive preview and special offers.</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Learn More</a>
                    </div>
                </div>
            </div>
            <!-- Event Card 3 -->
            <div class="col-lg-3 col-md-6" data-animate="scale-in" data-delay="500">
                <div class="event-card h-100">
                    <div class="card-media">
                        <img src="assets/images/sample1.png" class="media-image" alt="Event image" onerror="this.style.background='#1c3b6e';this.removeAttribute('src')">
                    </div>
                    <div class="event-card-body">
                        <span class="badge bg-primary">August 5, 2026</span>
                        <h4>Safe Riding Seminar</h4>
                        <p class="card-text">Free seminar on tire maintenance and safe riding techniques for all riders. Learn from expert instructors.</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Learn More</a>
                    </div>
                </div>
            </div>
            <!-- Event Card 4 - New Card -->
            <div class="col-lg-3 col-md-6" data-animate="scale-in" data-delay="600">
                <div class="event-card h-100">
                    <div class="card-media">
                        <img src="assets/images/sample1.png" class="media-image" alt="Event image" onerror="this.style.background='#1c3b6e';this.removeAttribute('src')">
                    </div>
                    <div class="event-card-body">
                        <span class="badge bg-primary">September 12, 2026</span>
                        <h4>Weekend Track Day</h4>
                        <p class="card-text">Open track day for all skill levels. Free tire pressure check and riding tips from professional racers.</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BLOG Section - With 8 cards using Facebook embeds -->
<section id="blog" class="blog-section" style="margin-bottom: 0;">
    <div class="container">
        <h3 class="section-header" data-animate="fade-up" data-delay="200">BLOG</h3>
        <div class="row g-4">
            <!-- Blog Card 1 - Facebook Video -->
            <div class="col-lg-3 col-md-6" data-animate="scale-in" data-delay="300">
                <div class="blog-card h-100">
                    <div class="card-media">
                        <div class="fb-video" data-href="https://www.facebook.com/reel/1498618905159677" data-width="auto" data-show-text="false"></div>
                    </div>
                    <div class="blog-card-body">
                        <span class="badge bg-primary">March 10, 2026</span>
                        <h4>BIDA KASAMBUHAY: Ride Across Luzon</h4>
                        <p class="card-text">How a group conquered 2,000 km on Sapphire tires. Watch the full story on our Facebook page.</p>
                        <a href="https://www.facebook.com/reel/1498618905159677" target="_blank" class="btn btn-outline-primary btn-sm">View on Facebook</a>
                    </div>
                </div>
            </div>
            <!-- Blog Card 2 - Facebook Video -->
            <div class="col-lg-3 col-md-6" data-animate="scale-in" data-delay="350">
                <div class="blog-card h-100">
                    <div class="card-media">
                        <div class="fb-video" data-href="https://www.facebook.com/reel/1611407713413199" data-width="auto" data-show-text="false"></div>
                    </div>
                    <div class="blog-card-body">
                        <span class="badge bg-primary">February 5, 2026</span>
                        <h4>KWENTONG KASAMBUHAY: From Commuter to Entrepreneur</h4>
                        <p class="card-text">One rider's journey using his motorcycle for livelihood. An inspiring story of perseverance.</p>
                        <a href="https://www.facebook.com/reel/1611407713413199" target="_blank" class="btn btn-outline-primary btn-sm">View on Facebook</a>
                    </div>
                </div>
            </div>
            <!-- Blog Card 3 - Facebook Video -->
            <div class="col-lg-3 col-md-6" data-animate="scale-in" data-delay="400">
                <div class="blog-card h-100">
                    <div class="card-media">
                        <div class="fb-video" data-href="https://www.facebook.com/reel/2000239413857448" data-width="auto" data-show-text="false"></div>
                    </div>
                    <div class="blog-card-body">
                        <span class="badge bg-primary">January 20, 2026</span>
                        <h4>Event Recap: New Year Ride 2026</h4>
                        <p class="card-text">Highlights from the annual community ride in Tagaytay. See the amazing photos and videos.</p>
                        <a href="https://www.facebook.com/reel/2000239413857448" target="_blank" class="btn btn-outline-primary btn-sm">View on Facebook</a>
                    </div>
                </div>
            </div>
            <!-- Blog Card 4 - Facebook Video -->
            <div class="col-lg-3 col-md-6" data-animate="scale-in" data-delay="450">
                <div class="blog-card h-100">
                    <div class="card-media">
                        <div class="fb-video" data-href="https://www.facebook.com/reel/685233851312452" data-width="auto" data-show-text="false"></div>
                    </div>
                    <div class="blog-card-body">
                        <span class="badge bg-primary">December 15, 2025</span>
                        <h4>Tire Tech: Understanding Grip & Compounds</h4>
                        <p class="card-text">A deep dive into what makes Sapphire tires exceptional. Technical insights from our engineers.</p>
                        <a href="https://www.facebook.com/reel/685233851312452" target="_blank" class="btn btn-outline-primary btn-sm">View on Facebook</a>
                    </div>
                </div>
            </div>
            <!-- Blog Card 5 - Facebook Video -->
            <div class="col-lg-3 col-md-6" data-animate="scale-in" data-delay="500">
                <div class="blog-card h-100">
                    <div class="card-media">
                        <div class="fb-video" data-href="https://www.facebook.com/reel/1872163616818313" data-width="auto" data-show-text="false"></div>
                    </div>
                    <div class="blog-card-body">
                        <span class="badge bg-primary">November 8, 2025</span>
                        <h4>Rider Spotlight: Maria Santos</h4>
                        <p class="card-text">Meet the first female rider to complete the North Loop. Her journey and achievements.</p>
                        <a href="https://www.facebook.com/reel/1872163616818313" target="_blank" class="btn btn-outline-primary btn-sm">View on Facebook</a>
                    </div>
                </div>
            </div>
            <!-- Blog Card 6 - Facebook Video -->
            <div class="col-lg-3 col-md-6" data-animate="scale-in" data-delay="550">
                <div class="blog-card h-100">
                    <div class="card-media">
                        <div class="fb-video" data-href="https://www.facebook.com/reel/1930125860968398" data-width="auto" data-show-text="false"></div>
                    </div>
                    <div class="blog-card-body">
                        <span class="badge bg-primary">October 22, 2025</span>
                        <h4>Maintenance Tips: Tire Care 101</h4>
                        <p class="card-text">How to extend the life of your motorcycle tires. Essential tips for every rider.</p>
                        <a href="https://www.facebook.com/reel/1930125860968398" target="_blank" class="btn btn-outline-primary btn-sm">View on Facebook</a>
                    </div>
                </div>
            </div>
            <!-- Blog Card 7 - Facebook Video -->
            <div class="col-lg-3 col-md-6" data-animate="scale-in" data-delay="600">
                <div class="blog-card h-100">
                    <div class="card-media">
                        <div class="fb-video" data-href="https://www.facebook.com/reel/1396802295255273" data-width="auto" data-show-text="false"></div>
                    </div>
                    <div class="blog-card-body">
                        <span class="badge bg-primary">September 5, 2025</span>
                        <h4>Group Riding Etiquette</h4>
                        <p class="card-text">Essential tips for safe and enjoyable group rides. Learn the dos and don'ts.</p>
                        <a href="https://www.facebook.com/reel/1396802295255273" target="_blank" class="btn btn-outline-primary btn-sm">View on Facebook</a>
                    </div>
                </div>
            </div>
            <!-- Blog Card 8 - Facebook Video -->
            <div class="col-lg-3 col-md-6" data-animate="scale-in" data-delay="650">
                <div class="blog-card h-100">
                    <div class="card-media">
                        <div class="fb-video" data-href="https://www.facebook.com/reel/1217233713912484" data-width="auto" data-show-text="false"></div>
                    </div>
                    <div class="blog-card-body">
                        <span class="badge bg-primary">August 18, 2025</span>
                        <h4>Top 5 Scenic Rides in the Philippines</h4>
                        <p class="card-text">Must-visit destinations for every motorcycle enthusiast. Plan your next adventure.</p>
                        <a href="https://www.facebook.com/reel/1217233713912484" target="_blank" class="btn btn-outline-primary btn-sm">View on Facebook</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>