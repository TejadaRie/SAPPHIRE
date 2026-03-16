<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sapphire Tire Footer</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">

<style>
/* ===== ANIMATED SAPPHIRE TIRE FOOTER ===== */

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

/* Keyframes */
@keyframes floatTire {
  0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.04; }
  50% { transform: translateY(-20px) rotate(180deg); opacity: 0.07; }
}

@keyframes shimmer {
  0% { background-position: -200% center; }
  100% { background-position: 200% center; }
}

@keyframes pulseGlow {
  0%, 100% { box-shadow: 0 0 8px rgba(96, 165, 250, 0.3); }
  50% { box-shadow: 0 0 20px rgba(96, 165, 250, 0.7), 0 0 40px rgba(96, 165, 250, 0.3); }
}

@keyframes roadMove {
  0% { background-position: 0 0; }
  100% { background-position: 60px 0; }
}

@keyframes fadeSlideUp {
  0% { opacity: 0; transform: translateY(30px); }
  100% { opacity: 1; transform: translateY(0); }
}

@keyframes borderSweep {
  0% { width: 0; }
  100% { width: 100%; }
}

@keyframes iconBounce {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.2); }
}

@keyframes rotateTireIcon {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

@keyframes sparkle {
  0%, 100% { opacity: 0; transform: scale(0); }
  50% { opacity: 1; transform: scale(1); }
}

@keyframes gradientShift {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

@keyframes countUp {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

/* Footer base */
.footer {
  position: relative;
  background: linear-gradient(135deg, #060c18 0%, #0d1f3c 50%, #0a1628 100%);
  color: #fff;
  overflow: hidden;
  border-top: 1px solid rgba(59, 130, 246, 0.4);
  z-index: 1;
  padding: 2.5rem 0 1.2rem;
}

/* Animated background mesh */
.footer-mesh {
  position: absolute;
  inset: 0;
  background:
    radial-gradient(ellipse 60% 50% at 20% 80%, rgba(59, 130, 246, 0.12) 0%, transparent 70%),
    radial-gradient(ellipse 40% 40% at 80% 20%, rgba(99, 102, 241, 0.08) 0%, transparent 60%),
    radial-gradient(ellipse 30% 30% at 60% 60%, rgba(14, 165, 233, 0.06) 0%, transparent 60%);
  z-index: 0;
  pointer-events: none;
}

/* Floating tire circles */
.tire-float {
  position: absolute;
  border-radius: 50%;
  border: 3px solid rgba(96, 165, 250, 1);
  pointer-events: none;
  z-index: 0;
}

.tire-float::before {
  content: '';
  position: absolute;
  inset: 20%;
  border-radius: 50%;
  border: 2px solid rgba(96, 165, 250, 0.5);
  background: radial-gradient(circle, rgba(96, 165, 250, 0.1) 30%, transparent 70%);
}

.tire-float::after {
  content: '';
  position: absolute;
  inset: 42%;
  border-radius: 50%;
  background: rgba(96, 165, 250, 0.6);
}

.tire-1 { width: 120px; height: 120px; top: 10%; left: 5%; animation: floatTire 8s ease-in-out infinite; }
.tire-2 { width: 80px; height: 80px; top: 50%; right: 8%; animation: floatTire 10s ease-in-out infinite 2s; }
.tire-3 { width: 60px; height: 60px; bottom: 20%; left: 30%; animation: floatTire 12s ease-in-out infinite 4s; }
.tire-4 { width: 100px; height: 100px; top: 30%; left: 65%; animation: floatTire 9s ease-in-out infinite 1s; }

/* Container above bg */
.footer .container { position: relative; z-index: 2; }

/* Animated border reveal on load */
.footer-section {
  opacity: 0;
  animation: fadeSlideUp 0.7s ease forwards;
}
.footer-section:nth-child(1) { animation-delay: 0.1s; }
.footer-section:nth-child(2) { animation-delay: 0.2s; }
.footer-section:nth-child(3) { animation-delay: 0.3s; }
.footer-section:nth-child(4) { animation-delay: 0.4s; }

/* Brand */
.brand-sapphire {
  font-family: 'Montserrat', sans-serif;
  font-size: 1.8rem;
  font-weight: 900;
  letter-spacing: 2px;
  background: linear-gradient(90deg, #60a5fa, #93c5fd, #3b82f6, #60a5fa);
  background-size: 300% auto;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  animation: shimmer 3s linear infinite;
  display: inline-block;
}

.tagline {
  font-family: 'Montserrat', sans-serif;
  font-size: 0.75rem;
  letter-spacing: 3px;
  text-transform: uppercase;
  color: rgba(148, 163, 184, 0.7);
}

.footer-desc {
  font-family: 'Inter', sans-serif;
  font-size: 0.875rem;
  color: rgba(203, 213, 225, 0.75);
  line-height: 1.6;
  margin-top: 0.5rem;
}

/* Social links */
.social-links { display: flex; gap: 0.75rem; margin-top: 0.85rem; flex-wrap: wrap; }

.social-btn {
  display: inline-flex;
  align-items: center;
  gap: 0.4rem;
  padding: 0.4rem 0.9rem;
  border: 1px solid rgba(96, 165, 250, 0.3);
  border-radius: 20px;
  color: rgba(255,255,255,0.75);
  text-decoration: none;
  font-family: 'Inter', sans-serif;
  font-size: 0.8rem;
  font-weight: 500;
  transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
  position: relative;
  overflow: hidden;
}

.social-btn::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(99, 102, 241, 0.2));
  opacity: 0;
  transition: opacity 0.3s ease;
}

.social-btn:hover {
  color: #fff;
  border-color: #60a5fa;
  transform: translateY(-3px) scale(1.05);
  box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
}

.social-btn:hover::before { opacity: 1; }

/* Headings */
.footer-heading {
  font-family: 'Montserrat', sans-serif;
  font-size: 0.85rem;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: #fff;
  margin-bottom: 0.85rem;
  position: relative;
  padding-bottom: 0.6rem;
}

.footer-heading::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  height: 2px;
  background: linear-gradient(90deg, #3b82f6, transparent);
  width: 0;
  animation: borderSweep 1s ease forwards 0.6s;
}

/* Nav links */
.footer-nav { list-style: none; padding: 0; }

.footer-nav li { margin-bottom: 0.6rem; }

.footer-nav a {
  font-family: 'Inter', sans-serif;
  font-size: 0.875rem;
  color: rgba(148, 163, 184, 0.8);
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  transition: all 0.25s ease;
  position: relative;
}

.footer-nav a::before {
  content: '→';
  font-size: 0.7rem;
  opacity: 0;
  transform: translateX(-8px);
  transition: all 0.25s ease;
  color: #60a5fa;
}

.footer-nav a:hover {
  color: #93c5fd;
  transform: translateX(6px);
}

.footer-nav a:hover::before {
  opacity: 1;
  transform: translateX(0);
}

/* Google Map */
.map-wrap {
  background: rgba(255,255,255,0.03);
  border: 1px solid rgba(96, 165, 250, 0.15);
  border-radius: 12px;
  padding: 0;
  margin-bottom: 0.75rem;
  overflow: hidden;
  transition: border-color 0.3s ease;
}

.map-wrap:hover { border-color: rgba(96, 165, 250, 0.45); box-shadow: 0 0 20px rgba(59,130,246,0.15); }

.map-wrap iframe {
  width: 100%;
  height: 160px;
  border: none;
  display: block;
  border-radius: 12px;
  filter: brightness(0.9) saturate(1.1);
}

.map-label {
  padding: 0.6rem 1rem;
  font-family: 'Inter', sans-serif;
  font-size: 0.78rem;
  color: rgba(148, 163, 184, 0.75);
  display: flex;
  align-items: center;
  gap: 0.4rem;
  border-top: 1px solid rgba(96, 165, 250, 0.1);
}

.map-label i { color: #60a5fa; font-size: 0.85rem; }

/* Contact info */
.contact-item {
  display: flex;
  align-items: flex-start;
  gap: 0.6rem;
  margin-bottom: 0.5rem;
  font-family: 'Inter', sans-serif;
  font-size: 0.82rem;
  color: rgba(203, 213, 225, 0.8);
}

.contact-icon {
  width: 30px;
  height: 30px;
  background: rgba(59, 130, 246, 0.15);
  border: 1px solid rgba(59, 130, 246, 0.3);
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #60a5fa;
  font-size: 0.85rem;
  flex-shrink: 0;
  transition: all 0.3s ease;
  animation: pulseGlow 3s ease-in-out infinite;
}

.contact-item:hover .contact-icon {
  background: rgba(59, 130, 246, 0.3);
  transform: scale(1.1) rotate(5deg);
}

/* Stats bar */
.stats-bar {
  display: flex;
  gap: 1.5rem;
  margin-top: 0.75rem;
  flex-wrap: wrap;
}

.stat-item {
  text-align: center;
}

.stat-num {
  font-family: 'Montserrat', sans-serif;
  font-size: 1.2rem;
  font-weight: 800;
  color: #60a5fa;
  display: block;
  animation: countUp 0.6s ease forwards;
}

.stat-label {
  font-family: 'Inter', sans-serif;
  font-size: 0.65rem;
  color: rgba(148, 163, 184, 0.6);
  letter-spacing: 1px;
  text-transform: uppercase;
}

/* Divider */
.footer-divider {
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(96, 165, 250, 0.3) 30%, rgba(96, 165, 250, 0.3) 70%, transparent);
  margin: 1.5rem 0 1rem;
  position: relative;
  overflow: visible;
}

.footer-divider::after {
  content: '';
  position: absolute;
  top: -2px;
  left: 50%;
  transform: translateX(-50%);
  width: 60px;
  height: 5px;
  background: linear-gradient(90deg, #3b82f6, #60a5fa);
  border-radius: 3px;
  animation: shimmer 2s linear infinite;
  background-size: 200% auto;
}

/* Copyright */
.copyright {
  text-align: center;
  font-family: 'Inter', sans-serif;
  font-size: 0.8rem;
  color: rgba(148, 163, 184, 0.5);
}

.copyright span {
  color: #60a5fa;
  font-weight: 600;
}

/* Scroll-to-top button */
.scroll-top-btn {
  position: absolute;
  right: 1.5rem;
  bottom: 2rem;
  width: 42px;
  height: 42px;
  background: linear-gradient(135deg, #3b82f6, #2563eb);
  border: none;
  border-radius: 50%;
  color: #fff;
  font-size: 1rem;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
  animation: pulseGlow 2s ease-in-out infinite;
  z-index: 10;
}

.scroll-top-btn:hover {
  transform: translateY(-4px) scale(1.1);
  box-shadow: 0 12px 24px rgba(59, 130, 246, 0.5);
}

/* Tire spin on hover - removed as requested */

@media (max-width: 768px) {
  .footer { text-align: center; }
  .footer-heading::after { left: 50%; transform: translateX(-50%); }
  .social-links { justify-content: center; }
  .contact-item { justify-content: center; }
  .stats-bar { justify-content: center; }
  .footer-nav a::before { display: none; }
  .footer-nav a:hover { transform: none; }
}
</style>
</head>
<body style="background:#000">

<footer class="footer" id="mainFooter">

  <!-- Floating tire decorations -->
  <div class="tire-float tire-1"></div>
  <div class="tire-float tire-2"></div>
  <div class="tire-float tire-3"></div>
  <div class="tire-float tire-4"></div>
  <div class="footer-mesh"></div>

  <div class="container">
    <div class="row gy-3">

      <!-- Brand & Description -->
      <div class="col-lg-4 footer-section">
        <!-- Removed the spinning ball icon here -->
        <h4 class="brand-sapphire">SAPPHIRE TIRE</h4>
        <p class="tagline">Kasama mo sa Hanapbuhay</p>
        <p class="footer-desc">Sapphire Tire is committed to delivering high-quality, durable, and reliable tires designed for everyday riders and professionals.</p>

        <div class="stats-bar">
          <div class="stat-item">
            <span class="stat-num">25+</span>
            <span class="stat-label">Years</span>
          </div>
          <div class="stat-item">
            <span class="stat-num">500K+</span>
            <span class="stat-label">Riders</span>
          </div>
          <div class="stat-item">
            <span class="stat-num">1000+</span>
            <span class="stat-label">Dealers</span>
          </div>
        </div>

        <div class="social-links">
          <a href="https://facebook.com/sapphiretire" target="_blank" rel="noopener" class="social-btn"><i class="bi bi-facebook"></i> Facebook</a>
          <a href="https://shopee.ph/sapphiretire" target="_blank" rel="noopener" class="social-btn"><i class="bi bi-shop"></i> Shopee</a>
          <a href="https://lazada.com.ph/shop/sapphiretire" target="_blank" rel="noopener" class="social-btn"><i class="bi bi-bag-fill"></i> Lazada</a>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="col-lg-3 footer-section">
        <h5 class="footer-heading">Quick Links</h5>
        <ul class="footer-nav">
          <li><a href="index.php">Home</a></li>
          <li><a href="product.php">Products</a></li>
          <li><a href="events.php">Events</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="kitakm.php">KITAKM</a></li>
        </ul>
      </div>

      <!-- Find Us / Google Map -->
      <div class="col-lg-5 footer-section">
        <h5 class="footer-heading">Find Us</h5>

        <div class="map-wrap">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3869.8!2d121.0515!3d14.3132!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d6b3d2b2e2b3%3A0xd7a1234567890abc!2sNew%20World%20Rubber%20Corporation%2C%20Carmona%2C%20Cavite!5e0!3m2!1sen!2sph!4v1"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="Sapphire Tire – New World Rubber Corporation, Carmona, Cavite">
          </iframe>
          <div class="map-label">
            <i class="bi bi-geo-alt-fill"></i>
            New World Rubber Corp., Carmona, Cavite
          </div>
        </div>

        <div class="mt-1">
          <div class="contact-item">
            <span class="contact-icon"><i class="bi bi-geo-alt-fill"></i></span>
            <span>New World Rubber Corporation, Carmona, Cavite</span>
          </div>
          <div class="contact-item">
            <span class="contact-icon"><i class="bi bi-telephone-fill"></i></span>
            <span>+63 912 345 6789</span>
          </div>
          <div class="contact-item">
            <span class="contact-icon"><i class="bi bi-envelope-fill"></i></span>
            <span><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="60090e060f201301101008091205140912054e030f0d">[email&#160;protected]</a></span>
          </div>
        </div>
      </div>

    </div>

    <!-- Divider -->
    <div class="footer-divider"></div>

    <!-- Copyright -->
    <div class="row position-relative">
      <div class="col copyright">
        <p class="mb-1">© <span id="yearDisplay"></span> <span>SAPPHIRE TIRE</span>. All Rights Reserved.</p>
        <p style="font-size:0.72rem; color:rgba(148,163,184,0.4)">This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.</p>
      </div>
      <button class="scroll-top-btn" onclick="window.scrollTo({top:0,behavior:'smooth'})" title="Back to top">
        <i class="bi bi-chevron-up"></i>
      </button>
    </div>

  </div>
</footer>

<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Year
document.getElementById('yearDisplay').textContent = new Date().getFullYear();

// Intersection observer for staggered animations
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.style.animationPlayState = 'running';
    }
  });
}, { threshold: 0.1 });

document.querySelectorAll('.footer-section').forEach(el => {
  el.style.animationPlayState = 'paused';
  observer.observe(el);
});

// Contact icons staggered pulse reset
</script>

</body>
</html>