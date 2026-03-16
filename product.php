<?php
include 'header.php';

$categories = [
    'motocross'           => 'Motocross',
    'dual'                => 'On/Off-Road / Dual',
    'on-road-highspeed'   => 'On-Road Highspeed',
    'heavy-duty'         => 'Heavy Duty'
];

// Complete tire specifications from brochure.pdf and Screenshot 2026-03-06 161207.png
$tireSpecs = [
    // MOTOCROSS TIRES
    'HI-MILLER' => [
        'code' => 'E716',
        'type' => 'MOTOCROSS',
        'sizes' => ['2.50-17', '2.75-17', '3.00-17']
    ],
    'MEGACROSS' => [
        'code' => 'E717',
        'type' => 'MOTOCROSS',
        'sizes' => ['2.50-17', '2.75-17', '3.00-17']
    ],
    
    // ON-ROAD HIGHSPEED TIRES (from Page 2)
    'STRENGTH' => [
        'code' => 'E707',
        'type' => 'TUBE TYPE',
        'sizes' => ['60/90-14', '80/90-14', '90/90-14']
    ],
    'SPEED' => [
        'code' => 'E712',
        'type' => 'TUBE TYPE',
        'sizes' => ['80/90-17', '2.75-17', '3.00-17']
    ],
    'EXCELLENT' => [
        'code' => 'E713',
        'type' => 'TUBE TYPE',
        'sizes' => ['2.25-17', '2.50-17', '2.75-17', '3.00-17']
    ],
    'DYNAMAX' => [
        'code' => 'E715',
        'type' => 'TUBE TYPE',
        'sizes' => ['2.50-17', '2.75-17', '3.00-17']
    ],
    'VIGOR' => [
        'code' => 'S110',
        'type' => 'TUBE TYPE',
        'sizes' => ['2.25-17', '2.50-17', '2.75-17', '3.00-17']
    ],
    'SPIKER' => [
        'code' => 'S111',
        'type' => 'TUBE TYPE',
        'sizes' => ['60/90-17', '70/90-17', '80/90-17']
    ],
    'PIONEER' => [
        'code' => 'S112',
        'type' => 'TUBE TYPE',
        'sizes' => ['60/90-17', '70/80-17', '80/80-17', '70/90-17', '80/90-17']
    ],
    'BLADE' => [
        'code' => 'S113',
        'type' => 'TUBE TYPE',
        'sizes' => ['60/90-17', '70/80-17', '80/80-17', '70/90-17', '80/90-17']
    ],
    
    // DUAL / ON/OFF-ROAD TIRES (from Page 1 & 2)
    'SPORTS' => [
        'code' => 'E708',
        'type' => 'DUAL SPORT',
        'sizes' => ['3.00-16', '3.25-16']
    ],
    'BIZZARE' => [
        'code' => 'E709',
        'type' => 'DUAL SPORT',
        'sizes' => ['2.50-17', '2.75-17', '3.00-17', '3.25-17']
    ],
    'GENESIS' => [
        'code' => 'E710',
        'type' => 'DUAL SPORT',
        'sizes' => ['2.75-18', '3.00-18']
    ],
    'HIGH-LANDER' => [
        'code' => 'E711',
        'type' => 'DUAL SPORT',
        'sizes' => ['2.75-17', '3.00-17']
    ],
    'SUPER CROSS' => [
        'code' => 'E718',
        'type' => 'DUAL SPORT',
        'sizes' => ['2.50-17', '2.75-17', '3.00-17']
    ],
    'GIGANTIC' => [
        'code' => 'E719',
        'type' => 'DUAL SPORT',
        'sizes' => ['2.50-17', '2.75-17']
    ],
    'DURABLE' => [
        'code' => 'E714',
        'type' => 'DUAL SPORT',
        'sizes' => ['2.25-17', '2.50-17']
    ],
    
    // HEAVY DUTY TIRES
    'EXTREME PERFORMANCE' => [
        'code' => 'E701',
        'type' => 'HEAVY DUTY',
        'sizes' => ['2.50-17', '2.75-17', '3.00-17']
    ],
    'EXTREME TRACTION' => [
        'code' => 'E702',
        'type' => 'HEAVY DUTY',
        'sizes' => ['2.50-17', '2.75-17', '3.00-17']
    ],
    'EXTREME FRONTAL' => [
        'code' => 'E703',
        'type' => 'HEAVY DUTY',
        'sizes' => ['2.50-17', '2.75-17', '3.00-17']
    ],
    'EXTREME ENDURANCE' => [
        'code' => 'E704',
        'type' => 'HEAVY DUTY',
        'sizes' => ['2.50-17', '2.75-17', '3.00-17']
    ],
    'EXTREME MILER' => [
        'code' => 'E705',
        'type' => 'HEAVY DUTY',
        'sizes' => ['2.50-17', '2.75-17', '3.00-17']
    ],
    'MEGA' => [
        'code' => 'E801',
        'type' => 'HEAVY DUTY',
        'sizes' => ['6R 60/90-14', '70/80-14', '80/80-14']
    ],
    'HYPER' => [
        'code' => 'E802',
        'type' => 'HEAVY DUTY',
        'sizes' => ['60/80-17', '70/80-17', '80/80-17']
    ],
    'CRUISER' => [
        'code' => 'E803',
        'type' => 'HEAVY DUTY',
        'sizes' => ['2.75-17', '3.00-17']
    ],
    
    // Additional tires from Page 2
    'SPIKER PIONEER' => [
        'code' => 'BLADE',
        'type' => 'TUBE TYPE',
        'sizes' => ['60/90-17', '70/80-17', '80/80-17', '70/90-17', '80/90-17']
    ]
];

