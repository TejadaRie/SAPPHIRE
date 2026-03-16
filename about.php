<?php include 'header.php'; ?>

<style>
/* ============================================
   ROOT VARIABLES
   ============================================ */
:root {
    --primary: #3b82f6;
    --primary-light: #60a5fa;
    --primary-dark: #2563eb;
    --dark-bg: #0a0f1a;
    --dark-blue: #1c3b6e;
    --darker-blue: #0f2044;
    --text-light: #ffffff;
    --text-muted: rgba(255, 255, 255, 0.6);
    --text-muted-light: rgba(255, 255, 255, 0.4);
    --border-light: rgba(255, 255, 255, 0.1);
    --border-primary: rgba(59, 130, 246, 0.3);
    --glass-bg: rgba(255, 255, 255, 0.04);
    --glass-bg-hover: rgba(59, 130, 246, 0.1);
    --transition: all 0.3s ease;
    --transition-slow: all 0.5s ease;
}

/* ============================================
   NAVIGATION STYLES
   ============================================ */
#mainNavbar.scrolled {
    background: linear-gradient(135deg,
        rgba(30, 58, 138, 0.98) 0%,
        rgba(29, 78, 216, 0.95) 50%,
        rgba(147, 197, 253, 0.7) 100%) !important;
}

#mainNavbar .nav-link {
    color: var(--text-light) !important;
}

#mainNavbar .nav-link.active-page::after {
    background: var(--primary-light) !important;
}

/* ============================================
   PAGE HERO SECTION
   ============================================ */
.page-hero {
    position: relative;
    display: grid;
    grid-template-columns: 1fr 1fr;
    min-height: 88vh;
    overflow: hidden;
    background: linear-gradient(135deg, var(--dark-blue) 0%, var(--darker-blue) 100%);
    border-bottom: 1px solid var(--border-light);
}

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

.hero-copy, .hero-visual {
    position: relative;
    z-index: 2;
}

.hero-visual {
    position: relative;
    background: var(--darker-blue);
    overflow: hidden;
}

.hero-visual-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: grayscale(8%) brightness(0.7);
    transform: scale(1.06);
    animation: heroImgReveal 1.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

@keyframes heroImgReveal {
    from { transform: scale(1.14); opacity: 0; }
    to { transform: scale(1.06); opacity: 1; }
}

.hero-visual-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(120deg, transparent 55%, rgba(10, 15, 26, 0.8) 100%);
}

/* Hero Ticker */
.hero-ticker {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 36px;
    background: rgba(59, 130, 246, 0.18);
    border-top: 1px solid var(--border-primary);
    color: var(--primary-light);
    display: flex;
    align-items: center;
    overflow: hidden;
    font-family: 'Montserrat', sans-serif;
    font-size: 0.65rem;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    backdrop-filter: blur(8px);
}

.ticker-track {
    display: flex;
    gap: 3rem;
    white-space: nowrap;
    animation: ticker 22s linear infinite;
}

.ticker-track span::before {
    content: '— ';
    opacity: 0.4;
}

@keyframes ticker {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
}

/* Hero Copy */
.hero-copy {
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 3rem 4rem;
    animation: heroCopyIn 1s 0.2s cubic-bezier(0.16, 1, 0.3, 1) both;
}

@keyframes heroCopyIn {
    from { opacity: 0; transform: translateY(32px); }
    to { opacity: 1; transform: translateY(0); }
}

.hero-eyebrow {
    font-family: 'Montserrat', sans-serif;
    font-size: 0.65rem;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--primary);
    margin-bottom: 1.2rem;
    display: flex;
    align-items: center;
    gap: 0.7rem;
}

.hero-eyebrow::before {
    content: '';
    display: block;
    width: 28px;
    height: 1px;
    background: var(--primary);
}

.hero-heading {
    font-family: 'Montserrat', sans-serif;
    font-size: clamp(2.2rem, 4vw, 3.6rem);
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.02em;
    color: var(--text-light);
    margin-bottom: 1rem;
}

.hero-heading em {
    font-style: italic;
    color: var(--primary-light);
    font-weight: 700;
}

.hero-subtext {
    font-size: 0.87rem;
    line-height: 1.75;
    color: var(--text-muted);
    max-width: 360px;
    margin-bottom: 1.5rem;
}

