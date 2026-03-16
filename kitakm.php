<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KITAKM · Sapphire Tire</title>
    <!-- Fonts: Montserrat + Open Sans (same as index) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* ----- base & blue theme (from about.php) ----- */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --bg-deep:    #0f2044;
            --bg-mid:     #1c3b6e;
            --bg-card:    rgba(255,255,255,0.05);
            --blue:       #3b82f6;
            --blue-light: #60a5fa;
            --blue-dim:   rgba(59,130,246,0.15);
            --teal:       #2dd4bf;
            --white:      #ffffff;
            --white-70:   rgba(255,255,255,0.7);
            --white-40:   rgba(255,255,255,0.4);
            --white-10:   rgba(255,255,255,0.06);
            --border:     rgba(255,255,255,0.1);
            --primary: #3b82f6;
            --primary-light: #60a5fa;
        }

        body {
            background: linear-gradient(135deg, #1c3b6e 0%, #0f2044 100%);
            color: var(--white);
            font-family: 'Open Sans', sans-serif;
            min-height: 100vh;
        }

        /* ===== CONSISTENT PARAGRAPH STYLES FOR ALL SECTIONS ===== */
        p, .hero-lead, .journey-header p, .req-note p, 
        .rule-note, .disclaimer-list li, .contact-container > p,
        .key-features-note p, .belief-right p {
            font-size: 1rem !important;
            line-height: 1.7 !important;
            color: var(--white-70);
        }

        /* scroll reveal helper */
        .sr {
            opacity: 0;
            transform: translateY(36px);
            transition: opacity 0.75s cubic-bezier(0.22,1,0.36,1),
                        transform 0.75s cubic-bezier(0.22,1,0.36,1);
        }
        .sr.sr-left  { transform: translateX(-36px); }
        .sr.sr-right { transform: translateX(36px); }
        .sr.sr-scale { transform: scale(0.93); }
        .sr.in { opacity: 1; transform: none; }

        .dot-cluster {
            display: flex; gap: 8px; align-items: center;
        }
        .dot { width: 6px; height: 6px; border-radius: 50%; }
        .dot.blue { background: var(--blue); }
        .dot.teal { background: var(--teal); }
        .dot.dim  { background: rgba(255,255,255,0.2); }

        /* ticker (same as about) */
        .ticker-track {
            display: flex; gap: 3rem;
            white-space: nowrap;
            animation: ticker 22s linear infinite;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--blue-light);
        }
        .ticker-track span::before { content: '· '; opacity: 0.4; }
        @keyframes ticker { from { transform: translateX(0); } to { transform: translateX(-50%); } }

        /* ===== HERO (exact copy of about.hero) ===== */
        .kitakm-hero {
            position: relative;
            min-height: 88vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
            background: linear-gradient(135deg, #1c3b6e 0%, #0f2044 100%);
        }

        .kitakm-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 50% at 80% 50%, rgba(59,130,246,0.18) 0%, transparent 70%),
                radial-gradient(ellipse 40% 60% at 10% 80%, rgba(45,212,191,0.1) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        .kitakm-hero::after {
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

        .hero-left {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 9rem 3.5rem 4rem 5rem;
        }

        .breadcrumb-trail {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.65rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--white-40);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .breadcrumb-trail a { color: var(--white-40); text-decoration: none; }
        .breadcrumb-trail a:hover { color: var(--blue-light); }
        .breadcrumb-trail .sep { opacity: 0.4; }
        .breadcrumb-trail .current { color: var(--blue-light); }

        .hero-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.62rem;
            font-weight: 700;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--blue-light);
            margin-bottom: 1.6rem;
        }
        .hero-tag::before {
            content: '';
            display: block;
            width: 30px; height: 1.5px;
            background: var(--blue-light);
        }

        .hero-h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 3rem !important;
            font-weight: 800;
            line-height: 1.0;
            letter-spacing: -0.03em;
            color: var(--white);
            margin-bottom: 1.6rem;
        }
        .hero-h1 .accent {
            font-style: italic;
            color: var(--blue-light);
            font-weight: 700;
        }

        .hero-lead {
            max-width: 420px;
            margin-bottom: 2rem;
        }

        .hero-right {
            position: relative;
            z-index: 2;
            overflow: hidden;
        }
        .hero-img-wrap {
            position: absolute;
            inset: 0;
        }
        .hero-img-wrap img {
            width: 100%; height: 100%;
            object-fit: cover;
            filter: brightness(0.55) saturate(0.7);
            animation: imgReveal 1.4s cubic-bezier(0.16,1,0.3,1) forwards;
            opacity: 0;
        }
        @keyframes imgReveal {
            from { opacity: 0; transform: scale(1.08); }
            to   { opacity: 1; transform: scale(1); }
        }
        .hero-img-wrap::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(90deg, #1c3b6e 0%, transparent 30%),
                        linear-gradient(0deg, #0f2044 0%, transparent 35%);
        }

        .hero-stat {
            position: absolute;
            right: 2.5rem;
            bottom: 5rem;
            z-index: 5;
            background: rgba(28,59,110,0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(59,130,246,0.35);
            border-radius: 16px;
            padding: 18px 24px;
            min-width: 160px;
            animation: statPop 0.8s cubic-bezier(0.34,1.56,0.64,1) 0.8s both;
        }
        @keyframes statPop {
            from { opacity: 0; transform: translateY(20px) scale(0.9); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }
        .hero-stat-num {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--blue-light);
            line-height: 1;
        }
        .hero-stat-label {
            font-size: 0.72rem;
            font-weight: 500;
            color: var(--white-70);
            margin-top: 4px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        /* ===== BELIEF / "WHY KITAKM" section ===== */
        .belief-section {
            background: rgba(255,255,255,0.04);
            padding: 80px 0;
            position: relative;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }
        .belief-section::before {
            content: '';
            position: absolute;
            top: -200px; right: -150px;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(59,130,246,0.14) 0%, transparent 65%);
            pointer-events: none;
        }
        .belief-grid {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }
        .belief-left .eyebrow {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.62rem;
            font-weight: 700;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--blue-light);
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .belief-left .eyebrow::before {
            content: '';
            width: 28px; height: 1.5px;
            background: var(--blue-light);
        }
        .belief-left h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -0.02em;
            color: var(--white);
        }

        /* ===== JOURNEY / REQUIREMENTS (two cards) ===== */
        .journey-section {
            padding: 80px 0;
            background-image: linear-gradient(135deg, rgba(15,32,68,0.95) 0%, rgba(30,64,175,0.95) 60%, rgba(37,99,235,0.95) 100%), 
                        url('assets/images/whatkitakm.jpg');
            position: relative;
            overflow: hidden;
        }
        .journey-section::before {
            content: '';
            position: absolute;
            top: -200px; right: -200px;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(147,197,253,0.2) 0%, transparent 70%);
            pointer-events: none;
            animation: float 8s ease-in-out infinite;
        }
        @keyframes float { 0%,100%{transform:translateY(0);}50%{transform:translateY(-8px);} }
        .journey-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 40px;
            position: relative;
            z-index: 2;
        }
        .journey-header {
            text-align: left;
            margin-bottom: 60px;
        }
        .journey-header h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--white);
            margin-bottom: 14px;
            letter-spacing: -0.02em;
        }
        .journey-header p {
            font-size: 1.1rem !important;
            line-height: 1.7 !important;
            color: var(--white-70);
            margin-bottom: 1rem;
        }
        .requirements-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }
        .req-card {
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(8px);
            border-radius: 20px;
            padding: 38px;
            border: 1px solid var(--border);
            transition: all 0.3s ease;
        }
        .req-card:hover {
            background: rgba(59,130,246,0.12);
            border-color: var(--blue-light);
            transform: translateY(-6px);
        }
        .req-card h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--blue-light);
            margin-bottom: 24px;
            letter-spacing: -0.02em;
        }
        .req-list, .numbered-list {
            list-style: none;
            padding: 0;
            margin: 0 0 20px 0;
        }
        .req-list li, .numbered-list li {
            font-family: 'Open Sans', sans-serif;
            font-size: 1.05rem !important;
            color: var(--white-70);
            padding: 8px 0 8px 24px;
            position: relative;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .req-list li::before {
            content: '•';
            position: absolute; left: 0;
            color: var(--blue-light);
            font-size: 1.2rem;
        }
        .numbered-list { counter-reset: item; }
        .numbered-list li { counter-increment: item; }
        .numbered-list li::before {
            content: counter(item) ".";
            position: absolute; left: 0;
            color: var(--blue-light);
            font-weight: 600;
        }
        .req-note {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid var(--border);
        }
        .req-note p {
            font-size: 1.05rem !important;
            line-height: 1.6 !important;
        }
        .req-note strong { color: var(--blue-light); }

        /* ===== RULES & DISCLAIMER (two‑column card) ===== */
        .rules-section {
            padding: 80px 0;
            background-image: linear-gradient(135deg, rgba(15,32,68,0.95) 0%, rgba(30,64,175,0.95) 60%, rgba(37,99,235,0.95) 100%), 
                        url('assets/images/whatkitakm.jpg');
            border-bottom: 1px solid var(--border);
        }
        .rules-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 40px;
        }
        .rules-card {
            background: rgba(255,255,255,0.04);
            backdrop-filter: blur(12px);
            border-radius: 24px;
            padding: 48px;
            border: 1px solid var(--border);
        }
        .rules-header h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            color: var(--white);
            margin-bottom: 32px;
        }
        .rules-content {
            display: grid;
            grid-template-columns: 1fr 1px 1fr;
            gap: 40px;
        }
        .rules-divider { background: var(--border); }
        .rules-left h4, .rules-right h4 {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--blue-light);
            margin-bottom: 24px;
        }
        .rule-item {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 16px;
            padding: 12px 16px;
            background: rgba(255,255,255,0.06);
            border-radius: 10px;
            border: 1px solid var(--border);
            transition: 0.2s;
        }
        .rule-item:hover {
            border-color: var(--blue-light);
            background: rgba(59,130,246,0.1);
        }
        .rule-days {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            color: var(--blue-light);
            min-width: 62px;
            font-size: 1.05rem;
        }
        .rule-arrow { 
            color: var(--white-40);
            font-size: 1.05rem;
        }
        .rule-desc { 
            color: var(--white-70);
            font-size: 1.05rem;
        }
        .rule-note {
            margin-top: 20px;
            font-style: italic;
            padding: 12px 16px;
            background: rgba(59,130,246,0.08);
            border-left: 3px solid var(--blue-light);
            border-radius: 0 8px 8px 0;
            font-size: 1.05rem !important;
            line-height: 1.6 !important;
        }
        .disclaimer-list {
            list-style: none;
            padding: 0;
        }
        .disclaimer-list li {
            padding: 10px 0 10px 24px;
            position: relative;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            font-size: 1.05rem !important;
            line-height: 1.6 !important;
        }
        .disclaimer-list li::before {
            content: '•';
            position: absolute; left: 0;
            color: var(--blue-light);
            font-size: 1.2rem;
        }

        /* ===== CONTACT / WHERE TO JOIN ===== */
        .contact-section {
            padding: 80px 0;
            background-image: linear-gradient(135deg, rgba(15,32,68,0.95) 0%, rgba(30,64,175,0.95) 60%, rgba(37,99,235,0.95) 100%), 
                        url('assets/images/whatkitakm.jpg');
        }
        .contact-container {
            max-width: 700px;
            margin: 0 auto;
            padding: 0 40px;
            text-align: center;
        }
        .contact-container h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            color: var(--white);
            margin-bottom: 10px;
        }
        .contact-container > p {
            font-size: 1.1rem !important;
            margin-bottom: 30px;
        }
        .contact-grid {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .contact-card {
            background: rgba(255,255,255,0.06);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 20px 28px;
            text-decoration: none;
            transition: 0.3s;
            display: flex;
            align-items: center;
            gap: 14px;
            flex: 1;
            min-width: 220px;
            max-width: 280px;
        }
        .contact-card:hover {
            border-color: var(--blue-light);
            background: rgba(59,130,246,0.12);
            transform: translateY(-4px);
        }
        .contact-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            background: rgba(59,130,246,0.2);
            display: flex; align-items: center; justify-content: center;
        }
        .contact-icon svg {
            width: 22px; height: 22px;
            stroke: var(--blue-light); fill: none;
        }
        .contact-text-group { text-align: left; }
        .contact-card span {
            font-size: 0.7rem;
            color: var(--white-40);
            text-transform: uppercase;
        }
        .contact-card strong {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            color: var(--white);
            font-size: 0.9rem;
        }

        .key-features-note {
            text-align: center;
            padding: 24px 0;
            border-top: 1px solid var(--border);
        }
        .key-features-note p {
            font-size: 1.1rem !important;
            line-height: 1.6 !important;
        }
        .key-features-note strong { color: var(--blue-light); }

        /* responsive */
        @media (max-width: 1024px) {
            .belief-grid { grid-template-columns: 1fr; }
            .requirements-grid { grid-template-columns: 1fr; }
            .rules-content { grid-template-columns: 1fr; gap: 30px; }
            .rules-divider { display: none; }
        }
        @media (max-width: 768px) {
            .kitakm-hero { grid-template-columns: 1fr; }
            .hero-left { padding: 7rem 1.5rem 3rem; }
            .hero-right { height: 55vw; }
            .hero-stat { right: 1rem; bottom: 3rem; }
        }

        @media (max-width: 480px) {
            p, .hero-lead, .journey-header p, .req-note p,
            .rule-note, .disclaimer-list li, .contact-container > p,
            .key-features-note p, .belief-right p {
                font-size: 0.95rem !important;
            }
        }
    </style>
