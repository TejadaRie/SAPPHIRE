<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SAPPHIRE TIRE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        /* ═══════════════════════════════════════════
           NAVBAR BASE - UNIFORM FOR ALL PAGES
        ═══════════════════════════════════════════ */
        #mainNavbar {
            background: linear-gradient(135deg,
                rgba(29, 78, 216, 0.45) 0%,
                rgba(59, 130, 246, 0.32) 40%,
                hsla(213, 18%, 56%, 0.20) 100%) !important;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 2px 20px rgba(29, 78, 216, 0.08);
            transition: background 0.5s ease, box-shadow 0.5s ease, padding 0.4s ease;
            padding-top: 8px;
            padding-bottom: 8px;
        }

        /* Hero page: ultra-transparent at very top */
        #mainNavbar.navbar-home:not(.scrolled) {
            background: linear-gradient(135deg,
                rgba(29, 78, 216, 0.22) 0%,
                rgba(59, 130, 246, 0.15) 40%,
                rgba(191, 219, 254, 0.08) 100%) !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.10);
            box-shadow: none;
        }

        /* Scrolled — slightly more solid so links stay readable */
        #mainNavbar.scrolled {
            background: linear-gradient(135deg,
                rgba(30, 58, 138, 0.70) 0%,
                rgba(29, 78, 216, 0.58) 45%,
                rgba(147, 197, 253, 0.35) 100%) !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.14);
            box-shadow: 0 4px 24px rgba(29, 78, 216, 0.12);
        }

        /* ═══════════════════════════════════════════
           DEFAULT LAYOUT (top of page)
           [LOGO left]  [HOME PRODUCT EVENTS ABOUT KITAKM right]
        ═══════════════════════════════════════════ */
        #mainNavbar .container {
            display: flex;
            align-items: center;
            position: relative;
        }

        /* Brand */
        .navbar-brand {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            flex-shrink: 0;
            z-index: 10;
        }
        .navbar-brand img {
            height: 72px;
            transition: height 0.4s ease;
        }

        /* Nav links */
        #mainNavbar .nav-link {
            color: #ffffff !important;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 2px;
            padding: 6px 16px;
            border-radius: 6px;
            transition: background 0.2s ease;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
            white-space: nowrap;
            position: relative;
        }
        #mainNavbar .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff !important;
            text-shadow: none;
        }

        /* ── ACTIVE: underline only, no background ── */
        #mainNavbar .nav-link.active-page {
            background: transparent !important;
            color: #ffffff !important;
        }
        #mainNavbar .nav-link.active-page::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 2px;
            background: #60a5fa;
            border-radius: 2px;
        }

        /* Mobile: left border instead of underline */
        @media (max-width: 991px) {
            #mainNavbar .nav-link.active-page::after {
                display: none;
            }
            #mainNavbar .nav-link.active-page {
                border-left: 3px solid #60a5fa;
                padding-left: 13px;
            }
        }

        /* Mobile toggler */
        #mainNavbar .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5);
        }
        #mainNavbar .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255,255,255,0.9%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* ═══════════════════════════════════════════
           DESKTOP ONLY LAYOUT SWITCHING
        ═══════════════════════════════════════════ */
        @media (min-width: 992px) {

            .navbar-toggler { display: none !important; }

            #navbarNav {
                display: flex !important;
                flex: 1;
                align-items: center;
            }

            /* ── DEFAULT: Logo left, all 5 links right ── */
            #mainNavbar:not(.scrolled) .navbar-brand {
                margin-right: 32px;
            }
            #mainNavbar:not(.scrolled) #navbarNav {
                justify-content: flex-end;
            }
            #mainNavbar:not(.scrolled) #navLeft  { display: none !important; }
            #mainNavbar:not(.scrolled) #navRight { display: none !important; }
            #mainNavbar:not(.scrolled) #navCenter {
                display: flex !important;
                flex-direction: row;
                margin-left: auto;
                gap: 2px;
            }

            /* ── SCROLLED: [left nav] [centered logo] [right nav] ── */
            #mainNavbar.scrolled .container {
                justify-content: space-between;
                padding-top: 9px;
                padding-bottom: 7px;
            }

            #mainNavbar.scrolled .navbar-brand {
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
                margin-right: 0;
            }
            #mainNavbar.scrolled .navbar-brand img {
                height: 58px;
            }
            #mainNavbar.scrolled .navbar-brand::after {
                content: '';
                display: block;
                width: 28px;
                height: 2px;
                background: rgba(255,255,255,0.45);
                margin: 3px auto 0;
                border-radius: 2px;
            }

            #mainNavbar.scrolled #navbarNav {
                justify-content: center;
                width: 100%;
            }
            #mainNavbar.scrolled #navCenter { display: none !important; }

            #mainNavbar.scrolled #navLeft {
                display: flex !important;
                flex-direction: row;
                gap: 2px;
                padding-right: 250px; /* Increased to accommodate 5 links */
            }
            #mainNavbar.scrolled #navRight {
                display: flex !important;
                flex-direction: row;
                gap: 2px;
                padding-left: 250px; /* Increased to accommodate 5 links */
            }
        }

        /* ═══════════════════════════════════════════
           MOBILE: always default layout
        ═══════════════════════════════════════════ */
        @media (max-width: 991px) {
            #navLeft, #navRight { display: none !important; }
            #navCenter { display: flex; flex-direction: column; }
            #mainNavbar.scrolled .navbar-brand {
                position: relative;
                left: auto;
                transform: none;
            }
        }

        /* ═══════════════════════════════════════════
           PRELOADER
        ═══════════════════════════════════════════ */
        #preloader {
            background: linear-gradient(135deg,
                rgba(29, 78, 216, 0.92) 0%,
                rgba(59, 130, 246, 0.85) 55%,
                rgba(191, 219, 254, 0.75) 100%);
            backdrop-filter: blur(10px);
        }
        .brand-sapphire-pre {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            color: #ffffff;
            text-shadow: 0 2px 10px rgba(0,0,0,0.18);
        }
        .preloader-script {
            font-family: 'Open Sans', sans-serif;
            font-style: italic;
            color: rgba(255, 255, 255, 0.85);
        }
        .preloader-line {
            background-color: rgba(255,255,255,0.8);
        }
        
        /* ═══════════════════════════════════════════
           UNIFORM HERO SPACING - APPLIED TO ALL PAGES
           This ensures navbar never overlaps with hero
        ═══════════════════════════════════════════ */
        
        
        /* Hero sections across all pages should start after spacer */
        .page-hero {
            margin-top: 0 !important; /* Remove any negative margin */
            position: relative;
            z-index: 1;
        }
        
        /* For index.php hero section */
        .hero-section {
            margin-top: 0 !important;
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body>

<?php
// ── Detect current page for active nav highlighting ──
$currentPage = basename($_SERVER['PHP_SELF']);

// Check if function already exists before declaring it
if (!function_exists('navActive')) {
    function navActive($page) {
        global $currentPage;
        return ($currentPage === $page) ? 'active-page' : '';
    }
}
?>

<?php if (defined('SHOW_PRELOADER') && SHOW_PRELOADER === true): ?>
<!-- PRELOADER -->
<div id="preloader">
    <div class="preloader-content">
        <div class="preloader-brand">
            <span class="brand-sapphire-pre">SAPPHIRE TIRE</span>
        </div>
        <div class="preloader-script">Est. 2005</div>
        <div class="preloader-line"></div>
    </div>
</div>
<?php endif; ?>

<!-- ═══════════════════════════════════════════
     NAVIGATION
═══════════════════════════════════════════ -->
<nav class="navbar navbar-expand-lg fixed-top <?php if (defined('SHOW_PRELOADER') && SHOW_PRELOADER === true) echo 'navbar-home'; ?>" id="mainNavbar">
    <div class="container">

        <!-- Brand Logo -->
        <a class="navbar-brand" href="index.php">
            <img src="assets/images/SAP LOGO.png" alt="Sapphire Tire" class="d-inline-block align-text-top">
        </a>

        <!-- Mobile Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Nav groups -->
        <div class="collapse navbar-collapse" id="navbarNav">

            <!-- LEFT group: HOME + PRODUCT (scrolled desktop only) -->
            <ul class="navbar-nav" id="navLeft" style="display:none;">
                <li class="nav-item"><a class="nav-link <?= navActive('index.php') ?>" href="index.php">HOME</a></li>
                <li class="nav-item"><a class="nav-link <?= navActive('product.php') ?>" href="product.php">PRODUCT</a></li>
            </ul>

            <!-- CENTER group: all 5 links (default state + mobile) -->
            <ul class="navbar-nav ms-auto" id="navCenter">
                <li class="nav-item"><a class="nav-link <?= navActive('index.php') ?>" href="index.php">HOME</a></li>
                <li class="nav-item"><a class="nav-link <?= navActive('product.php') ?>" href="product.php">PRODUCT</a></li>
                <li class="nav-item"><a class="nav-link <?= navActive('events.php') ?>" href="events.php">EVENTS</a></li>
                <li class="nav-item"><a class="nav-link <?= navActive('about.php') ?>" href="about.php">ABOUT</a></li>
                <li class="nav-item"><a class="nav-link <?= navActive('kitakm.php') ?>" href="kitakm.php">KITAKM</a></li>
            </ul>

            <!-- RIGHT group: EVENTS + ABOUT + KITAKM (scrolled desktop only) -->
            <ul class="navbar-nav" id="navRight" style="display:none;">
                <li class="nav-item"><a class="nav-link <?= navActive('events.php') ?>" href="events.php">EVENTS</a></li>
                <li class="nav-item"><a class="nav-link <?= navActive('about.php') ?>" href="about.php">ABOUT</a></li>
                <li class="nav-item"><a class="nav-link <?= navActive('kitakm.php') ?>" href="kitakm.php">KITAKM</a></li>
            </ul>

        </div>
    </div>
</nav>

<!-- UNIFORM SPACER for all pages - prevents navbar overlap -->
<div class="navbar-spacer"></div>

<script>
    // ── Preloader dismiss ──
    window.addEventListener('load', function () {
        document.getElementById('preloader')?.classList.add('hidden');
    });

    // ── Scroll morphing ──
    const navbar  = document.getElementById('mainNavbar');
    const THRESHOLD = 60;

    function handleScroll() {
        if (window.scrollY > THRESHOLD) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }

    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll(); // Run once on load
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>