/* ============================================
   COMPANY BACKGROUND SECTION - GRID LAYOUT
   ============================================ */
.company-background {
    padding: 80px 0;
    background: linear-gradient(rgba(28, 47, 125, 0.92), rgba(8, 15, 40, 0.95)),
                url('assets/images/sapphire-background.jpg') center/cover no-repeat;
    background-attachment: fixed;
    border-bottom: 5px solid var(--border-light);
    overflow: hidden;
}

.company-background .container,
.location-section .container {
    max-width: 1200px;
    margin: 0 auto;
    padding-left: 30px;
    padding-right: 30px;
}

.bg-eyebrow {
    grid-column: 1 / -1;
    display: inline-block;
    font-family: 'Montserrat', sans-serif;
    font-size: 0.62rem;
    font-weight: 700;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--primary);
    margin-bottom: 16px;
    opacity: 0;
    transform: translateY(16px);
    transition: opacity 0.6s ease, transform 0.6s ease;
    text-align: center;
}

/* Wrapper - NOW USING GRID */
.background-content {
    max-width: 1100px;
    margin: 0 auto;
    text-align: center;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
    align-items: stretch;
}

/* Heading - spans both columns */
.background-content h2 {
    grid-column: 1 / -1;
    font-family: 'Montserrat', sans-serif;
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--text-light);
    margin-bottom: 20px;
    letter-spacing: -1px;
    position: relative;
    display: inline-block;
    text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    opacity: 0;
    transform: translateY(24px);
    transition: opacity 0.7s ease, transform 0.7s ease;
    width: 100%;
}

/* Underline that grows when section enters view */
.background-content h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 3px;
    background: var(--primary);
    border-radius: 2px;
    transition: width 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.6s;
}
.background-content.in-view h2::after { width: 60px; }
.background-content h2:hover::after   { width: 100px !important; transition-delay: 0s !important; }

/* Paragraph cards - now in 2-column grid */
.bg-card {
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-left: 3px solid var(--primary);
    border-radius: 12px;
    padding: 24px 30px;
    margin-bottom: 0;
    text-align: left;
    opacity: 0;
    transform: translateX(-36px);
    transition: opacity 0.7s ease, transform 0.7s ease,
                background 0.3s ease, border-color 0.3s ease;
    height: 100%;
    display: flex;
    align-items: center;
}

/* Even cards - alternate styling */
.bg-card:nth-child(4) {
    transform: translateX(36px);
    border-left: 1px solid rgba(255,255,255,0.08);
    border-right: 3px solid var(--primary-light);
    text-align: left;
}

.bg-card:nth-child(5) {
    transform: translateX(-36px);
}

.bg-card:hover {
    background: rgba(59, 130, 246, 0.08);
    border-color: rgba(59, 130, 246, 0.35);
}

.bg-card p {
    font-family: 'Open Sans', sans-serif;
    font-size: 1rem;
    line-height: 1.9;
    color: rgba(255, 255, 255, 0.8);
    margin: 0;
}

/* Stats bar - spans both columns */
.bg-stats {
    grid-column: 1 / -1;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0;
    margin-top: 24px;
    padding: 28px 40px;
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    backdrop-filter: blur(8px);
    opacity: 0;
    transform: translateY(24px);
    transition: opacity 0.7s ease, transform 0.7s ease;
}

.bg-stat { flex: 1; text-align: center; padding: 8px 20px; }
.bg-stat-num {
    font-family: 'Montserrat', sans-serif;
    font-size: 2.4rem; font-weight: 900;
    color: #60a5fa; letter-spacing: -2px;
    line-height: 1; display: block; margin-bottom: 6px;
}
.bg-stat-label {
    font-family: 'Open Sans', sans-serif;
    font-size: 0.75rem; color: rgba(255,255,255,0.5);
    text-transform: uppercase; letter-spacing: 1.5px;
}
.bg-stat-divider {
    width: 1px; background: rgba(255,255,255,0.12);
    align-self: stretch; flex-shrink: 0;
}

