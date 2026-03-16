<?php
// Database connection for dynamic content
session_start();
define('SHOW_PRELOADER', false);

$host = 'localhost';
$dbname = 'Sapphireweb';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Fallback to default content if database fails
    error_log("Database connection failed: " . $e->getMessage());
}

// Get dynamic content
$content = [];
$stats = [];
$collaborators = [];
$tires = [];
$stories = [];

if (isset($pdo)) {
    // Get text content
    $stmt = $pdo->query("SELECT * FROM site_content");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $content[$row['section']] = $row['content'];
    }
    
    // Get stats
    $stmt = $pdo->query("SELECT * FROM site_stats");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $stats[$row['stat_key']] = $row;
    }
    
    // Get collaborators
    $collaborators = $pdo->query("SELECT * FROM collaborators WHERE active = 1 ORDER BY display_order")->fetchAll(PDO::FETCH_ASSOC);
    
    // Get tires
    $tires = $pdo->query("SELECT * FROM tires WHERE active = 1 ORDER BY display_order")->fetchAll(PDO::FETCH_ASSOC);
    
    // Get rider stories
    $stories = $pdo->query("SELECT * FROM rider_stories WHERE active = 1 ORDER BY display_order")->fetchAll(PDO::FETCH_ASSOC);
}

// Default values for stats
$defaultStats = [
    'years' => ['stat_value' => '21', 'stat_label' => 'Years Experience'],
    'models' => ['stat_value' => '25', 'stat_label' => 'Tire Models'],
    'riders' => ['stat_value' => '1000K', 'stat_label' => 'Happy Riders']
];

// Merge with defaults if not set
foreach ($defaultStats as $key => $default) {
    if (!isset($stats[$key])) {
        $stats[$key] = $default;
    }
}

// Helper function to get content with default
function getContent($key, $default = '') {
    global $content;
    return isset($content[$key]) ? htmlspecialchars($content[$key]) : $default;
}

// Helper function to get video path
function getVideoPath($default = 'assets/images/BKasambuhay-Video.mp4') {
    global $content;
    return isset($content['hero_video']) ? htmlspecialchars($content['hero_video']) : $default;
}
?>
<?php include 'header.php'; ?>


<style>

    
/* ── Hero with Video Background ── */
    .navbar-spacer {
            height: 80px; /* Same as navbar height */
            width: 100%;
            background: transparent;
        }
        
    .hero-section {
    min-height: 95vh;
    margin-top: -80px;
    position: relative;
    overflow: hidden;
    background-color: #0a0f1a;
}
.hero-section .text-white,
.hero-section h1,
.hero-section h2, 
.hero-section .script-text {
    color: #ffffff !important;
}
.hero-section .stats .stat-label {
    color: rgba(255,255,255,0.75) !important;
}

/* ── Video Background ── */
.hero-video-bg {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    z-index: 0;
    overflow: hidden;
}
.hero-video-bg video {
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    min-width: 100%; min-height: 100%;
    width: auto; height: auto;
    object-fit: cover;
    /* Subtle slow-zoom on the video for cinematic feel */
    animation: videoZoom 20s ease-in-out infinite alternate;
}
@keyframes videoZoom {
    0%   { transform: translate(-50%, -50%) scale(1); }
    100% { transform: translate(-50%, -50%) scale(1.06); }
}

/* Overlay: dark gradient for legibility */
.hero-video-overlay {
    position: absolute;
    inset: 0;
    background:
        linear-gradient(
            to bottom,
            rgba(10, 15, 26, 0.35) 0%,
            rgba(10, 15, 26, 0.55) 60%,
            rgba(10, 15, 26, 0.85) 100%
        );
    z-index: 1;
}

/* Fallback: shown when video can't play */
.hero-video-fallback {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                url('<?php echo getVideoPath(); ?>') top/cover no-repeat;
    z-index: 0;
    display: none; /* hidden by default; shown via JS if video fails */
}

.hero-section .container {
    position: relative;
    z-index: 2;
}

