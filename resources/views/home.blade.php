@extends('layouts.app')
@section('title','InnoVenture Hub')
@section('content')
<!-- HERO -->
<section style="min-height:100vh;display:flex;align-items:center;padding:2rem 0;position:relative;overflow:hidden;">
  <!-- Animated BG particles -->
  <div id="particles" style="position:absolute;inset:0;pointer-events:none;z-index:0;"></div>
  <!-- Orbs -->
  <div style="position:absolute;top:15%;right:10%;width:400px;height:400px;background:radial-gradient(circle,rgba(99,102,241,.2),transparent 70%);border-radius:50%;animation:float 6s ease-in-out infinite;"></div>
  <div style="position:absolute;bottom:15%;left:5%;width:300px;height:300px;background:radial-gradient(circle,rgba(168,85,247,.15),transparent 70%);border-radius:50%;animation:float 8s ease-in-out infinite reverse;"></div>

  <div class="container" style="position:relative;z-index:1;">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;">
      <div>
        <div class="badge badge-primary animate-fadeInUp" style="margin-bottom:1.5rem;">
          <i class="fas fa-sparkles"></i> AI-Powered Innovation Platform
        </div>
        <h1 class="animate-fadeInUp delay-1" style="font-family:'Outfit',sans-serif;font-size:3.5rem;font-weight:900;line-height:1.1;margin-bottom:1.5rem;">
          Connect Startups<br>with <span class="gradient-text">Corporates</span><br>Fuel Innovation
        </h1>
        <p class="animate-fadeInUp delay-2" style="color:var(--text-muted);font-size:1.1rem;line-height:1.7;margin-bottom:2rem;">
          InnoVenture Hub uses AI to match innovative startups with forward-thinking corporates for partnerships, pilot programs, investments, and procurement — at unprecedented scale.
        </p>
        <div class="animate-fadeInUp delay-3" style="display:flex;gap:1rem;flex-wrap:wrap;margin-bottom:3rem;">
          <a href="{{ route('register') }}" class="btn btn-primary" style="font-size:1rem;padding:.8rem 2rem;">
            <i class="fas fa-rocket"></i> Get Started Free
          </a>
          <a href="{{ route('matchmaking') }}" class="btn btn-outline" style="font-size:1rem;padding:.8rem 2rem;">
            <i class="fas fa-magic"></i> Try AI Matchmaking
          </a>
        </div>
        <!-- Social proof -->
        <div class="animate-fadeInUp delay-4" style="display:flex;align-items:center;gap:2rem;">
          <div style="display:flex;">
            @foreach(['#6366f1','#a855f7','#06b6d4','#10b981','#f59e0b'] as $c)
            <div style="width:36px;height:36px;border-radius:50%;background:{{$c}};border:2px solid var(--dark);margin-left:-8px;display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:700;">{{ chr(rand(65,90)) }}</div>
            @endforeach
          </div>
          <div>
            <div style="font-weight:700;">12,400+ Members</div>
            <div style="color:var(--text-muted);font-size:.8rem;">Startups, Corporates & Investors</div>
          </div>
          <div style="color:var(--warning);">★★★★★ <span style="color:var(--text-muted);font-size:.8rem;">4.9/5</span></div>
        </div>
      </div>
      <!-- Hero Visual -->
      <div class="animate-float" style="position:relative;">
        <!-- Main dashboard mockup -->
        <div style="background:var(--dark-2);border:1px solid var(--card-border);border-radius:24px;padding:1.5rem;backdrop-filter:blur(20px);box-shadow:0 40px 80px rgba(0,0,0,.5);">
          <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
            <div style="font-weight:700;font-size:1rem;">AI Match Score</div>
            <div class="badge badge-success"><i class="fas fa-brain"></i> Live</div>
          </div>
          <!-- Match cards -->
          @php $matches = [['TechNova AI','FinTech','Series A',94,'#6366f1'],['GreenPath','CleanTech','Seed',87,'#10b981'],['HealthSync','HealthTech','Series B',81,'#a855f7']]; @endphp
          @foreach($matches as $m)
          <div style="background:var(--card);border:1px solid var(--card-border);border-radius:12px;padding:1rem;margin-bottom:.75rem;display:flex;align-items:center;gap:1rem;">
            <div style="width:44px;height:44px;border-radius:10px;background:{{$m[4]}};display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.1rem;flex-shrink:0;">{{ substr($m[0],0,1) }}</div>
            <div style="flex:1;">
              <div style="font-weight:700;font-size:.9rem;">{{ $m[0] }}</div>
              <div style="font-size:.75rem;color:var(--text-muted);">{{ $m[1] }} · {{ $m[2] }}</div>
            </div>
            <div style="text-align:center;">
              <div style="font-size:1.3rem;font-weight:800;color:{{$m[4]}};">{{ $m[3] }}%</div>
              <div style="font-size:.7rem;color:var(--text-muted);">Match</div>
            </div>
          </div>
          @endforeach
          <a href="{{ route('matchmaking') }}" class="btn btn-primary" style="width:100%;justify-content:center;margin-top:.5rem;">
            <i class="fas fa-magic"></i> Find Your Match
          </a>
        </div>
        <!-- Floating badges -->
        <div style="position:absolute;top:-20px;right:-20px;background:var(--dark-2);border:1px solid var(--card-border);border-radius:12px;padding:.75rem 1rem;backdrop-filter:blur(10px);">
          <div style="font-size:.75rem;color:var(--text-muted);">New Partnership</div>
          <div style="font-weight:700;font-size:.9rem;">TechCorp × NovaPay 🤝</div>
        </div>
        <div style="position:absolute;bottom:-20px;left:-20px;background:var(--dark-2);border:1px solid rgba(16,185,129,.3);border-radius:12px;padding:.75rem 1rem;backdrop-filter:blur(10px);">
          <div style="font-size:.75rem;color:var(--text-muted);">Funding Closed</div>
          <div style="font-weight:700;font-size:.9rem;color:#10b981;">₹2.5Cr Series A 🚀</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- STATS BAR -->