// Marketplace links for each product (Shopee and Lazada)
// These are placeholder URLs - replace with actual product links
$marketplaceLinks = [
    'HI-MILLER' => [
        'shopee' => 'https://shopee.ph/product/123456789/hi-miller',
        'lazada' => 'https://www.lazada.com.ph/products/hi-miller-i123456789'
    ],
    'MEGACROSS' => [
        'shopee' => 'https://shopee.ph/product/123456789/megacross',
        'lazada' => 'https://www.lazada.com.ph/products/megacross-i123456789'
    ],
    'STRENGTH' => [
        'shopee' => 'https://shopee.ph/product/123456789/strength',
        'lazada' => 'https://www.lazada.com.ph/products/strength-i123456789'
    ],
    'SPEED' => [
        'shopee' => 'https://shopee.ph/product/123456789/speed',
        'lazada' => 'https://www.lazada.com.ph/products/speed-i123456789'
    ],
    'EXCELLENT' => [
        'shopee' => 'https://shopee.ph/product/123456789/excellent',
        'lazada' => 'https://www.lazada.com.ph/products/excellent-i123456789'
    ],
    'DYNAMAX' => [
        'shopee' => 'https://shopee.ph/product/123456789/dynamax',
        'lazada' => 'https://www.lazada.com.ph/products/dynamax-i123456789'
    ],
    'VIGOR' => [
        'shopee' => 'https://shopee.ph/product/123456789/vigor',
        'lazada' => 'https://www.lazada.com.ph/products/vigor-i123456789'
    ],
    'SPIKER' => [
        'shopee' => 'https://shopee.ph/product/123456789/spiker',
        'lazada' => 'https://www.lazada.com.ph/products/spiker-i123456789'
    ],
    'PIONEER' => [
        'shopee' => 'https://shopee.ph/product/123456789/pioneer',
        'lazada' => 'https://www.lazada.com.ph/products/pioneer-i123456789'
    ],
    'BLADE' => [
        'shopee' => 'https://shopee.ph/product/123456789/blade',
        'lazada' => 'https://www.lazada.com.ph/products/blade-i123456789'
    ],
    'SPORTS' => [
        'shopee' => 'https://shopee.ph/product/123456789/sports',
        'lazada' => 'https://www.lazada.com.ph/products/sports-i123456789'
    ],
    'BIZZARE' => [
        'shopee' => 'https://shopee.ph/product/123456789/bizzare',
        'lazada' => 'https://www.lazada.com.ph/products/bizzare-i123456789'
    ],
    'GENESIS' => [
        'shopee' => 'https://shopee.ph/product/123456789/genesis',
        'lazada' => 'https://www.lazada.com.ph/products/genesis-i123456789'
    ],
    'HIGH-LANDER' => [
        'shopee' => 'https://shopee.ph/product/123456789/high-lander',
        'lazada' => 'https://www.lazada.com.ph/products/high-lander-i123456789'
    ],
    'SUPER CROSS' => [
        'shopee' => 'https://shopee.ph/product/123456789/super-cross',
        'lazada' => 'https://www.lazada.com.ph/products/super-cross-i123456789'
    ],
    'GIGANTIC' => [
        'shopee' => 'https://shopee.ph/product/123456789/gigantic',
        'lazada' => 'https://www.lazada.com.ph/products/gigantic-i123456789'
    ],
    'DURABLE' => [
        'shopee' => 'https://shopee.ph/product/123456789/durable',
        'lazada' => 'https://www.lazada.com.ph/products/durable-i123456789'
    ],
    'EXTREME PERFORMANCE' => [
        'shopee' => 'https://shopee.ph/product/123456789/extreme-performance',
        'lazada' => 'https://www.lazada.com.ph/products/extreme-performance-i123456789'
    ],
    'EXTREME TRACTION' => [
        'shopee' => 'https://shopee.ph/product/123456789/extreme-traction',
        'lazada' => 'https://www.lazada.com.ph/products/extreme-traction-i123456789'
    ],
    'EXTREME FRONTAL' => [
        'shopee' => 'https://shopee.ph/product/123456789/extreme-frontal',
        'lazada' => 'https://www.lazada.com.ph/products/extreme-frontal-i123456789'
    ],
    'EXTREME ENDURANCE' => [
        'shopee' => 'https://shopee.ph/product/123456789/extreme-endurance',
        'lazada' => 'https://www.lazada.com.ph/products/extreme-endurance-i123456789'
    ],
    'EXTREME MILER' => [
        'shopee' => 'https://shopee.ph/product/123456789/extreme-miler',
        'lazada' => 'https://www.lazada.com.ph/products/extreme-miler-i123456789'
    ],
    'MEGA' => [
        'shopee' => 'https://shopee.ph/product/123456789/mega',
        'lazada' => 'https://www.lazada.com.ph/products/mega-i123456789'
    ],
    'HYPER' => [
        'shopee' => 'https://shopee.ph/product/123456789/hyper',
        'lazada' => 'https://www.lazada.com.ph/products/hyper-i123456789'
    ],
    'CRUISER' => [
        'shopee' => 'https://shopee.ph/product/123456789/cruiser',
        'lazada' => 'https://www.lazada.com.ph/products/cruiser-i123456789'
    ]
];

$allTires = [
    'motocross' => [
        ['name' => 'HI-MILLER',  'description' => 'High traction motocross tire engineered for extreme terrain and competitive racing.', 'image' => 'E716 edited.png'],
        ['name' => 'MEGACROSS',  'description' => 'Lightweight racing tire designed for the most competitive motocross riders.', 'image' => 'E717 edited.png'],
    ],
    'dual' => [
        ['name' => 'SPORTS',      'description' => 'Perfect balance for on and off-road riding — your all-terrain companion.', 'image' => 'E708 edited.png'],
        ['name' => 'BIZZARE',     'description' => 'Engineered for adventure riders who demand performance in any condition.', 'image' => 'E709 edited.png'],
        ['name' => 'GENESIS',     'description' => 'Perfect balance for on and off-road riding — your all-terrain companion.', 'image' => 'E710 edited.png'],
        ['name' => 'HIGH-LANDER', 'description' => 'Engineered for adventure riders who demand performance in any condition.', 'image' => 'E711 edited.png'],
        ['name' => 'SUPER CROSS', 'description' => 'Perfect balance for on and off-road riding — your all-terrain companion.', 'image' => 'E718 edited.png'],
        ['name' => 'GIGANTIC',    'description' => 'Engineered for adventure riders who demand performance in any condition.', 'image' => 'E719 edited.png'],
        ['name' => 'DURABLE',     'description' => 'Perfect balance for on and off-road riding — your all-terrain companion.', 'image' => 'E714 edited.png'],
    ],
    'on-road-highspeed' => [
        ['name' => 'STRENGTH',  'description' => 'Sport-touring tire with exceptional wet and dry handling characteristics.', 'image' => 'E707 png.png'],
        ['name' => 'SPEED',     'description' => 'High-speed stability tire for sport touring and daily commuting.', 'image' => 'E712 edited.png'],
        ['name' => 'EXCELLENT', 'description' => 'Premium tube-type tire offering excellent grip and durability.', 'image' => 'E713 edited.png'],
        ['name' => 'DYNAMAX',   'description' => 'Dynamic performance tire for riders seeking maximum control.', 'image' => 'E715 edited.png'],
        ['name' => 'VIGOR',     'description' => 'High-performance tube-type tire with superior traction.', 'image' => 'S110 edited.png'],
        ['name' => 'SPIKER',    'description' => 'Aggressive tread pattern for enhanced grip on various surfaces.', 'image' => 's111 edited.png'],
        ['name' => 'PIONEER',   'description' => 'Versatile tire for riders who demand performance in all conditions.', 'image' => 'S112 edited.png'],
        ['name' => 'BLADE',     'description' => 'Precision-engineered tire for sharp handling and control.', 'image' => 'S113-2 edited.png'],
    ],
    'heavy-duty' => [
        ['name' => 'EXTREME PERFORMANCE', 'description' => 'Maximum durability and performance for heavy-duty applications.', 'image' => 'E701 edited.png'],
        ['name' => 'EXTREME TRACTION',    'description' => 'Superior traction in challenging conditions with extended tread life.', 'image' => 'E702 edited.png'],
        ['name' => 'EXTREME FRONTAL',     'description' => 'Reinforced front tire design for enhanced stability and control.', 'image' => 'E703 edited.png'],
        ['name' => 'EXTREME ENDURANCE',   'description' => 'Long-lasting tire engineered for extended mileage and reliability.', 'image' => 'E704 edited.png'],
        ['name' => 'EXTREME MILER',       'description' => 'High-mileage tire for commercial and heavy-use applications.', 'image' => 'E705 edited.png'],
        ['name' => 'MEGA',    'description' => 'Heavy-duty construction for maximum load capacity and durability.', 'image' => 'E801 edited.png'],
        ['name' => 'HYPER',   'description' => 'Enhanced performance tire for demanding riding conditions.', 'image' => 'E802 edited.png'],
        ['name' => 'CRUISER', 'description' => 'Comfort-focused tire for long-distance cruising and touring.', 'image' => 'E803 edited.png'],
    ],
];

$catAccentLabels = [
    'motocross'          => 'Motocross',
    'dual'               => 'On/Off-Road',
    'on-road-highspeed'  => 'Highspeed',
    'heavy-duty'         => 'Heavy Duty',
];