</head>
<body>
<?php include 'header.php';   // header include 
?>

<!-- ========== HERO (about.php layout) ========== -->
<section class="kitakm-hero">
    <div class="hero-left">
        <div class="breadcrumb-trail">
            <a href="index.php">Home</a>
            <span class="sep">›</span>
            <span class="current">KITAKM</span>
        </div>
        <div class="hero-tag">Volunteer program</div>
        <h1 class="hero-h1">Real‑world mileage,<br><span class="accent">new standard</span></h1>
        <p class="hero-lead">
            Join the largest motorcycle tire database in the Philippines — every kilometre you ride builds credible durability data.
        </p>
        <div class="dot-cluster">
            <div class="dot blue"></div>
            <div class="dot teal"></div>
            <div class="dot dim"></div>
            <div class="dot dim"></div>
        </div>
    </div>
    <div class="hero-right">
        <div class="hero-img-wrap">
            <img src="assets/images/hero-bg.png" alt="Sapphire KITAKM" onerror="this.style.backgroundColor='#1c3b6e'">
        </div>
        
        </div>
    </div>
</section>



<!-- ===== JOURNEY / REQUIREMENTS (two cards) ===== -->
<section class="journey-section">
    <div class="journey-container">
        <div class="journey-header reveal">
            <h2>WHAT IS KITAKM?</h2>
            <p>KITAKM changes that by building the largest real-world motorcycle tire mileage database in the country. Every ride logged contributes verified data showing how tires actually perform on Philippine roads.</p>
            <p>Over time, this growing dataset powers credible durability reports, enables cost-per-kilometer selling, improves dealer close rates, and helps shift the market from price-driven decisions to value-based choices. With every kilometer recorded, KITAKM is turning real-world mileage into the new standard for motorcycle tire durability.</p>
        </div>

        <div class="requirements-grid">
            <div class="req-card reveal reveal-left">
                <h3>Requirements to Join!</h3>
                <ul class="req-list">
                    <li>Working odometer mileage</li>
                    <li>Valid ID</li>
                    <li>Sign Participation agreement</li>
                    <li>Willing to Update every 3,000km</li>
                    <li>Video and Photo of tires every 3,000km</li>
                </ul>
            </div>
            <div class="req-card reveal reveal-right">
                <h3>Required Per Update</h3>
                <ol class="numbered-list">
                    <li>Photo of Odometer mileage</li>
                    <li>Front and Rear photo of tires</li>
                    <li>A short video review or comment about the tires</li>
                </ol>
                <div class="req-note">
                    <p><strong>NOTE:</strong> Tires will be released after your application is approved. No incentives are given upfront. Completion of volunteer on KITAKM program receives another new pair of tires.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== RULES & DISCLAIMER ===== -->
