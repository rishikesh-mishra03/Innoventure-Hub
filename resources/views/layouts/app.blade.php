<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'InnoVenture Hub') - Connect Startups & Corporates</title>
<meta name="description" content="@yield('meta_description', 'InnoVenture Hub - AI-powered platform connecting startups with corporates for partnerships, investments, and innovation.')">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root {
  --primary: #6366f1;
  --primary-dark: #4f46e5;
  --secondary: #a855f7;
  --accent: #06b6d4;
  --success: #10b981;
  --warning: #f59e0b;
  --danger: #ef4444;
  --dark: #0f0f23;
  --dark-2: #1a1a3e;
  --dark-3: #252552;
  --card: rgba(255,255,255,0.05);
  --card-border: rgba(255,255,255,0.1);
  --text: #e2e8f0;
  --text-muted: #94a3b8;
  --gradient: linear-gradient(135deg, #6366f1, #a855f7, #06b6d4);
}
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Inter',sans-serif;background:var(--dark);color:var(--text);min-height:100vh;overflow-x:hidden;}
body::before{content:'';position:fixed;top:0;left:0;width:100%;height:100%;background:radial-gradient(ellipse at 20% 50%,rgba(99,102,241,0.15) 0%,transparent 50%),radial-gradient(ellipse at 80% 20%,rgba(168,85,247,0.1) 0%,transparent 50%),radial-gradient(ellipse at 50% 80%,rgba(6,182,212,0.08) 0%,transparent 50%);pointer-events:none;z-index:0;}

/* NAVBAR */
nav{position:fixed;top:0;left:0;right:0;z-index:1000;padding:1rem 2rem;display:flex;align-items:center;justify-content:space-between;backdrop-filter:blur(20px);background:rgba(15,15,35,0.8);border-bottom:1px solid var(--card-border);transition:all .3s;}
.nav-brand{display:flex;align-items:center;gap:.75rem;text-decoration:none;}
.nav-logo{width:40px;height:40px;background:var(--gradient);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;color:#fff;}
.nav-brand-text{font-family:'Outfit',sans-serif;font-size:1.3rem;font-weight:800;background:var(--gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;}
.nav-links{display:flex;align-items:center;gap:1.5rem;}
.nav-links a{color:var(--text-muted);text-decoration:none;font-size:.9rem;font-weight:500;transition:color .2s;position:relative;}
.nav-links a:hover,.nav-links a.active{color:#fff;}
.nav-links a.active::after{content:'';position:absolute;bottom:-4px;left:0;right:0;height:2px;background:var(--gradient);border-radius:2px;}
.btn{display:inline-flex;align-items:center;gap:.5rem;padding:.6rem 1.4rem;border-radius:10px;font-size:.875rem;font-weight:600;text-decoration:none;border:none;cursor:pointer;transition:all .3s;}
.btn-primary{background:var(--gradient);color:#fff;}
.btn-primary:hover{transform:translateY(-2px);box-shadow:0 8px 25px rgba(99,102,241,.4);}
.btn-outline{background:transparent;color:var(--text);border:1px solid var(--card-border);}
.btn-outline:hover{background:var(--card);border-color:var(--primary);}
.btn-sm{padding:.4rem 1rem;font-size:.8rem;}
.btn-success{background:linear-gradient(135deg,#10b981,#059669);color:#fff;}
.btn-success:hover{transform:translateY(-2px);box-shadow:0 8px 25px rgba(16,185,129,.4);}
.btn-danger{background:linear-gradient(135deg,#ef4444,#dc2626);color:#fff;}
.nav-avatar{width:36px;height:36px;border-radius:50%;background:var(--gradient);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9rem;cursor:pointer;}
.dropdown{position:relative;}
.dropdown-menu{position:absolute;right:0;top:calc(100% + 10px);background:var(--dark-2);border:1px solid var(--card-border);border-radius:12px;padding:.5rem;min-width:200px;display:none;backdrop-filter:blur(20px);}
.dropdown:hover .dropdown-menu{display:block;}
.dropdown-menu a,.dropdown-menu button{display:flex;align-items:center;gap:.75rem;padding:.6rem 1rem;border-radius:8px;color:var(--text);text-decoration:none;font-size:.875rem;background:none;border:none;width:100%;cursor:pointer;transition:background .2s;}
.dropdown-menu a:hover,.dropdown-menu button:hover{background:var(--card);}
.hamburger{display:none;flex-direction:column;gap:5px;cursor:pointer;padding:.5rem;}
.hamburger span{width:24px;height:2px;background:var(--text);border-radius:2px;transition:all .3s;}

/* MAIN */
main{padding-top:80px;position:relative;z-index:1;}
.container{max-width:1280px;margin:0 auto;padding:0 1.5rem;}

/* CARDS */
.card{background:var(--card);border:1px solid var(--card-border);border-radius:16px;padding:1.5rem;backdrop-filter:blur(10px);transition:all .3s;}
.card:hover{border-color:var(--primary);transform:translateY(-2px);box-shadow:0 20px 40px rgba(0,0,0,.3);}
.card-glow{box-shadow:0 0 30px rgba(99,102,241,.1);}

/* BADGES */
.badge{display:inline-flex;align-items:center;gap:.3rem;padding:.25rem .75rem;border-radius:20px;font-size:.75rem;font-weight:600;}
.badge-primary{background:rgba(99,102,241,.2);color:#a5b4fc;}
.badge-success{background:rgba(16,185,129,.2);color:#6ee7b7;}
.badge-warning{background:rgba(245,158,11,.2);color:#fde68a;}
.badge-danger{background:rgba(239,68,68,.2);color:#fca5a5;}
.badge-purple{background:rgba(168,85,247,.2);color:#d8b4fe;}
.badge-cyan{background:rgba(6,182,212,.2);color:#a5f3fc;}

/* ALERTS */
.alert{padding:1rem 1.5rem;border-radius:12px;margin-bottom:1.5rem;display:flex;align-items:center;gap:.75rem;}
.alert-success{background:rgba(16,185,129,.15);border:1px solid rgba(16,185,129,.3);color:#6ee7b7;}
.alert-error{background:rgba(239,68,68,.15);border:1px solid rgba(239,68,68,.3);color:#fca5a5;}
.alert-info{background:rgba(99,102,241,.15);border:1px solid rgba(99,102,241,.3);color:#a5b4fc;}

/* FORMS */
.form-group{margin-bottom:1.25rem;}
label{display:block;margin-bottom:.5rem;font-size:.875rem;font-weight:500;color:var(--text-muted);}
input,textarea,select{width:100%;padding:.75rem 1rem;background:rgba(255,255,255,.05);border:1px solid var(--card-border);border-radius:10px;color:var(--text);font-family:'Inter',sans-serif;font-size:.9rem;transition:all .3s;outline:none;}
input:focus,textarea:focus,select:focus{border-color:var(--primary);background:rgba(99,102,241,.05);box-shadow:0 0 0 3px rgba(99,102,241,.15);}
input::placeholder,textarea::placeholder{color:var(--text-muted);}
select option{background:var(--dark-2);}
textarea{resize:vertical;min-height:100px;}

/* SECTION HEADERS */
.section-title{font-family:'Outfit',sans-serif;font-size:2.5rem;font-weight:800;margin-bottom:.75rem;}
.section-subtitle{color:var(--text-muted);font-size:1.1rem;margin-bottom:3rem;}
.gradient-text{background:var(--gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;}

/* STATS */
.stat-card{background:var(--card);border:1px solid var(--card-border);border-radius:16px;padding:1.5rem;text-align:center;backdrop-filter:blur(10px);}
.stat-value{font-family:'Outfit',sans-serif;font-size:2rem;font-weight:800;background:var(--gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;}
.stat-label{color:var(--text-muted);font-size:.85rem;margin-top:.25rem;}

/* GRID */
.grid-2{display:grid;grid-template-columns:repeat(2,1fr);gap:1.5rem;}
.grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;}
.grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem;}

/* TAGS */
.tag{display:inline-block;padding:.2rem .6rem;background:rgba(255,255,255,.08);border:1px solid var(--card-border);border-radius:6px;font-size:.75rem;color:var(--text-muted);margin:.15rem;}

/* PROGRESS */
.progress{background:rgba(255,255,255,.1);border-radius:10px;height:8px;overflow:hidden;}
.progress-bar{height:100%;border-radius:10px;background:var(--gradient);transition:width .8s ease;}

/* SIDEBAR LAYOUT */
.sidebar-layout{display:grid;grid-template-columns:260px 1fr;gap:2rem;align-items:start;}
.sidebar{background:var(--card);border:1px solid var(--card-border);border-radius:16px;padding:1.5rem;position:sticky;top:100px;}
.sidebar-link{display:flex;align-items:center;gap:.75rem;padding:.75rem 1rem;border-radius:10px;color:var(--text-muted);text-decoration:none;font-size:.875rem;font-weight:500;transition:all .2s;margin-bottom:.25rem;}
.sidebar-link:hover,.sidebar-link.active{background:rgba(99,102,241,.15);color:var(--text);border-left:3px solid var(--primary);}
.sidebar-link i{width:18px;text-align:center;}

/* FOOTER */
footer{background:var(--dark-2);border-top:1px solid var(--card-border);padding:3rem 2rem 1.5rem;margin-top:5rem;position:relative;z-index:1;}
.footer-grid{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:3rem;margin-bottom:2rem;}
.footer-brand-text{color:var(--text-muted);font-size:.875rem;line-height:1.6;margin:.75rem 0 1rem;}
.footer-socials{display:flex;gap:.75rem;}
.footer-social{width:36px;height:36px;background:var(--card);border:1px solid var(--card-border);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--text-muted);text-decoration:none;transition:all .3s;}
.footer-social:hover{background:var(--primary);color:#fff;border-color:var(--primary);}
.footer-title{font-weight:700;margin-bottom:1rem;color:#fff;}
.footer-links{list-style:none;}
.footer-links li{margin-bottom:.5rem;}
.footer-links a{color:var(--text-muted);text-decoration:none;font-size:.875rem;transition:color .2s;}
.footer-links a:hover{color:var(--primary);}
.footer-bottom{border-top:1px solid var(--card-border);padding-top:1.5rem;display:flex;justify-content:space-between;align-items:center;color:var(--text-muted);font-size:.8rem;}

/* ANIMATIONS */
@keyframes fadeInUp{from{opacity:0;transform:translateY(30px);}to{opacity:1;transform:translateY(0);}}
@keyframes float{0%,100%{transform:translateY(0);}50%{transform:translateY(-10px);}}
@keyframes pulse{0%,100%{opacity:1;}50%{opacity:.5;}}
@keyframes spin{from{transform:rotate(0deg);}to{transform:rotate(360deg);}}
@keyframes shimmer{0%{background-position:-200% 0;}100%{background-position:200% 0;}}
.animate-fadeInUp{animation:fadeInUp .6s ease forwards;}
.animate-float{animation:float 3s ease-in-out infinite;}
.animate-pulse{animation:pulse 2s ease-in-out infinite;}
.delay-1{animation-delay:.1s;}
.delay-2{animation-delay:.2s;}
.delay-3{animation-delay:.3s;}
.delay-4{animation-delay:.4s;}

/* MATCH SCORE RING */
.score-ring{width:80px;height:80px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.3rem;font-weight:800;background:conic-gradient(var(--primary) calc(var(--score) * 3.6deg),rgba(255,255,255,.1) 0deg);position:relative;}
.score-ring::before{content:'';position:absolute;width:64px;height:64px;border-radius:50%;background:var(--dark-2);}
.score-ring span{position:relative;z-index:1;}

/* RESPONSIVE */
@media(max-width:1024px){.grid-4{grid-template-columns:repeat(2,1fr);}.footer-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:768px){.nav-links,.nav-auth{display:none;}.hamburger{display:flex;}.grid-2,.grid-3,.grid-4{grid-template-columns:1fr;}.sidebar-layout{grid-template-columns:1fr;}.sidebar{position:static;}.section-title{font-size:1.8rem;}.footer-grid{grid-template-columns:1fr;}}
</style>
@yield('styles')
</head>
<body>
<nav id="navbar">
  <a href="{{ route('home') }}" class="nav-brand">
    <div class="nav-logo"><i class="fas fa-rocket"></i></div>
    <span class="nav-brand-text">InnoVenture Hub</span>
  </a>
  <div class="nav-links">
    <a href="{{ route('startups.index') }}" class="{{ request()->routeIs('startups.*') ? 'active' : '' }}">Startups</a>
    <a href="{{ route('corporates.index') }}" class="{{ request()->routeIs('corporates.*') ? 'active' : '' }}">Corporates</a>
    <a href="{{ route('opportunities.index') }}" class="{{ request()->routeIs('opportunities.*') ? 'active' : '' }}">Opportunities</a>
    <a href="{{ route('matchmaking') }}" class="{{ request()->routeIs('matchmaking') ? 'active' : '' }}">AI Match</a>
    <a href="{{ route('events') }}" class="{{ request()->routeIs('events') ? 'active' : '' }}">Events</a>
    <a href="{{ route('blog') }}" class="{{ request()->routeIs('blog') ? 'active' : '' }}">Blog</a>
  </div>
  <div style="display:flex;align-items:center;gap:1rem;">
    @auth
    <div class="dropdown">
      <div class="nav-avatar">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div>
      <div class="dropdown-menu">
        <a href="{{ route('dashboard') }}"><i class="fas fa-th-large"></i> Dashboard</a>
        @if(auth()->user()->role === 'startup')
        <a href="{{ route('startups.dashboard') }}"><i class="fas fa-rocket"></i> My Startup</a>
        @elseif(auth()->user()->role === 'corporate')
        <a href="{{ route('corporates.dashboard') }}"><i class="fas fa-building"></i> My Company</a>
        @endif
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('admin.index') }}" style="color:#ef4444;"><i class="fas fa-shield-alt"></i> Admin Panel</a>
        @endif
        <hr style="border-color:var(--card-border);margin:.5rem 0;">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
      </div>
    </div>
    @else
    <a href="{{ route('login') }}" class="btn btn-outline btn-sm">Login</a>
    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Get Started</a>
    @endauth
  </div>
  <div class="hamburger" onclick="toggleMobileMenu()">
    <span></span><span></span><span></span>
  </div>
</nav>

<main>
  @if(session('success'))
  <div style="position:fixed;top:90px;right:20px;z-index:2000;">
    <div class="alert alert-success" style="max-width:350px;box-shadow:0 10px 30px rgba(0,0,0,.3);">
      <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
  </div>
  @endif
  @if(session('error'))
  <div style="position:fixed;top:90px;right:20px;z-index:2000;">
    <div class="alert alert-error" style="max-width:350px;box-shadow:0 10px 30px rgba(0,0,0,.3);">
      <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
    </div>
  </div>
  @endif
  @yield('content')
</main>

<footer>
  <div class="container">
    <div class="footer-grid">
      <div>
        <a href="{{ route('home') }}" class="nav-brand" style="text-decoration:none;">
          <div class="nav-logo"><i class="fas fa-rocket"></i></div>
          <span class="nav-brand-text">InnoVenture Hub</span>
        </a>
        <p class="footer-brand-text">The AI-powered platform bridging startups and corporates for meaningful partnerships, investments, and innovation at scale.</p>
        <div class="footer-socials">
          <a href="#" class="footer-social"><i class="fab fa-linkedin"></i></a>
          <a href="#" class="footer-social"><i class="fab fa-twitter"></i></a>
          <a href="#" class="footer-social"><i class="fab fa-github"></i></a>
          <a href="#" class="footer-social"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
      <div>
        <p class="footer-title">Platform</p>
        <ul class="footer-links">
          <li><a href="{{ route('startups.index') }}">Browse Startups</a></li>
          <li><a href="{{ route('corporates.index') }}">Browse Corporates</a></li>
          <li><a href="{{ route('opportunities.index') }}">Opportunities</a></li>
          <li><a href="{{ route('matchmaking') }}">AI Matchmaking</a></li>
          <li><a href="{{ route('events') }}">Events</a></li>
        </ul>
      </div>
      <div>
        <p class="footer-title">Company</p>
        <ul class="footer-links">
          <li><a href="{{ route('about') }}">About Us</a></li>
          <li><a href="{{ route('how-it-works') }}">How It Works</a></li>
          <li><a href="{{ route('pricing') }}">Pricing</a></li>
          <li><a href="{{ route('blog') }}">Blog</a></li>
          <li><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
      </div>
      <div>
        <p class="footer-title">Legal</p>
        <ul class="footer-links">
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Terms of Service</a></li>
          <li><a href="#">Cookie Policy</a></li>
          <li><a href="#">GDPR</a></li>
          <li><a href="#">NDA Templates</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© 2024 InnoVenture Hub. All rights reserved.</span>
      <span>Made with <i class="fas fa-heart" style="color:#ef4444;"></i> for the innovation ecosystem</span>
    </div>
  </div>
</footer>

<script>
// Navbar scroll effect
window.addEventListener('scroll', () => {
  const nav = document.getElementById('navbar');
  if (window.scrollY > 50) {
    nav.style.background = 'rgba(15,15,35,0.95)';
  } else {
    nav.style.background = 'rgba(15,15,35,0.8)';
  }
});

// Auto-hide alerts
setTimeout(() => {
  document.querySelectorAll('.alert').forEach(a => {
    a.style.transition = 'opacity .5s';
    a.style.opacity = '0';
    setTimeout(() => a.remove(), 500);
  });
}, 4000);

function toggleMobileMenu() {
  const links = document.querySelector('.nav-links');
  links.style.display = links.style.display === 'flex' ? 'none' : 'flex';
  links.style.flexDirection = 'column';
  links.style.position = 'fixed';
  links.style.top = '70px';
  links.style.left = '0';
  links.style.right = '0';
  links.style.background = 'rgba(15,15,35,0.98)';
  links.style.padding = '2rem';
}

// Intersection Observer for animations
const observer = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) {
      e.target.classList.add('animate-fadeInUp');
    }
  });
}, { threshold: 0.1 });
document.querySelectorAll('.card,.stat-card,.section-title').forEach(el => observer.observe(el));
</script>
@yield('scripts')
</body>
</html>