<section style="padding:2rem 0;border-top:1px solid var(--card-border);border-bottom:1px solid var(--card-border);background:rgba(255,255,255,.02);">
  <div class="container">
    <div class="grid-4">
      @foreach([['12,400+','Active Members'],['3,800+','Startups Listed'],['620+','Corporates'],['₹480Cr+','Deals Facilitated']] as $s)
      <div class="stat-card"><div class="stat-value">{{ $s[0] }}</div><div class="stat-label">{{ $s[1] }}</div></div>
      @endforeach
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section style="padding:5rem 0;">
  <div class="container" style="text-align:center;">
    <div class="badge badge-purple" style="margin-bottom:1rem;"><i class="fas fa-play-circle"></i> How It Works</div>
    <h2 class="section-title">From <span class="gradient-text">Idea to Partnership</span><br>in 3 Simple Steps</h2>
    <p class="section-subtitle">Our AI-powered platform makes collaboration effortless</p>
    <div class="grid-3">
      @foreach([
        ['1','fas fa-user-plus','Create Your Profile','Startups showcase their innovation. Corporates share their goals. AI builds your digital identity instantly.','#6366f1'],
        ['2','fas fa-brain','AI Matchmaking','Our smart engine analyzes 50+ parameters to surface the most relevant partnerships for you.','#a855f7'],
        ['3','fas fa-handshake','Collaborate & Grow','Chat, pitch, sign NDAs, schedule meetings and close deals — all inside InnoVenture Hub.','#06b6d4'],
      ] as $step)
      <div class="card" style="text-align:center;padding:2.5rem;">
        <div style="width:70px;height:70px;border-radius:20px;background:rgba({{$step[4]=='#6366f1'?'99,102,241':($step[4]=='#a855f7'?'168,85,247':'6,182,212')}},.15);display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;font-size:1.8rem;color:{{$step[4]}};">
          <i class="{{ $step[1] }}"></i>
        </div>
        <div style="font-size:3rem;font-weight:900;color:var(--card-border);position:absolute;top:1rem;right:1.5rem;">{{ $step[0] }}</div>
        <h3 style="font-size:1.2rem;font-weight:700;margin-bottom:.75rem;">{{ $step[2] }}</h3>
        <p style="color:var(--text-muted);line-height:1.6;font-size:.9rem;">{{ $step[3] }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- FEATURES -->
<section style="padding:5rem 0;background:rgba(255,255,255,.01);">
  <div class="container">
    <div style="text-align:center;margin-bottom:3rem;">
      <div class="badge badge-cyan" style="margin-bottom:1rem;"><i class="fas fa-star"></i> Platform Features</div>
      <h2 class="section-title">Everything You Need to<br><span class="gradient-text">Scale Innovation</span></h2>
    </div>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;">
      @foreach([
        ['fas fa-brain','AI Matchmaking Engine','Smart algorithm matching startups and corporates based on industry, tech stack, goals and ESG alignment.','#6366f1'],
        ['fas fa-comments','Real-time Messaging','Chat, video calls, file sharing and NDA signing — all in one secure communication hub.','#a855f7'],
        ['fas fa-chart-line','Advanced Analytics','Track profile views, investor interest, engagement metrics and partnership probability scores.','#06b6d4'],
        ['fas fa-search','Smart Discovery','Filter startups by AI/Blockchain/SaaS, funding stage, location, ESG focus, and more.','#10b981'],
        ['fas fa-calendar','Events & Networking','Virtual expos, demo days, hackathons and summits with AI-powered networking suggestions.','#f59e0b'],
        ['fas fa-shield-alt','Trust & Verification','Company verification, KYC, LinkedIn badges, GST/PAN checks and fraud detection.','#ef4444'],
        ['fas fa-file-contract','Legal & NDA Tools','One-click NDA templates, digital signatures, IP protection and compliance tracking.','#8b5cf6'],
        ['fas fa-rocket','Accelerator Module','Cohort management, mentor assignment, startup progress tracking and demo day events.','#ec4899'],
        ['fas fa-coins','Funding Hub','Equity management, cap table, investor rooms and due diligence tools for fundraising.','#14b8a6'],
      ] as $f)
      <div class="card" style="display:flex;gap:1rem;align-items:flex-start;">
        <div style="width:44px;height:44px;border-radius:12px;background:rgba(0,0,0,.3);display:flex;align-items:center;justify-content:center;color:{{$f[3]}};flex-shrink:0;font-size:1.1rem;">
          <i class="{{ $f[0] }}"></i>
        </div>
        <div>
          <h3 style="font-weight:700;margin-bottom:.4rem;font-size:1rem;">{{ $f[1] }}</h3>
          <p style="color:var(--text-muted);font-size:.85rem;line-height:1.5;">{{ $f[2] }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- TRENDING STARTUPS -->
<section style="padding:5rem 0;">
  <div class="container">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;">
      <div>
        <div class="badge badge-warning" style="margin-bottom:.5rem;"><i class="fas fa-fire"></i> Trending</div>
        <h2 style="font-family:'Outfit',sans-serif;font-size:2rem;font-weight:800;">Hot <span class="gradient-text">Startups</span> This Week</h2>
      </div>
      <a href="{{ route('startups.index') }}" class="btn btn-outline">View All <i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="grid-3">
      @php
      $demoStartups = [
        ['TechNova AI','Building next-gen AI infrastructure for SMEs','AI/ML','Series A','₹8.2Cr','India','🤖',92,'#6366f1'],
        ['GreenPath Energy','Clean energy solutions for tier-2 cities','CleanTech','Seed','₹1.5Cr','India','🌱',87,'#10b981'],
        ['HealthSync Pro','Connecting patients with AI-diagnostics','HealthTech','Series B','₹22Cr','India','🏥',81,'#a855f7'],
        ['EduVerse','Gamified learning for K-12','EdTech','Seed','₹3Cr','India','📚',76,'#f59e0b'],
        ['FinBridge','Neo-banking for gig workers','FinTech','Series A','₹12Cr','India','💰',89,'#06b6d4'],
        ['AgroBot','AI-powered precision farming','AgriTech','Pre-Seed','₹60L','India','🌾',74,'#84cc16'],
      ];
      @endphp
      @foreach($demoStartups as $s)
      <div class="card">
        <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1rem;">
          <div style="width:52px;height:52px;border-radius:14px;background:{{$s[8]}};display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0;">{{ $s[6] }}</div>
          <div>
            <div style="font-weight:700;font-size:1rem;">{{ $s[0] }}</div>
            <span class="badge badge-primary" style="font-size:.7rem;">{{ $s[2] }}</span>
          </div>
          <div style="margin-left:auto;text-align:center;">
            <div style="font-size:1.1rem;font-weight:800;color:{{$s[8]}};">{{ $s[7] }}%</div>
            <div style="font-size:.65rem;color:var(--text-muted);">Match</div>
          </div>
        </div>
        <p style="color:var(--text-muted);font-size:.85rem;line-height:1.5;margin-bottom:1rem;">{{ $s[1] }}</p>
        <div style="display:flex;justify-content:space-between;align-items:center;padding:.75rem;background:rgba(255,255,255,.03);border-radius:8px;">
          <div><div style="font-size:.7rem;color:var(--text-muted);">Stage</div><div style="font-size:.85rem;font-weight:600;">{{ $s[3] }}</div></div>
          <div><div style="font-size:.7rem;color:var(--text-muted);">Raised</div><div style="font-size:.85rem;font-weight:600;color:#10b981;">{{ $s[4] }}</div></div>
          <div><div style="font-size:.7rem;color:var(--text-muted);">Location</div><div style="font-size:.85rem;font-weight:600;">{{ $s[5] }}</div></div>
        </div>
        <a href="{{ route('startups.index') }}" class="btn btn-outline btn-sm" style="width:100%;justify-content:center;margin-top:1rem;">View Profile</a>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- CTA -->
<section style="padding:5rem 0;">
  <div class="container">
    <div style="background:linear-gradient(135deg,rgba(99,102,241,.2),rgba(168,85,247,.2),rgba(6,182,212,.1));border:1px solid rgba(99,102,241,.3);border-radius:24px;padding:4rem;text-align:center;position:relative;overflow:hidden;">
      <div style="position:absolute;top:-50px;right:-50px;width:200px;height:200px;background:radial-gradient(circle,rgba(99,102,241,.3),transparent);border-radius:50%;"></div>
      <div style="position:absolute;bottom:-50px;left:-50px;width:200px;height:200px;background:radial-gradient(circle,rgba(168,85,247,.2),transparent);border-radius:50%;"></div>
      <div style="position:relative;z-index:1;">
        <div class="badge badge-primary" style="margin-bottom:1rem;"><i class="fas fa-rocket"></i> Start Today</div>
        <h2 class="section-title">Ready to Find Your <span class="gradient-text">Perfect Match?</span></h2>
        <p style="color:var(--text-muted);font-size:1.1rem;margin-bottom:2.5rem;max-width:600px;margin-left:auto;margin-right:auto;">Join 12,400+ innovators using InnoVenture Hub to build the future. Free to get started — no credit card required.</p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
          <a href="{{ route('register') }}?role=startup" class="btn btn-primary" style="font-size:1rem;padding:.9rem 2.5rem;">
            <i class="fas fa-rocket"></i> I'm a Startup
          </a>
          <a href="{{ route('register') }}?role=corporate" class="btn btn-outline" style="font-size:1rem;padding:.9rem 2.5rem;">
            <i class="fas fa-building"></i> I'm a Corporate
          </a>
          <a href="{{ route('demo.login') }}?role=startup" class="btn btn-success" style="font-size:1rem;padding:.9rem 2.5rem;">
            <i class="fas fa-play"></i> Try Demo
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')
<script>
// Particle animation
const canvas = document.createElement('canvas');
canvas.style.cssText = 'position:absolute;inset:0;width:100%;height:100%;';
document.getElementById('particles').appendChild(canvas);
const ctx = canvas.getContext('2d');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;
const particles = Array.from({length:60},() => ({
  x: Math.random()*canvas.width, y: Math.random()*canvas.height,
  vx: (Math.random()-.5)*.5, vy: (Math.random()-.5)*.5,
  size: Math.random()*2+1,
  color: ['#6366f1','#a855f7','#06b6d4'][Math.floor(Math.random()*3)]
}));
function animParticles(){
  ctx.clearRect(0,0,canvas.width,canvas.height);
  particles.forEach(p => {
    p.x += p.vx; p.y += p.vy;
    if(p.x<0||p.x>canvas.width) p.vx*=-1;
    if(p.y<0||p.y>canvas.height) p.vy*=-1;
    ctx.beginPath(); ctx.arc(p.x,p.y,p.size,0,Math.PI*2);
    ctx.fillStyle = p.color+'60'; ctx.fill();
  });
  // Connect nearby particles
  particles.forEach((a,i) => particles.slice(i+1).forEach(b => {
    const d = Math.hypot(a.x-b.x,a.y-b.y);
    if(d<100){ctx.beginPath();ctx.moveTo(a.x,a.y);ctx.lineTo(b.x,b.y);ctx.strokeStyle=`rgba(99,102,241,${.15*(1-d/100)})`;ctx.stroke();}
  }));
  requestAnimationFrame(animParticles);
}
animParticles();
window.addEventListener('resize',() => { canvas.width=window.innerWidth; canvas.height=window.innerHeight; });
</script>
@endsection