$catColors = [
    'motocross'          => '#1a1a2e',
    'dual'               => '#0d3b4f',
    'on-road-highspeed'  => '#1a0d3b',
    'heavy-duty'         => '#3b0d0d',
];

$activeCat = isset($_GET['cat']) && array_key_exists($_GET['cat'], $categories)
    ? $_GET['cat'] : array_key_first($categories);

$totalAll = array_sum(array_map('count', $allTires));
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,600;0,700;0,800;0,900;1,400&family=Open+Sans:wght@300;400;500;600&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
/* ═══════════════════════════════════════
   RESET & TOKENS - BLUE THEME (from index.php)
═══════════════════════════════════════ */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --cream:    #1c3b6e;      /* Dark blue from index */
    --paper:    #0a0f1a;       /* Almost black background */
    --ink:      #ffffff;       /* White text */
    --ink-60:   rgba(255,255,255,0.6);
    --ink-20:   rgba(255,255,255,0.12);
    --ink-08:   rgba(255,255,255,0.05);
    --rule:     rgba(255,255,255,0.08);
    --accent:   #3b82f6;       /* Bright blue accent */
    --accent-dk: #60a5fa;      /* Lighter blue for hover states */
    --accent-gradient: linear-gradient(135deg, #1c3b6e 0%, #0f2044 100%);
    --red:      #ef4444;
    --shopee:   #ee4d2d;       /* Shopee orange color */
    --lazada:   #0f146d;       /* Lazada blue color */

    --font-display: 'Montserrat', sans-serif;
    --font-body:    'Open Sans', sans-serif;
    --font-mono:    'Montserrat', sans-serif;
    --font-inter:   'Inter', sans-serif;

    --sidebar-w: 240px;
    --ease-expo: cubic-bezier(0.16, 1, 0.3, 1);
    --ease-back: cubic-bezier(0.34, 1.56, 0.64, 1);
}

body { 
    background: var(--paper); 
    color: var(--ink); 
    font-family: var(--font-body); 
}

/* ═══════════════════════════════════════
   MARKETPLACE LINKS - Styled like footer social buttons
═══════════════════════════════════════ */
@keyframes iconBounce {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.2); }
}

.marketplace-links {
    display: flex;
    gap: 0.5rem;
    margin: 0.75rem 0 1rem;
    flex-wrap: wrap;
}

.marketplace-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.35rem 0.9rem;
    border: 1px solid rgba(96, 165, 250, 0.3);
    border-radius: 20px;
    color: rgba(255,255,255,0.75);
    text-decoration: none;
    font-family: var(--font-inter);
    font-size: 0.75rem;
    font-weight: 500;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    position: relative;
    overflow: hidden;
    background: transparent;
    cursor: pointer;
}

.marketplace-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(99, 102, 241, 0.2));
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: -1;
}

.marketplace-btn:hover {
    color: #fff;
    border-color: #60a5fa;
    transform: translateY(-2px) scale(1.02);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
}

.marketplace-btn:hover::before {
    opacity: 1;
}

.marketplace-btn i {
    font-size: 0.8rem;
    color: #60a5fa;
    transition: transform 0.3s ease;
}

.marketplace-btn:hover i {
    transform: scale(1.1);
    animation: iconBounce 0.5s ease infinite;
}