/* ── Mute / Unmute Button ── */
.hero-video-controls {
    position: absolute;
    bottom: 32px;
    right: 36px;
    z-index: 10;
    display: flex;
    align-items: center;
    gap: 12px;
}
.hero-mute-btn {
    display: flex; align-items: center; justify-content: center;
    width: 44px; height: 44px;
    border-radius: 50%;
    border: 1px solid rgba(255,255,255,0.3);
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(8px);
    cursor: pointer;
    transition: all 0.25s ease;
    color: #fff;
}
.hero-mute-btn:hover {
    background: rgba(59,130,246,0.35);
    border-color: #3b82f6;
    transform: scale(1.08);
}
.hero-mute-btn svg { width: 18px; height: 18px; stroke: #fff; stroke-width: 2; fill: none; }

/* ── Scroll-down cue ── */
.hero-scroll-cue {
    position: absolute;
    bottom: 36px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 10;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    opacity: 0.6;
    animation: scrollBounce 2.2s ease-in-out infinite;
}
.hero-scroll-cue span {
    font-family: 'Montserrat', sans-serif;
    font-size: 0.6rem; font-weight: 700;
    letter-spacing: 3px; text-transform: uppercase;
    color: rgba(255,255,255,0.8);
}
.hero-scroll-cue svg { width: 20px; height: 20px; stroke: rgba(255,255,255,0.7); stroke-width: 2; fill: none; }
@keyframes scrollBounce {
    0%, 100% { transform: translateX(-50%) translateY(0); }
    50%       { transform: translateX(-50%) translateY(6px); }
}

.script-text {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 2.5rem;
    color: #60a5fa !important;
    letter-spacing: -1px;
    line-height: 1.15;
}
.stats .stat-number {
    font-family: 'Montserrat', sans-serif;
    font-size: 3rem !important; /* Keep stats large */;
    font-weight: 800;
    color: #60a5fa !important;
    letter-spacing: -1px;
}
.stats .stat-label {
    font-family: 'Open Sans', sans-serif;
    font-size: 1rem !important;
    font-weight: 400;
    color: rgba(255,255,255,0.75) !important;
}

/* ══════════════════════════════════════════════
   BEST SELLING TIRES — Magazine Split Layout
   ══════════════════════════════════════════════ */
.bst-section {
    position: relative;
    padding: 60px 0 80px;
    background:
        linear-gradient(rgba(28, 47, 125, 0.88), rgba(8, 15, 40, 0.88)),
        url('assets/images/bg.jpg') center/cover no-repeat;
    background-attachment: fixed;
    overflow: hidden;
}

/* ── Layout: two columns ── */
.bst-layout {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    align-items: stretch;
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 20px;
}

/* ── LEFT: Specs Panel ── */
.bst-specs-panel {
    position: sticky;
    top: 100px;
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 24px;
    padding: 0;
    backdrop-filter: blur(12px);
    height: calc(100vh - 180px);
    max-height: 780px;
    min-height: 520px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    overflow: hidden;
    transition: border-color 0.3s ease;
}

/* Scrollable inner wrapper */
.bst-specs-inner {
    flex: 1;
    overflow-y: auto;
    padding: 36px 36px 40px;
    display: flex;
    flex-direction: column;
    scrollbar-width: thin;
    scrollbar-color: rgba(59, 130, 246, 0.3) transparent;
}
.bst-specs-inner::-webkit-scrollbar { width: 4px; }
.bst-specs-inner::-webkit-scrollbar-track { background: transparent; }
.bst-specs-inner::-webkit-scrollbar-thumb { background: rgba(59, 130, 246, 0.3); border-radius: 4px; }
.bst-specs-panel.active {
    border-color: rgba(59, 130, 246, 0.4);
    background: rgba(59, 130, 246, 0.06);
}
.bst-specs-img-wrap {
    width: 100%;
    aspect-ratio: 4/3;
    border-radius: 16px;
    overflow: hidden;
    background: rgba(255, 255, 255, 0.06);
    margin-bottom: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.bst-specs-img {
    width: 100%; height: 100%;
    object-fit: contain;
    transform: scale(0.92);
    transition: transform 0.5s ease;
}
.bst-specs-panel.active .bst-specs-img { transform: scale(1); }
.bst-specs-tag {
    font-family: 'Montserrat', sans-serif;
    font-size: 0.65rem; font-weight: 700;
    letter-spacing: 4px; text-transform: uppercase;
    color: #3b82f6; margin-bottom: 6px;
}
.bst-specs-name {
    font-family: 'Montserrat', sans-serif;
    font-weight: 900; font-size: 1.6rem;
    color: #ffffff; letter-spacing: -0.5px;
    line-height: 1.15; margin-bottom: 12px;
}
.bst-specs-desc {
    font-family: 'Open Sans', sans-serif;
    font-size: 0.85rem; color: rgba(255, 255, 255, 0.65);
    line-height: 1.75; margin-bottom: 24px;
}
.bst-sizes-label {
    font-family: 'Montserrat', sans-serif;
    font-size: 0.62rem; font-weight: 700;
    letter-spacing: 3px; text-transform: uppercase;
    color: rgba(255, 255, 255, 0.4); margin-bottom: 10px;
}
.bst-sizes { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 28px; }
.bst-size-pill {
    font-family: 'Montserrat', sans-serif;
    font-size: 0.7rem; font-weight: 600;
    padding: 5px 14px; border-radius: 50px;
    border: 1px solid rgba(255, 255, 255, 0.18);
    color: rgba(255, 255, 255, 0.7);
    cursor: pointer; transition: all 0.2s; background: transparent;
}
.bst-size-pill:hover, .bst-size-pill.selected {
    background: #3b82f6; border-color: #3b82f6; color: #fff;
}
.bst-cta {
    display: inline-flex; align-items: center; gap: 10px;
    font-family: 'Montserrat', sans-serif;
    font-size: 0.72rem; font-weight: 700;
    letter-spacing: 2.5px; text-transform: uppercase;
    padding: 13px 28px; border-radius: 50px;
    background: #3b82f6; color: #fff; border: none;
    cursor: pointer; transition: all 0.3s;
    text-decoration: none; align-self: flex-start; margin-top: auto;
}
.bst-cta:hover {
    background: #2563eb; color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(59, 130, 246, 0.35);
}
.bst-empty-state {
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    flex: 1; min-height: 300px; opacity: 0.4; text-align: center;
}
.bst-empty-state svg { width: 56px; height: 56px; stroke: #3b82f6; margin-bottom: 16px; opacity: 0.6; }
.bst-empty-state p {
    font-family: 'Montserrat', sans-serif;
    font-size: 0.85rem; font-weight: 600;
    letter-spacing: 1px; color: rgba(255, 255, 255, 0.5); margin: 0;
}
.bst-cards-col { display: flex; flex-direction: column; gap: 16px; }
.bst-card {
    display: grid; grid-template-columns: 110px 1fr auto; gap: 0;
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px; overflow: hidden; cursor: pointer;
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
}
.bst-card:hover {
    border-color: rgba(59, 130, 246, 0.4);
    background: rgba(59, 130, 246, 0.07);
    transform: translateX(4px);
}
.bst-card.active {
    border-color: #3b82f6;
    background: rgba(59, 130, 246, 0.12);
    box-shadow: 0 0 0 1px rgba(59, 130, 246, 0.3), 0 16px 48px rgba(59, 130, 246, 0.18);
    transform: translateX(6px);
}
.bst-card-thumb {
    width: 110px; aspect-ratio: 1;
    background: rgba(255, 255, 255, 0.05);
    display: flex; align-items: center; justify-content: center;
    padding: 12px; flex-shrink: 0;
    border-right: 1px solid rgba(255, 255, 255, 0.07);
    transition: background 0.3s;
}
.bst-card.active .bst-card-thumb {
    background: rgba(59, 130, 246, 0.1);
    border-right-color: rgba(59, 130, 246, 0.2);
}
.bst-card-thumb img { width: 100%; height: 100%; object-fit: contain; transition: transform 0.4s ease; }
.bst-card:hover .bst-card-thumb img,
.bst-card.active .bst-card-thumb img { transform: scale(1.08); }
.bst-card-info {
    padding: 20px 22px; display: flex;
    flex-direction: column; justify-content: center; gap: 4px;
}
.bst-card-tag {
    font-family: 'Montserrat', sans-serif;
    font-size: 0.6rem; font-weight: 700;
    letter-spacing: 3px; text-transform: uppercase; color: #3b82f6;
}
.bst-card-name {
    font-family: 'Montserrat', sans-serif;
    font-size: 0.95rem; font-weight: 800;
    color: #ffffff; letter-spacing: 0.3px; line-height: 1.2;
}
.bst-card.active .bst-card-name { color: #93c5fd; }
.bst-card-hint {
    font-family: 'Open Sans', sans-serif;
    font-size: 0.75rem; color: rgba(255, 255, 255, 0.4);
    line-height: 1.5; margin-top: 2px;
}
.bst-card-arrow {
    align-self: center; padding-right: 20px;
    opacity: 0; transform: translateX(-6px);
    transition: all 0.3s; color: #3b82f6;
}
.bst-card:hover .bst-card-arrow,
.bst-card.active .bst-card-arrow { opacity: 1; transform: translateX(0); }
.bst-panel-content { animation: bstFadeUp 0.4s ease forwards; }
@keyframes bstFadeUp {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}
@media (max-width: 768px) {
    .bst-layout { grid-template-columns: 1fr; }
    .bst-specs-panel { position: static; order: 2; height: auto; max-height: none; }
    .bst-specs-inner { overflow-y: visible; }
    .bst-cards-col { order: 1; }
}

/* ══════════════════════════════════════════════
   COLLABORATORS SECTION BACKGROUND
   ══════════════════════════════════════════════ */
:root {
    --collaborators-bg:          linear-gradient(135deg, #1c3b6e 0%, #0f2044 100%);
    --collaborators-bg-fallback: #1c3b6e;
    --collaborators-fade-left:   #1c3b6e;
    --collaborators-fade-right:  #0f2044;
}

body section.collaborators-section {
    background: var(--collaborators-bg) !important;
    background-color: var(--collaborators-bg-fallback) !important;
    isolation: isolate;
    position: relative;
}

/* ══════════════════════════════════════════════
   COMPANY OVERVIEW — Split Panel Layout
   ══════════════════════════════════════════════ */
.overview-split-section {
    background:
        linear-gradient(rgba(28, 47, 125, 0.88), rgba(8, 15, 40, 0.88)),
        url('assets/images/bg.jpg') center/cover no-repeat;
    background-attachment: fixed;
    padding: 80px 0;
    overflow: visible;
}
.overview-section-heading {
    text-align: center;
    margin-bottom: 60px;
    padding: 0 20px;
}
.overview-section-eyebrow {
    font-family: 'Montserrat', sans-serif;
    font-size: 0.62rem; font-weight: 700;
    letter-spacing: 4px; text-transform: uppercase;
    color: #3b82f6; margin-bottom: 10px;
    display: block;
}
.overview-section-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 900; font-size: 2.4rem;
    color: #fff; letter-spacing: -1px; margin: 0;
}
.ov-row {
    display: flex;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto 24px;
    padding: 0 32px;
    position: relative;
}
.ov-row:last-child { margin-bottom: 0; }

.ov-title-zone {
    flex: 0 0 38%;
    padding: 48px 32px 48px 0;
}
.ov-big-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 900;
    font-size: clamp(2.4rem, 4.5vw, 3.8rem);
    color: #ffffff;
    line-height: 1.0;
    letter-spacing: -2px;
    margin: 0 0 18px;
}
.ov-underline {
    width: 52px; height: 4px;
    background: linear-gradient(90deg, #3b82f6 0%, #60a5fa 100%);
    border-radius: 3px;
}
.ov-circle-zone {
    position: relative;
    z-index: 3;
    margin: 0 -90px;
    width: 180px;
    height: 180px;
    flex-shrink: 0;
}
.ov-circle {
    width: 180px; height: 180px;
    border-radius: 50%; overflow: hidden;
    border: 3px solid rgba(59,130,246,0.5);
    box-shadow: 0 0 0 6px rgba(59,130,246,0.1), 0 12px 40px rgba(0,0,0,0.5);
    background: rgba(59,130,246,0.12);
    display: flex; align-items: center; justify-content: center;
    transition: border-color 0.3s ease, transform 0.3s ease;
}
.ov-row:hover .ov-circle { border-color: #60a5fa; transform: scale(1.04); }
.ov-circle svg { width: 70px; height: 70px; stroke: #60a5fa; opacity: 0.75; }
.ov-card-zone {
    flex: 1;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 16px;
    padding: 36px 40px 36px 110px;
    transition: background 0.3s ease, border-color 0.3s ease;
    min-height: 160px;
    display: flex; flex-direction: column; justify-content: center;
}
.ov-row:hover .ov-card-zone {
    background: rgba(59,130,246,0.07);
    border-color: rgba(59,130,246,0.35);
}
.ov-card-zone h5 {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800; font-size: 1.25rem;
    color: #ffffff; margin: 0 0 8px; letter-spacing: 0.2px;
}
.ov-card-stat {
    font-family: 'Montserrat', sans-serif;
    font-weight: 900; font-size: 1.4rem;
    color: #60a5fa; letter-spacing: -0.5px;
    margin-bottom: 10px; line-height: 1;
}
.ov-card-zone p {
    font-family: 'Open Sans', sans-serif;
    font-size: 0.875rem; color: rgba(255,255,255,0.6);
    line-height: 1.75; margin: 0; max-width: 420px;
}
.ov-row.ov-reversed { flex-direction: row-reverse; }
.ov-row.ov-reversed .ov-title-zone { padding: 48px 0 48px 32px; text-align: right; }
.ov-row.ov-reversed .ov-underline { margin-left: auto; }
.ov-row.ov-reversed .ov-card-zone {
    padding: 36px 110px 36px 40px;
    align-items: flex-end; text-align: right;
}
.ov-row.ov-reversed .ov-card-zone p { margin-left: auto; }

@media (max-width: 900px) {
    .ov-row, .ov-row.ov-reversed {
        flex-direction: column; align-items: flex-start;
        padding: 0 20px; gap: 0;
    }
    .ov-title-zone, .ov-row.ov-reversed .ov-title-zone {
        padding: 36px 0 20px; text-align: left; flex: none; width: 100%;
    }
    .ov-circle-zone { margin: -20px auto; width: 140px; height: 140px; }
    .ov-circle { width: 140px; height: 140px; }
    .ov-card-zone, .ov-row.ov-reversed .ov-card-zone {
        padding: 80px 28px 36px; width: 100%;
        text-align: left; align-items: flex-start;
    }
    .ov-row.ov-reversed .ov-underline { margin-left: 0; }
    .ov-row.ov-reversed .ov-card-zone p { margin-left: 0; }
}

/* Horizontal Cards Container */
.collaborators-horizontal-container {
    width: 100%;
    overflow: hidden;
    position: relative;
    padding: 40px 0;
    margin: 0 -15px;
    width: calc(100% + 30px);
    left: -15px;
}
.collaborators-horizontal-track {
    display: flex; align-items: center; gap: 30px;
    width: max-content;
    animation: horizontalScroll 35s linear infinite;
}
.collaborators-horizontal-track:hover { animation-play-state: paused; }
.collaborator-horizontal-card {
    display: flex; align-items: center;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 80px;
    padding: 8px 25px 8px 8px;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
    min-width: 220px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}
.collaborator-horizontal-card:hover {
    transform: translateY(-3px);
    border-color: #60a5fa;
    background: rgba(96, 165, 250, 0.15);
    box-shadow: 0 8px 30px rgba(96, 165, 250, 0.3);
}
.collaborator-horizontal-card img {
    width: 100px; height: 95px;
    border-radius: 50%; object-fit: cover;
    border: 2px solid #60a5fa;
    margin-right: 15px;
    transition: transform 0.3s ease;
}
.collaborator-horizontal-card:hover img { transform: scale(1.1); border-color: #ffffff; }
.collaborator-card-content { flex: 1; text-align: left; }
.collaborator-card-content h4 {
    font-family: 'Montserrat', sans-serif;
    font-size: 1.3rem; font-weight: 700;
    color: #ffffff; margin: 0 0 3px 0; letter-spacing: 0.3px;
}
.collaborator-card-content p {
    font-family: 'Open Sans', sans-serif;
    font-size: 1rem; font-weight: 400;
    color: rgba(255, 255, 255, 0.7); margin: 0; line-height: 1.2;
}
@keyframes horizontalScroll {
    0%   { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
.collaborators-horizontal-container::before,
.collaborators-horizontal-container::after {
    content: ''; position: absolute; top: 0;
    width: 100px; height: 100%; z-index: 2; pointer-events: none;
}
.collaborators-horizontal-container::before {
    left: 0;
    background: linear-gradient(to right, var(--collaborators-fade-left), transparent);
}
.collaborators-horizontal-container::after {
    right: 0;
    background: linear-gradient(to left, var(--collaborators-fade-right), transparent);
}
.collaborators-section .container,
.bst-section .container {
    max-width: 100%;
    padding-left: 30px;
    padding-right: 30px;
}
@media (max-width: 768px) {
    .collaborator-horizontal-card { min-width: 200px; padding: 6px 20px 6px 6px; }
    .collaborator-horizontal-card img { width: 40px; height: 40px; margin-right: 12px; }
    .collaborator-card-content h4 { font-size: 0.85rem; }
    .collaborator-card-content p { font-size: 0.65rem; }
}

/* ══════════════════════════════════════════════
   BIDA & KWENTO — Profile-style Story Cards
   ══════════════════════════════════════════════ */
body {
    background: #0a0f1a;
}
.rider-stories-section {
    padding: 100px 50px 80px;
    background: linear-gradient(135deg, #1c3b6e 0%, #0f2044 100%);
    background-color: #1c3b6e;
    border-bottom: none;
    margin-bottom: 0;
    margin-top: 0;
    position: relative;
    z-index: 1;
}
.rider-stories-section .container {
    padding-left: 60px;
    padding-right: 60px;
    max-width: 1400px;
    margin: 0 auto;
}
.rider-stories-layout {
    display: grid;
    grid-template-columns: 260px 1fr;
    gap: 48px;
    align-items: start;
}
.rider-stories-header {
    position: sticky;
    top: 100px;
}
.rider-stories-header .section-eyebrow {
    font-family: 'Montserrat', sans-serif;
    font-size: 1rem; font-weight: 700;
    letter-spacing: 4px; text-transform: uppercase;
    color: #3b82f6; display: block; margin-bottom: 10px;
}
.rider-stories-header .section-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 900; font-size: 3.5rem;
    color: #ffffff; letter-spacing: -1px;
    margin-bottom: 14px; line-height: 1.1;
}
.rider-stories-header .section-sub {
    font-family: 'Open Sans', sans-serif;
    font-size: 0.9rem; color: rgba(255,255,255,0.5);
    line-height: 1.7; margin: 0;
}
.header-underline {
    width: 48px; height: 4px;
    background: linear-gradient(90deg, #3b82f6, #60a5fa);
    border-radius: 3px; margin-top: 20px;
}
.rider-stories-cards {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}
.story-profile-card {
    position: relative;
    border-radius: 24px;
    overflow: hidden;
    background: #141b2d;
    border: 1px solid rgba(255,255,255,0.1);
    box-shadow: 0 24px 60px rgba(0,0,0,0.5);
    transition: transform 0.4s cubic-bezier(0.4,0,0.2,1),
                box-shadow 0.4s ease, border-color 0.3s ease;
}
.story-profile-card:hover {
    transform: translateY(-6px) scale(1.01);
    box-shadow: 0 36px 80px rgba(0,0,0,0.65);
    border-color: rgba(59,130,246,0.4);
}
.story-card-img-wrap {
    position: relative; width: 100%; height: 240px; overflow: hidden;
}
.story-card-img-wrap img {
    width: 100%; height: 100%;
    object-fit: cover; object-position: center center;
    transition: transform 0.5s ease;
}
.story-profile-card:hover .story-card-img-wrap img { transform: scale(1.05); }
.story-card-img-wrap::after {
    content: ''; position: absolute;
    bottom: 0; left: 0; right: 0; height: 55%;
    background: linear-gradient(to bottom, transparent, #141b2d);
}
.story-card-body { padding: 0 20px 24px; position: relative; }
.story-card-title-row {
    display: flex; align-items: center; gap: 8px; margin-bottom: 8px;
}
.story-card-title-row h5 {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800; font-size: 1rem;
    color: #ffffff; margin: 0; letter-spacing: 0.2px;
}
.story-card-badge {
    display: flex; align-items: center; justify-content: center;
    width: 20px; height: 20px;
    background: #3b82f6; border-radius: 50%; flex-shrink: 0;
}
.story-card-badge svg { width: 11px; height: 11px; stroke: #fff; stroke-width: 2.5; }
.story-card-desc {
    font-family: 'Open Sans', sans-serif;
    font-size: 0.82rem; color: rgba(255,255,255,0.6);
    line-height: 1.65; margin-bottom: 18px;
}
.story-card-footer {
    display: flex; align-items: center;
    justify-content: space-between; gap: 12px;
}
.story-card-stats { display: flex; align-items: center; gap: 14px; }
.story-stat {
    display: flex; align-items: center; gap: 5px;
    font-family: 'Montserrat', sans-serif;
    font-size: 0.75rem; font-weight: 600;
    color: rgba(255,255,255,0.55);
}
.story-stat svg { width: 13px; height: 13px; stroke: rgba(255,255,255,0.4); flex-shrink: 0; }
.story-card-cta {
    display: inline-flex; align-items: center; gap: 6px;
    font-family: 'Montserrat', sans-serif;
    font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px;
    padding: 9px 18px; border-radius: 50px;
    background: #ffffff; color: #0a0f1a; border: none;
    text-decoration: none; white-space: nowrap;
    transition: background 0.2s ease, color 0.2s ease, transform 0.2s ease;
}
.story-card-cta:hover { background: #3b82f6; color: #ffffff; transform: scale(1.04); }
.story-card-cta svg { width: 12px; height: 12px; stroke: currentColor; stroke-width: 2.5; }

@media (max-width: 900px) {
    .rider-stories-layout { grid-template-columns: 1fr; }
    .rider-stories-header { position: static; }
    .header-underline { margin-top: 20px; }
}
@media (max-width: 600px) {
    .rider-stories-cards { grid-template-columns: 1fr; }
    .story-card-img-wrap { height: 220px; }
}


/* ══════════════════════════════════════════════
   COMPANY OVERVIEW — Tagline & Stats Bar
   ══════════════════════════════════════════════ */
.overview-section-tagline {
    font-family: 'Montserrat', sans-serif;
    font-size: 1rem; font-weight: 600;
    color: rgba(255,255,255,0.55);
    letter-spacing: 2px;
    margin: 10px 0 40px;
    text-transform: uppercase;
}
.overview-stats-bar {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0;
    flex-wrap: wrap;
    margin-top: 0;
    padding: 28px 40px;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 20px;
    max-width: 680px;
    margin: 0 auto 16px;
    backdrop-filter: blur(8px);
}
.ov-stat-item {
    flex: 1;
    text-align: center;
    min-width: 120px;
    padding: 8px 20px;
}
.ov-stat-number {
    font-family: 'Montserrat', sans-serif;
    font-size: 2.6rem; font-weight: 900;
    color: #60a5fa; letter-spacing: -2px;
    line-height: 1;
    margin-bottom: 6px;
}
.ov-stat-label {
    font-family: 'Open Sans', sans-serif;
    font-size: 0.78rem; font-weight: 400;
    color: rgba(255,255,255,0.55);
    text-transform: uppercase; letter-spacing: 1.5px;
}
.ov-stat-divider {
    width: 1px; height: 50px;
    background: rgba(255,255,255,0.12);
    flex-shrink: 0;
}
@media (max-width: 600px) {
    .overview-stats-bar { gap: 12px; padding: 20px 16px; }
    .ov-stat-divider { display: none; }
    .ov-stat-number { font-size: 2rem; }
}

/* ── Mobile: hide mute btn label on tiny screens ── */
@media (max-width: 480px) {
    .hero-video-controls { bottom: 20px; right: 20px; }
    .hero-scroll-cue { display: none; }
}
</style>

<!-- Hero Section with Video Background -->
<section class="hero-section text-white d-flex align-items-center" id="hero">

    <!-- Video Background -->
    <div class="hero-video-bg" id="heroVideoBg">
        <!--
            ╔══════════════════════════════════════════════════════╗
            ║  REPLACE THE src BELOW WITH YOUR ACTUAL VIDEO FILE  ║
            ║  Recommended: MP4 (H.264) + WebM for best coverage  ║
            ║  Ideal resolution: 1920×1080 or higher              ║
            ║  Keep file size under ~15 MB for fast loading        ║
            ╚══════════════════════════════════════════════════════╝
        -->
        <video
            id="heroVideo"
            autoplay
            muted
            loop
            playsinline
            preload="auto"
            poster="assets/images/sapphire-background.jpg"
        >
            <source src="<?php echo getVideoPath(); ?>" type="video/mp4">
        </video>
    </div>

    <!-- Dark gradient overlay for text legibility -->
    <div class="hero-video-overlay"></div>

    <!-- Fallback image (shown if video fails to load/play) -->
    <div class="hero-video-fallback" id="heroFallback"></div>



    <!-- Mute / Unmute toggle -->
    <div class="hero-video-controls">
        <button class="hero-mute-btn" id="heroMuteBtn" title="Toggle sound" aria-label="Toggle video sound">
            <!-- Muted icon (default) -->
            <svg id="iconMuted" viewBox="0 0 24 24">
                <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/>
                <line x1="23" y1="9" x2="17" y2="15"/>
                <line x1="17" y1="9" x2="23" y2="15"/>
            </svg>
            <!-- Unmuted icon (hidden by default) -->
            <svg id="iconUnmuted" viewBox="0 0 24 24" style="display:none;">
                <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/>
                <path d="M15.54 8.46a5 5 0 0 1 0 7.07"/>
                <path d="M19.07 4.93a10 10 0 0 1 0 14.14"/>
            </svg>
        </button>
    </div>

    <!-- Scroll cue -->
    <div class="hero-scroll-cue" aria-hidden="true">
        <span>Scroll</span>
        <svg viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
    </div>

</section>

<!-- Video behaviour script -->
<script>
(function () {
    const video    = document.getElementById('heroVideo');
    const fallback = document.getElementById('heroFallback');
    const muteBtn  = document.getElementById('heroMuteBtn');
    const iconMuted   = document.getElementById('iconMuted');
    const iconUnmuted = document.getElementById('iconUnmuted');

    /* ── Fallback: if video can't play, show the image instead ── */
    if (video) {
        video.addEventListener('error', showFallback);
        video.addEventListener('stalled', showFallback);

        /* Some browsers block autoplay even with muted; try explicitly */
        const playPromise = video.play();
        if (playPromise !== undefined) {
            playPromise.catch(function () {
                /* Autoplay blocked → show fallback image */
                showFallback();
            });
        }
    }

    function showFallback() {
        if (fallback) fallback.style.display = 'block';
        const vbg = document.getElementById('heroVideoBg');
        if (vbg) vbg.style.display = 'none';
    }

    /* ── Mute / Unmute toggle ── */
    if (muteBtn && video) {
        muteBtn.addEventListener('click', function () {
            video.muted = !video.muted;
            iconMuted.style.display   = video.muted ? 'block' : 'none';
            iconUnmuted.style.display = video.muted ? 'none'  : 'block';
        });
    }

    /* ── Pause video when off-screen (saves battery on mobile) ── */
    if ('IntersectionObserver' in window && video) {
        const obs = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) { video.play(); }
                else                      { video.pause(); }
            });
        }, { threshold: 0.1 });
        obs.observe(video);
    }
})();
</script>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">

<!-- COMPANY OVERVIEW -->
<section class="overview-split-section" data-animate="fade-up">
    <div class="overview-section-heading">
        <span class="overview-section-eyebrow"><?php echo getContent('overview_eyebrow', 'Who We Are'); ?></span>
        <h2 class="overview-section-title"><?php echo getContent('overview_title', 'COMPANY OVERVIEW'); ?></h2>
        <p class="overview-section-tagline"><?php echo getContent('overview_tagline', 'Kasama mo sa Hanapbuhay &mdash; Philippine Made'); ?></p>
        <div class="overview-stats-bar">
            <div class="ov-stat-item">
                <div class="ov-stat-number"><?php echo $stats['years']['stat_value']; ?><?php if($stats['years']['stat_value'] == '1000K') echo '<span style="font-size:1.4rem">+</span>'; ?></div>
                <div class="ov-stat-label"><?php echo $stats['years']['stat_label']; ?></div>
            </div>
            <div class="ov-stat-divider"></div>
            <div class="ov-stat-item">
                <div class="ov-stat-number"><?php echo $stats['models']['stat_value']; ?></div>
                <div class="ov-stat-label"><?php echo $stats['models']['stat_label']; ?></div>
            </div>
            <div class="ov-stat-divider"></div>
            <div class="ov-stat-item">
                <div class="ov-stat-number"><?php echo $stats['riders']['stat_value']; ?><?php if($stats['riders']['stat_value'] == '1000K') echo '<span style="font-size:1.4rem">+</span>'; ?></div>
                <div class="ov-stat-label"><?php echo $stats['riders']['stat_label']; ?></div>
            </div>
        </div>
    </div>

    <div class="ov-row" data-animate="fade-up" data-delay="100">
        <div class="ov-title-zone">
            <h2 class="ov-big-title"><?php echo getContent('quality_title', 'Quality<br>First'); ?></h2>
            <div class="ov-underline"></div>
        </div>
        <div class="ov-circle-zone">
            <div class="ov-circle">
                <svg fill="none" stroke="currentColor" stroke-width="1.3" viewBox="0 0 24 24">
                    <path d="M12 2l7 4v5c0 5-3.5 9.7-7 11C8.5 20.7 5 16 5 11V6l7-4z"/>
                    <path d="M9 12l2 2 4-4" stroke-width="1.8"/>
                </svg>
            </div>
        </div>
        <div class="ov-card-zone">
            <div class="ov-card-stat"><?php echo getContent('quality_stat', '15+ Years of Excellence'); ?></div>
            <h5><?php echo getContent('quality_heading', 'Our Commitment'); ?></h5>
            <p><?php echo getContent('quality_text', 'Sapphire Tire is committed to delivering high-quality, durable, and reliable tires designed for everyday riders and professionals. Our dedication to quality has made us a trusted name in the motorcycle tire industry.'); ?></p>
        </div>
    </div>

    <div class="ov-row ov-reversed" data-animate="fade-up" data-delay="200">
        <div class="ov-title-zone">
            <h2 class="ov-big-title"><?php echo getContent('rider_title', 'Rider<br>Focused'); ?></h2>
            <div class="ov-underline"></div>
        </div>
        <div class="ov-circle-zone">
            <div class="ov-circle">
                <svg fill="none" stroke="currentColor" stroke-width="1.3" viewBox="0 0 24 24">
                    <circle cx="9" cy="7" r="3"/>
                    <circle cx="17" cy="8" r="2.5"/>
                    <path d="M2 20c0-3.3 3.1-6 7-6s7 2.7 7 6"/>
                    <path d="M17 14c2.2.5 4 2.3 4 4.5"/>
                </svg>
            </div>
        </div>
        <div class="ov-card-zone">
            <div class="ov-card-stat"><?php echo getContent('rider_stat', '1,000K+ Satisfied Riders'); ?></div>
            <h5><?php echo getContent('rider_heading', 'Our Philosophy'); ?></h5>
            <p><?php echo getContent('rider_text', 'We understand the needs of Filipino riders. From daily commuters to adventure enthusiasts, our tires are designed to deliver performance, safety, and confidence on every journey.'); ?></p>
        </div>
    </div>
</section>

<!-- Collaborators -->
<section class="py-5 collaborators-section" data-animate="fade-up">
    <div class="container">
        <div class="text-center mb-5" style="margin-bottom: 40px !important;">
            <span class="overview-section-eyebrow"><?php echo getContent('collab_eyebrow', 'Our Partners'); ?></span>
            <h2 class="overview-section-title" style="margin-bottom: 0;"><?php echo getContent('collab_title', 'COLLABORATORS'); ?></h2>
            <p class="overview-section-tagline"><?php echo getContent('collab_tagline', 'Kasama mo sa Hanapbuhay — Trusted Partners'); ?></p>
        </div>
        <div class="collaborators-horizontal-container">
            <div class="collaborators-horizontal-track">
                <?php if (!empty($collaborators)): ?>
                    <?php foreach ($collaborators as $collab): ?>
                        <div class="collaborator-horizontal-card">
                            <img src="<?php echo htmlspecialchars($collab['image']); ?>" alt="<?php echo htmlspecialchars($collab['name']); ?>">
                            <div class="collaborator-card-content">
                                <h4><?php echo htmlspecialchars($collab['name']); ?></h4>
                                <p><?php echo htmlspecialchars($collab['title']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- Duplicate for seamless loop -->
                    <?php foreach ($collaborators as $collab): ?>
                        <div class="collaborator-horizontal-card">
                            <img src="<?php echo htmlspecialchars($collab['image']); ?>" alt="<?php echo htmlspecialchars($collab['name']); ?>">
                            <div class="collaborator-card-content">
                                <h4><?php echo htmlspecialchars($collab['name']); ?></h4>
                                <p><?php echo htmlspecialchars($collab['title']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Default collaborators if none in database -->
                    <div class="collaborator-horizontal-card"><img src="assets/images/collaborators/Lodi-Lia.jpg" alt="Lodi-Lia"><div class="collaborator-card-content"><h4>Lodi Lia</h4><p>Rider & Influencer</p></div></div>
                    <div class="collaborator-horizontal-card"><img src="assets/images/collaborators/Zurc-Moto.jpg" alt="Zurc-Moto"><div class="collaborator-card-content"><h4>Zurc Moto</h4><p>Motorcycle Enthusiast</p></div></div>
                    <div class="collaborator-horizontal-card"><img src="assets/images/collaborators/Sunshine-Effy.jpg" alt="Sunshine-Effy"><div class="collaborator-card-content"><h4>Sunshine Effy</h4><p>Adventure Rider</p></div></div>
                    <div class="collaborator-horizontal-card"><img src="assets/images/collaborators/Don-Nelson.jpg" alt="Don-Nelson"><div class="collaborator-card-content"><h4>Don Nelson</h4><p>Motovlogger</p></div></div>
                    <div class="collaborator-horizontal-card"><img src="assets/images/collaborators/Elmer-Pakingan.jpg" alt="Elmer Pakingan"><div class="collaborator-card-content"><h4>Elmer Pakingan</h4><p>Professional Rider</p></div></div>
                    <div class="collaborator-horizontal-card"><img src="assets/images/collaborators/AZIZAH.jpg" alt="AZIZAH"><div class="collaborator-card-content"><h4>AZIZAH</h4><p>Motorcycle Club Member</p></div></div>
                    <div class="collaborator-horizontal-card"><img src="assets/images/collaborators/Ayee-Lakwatsera.jpg" alt="Ayee Lakwatsera"><div class="collaborator-card-content"><h4>Ayee Lakwatsera</h4><p>Travel Rider</p></div></div>
                    <div class="collaborator-horizontal-card"><img src="assets/images/collaborators/TMX125-ANGEL.jpg" alt="TMX125-ANGEL"><div class="collaborator-card-content"><h4>TMX125 Angel</h4><p>Custom Bike Builder</p></div></div>
                    <div class="collaborator-horizontal-card"><img src="assets/images/collaborators/TMX155-PAMPANG.jpg" alt="TMX155-PAMPANG"><div class="collaborator-card-content"><h4>TMX155 Pampang</h4><p>Racing Enthusiast</p></div></div>
                    <!-- Duplicate for seamless loop -->
                    <div class="collaborator-horizontal-card"><img src="assets/images/collaborators/Lodi-Lia.jpg" alt="Lodi-Lia"><div class="collaborator-card-content"><h4>Lodi Lia</h4><p>Rider & Influencer</p></div></div>
                    <div class="collaborator-horizontal-card"><img src="assets/images/collaborators/Zurc-Moto.jpg" alt="Zurc-Moto"><div class="collaborator-card-content"><h4>Zurc Moto</h4><p>Motorcycle Enthusiast</p></div></div>
                    <div class="collaborator-horizontal-card"><img src="assets/images/collaborators/Sunshine-Effy.jpg" alt="Sunshine-Effy"><div class="collaborator-card-content"><h4>Sunshine Effy</h4><p>Adventure Rider</p></div></div>
                    <div class="collaborator-horizontal-card"><img src="assets/images/collaborators/Don-Nelson.jpg" alt="Don-Nelson"><div class="collaborator-card-content"><h4>Don Nelson</h4><p>Motovlogger</p></div></div>
                    <div class="collaborator-horizontal-card"><img src="assets/images/collaborators/Elmer-Pakingan.jpg" alt="Elmer Pakingan"><div class="collaborator-card-content"><h4>Elmer Pakingan</h4><p>Professional Rider</p></div></div>
                    <div class="collaborator-horizontal-card"><img src="assets/images/collaborators/AZIZAH.jpg" alt="AZIZAH"><div class="collaborator-card-content"><h4>AZIZAH</h4><p>Motorcycle Club Member</p></div></div>
                    <div class="collaborator-horizontal-card"><img src="assets/images/collaborators/Ayee-Lakwatsera.jpg" alt="Ayee Lakwatsera"><div class="collaborator-card-content"><h4>Ayee Lakwatsera</h4><p>Travel Rider</p></div></div>
                    <div class="collaborator-horizontal-card"><img src="assets/images/collaborators/TMX125-ANGEL.jpg" alt="TMX125-ANGEL"><div class="collaborator-card-content"><h4>TMX125 Angel</h4><p>Custom Bike Builder</p></div></div>
                    <div class="collaborator-horizontal-card"><img src="assets/images/collaborators/TMX155-PAMPANG.jpg" alt="TMX155-PAMPANG"><div class="collaborator-card-content"><h4>TMX155 Pampang</h4><p>Racing Enthusiast</p></div></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Best Selling Tires -->
<section class="bst-section" id="bestSellingSection">
    <div class="container-fluid px-4 px-md-5">
        <div class="text-center mb-5" style="margin-bottom: 40px !important;">
            <span class="overview-section-eyebrow"><?php echo getContent('bst_eyebrow', 'Top Picks'); ?></span>
            <h2 class="overview-section-title" style="margin-bottom: 0;"><?php echo getContent('bst_title', 'BEST SELLING TIRES'); ?></h2>
            <p class="overview-section-tagline"><?php echo getContent('bst_tagline', 'Most trusted by Filipino riders'); ?></p>
        </div>
        
        <div class="bst-layout">
            <div class="bst-specs-panel" id="bstSpecsPanel">
                <div class="bst-specs-inner">
                    <div class="bst-empty-state" id="bstEmptyState">
                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 8v4M12 16h.01"/>
                        </svg>
                        <p>Select a tire to<br>view full specs</p>
                    </div>
                    <div id="bstPanelContent" style="display:none; flex-direction:column; flex:1;"></div>
                </div>
            </div>
            <div class="bst-cards-col" id="bstCardsCol">
                <?php if (!empty($tires)): ?>
                    <?php foreach ($tires as $index => $tire): ?>
                    <div class="bst-card" data-index="<?php echo $index; ?>" onclick="bstSelect(<?php echo $index; ?>)">
                        <div class="bst-card-thumb"><img src="<?php echo htmlspecialchars($tire['image']); ?>" alt="<?php echo htmlspecialchars($tire['name']); ?>"></div>
                        <div class="bst-card-info">
                            <div class="bst-card-tag"><?php echo htmlspecialchars($tire['tag']); ?></div>
                            <div class="bst-card-name"><?php echo htmlspecialchars($tire['name']); ?></div>
                            <div class="bst-card-hint"><?php echo substr(htmlspecialchars($tire['description']), 0, 50) . '...'; ?></div>
                        </div>
                        <div class="bst-card-arrow"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg></div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Default tires if none in database -->
                    <div class="bst-card" data-index="0" onclick="bstSelect(0)">
                        <div class="bst-card-thumb"><img src="assets/images/E716 edited.png" alt="HI-MILLER E716"></div>
                        <div class="bst-card-info">
                            <div class="bst-card-tag">Motocross</div>
                            <div class="bst-card-name">HI-MILLER E716</div>
                            <div class="bst-card-hint">Off-road dominance with aggressive knob pattern</div>
                        </div>
                        <div class="bst-card-arrow"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg></div>
                    </div>
                    <div class="bst-card" data-index="1" onclick="bstSelect(1)">
                        <div class="bst-card-thumb"><img src="assets/images/E708 edited.png" alt="SPORTS E708"></div>
                        <div class="bst-card-info">
                            <div class="bst-card-tag">On/Off-Road · Dual</div>
                            <div class="bst-card-name">SPORTS E708</div>
                            <div class="bst-card-hint">Versatile dual-purpose performance tire</div>
                        </div>
                        <div class="bst-card-arrow"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg></div>
                    </div>
                    <div class="bst-card" data-index="2" onclick="bstSelect(2)">
                        <div class="bst-card-thumb"><img src="assets/images/E707 png.png" alt="STRENGTH E707"></div>
                        <div class="bst-card-info">
                            <div class="bst-card-tag">On-Road · High Speed</div>
                            <div class="bst-card-name">STRENGTH E707</div>
                            <div class="bst-card-hint">High-speed road stability and grip</div>
                        </div>
                        <div class="bst-card-arrow"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg></div>
                    </div>
                    <div class="bst-card" data-index="3" onclick="bstSelect(3)">
                        <div class="bst-card-thumb"><img src="assets/images/E701 edited.png" alt="EXTREME PERFORMANCE E701"></div>
                        <div class="bst-card-info">
                            <div class="bst-card-tag">Heavy Duty Tricycle</div>
                            <div class="bst-card-name">EXTREME PERFORMANCE E701</div>
                            <div class="bst-card-hint">Built tough for commercial tricycle loads</div>
                        </div>
                        <div class="bst-card-arrow"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg></div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<script>
const bstData = <?php 
    if (!empty($tires)) {
        $data = [];
        foreach ($tires as $tire) {
            $sizes = json_decode($tire['sizes'], true);
            if (!is_array($sizes)) {
                $sizes = ['2.50-17', '2.75-17', '3.00-17'];
            }
            $data[] = [
                'name' => $tire['name'],
                'tag' => $tire['tag'],
                'img' => $tire['image'],
                'desc' => $tire['description'],
                'sizes' => $sizes
            ];
        }
        echo json_encode($data);
    } else {
        echo json_encode([
            ['name' => 'HI-MILLER E716', 'tag' => 'Motocross', 'img' => 'assets/images/E716 edited.png', 'desc' => 'Engineered for the toughest off-road conditions, the HI-MILLER E716 features an aggressive knob pattern that delivers superior mud traction and stability on loose terrain. Ideal for motocross riders who demand peak performance.', 'sizes' => ['2.50-17', '2.75-17', '3.00-17', '2.50-18', '2.75-18', '3.00-18']],
            ['name' => 'SPORTS E708', 'tag' => 'On/Off-Road · Dual', 'img' => 'assets/images/E708 edited.png', 'desc' => 'The versatile SPORTS E708 transitions seamlessly between tarmac and trail. A dual-purpose tread pattern ensures confident handling on paved roads while retaining off-road capability for weekend adventures.', 'sizes' => ['2.50-17', '2.75-17', '3.00-17', '2.75-18', '3.00-18', '3.25-18']],
            ['name' => 'STRENGTH E707', 'tag' => 'On-Road · High Speed', 'img' => 'assets/images/E707 png.png', 'desc' => 'Designed for the fast lane, the STRENGTH E707 offers a smooth center rib for straight-line stability and optimized shoulder blocks for confident cornering. Perfect for daily commuters and highway cruisers.', 'sizes' => ['2.50-17', '2.75-17', '3.00-17', '3.50-17', '2.75-18', '3.00-18', '3.50-18']],
            ['name' => 'EXTREME PERFORMANCE E701', 'tag' => 'Heavy Duty Tricycle', 'img' => 'assets/images/E701 edited.png', 'desc' => 'Built to handle the demands of commercial tricycle operations, the E701 features a reinforced carcass for heavy load capacity and a wide tread for maximum contact patch and durability under constant use.', 'sizes' => ['4.00-8', '4.50-10', '5.00-10', '6.00-12', '3.50-8']]
        ]);
    }
?>;
let bstActive = -1;
function bstSelect(index) {
    if (bstActive === index) return;
    bstActive = index;
    document.querySelectorAll('.bst-card').forEach((c, i) => c.classList.toggle('active', i === index));
    const d = bstData[index];
    const panel = document.getElementById('bstSpecsPanel');
    const empty = document.getElementById('bstEmptyState');
    const content = document.getElementById('bstPanelContent');
    panel.classList.add('active');
    empty.style.display = 'none';
    const sizesHTML = d.sizes.map(s => `<button class="bst-size-pill" onclick="this.classList.toggle('selected')">${s}</button>`).join('');
    content.style.display = 'flex';
    content.innerHTML = `<div class="bst-panel-content" style="display:flex;flex-direction:column;flex:1;"><div class="bst-specs-img-wrap"><img src="${d.img}" alt="${d.name}" class="bst-specs-img"></div><div class="bst-specs-tag">${d.tag}</div><div class="bst-specs-name">${d.name}</div><p class="bst-specs-desc">${d.desc}</p><div class="bst-sizes-label">Available Sizes</div><div class="bst-sizes">${sizesHTML}</div></div>`;
}
document.addEventListener('DOMContentLoaded', () => bstSelect(0));
</script>

<!-- Rider Stories -->
<section class="rider-stories-section" data-animate="fade-up">
    <div class="container">
        <div class="rider-stories-layout">
            <div class="rider-stories-header" data-animate="slide-in-left" data-delay="100">
                <span class="section-eyebrow"><?php echo getContent('stories_eyebrow', 'Rider Stories'); ?></span>
                <h3 class="section-title"><?php echo getContent('stories_title', 'BIDA & KWENTO'); ?></h3>
                <p class="section-sub"><?php echo getContent('stories_subtitle', 'Discover the inspiring journeys of riders who trust Sapphire Tire for their adventures.'); ?></p>
                <div class="header-underline"></div>
            </div>

            <div class="rider-stories-cards">
                <?php if (!empty($stories)): ?>
                    <?php foreach ($stories as $story): ?>
                    <div class="story-profile-card" data-animate="fade-up" data-delay="200">
                        <div class="story-card-img-wrap">
                            <img src="<?php echo htmlspecialchars($story['image']); ?>"
                                 onerror="this.style.background='linear-gradient(135deg,#1c3b6e,#0f2044)';this.style.display='block';this.removeAttribute('src')"
                                 alt="<?php echo htmlspecialchars($story['title']); ?>">
                        </div>
                        <div class="story-card-body">
                            <div class="story-card-title-row">
                                <h5><?php echo htmlspecialchars($story['title']); ?></h5>
                                <span class="story-card-badge">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                                </span>
                            </div>
                            <p class="story-card-desc"><?php echo htmlspecialchars($story['description']); ?></p>
                            <div class="story-card-footer">
                                <div class="story-card-stats">
                                    <div class="story-stat">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                        <span>Riders</span>
                                    </div>
                                    <div class="story-stat">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
                                        <span>Stories</span>
                                    </div>
                                </div>
                                <a href="<?php echo htmlspecialchars($story['link']); ?>" class="story-card-cta">
                                    View More
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Default stories if none in database -->
                    <div class="story-profile-card" data-animate="fade-up" data-delay="200">
                        <div class="story-card-img-wrap">
                            <img src="assets/images/bida.jpg"
                                 onerror="this.style.background='linear-gradient(135deg,#1c3b6e,#0f2044)';this.style.display='block';this.removeAttribute('src')"
                                 alt="Bida Kasambuhay">
                        </div>
                        <div class="story-card-body">
                            <div class="story-card-title-row">
                                <h5>BIDA KASAMBUHAY</h5>
                                <span class="story-card-badge">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                                </span>
                            </div>
                            <p class="story-card-desc">Featured rider stories using Sapphire Tire products.</p>
                            <div class="story-card-footer">
                                <div class="story-card-stats">
                                    <div class="story-stat">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                        <span>Riders</span>
                                    </div>
                                    <div class="story-stat">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
                                        <span>Stories</span>
                                    </div>
                                </div>
                                <a href="events.php#blog" class="story-card-cta">
                                    View More
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="story-profile-card" data-animate="fade-up" data-delay="300">
                        <div class="story-card-img-wrap">
                            <img src="assets/images/kwento.jpg"
                                 onerror="this.style.background='linear-gradient(135deg,#0f2044,#1c3b6e)';this.style.display='block';this.removeAttribute('src')"
                                 alt="Kwentong Kasambuhay">
                        </div>
                        <div class="story-card-body">
                            <div class="story-card-title-row">
                                <h5>KWENTONG KASAMBUHAY</h5>
                                <span class="story-card-badge">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                                </span>
                            </div>
                            <p class="story-card-desc">Inspirational journeys of riders powered by Sapphire Tire.</p>
                            <div class="story-card-footer">
                                <div class="story-card-stats">
                                    <div class="story-stat">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                        <span>Riders</span>
                                    </div>
                                    <div class="story-stat">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
                                        <span>Stories</span>
                                    </div>
                                </div>
                                <a href="events.php#blog" class="story-card-cta">
                                    View More
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>