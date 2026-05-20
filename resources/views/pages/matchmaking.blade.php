@extends('layouts.app')
@section('title','AI Matchmaking Engine')
@section('content')
<div class="container" style="padding:2rem 1.5rem;">
  <!-- Header -->
  <div style="text-align:center;margin-bottom:3rem;">
    <div class="badge badge-primary" style="margin-bottom:1rem;"><i class="fas fa-brain"></i> Powered by AI</div>
    <h1 class="section-title">Smart <span class="gradient-text">Matchmaking Engine</span></h1>
    <p style="color:var(--text-muted);font-size:1.1rem;max-width:600px;margin:0 auto;">Our AI analyzes 50+ parameters to surface the most relevant startup-corporate partnerships in real time</p>
  </div>

  <!-- Animated Match Visualization -->
  <div style="background:var(--card);border:1px solid var(--card-border);border-radius:24px;padding:3rem;margin-bottom:3rem;text-align:center;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at center,rgba(99,102,241,.1),transparent 70%);pointer-events:none;"></div>
    <div style="display:flex;align-items:center;justify-content:center;gap:3rem;flex-wrap:wrap;position:relative;z-index:1;">
      <!-- Startup Side -->
      <div style="text-align:center;">
        <div style="font-size:.85rem;color:var(--text-muted);margin-bottom:1.5rem;font-weight:600;text-transform:uppercase;letter-spacing:.05em;">Startup</div>
        @foreach([['TechNova AI','#6366f1','🤖'],['GreenPath','#10b981','🌱'],['HealthSync','#a855f7','🏥']] as $s)
        <div id="s{{ $loop->index }}" style="background:var(--dark-2);border:2px solid {{ $s[1] }};border-radius:14px;padding:1rem 1.5rem;margin-bottom:.75rem;display:flex;align-items:center;gap:.75rem;transition:all .3s;cursor:pointer;" onclick="runMatch({{ $loop->index }})">
          <div style="font-size:1.5rem;">{{ $s[2] }}</div>
          <div style="text-align:left;"><div style="font-weight:700;font-size:.9rem;">{{ $s[0] }}</div><div style="font-size:.7rem;color:var(--text-muted);">AI Startup</div></div>
        </div>
        @endforeach
      </div>
      <!-- Center Engine -->
      <div style="position:relative;">
        <div id="matchEngine" style="width:120px;height:120px;border-radius:50%;background:var(--gradient);display:flex;flex-direction:column;align-items:center;justify-content:center;box-shadow:0 0 40px rgba(99,102,241,.4);cursor:pointer;" onclick="runAllMatches()">
          <i class="fas fa-brain" style="font-size:2.5rem;color:#fff;"></i>
          <div style="font-size:.6rem;color:rgba(255,255,255,.8);margin-top:.25rem;font-weight:700;">AI ENGINE</div>
        </div>
        <div id="matchScore" style="position:absolute;top:-20px;right:-20px;background:#10b981;color:#fff;width:50px;height:50px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1rem;box-shadow:0 4px 15px rgba(16,185,129,.4);opacity:0;transition:all .5s;">94%</div>
        <div style="text-align:center;margin-top:1rem;font-size:.8rem;color:var(--text-muted);" id="engineStatus">Click to match</div>
      </div>
      <!-- Corporate Side -->
      <div style="text-align:center;">
        <div style="font-size:.85rem;color:var(--text-muted);margin-bottom:1.5rem;font-weight:600;text-transform:uppercase;letter-spacing:.05em;">Corporate</div>
        @foreach([['TechCorp Global','#06b6d4','🏢'],['InnoBank','#f59e0b','🏦'],['GreenEnergy Co','#84cc16','⚡']] as $c)
        <div style="background:var(--dark-2);border:2px solid {{ $c[1] }};border-radius:14px;padding:1rem 1.5rem;margin-bottom:.75rem;display:flex;align-items:center;gap:.75rem;">
          <div style="font-size:1.5rem;">{{ $c[2] }}</div>
          <div style="text-align:left;"><div style="font-weight:700;font-size:.9rem;">{{ $c[0] }}</div><div style="font-size:.7rem;color:var(--text-muted);">Enterprise</div></div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  <!-- Match Parameters -->
  <div style="margin-bottom:3rem;">
    <h2 style="font-size:1.3rem;font-weight:700;margin-bottom:1.5rem;"><i class="fas fa-sliders-h" style="color:var(--primary);"></i> Match Parameters</h2>
    <div class="grid-3">
      @foreach([
        ['fas fa-tag','Industry Alignment','95%','#6366f1'],
        ['fas fa-code','Tech Stack Match','88%','#a855f7'],
        ['fas fa-map-marker-alt','Geographic Fit','72%','#06b6d4'],
        ['fas fa-seedling','ESG Alignment','91%','#10b981'],
        ['fas fa-chart-bar','Market Size Fit','85%','#f59e0b'],
        ['fas fa-money-bill','Funding Stage','78%','#ef4444'],
      ] as $p)
      <div class="card">
        <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:.75rem;">
          <i class="{{ $p[0] }}" style="color:{{ $p[3] }};font-size:1rem;"></i>
          <div style="font-weight:600;font-size:.9rem;">{{ $p[1] }}</div>
          <div style="margin-left:auto;font-weight:800;color:{{ $p[3] }};">{{ $p[2] }}</div>
        </div>
        <div class="progress"><div class="progress-bar" style="width:{{ $p[2] }};background:linear-gradient(135deg,{{ $p[3] }},{{ $p[3] }}aa);"></div></div>
      </div>
      @endforeach
    </div>
  </div>

  <!-- Top Matches -->
  <div>
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
      <h2 style="font-size:1.3rem;font-weight:700;"><i class="fas fa-fire" style="color:var(--warning);"></i> Top AI Matches Today</h2>
      <span class="badge badge-success"><i class="fas fa-circle" style="font-size:.5rem;"></i> Live</span>
    </div>
    <div style="display:flex;flex-direction:column;gap:1rem;">
      @php
      $matches=[['TechNova AI','🤖','AI/ML','Series A','TechCorp Global','🏢','Technology',94,'Smart automation partnership opportunity'],['GreenPath Energy','🌱','CleanTech','Seed','GreenEnergy Co','⚡','Energy',91,'ESG-aligned clean energy pilot program'],['HealthSync','🏥','HealthTech','Series B','MediCorp','💊','Healthcare',87,'Digital health transformation initiative'],['EduVerse','📚','EdTech','Seed','LearningBank','🏦','BFSI',82,'Employee training & upskilling program'],['FinBridge','💰','FinTech','Series A','InnoBank','🏦','Banking',79,'Neo-banking API integration opportunity']];
      @endphp
      @foreach($matches as $i => $m)
      <div class="card" style="display:flex;align-items:center;gap:1.5rem;border-left:4px solid {{ ['#6366f1','#10b981','#a855f7','#f59e0b','#06b6d4'][$i] }};">
        <div style="font-size:1.5rem;width:28px;text-align:center;font-weight:900;color:var(--text-muted);">{{ $i+1 }}</div>
        <!-- Startup -->
        <div style="flex:1;min-width:0;">
          <div style="font-size:.7rem;color:var(--text-muted);margin-bottom:.25rem;">STARTUP</div>
          <div style="display:flex;align-items:center;gap:.5rem;">
            <span style="font-size:1.2rem;">{{ $m[1] }}</span>
            <div><div style="font-weight:700;font-size:.9rem;">{{ $m[0] }}</div><div style="font-size:.7rem;color:var(--text-muted);">{{ $m[2] }} · {{ $m[3] }}</div></div>
          </div>
        </div>
        <!-- Score -->
        <div style="text-align:center;min-width:80px;">
          <div style="font-size:1.8rem;font-weight:900;background:var(--gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">{{ $m[7] }}%</div>
          <div style="font-size:.7rem;color:var(--text-muted);">Match Score</div>
        </div>
        <!-- Corporate -->
        <div style="flex:1;min-width:0;text-align:right;">
          <div style="font-size:.7rem;color:var(--text-muted);margin-bottom:.25rem;">CORPORATE</div>
          <div style="display:flex;align-items:center;gap:.5rem;justify-content:flex-end;">
            <div><div style="font-weight:700;font-size:.9rem;">{{ $m[4] }}</div><div style="font-size:.7rem;color:var(--text-muted);">{{ $m[6] }}</div></div>
            <span style="font-size:1.2rem;">{{ $m[5] }}</span>
          </div>
        </div>
        <!-- Reason & Actions -->
        <div style="display:flex;flex-direction:column;gap:.5rem;flex-shrink:0;">
          <button class="btn btn-primary btn-sm"><i class="fas fa-handshake"></i> Connect</button>
          <button class="btn btn-outline btn-sm"><i class="fas fa-info-circle"></i> Details</button>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
let matchRunning=false;
function runAllMatches(){
  if(matchRunning) return;
  matchRunning=true;
  const engine=document.getElementById('matchEngine');
  const score=document.getElementById('matchScore');
  const status=document.getElementById('engineStatus');
  engine.style.animation='spin 1s linear infinite';
  status.textContent='Analyzing 50+ parameters...';
  let count=0, scores=[94,87,81];
  const interval=setInterval(()=>{
    count++;
    status.textContent=['Processing industry data...','Checking tech stack...','Analyzing ESG goals...','Computing match scores...'][count%4];
  },400);
  setTimeout(()=>{
    clearInterval(interval);
    engine.style.animation='';
    score.style.opacity='1';
    status.textContent='✓ 3 perfect matches found!';
    status.style.color='#10b981';
    matchRunning=false;
  },2000);
}
function runMatch(i){
  const cards=document.querySelectorAll('[id^="s"]');
  cards.forEach((c,idx)=>c.style.transform=idx===i?'scale(1.05)':'scale(1)');
  document.getElementById('matchScore').textContent=[94,87,81][i]+'%';
  runAllMatches();
}
</script>
@endsection