/* Shopee specific hover effect */
.shopee-btn:hover {
    background: linear-gradient(135deg, #ee4d2d, #d43f1f);
    border-color: #ee4d2d;
}

.shopee-btn:hover i {
    color: #fff;
}

/* Lazada specific hover effect */
.lazada-btn:hover {
    background: linear-gradient(135deg, #0f146d, #0a0e4f);
    border-color: #0f146d;
}

.lazada-btn:hover i {
    color: #fff;
}

/* ═══════════════════════════════════════
   LIGHTBOX / MODAL STYLES
═══════════════════════════════════════ */
.lightbox-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.95);
    backdrop-filter: blur(10px);
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.lightbox-content {
    position: relative;
    margin: auto;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
    width: 100%;
    padding: 40px;
}

.lightbox-image-container {
    position: relative;
    max-width: 90vw;
    max-height: 80vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.lightbox-image-container img {
    max-width: 100%;
    max-height: 80vh;
    object-fit: contain;
    border-radius: 8px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
    animation: zoomIn 0.3s ease;
}

@keyframes zoomIn {
    from { transform: scale(0.9); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

.lightbox-close {
    position: absolute;
    top: 20px;
    right: 30px;
    color: #fff;
    font-size: 40px;
    font-weight: 300;
    cursor: pointer;
    z-index: 10000;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(255,255,255,0.1);
    transition: all 0.3s ease;
    line-height: 1;
}

.lightbox-close:hover {
    background: rgba(59,130,246,0.3);
    transform: rotate(90deg);
    color: #60a5fa;
}

.lightbox-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    color: white;
    font-size: 24px;
    z-index: 10000;
}

.lightbox-nav:hover {
    background: #3b82f6;
    transform: translateY(-50%) scale(1.1);
}

.lightbox-prev {
    left: 20px;
}

.lightbox-next {
    right: 20px;
}

.lightbox-caption {
    position: absolute;
    bottom: 20px;
    left: 0;
    right: 0;
    text-align: center;
    color: white;
    font-family: var(--font-display);
    font-size: 1.2rem;
    padding: 20px;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
}

.lightbox-caption small {
    font-size: 0.9rem;
    color: #60a5fa;
    display: block;
    margin-top: 5px;
}

/* Add zoom cursor to product images */
.prod-img-wrap {
    cursor: zoom-in;
}

/* Lightbox image counter */
.lightbox-counter {
    position: absolute;
    top: 20px;
    left: 20px;
    color: rgba(255,255,255,0.7);
    font-family: var(--font-mono);
    font-size: 0.9rem;
    background: rgba(0,0,0,0.5);
    padding: 5px 15px;
    border-radius: 30px;
    border: 1px solid rgba(255,255,255,0.2);
}

/* ═══════════════════════════════════════
   HERO BANNER - Blue gradient from index
═══════════════════════════════════════ */
.page-hero {
    position: relative;
    display: grid;
    grid-template-columns: 1fr 1fr;
    min-height: 88vh;
    overflow: hidden;
    background: linear-gradient(135deg, #1c3b6e 0%, #0f2044 100%);
    border-bottom: 1px solid var(--rule);
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
    animation: heroImgReveal 1.4s var(--ease-expo) forwards;
}
@keyframes heroImgReveal {
    from { transform: scale(1.14); opacity: 0; }
    to   { transform: scale(1.06); opacity: 1; }
}
.hero-visual-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(120deg, transparent 55%, rgba(10,15,26,0.8) 100%);
}

/* Ticker strip - blue themed */
.hero-ticker {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 36px;
    background: rgba(59,130,246,0.18);
    border-top: 1px solid rgba(59,130,246,0.3);
    color: #93c5fd;
    display: flex; align-items: center;
    overflow: hidden;
    font-family: var(--font-mono);
    font-size: 0.65rem; letter-spacing: 0.18em;
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

/* Hero copy */
.hero-copy {
    display: flex; flex-direction: column;
    justify-content: center; padding: 4rem 5rem 4rem 4rem;
    animation: heroCopyIn 1s 0.2s var(--ease-expo) both;
}
@keyframes heroCopyIn {
    from { opacity: 0; transform: translateY(32px); }
    to   { opacity: 1; transform: translateY(0); }
}
.hero-eyebrow {
    font-family: var(--font-mono); font-size: 0.65rem;
    letter-spacing: 0.22em; text-transform: uppercase;
    color: var(--accent); margin-bottom: 1.2rem;
    display: flex; align-items: center; gap: 0.7rem;
}
.hero-eyebrow::before {
    content: ''; display: block; width: 28px; height: 1px;
    background: var(--accent);
}
.hero-heading {
    font-family: var(--font-display);
    font-size: clamp(2.2rem, 4vw, 3.6rem);
    font-weight: 800; line-height: 1.1;
    letter-spacing: -0.02em; color: #ffffff;
    margin-bottom: 1.4rem;
}
.hero-heading em { 
    font-style: italic; 
    color: var(--accent-dk); 
    font-weight: 700; 
}
.hero-subtext {
    font-size: 0.87rem; line-height: 1.75;
    color: var(--ink-60); max-width: 360px;
    margin-bottom: 2.4rem;
}
.hero-stats {
    display: flex; gap: 2.5rem;
    padding-top: 2rem;
    border-top: 1px solid var(--rule);
}
.stat-item {}
.stat-num {
    font-family: var(--font-display);
    font-size: 2rem; font-weight: 900; line-height: 1;
    color: #60a5fa;
}
.stat-label {
    font-family: var(--font-mono); font-size: 0.6rem;
    letter-spacing: 0.18em; text-transform: uppercase;
    color: var(--ink-60); margin-top: 0.3rem;
}

/* ── Category pill nav under hero - blue theme ── */
.cat-nav {
    background: #0f2044;
    border-bottom: 1px solid rgba(59,130,246,0.2);
    padding: 0 2rem; height: 52px;
    display: flex; align-items: center; gap: 0;
    overflow-x: auto; scrollbar-width: none;
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
}
.cat-nav::-webkit-scrollbar { display: none; }
.cat-nav-label {
    font-family: var(--font-mono); font-size: 0.58rem;
    letter-spacing: 0.22em; text-transform: uppercase;
    color: rgba(255,255,255,0.25); margin-right: 2rem;
    white-space: nowrap; flex-shrink: 0;
}
.cat-pill {
    display: flex; align-items: center;
    height: 100%; padding: 0 1.4rem;
    font-family: var(--font-body); font-size: 0.78rem;
    font-weight: 500; letter-spacing: 0.04em;
    color: rgba(255,255,255,0.45);
    white-space: nowrap; cursor: pointer;
    border: none; background: none;
    border-bottom: 2px solid transparent;
    transition: color 0.2s, border-color 0.2s;
    position: relative; flex-shrink: 0;
}
.cat-pill:hover { color: rgba(255,255,255,0.8); }
.cat-pill.active {
    color: #fff; border-bottom-color: #3b82f6;
}
.cat-pill-count {
    font-family: var(--font-mono); font-size: 0.58rem;
    background: rgba(255,255,255,0.07);
    border-radius: 20px; padding: 0.1rem 0.45rem;
    margin-left: 0.5rem; color: rgba(255,255,255,0.3);
}
.cat-pill.active .cat-pill-count { background: #3b82f6; color: #fff; }

/* ═══════════════════════════════════════
   MAIN LAYOUT
═══════════════════════════════════════ */
.shop-layout {
    display: grid;
    grid-template-columns: var(--sidebar-w) 1fr;
    min-height: 80vh;
    align-items: start;
}

/* ═══════════════════════════════════════
   SIDEBAR - Blue theme
═══════════════════════════════════════ */
.shop-sidebar {
    position: sticky; top: 80px;
    height: calc(100vh - 80px); overflow-y: auto;
    scrollbar-width: none;
    border-right: 1px solid var(--rule);
    padding: 2.5rem 0;
    background: #0f2044;
    animation: sidebarIn 0.8s 0.3s var(--ease-expo) both;
}
.shop-sidebar::-webkit-scrollbar { display: none; }
@keyframes sidebarIn {
    from { opacity: 0; transform: translateX(-20px); }
    to   { opacity: 1; transform: translateX(0); }
}

.sidebar-section { padding: 0 1.8rem 1.8rem; border-bottom: 1px solid var(--rule); margin-bottom: 1.8rem; }
.sidebar-section:last-child { border-bottom: none; margin-bottom: 0; }

.sidebar-label {
    font-family: var(--font-mono); font-size: 0.58rem;
    letter-spacing: 0.22em; text-transform: uppercase;
    color: var(--ink-60); margin-bottom: 1.2rem;
    display: flex; align-items: center; justify-content: space-between;
}
.sidebar-label a {
    font-size: 0.58rem; color: var(--accent); text-decoration: none;
    transition: color 0.2s;
}
.sidebar-label a:hover { color: var(--accent-dk); }

/* Sidebar total */
.sidebar-total {
    padding: 0 1.8rem 2rem;
}
.total-num {
    font-family: var(--font-display);
    font-size: 3rem; font-weight: 900; line-height: 1;
    color: #60a5fa; display: block;
}
.total-label {
    font-family: var(--font-mono); font-size: 0.6rem;
    letter-spacing: 0.18em; text-transform: uppercase;
    color: var(--ink-60); display: block; margin-top: 0.3rem;
}

/* Filter rows */
.filter-list { display: flex; flex-direction: column; gap: 0; }
.filter-row {
    display: flex; align-items: center; justify-content: space-between;
    padding: 0.58rem 0;
    font-size: 0.83rem; color: var(--ink-60);
    cursor: pointer; border: none; background: none;
    text-align: left; width: 100%;
    border-bottom: 1px solid transparent;
    transition: color 0.18s, border-color 0.18s;
    position: relative;
}
.filter-row::before {
    content: '';
    position: absolute; left: -1.8rem; top: 50%; transform: translateY(-50%);
    width: 2px; height: 0; background: #3b82f6;
    transition: height 0.22s var(--ease-expo);
    border-radius: 2px;
}
.filter-row:hover { color: var(--ink); }
.filter-row.active { color: var(--ink); font-weight: 600; }
.filter-row.active::before { height: 18px; }
.filter-count {
    font-family: var(--font-mono); font-size: 0.62rem;
    color: var(--ink-60); letter-spacing: 0.05em;
}
.filter-row.active .filter-count { color: #60a5fa; }

/* Checkbox style filters */
.check-row {
    display: flex; align-items: center; gap: 0.75rem;
    padding: 0.45rem 0; cursor: pointer;
    font-size: 0.83rem; color: var(--ink-60);
    transition: color 0.18s;
}
.check-row:hover { color: var(--ink); }
.check-box {
    width: 15px; height: 15px; border-radius: 3px;
    border: 1.5px solid var(--ink-20); background: transparent;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; transition: all 0.18s;
}
.check-row.checked .check-box {
    background: #3b82f6; border-color: #3b82f6;
}
.check-row.checked .check-box::after {
    content: '✓'; color: white; font-size: 0.6rem; line-height: 1;
}
.check-row.checked { color: var(--ink); font-weight: 500; }

/* ═══════════════════════════════════════
   CATALOG CONTENT - Blue gradient background like index.php
═══════════════════════════════════════ */
.shop-content {
    min-width: 0; padding-bottom: 6rem;
    position: relative;
    background:
        linear-gradient(rgba(28, 47, 125, 0.92), rgba(15, 32, 68, 0.95)),
        url('assets/images/sapphire-background.jpg') center/cover no-repeat;
    background-attachment: fixed;
}

/* Toolbar - blue theme */
.catalog-toolbar {
    display: flex; align-items: center; justify-content: space-between;
    padding: 1.4rem 2.5rem;
    border-bottom: 1px solid var(--rule);
    background: #1c3b6e;
    backdrop-filter: blur(12px);
}
.toolbar-left { 
    font-family: var(--font-mono); font-size: 0.65rem;
    letter-spacing: 0.16em; text-transform: uppercase; color: var(--ink-60);
}
.toolbar-left strong { color: #60a5fa; font-weight: 500; }
.toolbar-right { display: flex; align-items: center; gap: 1rem; }
.sort-select {
    font-family: var(--font-body); font-size: 0.8rem;
    border: 1px solid var(--rule); background: rgba(255,255,255,0.05);
    color: var(--ink); padding: 0.35rem 0.8rem;
    border-radius: 4px; cursor: pointer; outline: none;
}
.sort-select option { background: #1c3b6e; }
.view-toggle { display: flex; gap: 0.35rem; }
.view-btn {
    width: 32px; height: 32px; border-radius: 4px;
    border: 1px solid var(--rule); background: transparent;
    cursor: pointer; display: flex; align-items: center; justify-content: center;
    color: var(--ink-60); transition: all 0.18s;
}
.view-btn.active { background: #3b82f6; color: #fff; border-color: #3b82f6; }
.view-btn svg { width: 13px; height: 13px; }

/* Group heading */
.group-heading {
    padding: 2.5rem 2.5rem 1.2rem;
    display: flex; align-items: baseline; gap: 1.2rem;
    border-bottom: 1px solid var(--rule);
    margin-bottom: 0;
}
.group-heading h2 {
    font-family: var(--font-display);
    font-size: 1.4rem; font-weight: 800; font-style: normal;
    letter-spacing: 0.08em; text-transform: uppercase;
    color: #60a5fa; line-height: 1;
}
.group-heading-rule { flex: 1; height: 1px; background: var(--rule); }
.group-heading-count {
    font-family: var(--font-mono); font-size: 0.6rem;
    letter-spacing: 0.14em; color: var(--ink-60);
}

/* ── PRODUCT GRID ── */
.product-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    border-left: 1px solid var(--rule);
}
.product-grid.hidden { display: none; }
.group-block.hidden { display: none; }

/* Card */
.prod-card {
    border-right: 1px solid var(--rule);
    border-bottom: 1px solid var(--rule);
    background: rgba(255,255,255,0.03);
    position: relative; cursor: pointer;
    transition: background 0.25s, border-color 0.25s;
    opacity: 0; transform: translateY(24px);
    animation: cardUp 0.55s var(--ease-expo) forwards;
}
@keyframes cardUp {
    to { opacity: 1; transform: translateY(0); }
}
.prod-card:hover { background: rgba(59,130,246,0.07); border-color: rgba(59,130,246,0.2); }

/* Image zone */
.prod-img-wrap {
    position: relative; overflow: hidden;
    aspect-ratio: 4/3;
    background: rgba(255,255,255,0.04);
    display: flex; align-items: center; justify-content: center;
    cursor: zoom-in;
}
.prod-img-wrap img {
    width: 100%; height: 100%;
    object-fit: contain; padding: 1.2rem;
    transition: transform 0.7s var(--ease-expo);
    filter: drop-shadow(0 6px 20px rgba(0,0,0,0.4));
}
.prod-card:hover .prod-img-wrap img { transform: scale(1.06) translateY(-4px); }

/* Category tag - UPDATED to show code */
.prod-tag {
    position: absolute; top: 1rem; left: 1rem;
    font-family: var(--font-mono); font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    background: rgba(59,130,246,0.25);
    color: #ffffff;
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    backdrop-filter: blur(6px);
    border: 1px solid rgba(59,130,246,0.5);
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    transition: background 0.2s;
    z-index: 2;
}

/* Code badge - NEW */
.prod-code {
    position: absolute; top: 1rem; right: 1rem;
    font-family: var(--font-mono); font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    background: rgba(0,0,0,0.6);
    color: #60a5fa;
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    backdrop-filter: blur(4px);
    border: 1px solid rgba(255,255,255,0.15);
    box-shadow: 0 2px 6px rgba(0,0,0,0.3);
    z-index: 2;
}

/* Wishlist btn */
.prod-wish {
    position: absolute; bottom: 1rem; right: 1rem; z-index: 5;
    width: 34px; height: 34px; border-radius: 50%;
    background: rgba(15,32,68,0.8); border: 1px solid var(--rule);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; backdrop-filter: blur(6px);
    transition: all 0.28s var(--ease-back);
    color: var(--ink-60);
    opacity: 0; transform: scale(0.7);
}
.prod-card:hover .prod-wish { opacity: 1; transform: scale(1); }
.prod-wish:hover { background: rgba(239,68,68,0.2); color: #ef4444; border-color: rgba(239,68,68,0.5); }
.prod-wish.wished { background: rgba(239,68,68,0.2); color: #ef4444; border-color: rgba(239,68,68,0.5); opacity: 1; transform: scale(1); }
.prod-wish svg { width: 14px; height: 14px; fill: currentColor; }

/* Image overlay number */
.prod-num {
    position: absolute; bottom: 1rem; left: 1rem;
    font-family: var(--font-mono); font-size: 0.65rem;
    color: var(--ink-60); letter-spacing: 0.1em;
    background: rgba(0,0,0,0.4);
    padding: 0.2rem 0.6rem;
    border-radius: 16px;
    backdrop-filter: blur(4px);
    border: 1px solid rgba(255,255,255,0.1);
    opacity: 0.7;
    transition: opacity 0.2s;
}
.prod-card:hover .prod-num { opacity: 1; }

/* Card body */
.prod-body {
    padding: 1.2rem 1.4rem 1.4rem;
    border-top: 1px solid var(--rule);
}
.prod-name {
    font-family: var(--font-display);
    font-size: 1.1rem; font-weight: 800;
    line-height: 1.2; color: #ffffff;
    margin-bottom: 0.25rem;
    letter-spacing: 0.02em;
}
.prod-type {
    font-family: var(--font-mono);
    font-size: 0.7rem;
    color: #93c5fd;
    margin-bottom: 0.75rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
}
.prod-desc {
    color: #ffffff !important;
    font-size: 1rem !important;
    line-height: 1.6 !important;
}
/* Tire specifications */
.prod-specs {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
    padding: 0.5rem 0;
    border-top: 1px dashed rgba(59,130,246,0.3);
    border-bottom: 1px dashed rgba(59,130,246,0.3);
}
.spec-badge {
    font-family: var(--font-mono);
    font-size: 0.7rem;
    font-weight: 500;
    background: rgba(59,130,246,0.2);
    color: #bfdbfe;
    padding: 0.25rem 0.7rem;
    border-radius: 20px;
    border: 1px solid rgba(59,130,246,0.4);
    letter-spacing: 0.02em;
    transition: all 0.2s;
}
.spec-badge:hover {
    background: rgba(59,130,246,0.35);
    color: white;
    border-color: #3b82f6;
    transform: translateY(-2px);
}
.prod-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.prod-cat-label {
    font-family: var(--font-mono); font-size: 0.62rem;
    letter-spacing: 0.14em; text-transform: uppercase;
    color: var(--ink-60);
    display: flex; align-items: center; gap: 0.5rem;
}
.prod-cat-dot {
    width: 5px; height: 5px; border-radius: 50%;
    background: #3b82f6; flex-shrink: 0;
}
.prod-cta {
    display: flex; align-items: center; gap: 0.5rem;
}
.btn-wish-sm {
    width: 30px; height: 30px; border-radius: 50%;
    border: 1px solid var(--rule); background: transparent;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--ink-60);
    transition: all 0.22s var(--ease-back);
}
.btn-wish-sm:hover { background: rgba(239,68,68,0.18); color: #ef4444; border-color: rgba(239,68,68,0.4); }
.btn-wish-sm.wished { background: rgba(239,68,68,0.18); color: #ef4444; border-color: rgba(239,68,68,0.4); }
.btn-wish-sm svg { width: 12px; height: 12px; fill: currentColor; }

.btn-view {
    width: 30px; height: 30px; border-radius: 50%;
    border: 1px solid rgba(59,130,246,0.4); background: transparent;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: #60a5fa; font-size: 1rem;
    transition: all 0.22s var(--ease-back);
    font-family: var(--font-mono);
}
.btn-view:hover { background: #3b82f6; color: white; border-color: #3b82f6; transform: rotate(45deg) scale(1.08); }

/* ── LIST VIEW ── */
.product-grid.list-view {
    grid-template-columns: 1fr;
}
.product-grid.list-view .prod-card {
    display: grid;
    grid-template-columns: 200px 1fr;
}
.product-grid.list-view .prod-img-wrap {
    aspect-ratio: auto; height: 100%;
}
.product-grid.list-view .prod-body {
    border-top: none;
    border-left: 1px solid var(--rule);
    display: flex; flex-direction: column; justify-content: center;
}
.product-grid.list-view .prod-specs {
    margin-bottom: 1rem;
}

/* ── Empty state ── */
.empty-state {
    grid-column: 1 / -1;
    padding: 5rem 2rem;
    text-align: center;
    color: var(--ink-60);
}
.empty-state p {
    font-family: var(--font-display);
    font-size: 1.4rem; font-style: italic;
    margin-bottom: 0.5rem;
}
.empty-state small {
    font-family: var(--font-mono);
    font-size: 0.65rem; letter-spacing: 0.16em;
    text-transform: uppercase;
}

/* Scroll-reveal */
.reveal { opacity: 0; transform: translateY(28px); transition: opacity 0.6s var(--ease-expo), transform 0.6s var(--ease-expo); }
.reveal.visible { opacity: 1; transform: translateY(0); }

/* ═══════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════ */
@media (max-width: 1100px) {
    .product-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 900px) {
    .page-hero { grid-template-columns: 1fr; min-height: auto; }
    .hero-visual { height: 42vw; }
    .hero-copy { padding: 3rem 2rem; }
    .shop-layout { grid-template-columns: 1fr; }
    .shop-sidebar { position: static; height: auto; }
    .product-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 600px) {
    .product-grid { grid-template-columns: repeat(2, 1fr); }
    .group-heading { padding: 1.8rem 1.2rem 1rem; }
    .catalog-toolbar { padding: 1rem 1.2rem; }
    .lightbox-content { padding: 20px; }
    .lightbox-nav { width: 40px; height: 40px; font-size: 20px; }
    .lightbox-close { top: 10px; right: 15px; font-size: 30px; }
    .marketplace-links { justify-content: center; }
}
</style>

<!-- ══════════════════════════════════════
     HERO
══════════════════════════════════════ -->
<div class="page-hero">
    <div class="hero-visual">
        <img class="hero-visual-img"
             src="assets/images/sapphire-background.jpg"
             alt="Tire collection"
             onerror="this.style.display='none'">
        <div class="hero-visual-overlay"></div>
        <div class="hero-ticker" aria-hidden="true">
            <div class="ticker-track" id="tickerTrack">
                <?php $items = ['E701', 'E702', 'E703', 'E704', 'E705', 'E707', 'E708', 'E709', 'E710', 'E711', 'E712', 'E713', 'E714', 'E715', 'E716', 'E717', 'E718', 'E719', 'E801', 'E802', 'E803', 'S110', 'S111', 'S112', 'S113']; ?>
                <?php for ($r = 0; $r < 2; $r++): foreach ($items as $it): ?>
                    <span><?= $it ?></span>
                <?php endforeach; endfor; ?>
            </div>
        </div>
    </div>

    <div class="hero-copy">
        <div class="hero-eyebrow">Complete Catalog</div>
        <h1 class="hero-heading">
            Sapphire<br>
            <em>Tire</em> Collection
        </h1>
        <p class="hero-subtext">
            Complete specifications including tire codes, sizes, and types for every model in the Sapphire lineup.
        </p>
        <div class="hero-stats">
            <div class="stat-item reveal">
                <span class="stat-num"><?= $totalAll ?></span>
                <span class="stat-label">Models</span>
            </div>
            <div class="stat-item reveal" style="transition-delay:0.1s">
                <span class="stat-num"><?= count($categories) ?></span>
                <span class="stat-label">Categories</span>
            </div>
            <div class="stat-item reveal" style="transition-delay:0.2s">
                <span class="stat-num">25+</span>
                <span class="stat-label">Codes</span>
            </div>
        </div>
    </div>
</div>

<!-- Category pill nav -->
<nav class="cat-nav" id="catNav" aria-label="Product categories">
    <span class="cat-nav-label">Filter by</span>
    <button class="cat-pill active" data-cat="all">
        All
        <span class="cat-pill-count"><?= $totalAll ?></span>
    </button>
    <?php foreach ($categories as $key => $label): ?>
        <button class="cat-pill" data-cat="<?= $key ?>">
            <?= $label ?>
            <span class="cat-pill-count"><?= count($allTires[$key]) ?></span>
        </button>
    <?php endforeach; ?>
</nav>

<!-- ══════════════════════════════════════
     SHOP LAYOUT
══════════════════════════════════════ -->
<div class="shop-layout">

    <!-- SIDEBAR -->
    <aside class="shop-sidebar" aria-label="Filters">

        <div class="sidebar-total">
            <span class="total-num" id="sideCount"><?= $totalAll ?></span>
            <span class="total-label">Models available</span>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-label">
                Category <a href="#" id="resetFilter">Reset</a>
            </div>
            <div class="filter-list" id="filterList">
                <button class="filter-row active" data-filter="all">
                    All Tires
                    <span class="filter-count"><?= $totalAll ?></span>
                </button>
                <?php foreach ($allTires as $catKey => $tires): ?>
                <button class="filter-row" data-filter="<?= $catKey ?>">
                    <?= $catAccentLabels[$catKey] ?>
                    <span class="filter-count"><?= count($tires) ?></span>
                </button>
                <?php endforeach; ?>
            </div>
        </div>

    </aside>

    <!-- CONTENT -->
    <main class="shop-content" id="shopContent">

        <!-- Toolbar -->
        <div class="catalog-toolbar">
            <div class="toolbar-left">
                Showing <strong id="toolbarCount"><?= $totalAll ?></strong> models
            </div>
            <div class="toolbar-right">
                <select class="sort-select" id="sortSelect" aria-label="Sort">
                    <option value="default">Default Order</option>
                    <option value="name-asc">Name A–Z</option>
                    <option value="name-desc">Name Z–A</option>
                    <option value="code">Code</option>
                </select>
                <div class="view-toggle" role="group" aria-label="View mode">
                    <button class="view-btn active" id="btnGrid" title="Grid view" aria-pressed="true">
                        <svg viewBox="0 0 16 16" fill="currentColor"><rect x="1" y="1" width="6" height="6" rx="1"/><rect x="9" y="1" width="6" height="6" rx="1"/><rect x="1" y="9" width="6" height="6" rx="1"/><rect x="9" y="9" width="6" height="6" rx="1"/></svg>
                    </button>
                    <button class="view-btn" id="btnList" title="List view" aria-pressed="false">
                        <svg viewBox="0 0 16 16" fill="currentColor"><rect x="1" y="2" width="14" height="2" rx="1"/><rect x="1" y="7" width="14" height="2" rx="1"/><rect x="1" y="12" width="14" height="2" rx="1"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Groups -->
        <?php
        $globalIdx = 0;
        foreach ($allTires as $catKey => $tires): ?>

        <div class="group-block reveal" data-group="<?= $catKey ?>">
            <div class="group-heading">
                <h2><?= $catAccentLabels[$catKey] ?? $catKey ?></h2>
                <div class="group-heading-rule"></div>
                <div class="group-heading-count"><?= count($tires) ?> models</div>
            </div>

            <div class="product-grid" id="grid-<?= $catKey ?>">
                <?php foreach ($tires as $i => $tire):
                    $img   = 'assets/images/' . $tire['image'];
                    $delay = ($i % 4) * 0.07;
                    $globalIdx++;
                    
                    // Get complete specifications for this tire
                    $tireName = strtoupper($tire['name']);
                    $specs = isset($tireSpecs[$tireName]) ? $tireSpecs[$tireName] : null;
                    
                    // If not found, try to find by partial match
                    if (!$specs) {
                        foreach ($tireSpecs as $key => $value) {
                            if (strpos($tireName, strtoupper($key)) !== false || strpos(strtoupper($key), $tireName) !== false) {
                                $specs = $value;
                                break;
                            }
                        }
                    }
                    
                    // Get marketplace links for this tire
                    $tireKey = strtoupper($tire['name']);
                    $shopeeLink = isset($marketplaceLinks[$tireKey]['shopee']) ? $marketplaceLinks[$tireKey]['shopee'] : '#';
                    $lazadaLink = isset($marketplaceLinks[$tireKey]['lazada']) ? $marketplaceLinks[$tireKey]['lazada'] : '#';
                ?>
                <article class="prod-card" data-cat="<?= $catKey ?>" data-img="<?= htmlspecialchars($img) ?>" data-name="<?= htmlspecialchars($tire['name']) ?>" data-code="<?= $specs ? htmlspecialchars($specs['code']) : '' ?>" data-category="<?= $catAccentLabels[$catKey] ?>" style="animation-delay:<?= $delay ?>s; animation-play-state:paused;">
                    <div class="prod-img-wrap" onclick="openLightbox(this)">
                        <!-- Tire Code Badge (top right) -->
                        <?php if ($specs && isset($specs['code'])): ?>
                            <span class="prod-code"><?= htmlspecialchars($specs['code']) ?></span>
                        <?php endif; ?>
                        
                        <!-- Category Tag (top left) -->
                        <span class="prod-tag"><?= $catAccentLabels[$catKey] ?></span>
                        
                        <button class="prod-wish" aria-label="Save to wishlist" onclick="event.stopPropagation();this.classList.toggle('wished')">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                            </svg>
                        </button>
                        
                        <img src="<?= htmlspecialchars($img) ?>"
                             alt="<?= htmlspecialchars($tire['name']) ?>"
                             loading="lazy"
                             onerror="this.src='assets/images/placeholder.jpg'">
                        
                        <span class="prod-num">#<?= str_pad($globalIdx, 2, '0', STR_PAD_LEFT) ?></span>
                    </div>
                    
                    <div class="prod-body">
                        <div class="prod-name"><?= htmlspecialchars($tire['name']) ?></div>
                        
                        <?php if ($specs && isset($specs['type'])): ?>
                            <div class="prod-type"><?= htmlspecialchars($specs['type']) ?></div>
                        <?php endif; ?>
                        
                        <p class="prod-desc"><?= htmlspecialchars($tire['description']) ?></p>
                        
                        <!-- Tire Specifications - Sizes -->
                        <?php if ($specs && isset($specs['sizes']) && !empty($specs['sizes'])): ?>
                        <div class="prod-specs">
                            <?php foreach ($specs['sizes'] as $spec): ?>
                                <span class="spec-badge"><?= htmlspecialchars($spec) ?></span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Shopee and Lazada Links (styled like footer) -->
                        <div class="marketplace-links">
                            <a href="<?= $shopeeLink ?>" class="marketplace-btn shopee-btn" target="_blank" rel="noopener noreferrer" onclick="event.stopPropagation();" title="Buy on Shopee">
                                <i class="bi bi-bag"></i> Shopee
                            </a>
                            <a href="<?= $lazadaLink ?>" class="marketplace-btn lazada-btn" target="_blank" rel="noopener noreferrer" onclick="event.stopPropagation();" title="Buy on Lazada">
                                <i class="bi bi-bag"></i> Lazada
                            </a>
                        </div>
                        
                        <div class="prod-footer">
                            <div class="prod-cat-label">
                                <span class="prod-cat-dot"></span>
                                <?= $catAccentLabels[$catKey] ?>
                            </div>
                            <div class="prod-cta">
                                <button class="btn-wish-sm" aria-label="Wishlist" onclick="this.classList.toggle('wished')">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                    </svg>
                                </button>
                                <button class="btn-view" aria-label="View details" onclick="viewProductDetails(this)">+</button>
                            </div>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
            </div><!-- /product-grid -->
        </div><!-- /group-block -->

        <?php endforeach; ?>

    </main>
</div>

<!-- Lightbox Modal -->
<div id="lightboxModal" class="lightbox-modal">
    <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
    <span class="lightbox-nav lightbox-prev" onclick="changeImage(-1)">&#10094;</span>
    <span class="lightbox-nav lightbox-next" onclick="changeImage(1)">&#10095;</span>
    <div class="lightbox-content">
        <span class="lightbox-counter" id="lightboxCounter"></span>
        <div class="lightbox-image-container">
            <img id="lightboxImage" src="" alt="Product view">
        </div>
        <div class="lightbox-caption" id="lightboxCaption"></div>
    </div>
</div>

<script>
(function() {
'use strict';

/* ── Lightbox functionality ── */
let currentImageIndex = 0;
let allImages = [];

// Collect all product images data
function refreshImageCollection() {
    allImages = [];
    document.querySelectorAll('.prod-card').forEach(card => {
        if (card.closest('.group-block') && !card.closest('.group-block').classList.contains('hidden')) {
            const imgWrap = card.querySelector('.prod-img-wrap');
            const img = imgWrap.querySelector('img');
            const name = card.dataset.name;
            const code = card.dataset.code;
            const category = card.dataset.category;
            
            if (img && img.src) {
                allImages.push({
                    src: img.src,
                    name: name,
                    code: code,
                    category: category
                });
            }
        }
    });
}

// Make openLightbox globally available
window.openLightbox = function(element) {
    const card = element.closest('.prod-card');
    if (!card) return;
    
    refreshImageCollection();
    
    // Find index of current image
    const imgSrc = card.querySelector('img').src;
    currentImageIndex = allImages.findIndex(img => img.src === imgSrc);
    
    if (currentImageIndex === -1) currentImageIndex = 0;
    
    updateLightboxImage();
    document.getElementById('lightboxModal').style.display = 'block';
    document.body.style.overflow = 'hidden'; // Prevent scrolling
}

// Make closeLightbox globally available
window.closeLightbox = function() {
    document.getElementById('lightboxModal').style.display = 'none';
    document.body.style.overflow = ''; // Restore scrolling
}

// Make changeImage globally available
window.changeImage = function(direction) {
    currentImageIndex += direction;
    
    if (currentImageIndex < 0) {
        currentImageIndex = allImages.length - 1;
    } else if (currentImageIndex >= allImages.length) {
        currentImageIndex = 0;
    }
    
    updateLightboxImage();
}

function updateLightboxImage() {
    if (allImages.length === 0) return;
    
    const image = allImages[currentImageIndex];
    const lightboxImg = document.getElementById('lightboxImage');
    const caption = document.getElementById('lightboxCaption');
    const counter = document.getElementById('lightboxCounter');
    
    lightboxImg.src = image.src;
    lightboxImg.alt = image.name;
    
    caption.innerHTML = `
        ${image.name} 
        <small>${image.category} ${image.code ? '· Code: ' + image.code : ''}</small>
    `;
    
    counter.textContent = `${currentImageIndex + 1} / ${allImages.length}`;
}

// Close lightbox with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeLightbox();
    } else if (e.key === 'ArrowLeft') {
        changeImage(-1);
    } else if (e.key === 'ArrowRight') {
        changeImage(1);
    }
});

// Close lightbox when clicking outside the image
document.getElementById('lightboxModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeLightbox();
    }
});

// Prevent marketplace button clicks from triggering card click
document.querySelectorAll('.marketplace-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
    });
});

/* ── Checkbox toggles (decorative) ── */
document.querySelectorAll('.check-row').forEach(row => {
    row.addEventListener('click', () => row.classList.toggle('checked'));
});

/* ── View toggle ── */
const btnGrid = document.getElementById('btnGrid');
const btnList = document.getElementById('btnList');
const grids   = document.querySelectorAll('.product-grid');

btnGrid.addEventListener('click', () => {
    grids.forEach(g => g.classList.remove('list-view'));
    btnGrid.classList.add('active'); btnGrid.setAttribute('aria-pressed','true');
    btnList.classList.remove('active'); btnList.setAttribute('aria-pressed','false');
});
btnList.addEventListener('click', () => {
    grids.forEach(g => g.classList.add('list-view'));
    btnList.classList.add('active'); btnList.setAttribute('aria-pressed','true');
    btnGrid.classList.remove('active'); btnGrid.setAttribute('aria-pressed','false');
});

/* ── Filter logic ── */
const catCounts = <?= json_encode(array_map('count', $allTires)) ?>;
const totalAll  = <?= $totalAll ?>;

const filterRows  = document.querySelectorAll('.filter-row');
const catPills    = document.querySelectorAll('.cat-pill');
const groupBlocks = document.querySelectorAll('.group-block');
const sideCount   = document.getElementById('sideCount');
const toolbarCount= document.getElementById('toolbarCount');
const resetBtn    = document.getElementById('resetFilter');

function applyFilter(filter) {
    let shown = 0;

    groupBlocks.forEach(block => {
        const grp  = block.dataset.group;
        const show = filter === 'all' || grp === filter;
        block.classList.toggle('hidden', !show);
        if (show) {
            shown += (catCounts[grp] || 0);
            /* Re-trigger card animations */
            block.querySelectorAll('.prod-card').forEach((c, i) => {
                c.style.animation = 'none';
                void c.offsetWidth;
                c.style.animation = '';
                c.style.animationDelay = (i % 4 * 0.07) + 's';
                c.style.animationPlayState = 'running';
            });
        }
    });

    sideCount.textContent   = shown;
    toolbarCount.textContent = shown;

    /* Sync sidebar rows */
    filterRows.forEach(r => r.classList.toggle('active', r.dataset.filter === filter));
    /* Sync top pills */
    catPills.forEach(p => p.classList.toggle('active', p.dataset.cat === filter));
    
    // Refresh lightbox image collection when filter changes
    refreshImageCollection();
}

filterRows.forEach(row =>
    row.addEventListener('click', () => applyFilter(row.dataset.filter))
);
catPills.forEach(pill =>
    pill.addEventListener('click', () => {
        applyFilter(pill.dataset.cat);
        document.querySelector('.shop-layout').scrollIntoView({ behavior: 'smooth', block: 'start' });
    })
);
resetBtn.addEventListener('click', e => { e.preventDefault(); applyFilter('all'); });

/* ── Sorting functionality ── */
const sortSelect = document.getElementById('sortSelect');
const groupBlocksArray = Array.from(document.querySelectorAll('.group-block'));

function sortProducts(sortBy) {
    groupBlocksArray.forEach(groupBlock => {
        const grid = groupBlock.querySelector('.product-grid');
        const cards = Array.from(grid.querySelectorAll('.prod-card'));
        
        // Store current filter state
        const isVisible = !groupBlock.classList.contains('hidden');
        if (!isVisible) return; // Don't sort hidden groups
        
        // Sort the cards
        cards.sort((a, b) => {
            const nameA = a.querySelector('.prod-name').textContent.trim();
            const nameB = b.querySelector('.prod-name').textContent.trim();
            const codeA = a.querySelector('.prod-code')?.textContent.trim() || '';
            const codeB = b.querySelector('.prod-code')?.textContent.trim() || '';
            
            switch(sortBy) {
                case 'name-asc':
                    return nameA.localeCompare(nameB);
                case 'name-desc':
                    return nameB.localeCompare(nameA);
                case 'code':
                    return codeA.localeCompare(codeB);
                default: // 'default' - maintain original order
                    return 0;
            }
        });
        
        // Re-append cards in new order
        cards.forEach(card => grid.appendChild(card));
        
        // Reset animation delays
        cards.forEach((card, i) => {
            card.style.animation = 'none';
            void card.offsetWidth;
            card.style.animation = '';
            card.style.animationDelay = (i % 4 * 0.07) + 's';
            card.style.animationPlayState = 'running';
        });
    });
    
    // Refresh lightbox image collection after sorting
    refreshImageCollection();
}

sortSelect.addEventListener('change', (e) => {
    sortProducts(e.target.value);
});

/* ── View product details (expand image) ── */
window.viewProductDetails = function(button) {
    const card = button.closest('.prod-card');
    if (card) {
        const imgWrap = card.querySelector('.prod-img-wrap');
        openLightbox(imgWrap);
    }
};

/* ── IntersectionObserver for scroll-reveal & card animations ── */
const io = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const el = entry.target;
            if (el.classList.contains('reveal')) {
                el.classList.add('visible');
            }
            if (el.classList.contains('prod-card')) {
                el.style.animationPlayState = 'running';
            }
            io.unobserve(el);
        }
    });
}, { threshold: 0.06 });

document.querySelectorAll('.reveal').forEach(el => io.observe(el));
document.querySelectorAll('.prod-card').forEach(el => io.observe(el));

/* ── Stat counter animation ── */
document.querySelectorAll('.stat-num').forEach(el => {
    const target = parseInt(el.textContent, 10);
    if (isNaN(target)) return;
    el.textContent = '0';
    const ioStat = new IntersectionObserver(entries => {
        if (!entries[0].isIntersecting) return;
        ioStat.disconnect();
        let start = 0;
        const dur = 900, step = 16;
        const timer = setInterval(() => {
            start += step;
            el.textContent = Math.min(Math.round(target * start / dur), target);
            if (start >= dur) clearInterval(timer);
        }, step);
    }, { threshold: 0.5 });
    ioStat.observe(el);
});

/* ── Subtle card cursor parallax ── */
document.querySelectorAll('.prod-card').forEach(card => {
    card.addEventListener('mousemove', e => {
        const r  = card.getBoundingClientRect();
        const cx = (e.clientX - r.left) / r.width  - 0.5;
        const cy = (e.clientY - r.top)  / r.height - 0.5;
        const img = card.querySelector('.prod-img-wrap img');
        if (img) {
            img.style.transform = `scale(1.06) translate(${cx * 8}px, ${cy * 5 - 4}px)`;
        }
    });
    card.addEventListener('mouseleave', () => {
        const img = card.querySelector('.prod-img-wrap img');
        if (img) {
            img.style.transform = '';
        }
    });
});

// Initialize image collection
refreshImageCollection();

})();
</script>

<?php include 'footer.php'; ?>