<section class="rules-section">
    <div class="rules-container">
        <div class="rules-card reveal reveal-scale">
            <div class="rules-header">
                <h3>Rules &amp; Disclaimer</h3>
            </div>
            <div class="rules-content">
                <div class="rules-left reveal-stagger">
                    <h4>Rules</h4>
                    <div class="rule-item">
                        <span class="rule-days">3 days</span>
                        <span class="rule-arrow">→</span>
                        <span class="rule-desc">Reminder</span>
                    </div>
                    <div class="rule-item">
                        <span class="rule-days">7 days</span>
                        <span class="rule-arrow">→</span>
                        <span class="rule-desc">Warning</span>
                    </div>
                    <div class="rule-item">
                        <span class="rule-days">15 days</span>
                        <span class="rule-arrow">→</span>
                        <span class="rule-desc">Suspension</span>
                    </div>
                    <p class="rule-note">If cannot submit within 5–7 days when milestone reaches 3,000 km</p>
                </div>
                <div class="rules-divider"></div>
                <div class="rules-right reveal reveal-right">
                    <h4>Disclaimer!</h4>
                    <ul class="disclaimer-list">
                        <li>Not a mileage guarantee or warranty</li>
                        <li>Results on tires are based on riding behavior, road, load, and maintenance</li>
                        <li>All participation is voluntary</li>
                        <li>Consent for media and data usage</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== WHERE TO JOIN ===== -->