/* ── Trigger states when .in-view is added by JS ── */
.background-content.in-view .bg-eyebrow {
    opacity: 1; transform: translateY(0);
    transition-delay: 0s;
}
.background-content.in-view h2 {
    opacity: 1; transform: translateY(0);
    transition-delay: 0.15s;
}
.background-content.in-view .bg-card {
    opacity: 1; transform: translateX(0);
}
.background-content.in-view .bg-card:nth-child(4) { transition-delay: 0.3s; }
.background-content.in-view .bg-card:nth-child(5) { transition-delay: 0.48s; }
.background-content.in-view .bg-stats {
    opacity: 1; transform: translateY(0);
    transition-delay: 0.66s;
}

/* Responsive */
@media (max-width: 768px) {
    .background-content {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .bg-stats { 
        flex-wrap: wrap; 
        gap: 12px; 
        padding: 20px 16px; 
    }
    
    .bg-stat-divider { 
        display: none; 
    }
    
    .bg-card, 
    .bg-card:nth-child(4),
    .bg-card:nth-child(5) {
        text-align: left;
        transform: translateY(24px);
        border-left: 3px solid var(--primary);
        border-right: none;
        margin-bottom: 0;
    }
    
    .background-content.in-view .bg-card {
        transform: translateY(0);
    }
}

/* ============================================
   LOCATION SECTION
   ============================================ */
.location-section {
    padding: 80px 0;
    background: linear-gradient(rgba(28, 47, 125, 0.92), rgba(8, 15, 40, 0.95)),
                url('assets/images/sapphire-background.jpg') center/cover no-repeat;
    background-attachment: fixed;
    border-bottom: 1px solid var(--border-light);
    overflow: hidden;
}

.location-header {
    text-align: center;
    margin-bottom: 40px;
}

.location-header h2 {
    font-family: 'Montserrat', sans-serif;
    font-size: 2.2rem;
    font-weight: 800;
    color: var(--text-light);
    margin-bottom: 15px;
    letter-spacing: -1px;
}

.location-header p {
    font-family: 'Open Sans', sans-serif;
    color: rgba(255, 255, 255, 0.8);
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.8;
}

.location-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    align-items: start;
}

/* Map Container */
.map-container {
    background: var(--glass-bg);
    backdrop-filter: blur(5px);
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid var(--border-light);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

/* ── GOOGLE MAP IFRAME ── */
#gmap {
    width: 100%;
    height: 340px;
    display: block;
    border: 0;
}

.map-caption {
    padding: 20px;
    background: rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(5px);
}

.map-caption p {
    font-family: 'Open Sans', sans-serif;
    font-size: 0.95rem;
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.7;
    margin: 0;
}

.directions-link {
    color: #60a5fa;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 0.85rem;
    margin-top: 8px;
    transition: color 0.3s ease;
}

.directions-link:hover {
    color: #3b82f6;
}

.directions-link svg {
    width: 16px;
    height: 16px;
}

/* Form Container */
.form-container {
    background: var(--glass-bg);
    backdrop-filter: blur(5px);
    border-radius: 16px;
    padding: 40px;
    border: 1px solid var(--border-light);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.form-container h3 {
    font-family: 'Montserrat', sans-serif;
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--text-light);
    margin-bottom: 10px;
    letter-spacing: -0.5px;
}

.form-container p {
    font-family: 'Open Sans', sans-serif;
    color: var(--text-muted);
    margin-bottom: 30px;
    line-height: 1.7;
}

.form-group {
    margin-bottom: 20px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.form-input,
.form-textarea {
    width: 100%;
    padding: 12px 18px;
    font-family: 'Open Sans', sans-serif;
    font-size: 0.95rem;
    border: 1px solid var(--border-light);
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.1);
    color: var(--text-light);
    transition: var(--transition);
}

.form-textarea {
    min-height: 120px;
    resize: vertical;
}

.form-input::placeholder,
.form-textarea::placeholder {
    color: var(--text-muted-light);
}

.form-input:focus,
.form-textarea:focus {
    outline: none;
    border-color: var(--primary);
    background: rgba(255, 255, 255, 0.15);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
}

.form-submit {
    background: var(--primary);
    color: var(--text-light);
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 0.9rem;
    letter-spacing: 1px;
    text-transform: uppercase;
    padding: 14px 30px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: var(--transition);
    width: 100%;
}

.form-submit:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
}

/* ============================================
   RESPONSIVE DESIGN
   ============================================ */