<section class="contact-section">
    <div class="contact-container reveal">
        <h2>Where to Join</h2>
        <p>Reach out to us through these channels to start your KITAKM journey</p>

        <div class="contact-grid">
            <a href="https://facebook.com/SapphireTirePH" target="_blank" rel="noopener noreferrer" class="contact-card">
                <div class="contact-icon">
                    <svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </div>
                <div class="contact-text-group">
                    <span>Facebook</span>
                    <strong>@SapphireTirePH</strong>
                </div>
            </a>
            <a href="mailto:kitakm@sapphiretire.com?subject=KITAKM%20Program%20Inquiry&body=Hi%2C%20I'm%20interested%20in%20joining%20the%20KITAKM%20volunteer%20program." class="contact-card">
                <div class="contact-icon">
                    <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                </div>
                <div class="contact-text-group">
                    <span>Email</span>
                    <strong>kitakm@sapphiretire.com</strong>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- footer note -->
<section class="key-features-note">
    <p><strong>Key features overview</strong> — Join KITAKM today and start your journey</p>
</section>

<!-- SCRIPTS (scroll reveal, loader, etc) -->
<script>
    window.addEventListener('load', ()=>{
        setTimeout(()=>{
            document.getElementById('pageLoader').style.opacity='0';
            document.getElementById('pageLoader').style.visibility='hidden';
        },700);
    });

    const srEls = document.querySelectorAll('.sr[data-sr]');
    const srObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const delay = parseInt(entry.target.dataset.delay || 0);
                setTimeout(() => entry.target.classList.add('in'), delay);
                srObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
    srEls.forEach(el => srObserver.observe(el));

    // additional reveal for .reveal items (used in journey, rules etc)
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });
    document.querySelectorAll('.reveal, .reveal-stagger').forEach(el => revealObserver.observe(el));
</script>

<?php include 'footer.php'; ?>
</body>
</html>