@media (max-width: 992px) {
    .page-hero {
        grid-template-columns: 1fr;
        min-height: auto;
    }
    
    .hero-visual {
        height: 42vw;
    }
    
    .hero-copy {
        padding: 2rem;
    }
    
    .hero-heading {
        font-size: 2rem;
    }
    
    .connect-layout {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .location-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .background-content h2 {
        font-size: 2rem;
    }
    
    .background-content p {
        font-size: 1rem;
    }
    
    .connect-info-item {
        padding: 15px;
    }
    
    .form-container {
        padding: 30px 20px;
    }
}

@media (max-width: 480px) {
    .hero-copy {
        padding: 1.5rem;
    }
    
    .hero-heading {
        font-size: 1.8rem;
    }
    
    .section-header h2 {
        font-size: 1.8rem;
    }
    
    .connect-pill {
        width: 100%;
        justify-content: center;
    }
}

/* ============================================
   UTILITY CLASSES
   ============================================ */
.text-center { text-align: center; }
.mb-1 { margin-bottom: 0.5rem; }
.mb-2 { margin-bottom: 1rem; }
.mb-3 { margin-bottom: 1.5rem; }
.mb-4 { margin-bottom: 2rem; }
.mb-5 { margin-bottom: 3rem; }
.mt-1 { margin-top: 0.5rem; }
.mt-2 { margin-top: 1rem; }
.mt-3 { margin-top: 1.5rem; }
.mt-4 { margin-top: 2rem; }
.mt-5 { margin-top: 3rem; }
</style>

<!-- ============================================
     HERO SECTION
     ============================================ -->
<div class="page-hero">
    <div class="hero-visual">
        <img class="hero-visual-img"
             src="assets/images/sapphire-background.jpg"
             alt="About Sapphire Tire"
             loading="lazy"
             onerror="this.style.display='none'">
        <div class="hero-visual-overlay"></div>
        <div class="hero-ticker" aria-hidden="true">
            <div class="ticker-track">
                <?php 
                $items = ['EST. 2005', 'PHILIPPINE MADE', 'QUALITY', 'DURABLE', 'RELIABLE', 'TRUSTED', 'INNOVATION', 'RIDER FIRST'];
                for ($r = 0; $r < 3; $r++): 
                    foreach ($items as $it): 
                ?>
                    <span><?= $it ?></span>
                <?php 
                    endforeach; 
                endfor; 
                ?>
            </div>
        </div>
    </div>
    <div class="hero-copy">
        <div class="hero-eyebrow">About Us</div>
        <h1 class="hero-heading">Sapphire <em>Tire</em></h1>
        <p class="hero-subtext">
            Discover the story behind the most trusted tire brand in the Philippines — our commitment to quality, innovation, and the Filipino rider.
        </p>
    </div>
</div>

<!-- ============================================
     COMPANY BACKGROUND SECTION
     ============================================ -->
<section class="company-background">
    <div class="container">
        <div class="background-content" id="bgContent">
            <span class="bg-eyebrow">Est. 2005 &mdash; Carmona, Cavite</span>
            <h2>Our Company Background</h2>

            <div class="bg-card">
                <p>Sapphire Tire was founded in 2005 in Carmona, Cavite with a simple mission: to provide Filipino riders with high-quality, affordable tires that deliver safety, durability, and confidence on every journey. What started as a small manufacturing facility has grown into one of the most trusted tire brands in the Philippines.</p>
            </div>

            <div class="bg-card">
                <p>Over the past two decades, we have expanded our operations nationwide, serving over one million riders across the archipelago. Our commitment to excellence, innovation, and customer satisfaction has made us the preferred choice for daily commuters, delivery riders, and motorcycle enthusiasts alike.</p>
            </div>

            <div class="bg-card">
                <p>Today, Sapphire Tire continues to innovate and expand our product line, offering a wide range of tires for every need — from heavy-duty commercial use to high-performance sports riding. We remain dedicated to our founding principle: being a true <em style="color:#60a5fa;font-style:italic;">kasama mo sa hanapbuhay</em>.</p>
            </div>

            <!-- Stats bar -->
            <div class="bg-stats">
                <div class="bg-stat">
                    <span class="bg-stat-num">21</span>
                    <span class="bg-stat-label">Years Experience</span>
                </div>
                <div class="bg-stat-divider"></div>
                <div class="bg-stat">
                    <span class="bg-stat-num">25</span>
                    <span class="bg-stat-label">Tire Models</span>
                </div>
                <div class="bg-stat-divider"></div>
                <div class="bg-stat">
                    <span class="bg-stat-num">1M+</span>
                    <span class="bg-stat-label">Happy Riders</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     LOCATION & FORM SECTION
     ============================================ -->
<section class="location-section">
    <div class="container">
        <div class="location-header">
            <h2>Our Location</h2>
            <p>Visit us at our facility or send us a message</p>
        </div>
        <div class="location-grid">
            <!-- Map Column -->
            <div class="map-container">
                <!-- Google Maps Embed — no API key required -->
                <iframe
                    id="gmap"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d965.8!2d121.0577!3d14.3139!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d9e3b3c9c001%3A0x4b3e4c2a5f8d1234!2sNew%20World%20Rubber%20Corporation!5e0!3m2!1sen!2sph!4v1"
                    width="100%"
                    height="340"
                    style="border:0; display:block;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="New World Rubber Corporation Location">
                </iframe>

                <div class="map-caption">
                    <p><strong>📍 New World Rubber Corporation</strong><br>
                       Carmona, Cavite, Philippines — Your trusted partner for quality tires since 2005.</p>
                    <a href="https://www.google.com/maps/dir/?api=1&destination=New+World+Rubber+Corporation+Carmona+Cavite"
                       target="_blank"
                       rel="noopener"
                       class="directions-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        Get Directions
                    </a>
                </div>
            </div>

            <!-- Form Column -->
            <div class="form-container">
                <h3>Get In Touch!</h3>
                <p>Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
                <form id="contactForm" action="#" method="POST">
                    <div class="form-row">
                        <input type="email" class="form-input" placeholder="Email" required>
                        <input type="text"  class="form-input" placeholder="Name"  required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-textarea" placeholder="Message" required></textarea>
                    </div>
                    <button type="submit" class="form-submit" id="submitBtn">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Google Maps iframe — no API key required, works immediately -->

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ── Scroll-trigger for "Our Company Background" ── */
    const bgContent = document.getElementById('bgContent');
    if (bgContent) {
        const bgObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    bgObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        bgObserver.observe(bgContent);
    }

    /* ── Animated stat counters ── */
    const statNums = document.querySelectorAll('.bg-stat-num');
    statNums.forEach(el => {
        const raw    = el.textContent.trim();
        const num    = parseInt(raw.replace(/\D/g, ''), 10);
        const suffix = raw.replace(/[\d]/g, '');
        if (isNaN(num)) return;
        el.textContent = '0' + suffix;
        const statObserver = new IntersectionObserver(entries => {
            if (!entries[0].isIntersecting) return;
            statObserver.disconnect();
            let start = 0;
            const dur = 1200, step = 16;
            const timer = setInterval(() => {
                start += step;
                const val = Math.min(Math.round(num * start / dur), num);
                el.textContent = val + suffix;
                if (start >= dur) clearInterval(timer);
            }, step);
        }, { threshold: 0.5 });
        statObserver.observe(el);
    });

    /* ── Contact form ── */
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const submitBtn  = document.getElementById('submitBtn');
            const origText   = submitBtn.textContent;
            submitBtn.textContent = 'Sending…';
            submitBtn.disabled    = true;
            /* Replace setTimeout with your real AJAX / fetch call */
            setTimeout(() => {
                alert('Thank you for your message! We will get back to you soon.');
                contactForm.reset();
                submitBtn.textContent = origText;
                submitBtn.disabled    = false;
            }, 1500);
        });
    }

    /* ── Fade-in on scroll for cards / containers ── */
    const fadeObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity   = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('.connect-info-item, .connect-pill, .map-container, .form-container')
        .forEach(el => {
            el.style.opacity    = '0';
            el.style.transform  = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            fadeObserver.observe(el);
        });

    /* ── Pause ticker on hover ── */
    const ticker = document.querySelector('.ticker-track');
    if (ticker) {
        ticker.addEventListener('mouseenter', () => ticker.style.animationPlayState = 'paused');
        ticker.addEventListener('mouseleave', () => ticker.style.animationPlayState = 'running');
    }
});
</script>

<?php include 'footer.php'; ?>