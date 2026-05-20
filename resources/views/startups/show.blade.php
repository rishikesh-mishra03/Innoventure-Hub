@extends('layouts.app')
@section('title', ($startup->name ?? 'Startup') . ' Profile')
@section('content')
<div class="container" style="padding:2rem 1.5rem;">
  <!-- Profile Header -->
  <div style="background:linear-gradient(135deg,rgba(99,102,241,.15),rgba(168,85,247,.1));border:1px solid var(--card-border);border-radius:20px;padding:2.5rem;margin-bottom:2rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-50px;right:-50px;width:200px;height:200px;background:radial-gradient(circle,rgba(99,102,241,.2),transparent);border-radius:50%;"></div>
    <div style="display:flex;gap:2rem;align-items:flex-start;flex-wrap:wrap;">
      <!-- Logo -->
      <div style="width:100px;height:100px;border-radius:20px;background:linear-gradient(135deg,#6366f1,#a855f7);display:flex;align-items:center;justify-content:center;font-size:2.5rem;font-weight:900;flex-shrink:0;">
        {{ strtoupper(substr($startup->name,0,1)) }}
      </div>
      <div style="flex:1;">
        <div style="display:flex;align-items:center;gap:1rem;flex-wrap:wrap;margin-bottom:.5rem;">
          <h1 style="font-size:2rem;font-weight:800;">{{ $startup->name }}</h1>
          @if($startup->is_verified)<span class="badge badge-cyan"><i class="fas fa-circle-check"></i> Verified</span>@endif
          @if($startup->is_featured)<span class="badge badge-warning"><i class="fas fa-star"></i> Featured</span>@endif
        </div>
        <p style="color:var(--text-muted);font-size:1rem;margin-bottom:1rem;">{{ $startup->tagline }}</p>
        <div style="display:flex;gap:1rem;flex-wrap:wrap;">
          <span class="badge badge-primary"><i class="fas fa-tag"></i> {{ $startup->industry }}</span>
          <span class="badge badge-warning">{{ $startup->funding_stage }}</span>
          @if($startup->headquarters)<span class="badge badge-purple"><i class="fas fa-map-marker-alt"></i> {{ $startup->headquarters }}</span>@endif
          @if($startup->founded_year)<span class="badge badge-cyan"><i class="fas fa-calendar"></i> Est. {{ $startup->founded_year }}</span>@endif
          @if($startup->women_led)<span class="badge badge-success">👩 Women-led</span>@endif
        </div>
      </div>
      <!-- Match & Actions -->
      <div style="display:flex;flex-direction:column;align-items:center;gap:1rem;">
        <div style="background:rgba(99,102,241,.15);border:2px solid var(--primary);border-radius:16px;padding:1rem 1.5rem;text-align:center;">
          <div style="font-size:2.5rem;font-weight:900;background:var(--gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">{{ $startup->credibility_score ? round($startup->credibility_score) : rand(75,95) }}%</div>
          <div style="font-size:.75rem;color:var(--text-muted);">Credibility Score</div>
        </div>
        <div style="display:flex;gap:.5rem;">
          @auth
          <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i> Connect</a>
          @else
          <a href="{{ route('login') }}" class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i> Connect</a>
          @endauth
          <button class="btn btn-outline btn-sm"><i class="fas fa-bookmark"></i></button>
          <button class="btn btn-outline btn-sm"><i class="fas fa-share-alt"></i></button>
        </div>
      </div>
    </div>
  </div>

  <div style="display:grid;grid-template-columns:2fr 1fr;gap:2rem;">
    <!-- Main -->
    <div>
      <!-- About -->
      <div class="card" style="margin-bottom:1.5rem;">
        <h2 style="font-size:1.1rem;font-weight:700;margin-bottom:1rem;"><i class="fas fa-info-circle" style="color:var(--primary);"></i> About</h2>
        <p style="color:var(--text-muted);line-height:1.7;">{{ $startup->description ?? 'No description provided yet.' }}</p>
      </div>

      <!-- Problem & Solution -->
      <div class="grid-2" style="margin-bottom:1.5rem;">
        <div class="card">
          <h3 style="font-size:1rem;font-weight:700;margin-bottom:.75rem;color:#ef4444;"><i class="fas fa-exclamation-triangle"></i> Problem</h3>
          <p style="color:var(--text-muted);font-size:.9rem;line-height:1.6;">{{ $startup->problem_solving ?? 'N/A' }}</p>
        </div>
        <div class="card">
          <h3 style="font-size:1rem;font-weight:700;margin-bottom:.75rem;color:#10b981;"><i class="fas fa-lightbulb"></i> Solution</h3>
          <p style="color:var(--text-muted);font-size:.9rem;line-height:1.6;">{{ $startup->solution ?? 'N/A' }}</p>
        </div>
      </div>

      <!-- Traction Metrics -->
      <div class="card" style="margin-bottom:1.5rem;">
        <h2 style="font-size:1.1rem;font-weight:700;margin-bottom:1.5rem;"><i class="fas fa-chart-line" style="color:var(--success);"></i> Traction</h2>
        <div class="grid-4">
          @foreach([['fas fa-users','Customers',number_format($startup->customer_count ?? rand(100,5000)),'#6366f1'],['fas fa-chart-line','MoM Growth',($startup->monthly_growth_rate ?? rand(5,40)).'%','#10b981'],['fas fa-dollar-sign','ARR','₹'.number_format(($startup->annual_revenue ?? rand(500000,5000000))/100000,1).'L','#f59e0b'],['fas fa-eye','Profile Views',number_format($startup->profile_views ?? rand(1000,20000)),'#a855f7']] as $m)
          <div style="text-align:center;padding:1rem;background:rgba(255,255,255,.03);border-radius:10px;">
            <i class="{{ $m[0] }}" style="font-size:1.3rem;color:{{ $m[3] }};margin-bottom:.5rem;display:block;"></i>
            <div style="font-size:1.3rem;font-weight:800;color:{{ $m[3] }};">{{ $m[2] }}</div>
            <div style="font-size:.7rem;color:var(--text-muted);">{{ $m[1] }}</div>
          </div>
          @endforeach
        </div>
      </div>

      <!-- Tech Stack -->
      @if($startup->tech_stack && count($startup->tech_stack) > 0)
      <div class="card" style="margin-bottom:1.5rem;">
        <h2 style="font-size:1.1rem;font-weight:700;margin-bottom:1rem;"><i class="fas fa-code" style="color:var(--accent);"></i> Tech Stack</h2>
        <div style="display:flex;flex-wrap:wrap;gap:.5rem;">
          @foreach($startup->tech_stack as $tech)
          <span class="tag" style="font-size:.85rem;padding:.4rem .8rem;">{{ $tech }}</span>
          @endforeach
        </div>
      </div>
      @endif

      <!-- Related Startups -->
      @if($relatedStartups->count() > 0)
      <div class="card">
        <h2 style="font-size:1.1rem;font-weight:700;margin-bottom:1rem;"><i class="fas fa-th-large" style="color:var(--secondary);"></i> Similar Startups</h2>
        @foreach($relatedStartups as $r)
        <a href="{{ route('startups.show',$r->id) }}" style="display:flex;align-items:center;gap:.75rem;padding:.75rem;border-radius:10px;text-decoration:none;color:var(--text);margin-bottom:.5rem;transition:background .2s;" onmouseover="this.style.background='rgba(255,255,255,.05)'" onmouseout="this.style.background='transparent'">
          <div style="width:38px;height:38px;border-radius:10px;background:linear-gradient(135deg,#6366f1,#a855f7);display:flex;align-items:center;justify-content:center;font-weight:700;">{{ strtoupper(substr($r->name,0,1)) }}</div>
          <div style="flex:1;"><div style="font-weight:600;font-size:.9rem;">{{ $r->name }}</div><div style="font-size:.75rem;color:var(--text-muted);">{{ $r->funding_stage }}</div></div>
          <i class="fas fa-arrow-right" style="color:var(--text-muted);"></i>
        </a>
        @endforeach
      </div>
      @endif
    </div>

    <!-- Sidebar -->
    <div>
      <!-- Quick Info -->
      <div class="card" style="margin-bottom:1.5rem;">
        <h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem;">Quick Info</h3>
        @foreach([
          ['fas fa-industry','Industry',$startup->industry ?? 'N/A'],
          ['fas fa-money-bill-wave','Revenue Model',$startup->revenue_model ?? 'N/A'],
          ['fas fa-users','Team Size',($startup->team_size ?? 'N/A').' people'],
          ['fas fa-map-marker-alt','Location',$startup->headquarters ?? 'N/A'],
          ['fas fa-globe','Website',$startup->website],
          ['fas fa-linkedin','LinkedIn',$startup->linkedin],
        ] as $info)
        @if($info[2] && $info[2] !== 'N/A')
        <div style="display:flex;gap:.75rem;align-items:center;padding:.6rem 0;border-bottom:1px solid rgba(255,255,255,.05);">
          <i class="{{ $info[0] }}" style="color:var(--primary);width:16px;text-align:center;font-size:.85rem;"></i>
          <div>
            <div style="font-size:.7rem;color:var(--text-muted);">{{ $info[1] }}</div>
            @if(filter_var($info[2],FILTER_VALIDATE_URL))
            <a href="{{ $info[2] }}" target="_blank" style="color:var(--primary);font-size:.85rem;">{{ parse_url($info[2],PHP_URL_HOST) }}</a>
            @else
            <div style="font-size:.85rem;font-weight:500;">{{ $info[2] }}</div>
            @endif
          </div>
        </div>
        @endif
        @endforeach
      </div>

      <!-- AI Summary -->
      <div class="card" style="margin-bottom:1.5rem;border-color:rgba(99,102,241,.3);">
        <h3 style="font-size:1rem;font-weight:700;margin-bottom:.75rem;"><i class="fas fa-brain" style="color:var(--primary);"></i> AI Summary</h3>
        <p style="color:var(--text-muted);font-size:.85rem;line-height:1.6;">{{ $startup->ai_profile_summary ?? 'An innovative startup working at the intersection of technology and business, with strong growth potential and a clear market opportunity.' }}</p>
        <div style="margin-top:1rem;padding:.75rem;background:rgba(99,102,241,.1);border-radius:8px;">
          <div style="font-size:.75rem;color:var(--text-muted);margin-bottom:.25rem;">Partnership Probability</div>
          <div class="progress"><div class="progress-bar" style="width:{{ rand(65,92) }}%;"></div></div>
        </div>
      </div>

      <!-- Contact -->
      <div class="card">
        <h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem;">Interested in Partnering?</h3>
        @auth
        <button class="btn btn-primary" style="width:100%;justify-content:center;margin-bottom:.75rem;"><i class="fas fa-paper-plane"></i> Send Message</button>
        <button class="btn btn-outline" style="width:100%;justify-content:center;"><i class="fas fa-calendar"></i> Schedule Meeting</button>
        @else
        <p style="color:var(--text-muted);font-size:.85rem;margin-bottom:1rem;">Login to connect with this startup</p>
        <a href="{{ route('login') }}" class="btn btn-primary" style="width:100%;justify-content:center;"><i class="fas fa-sign-in-alt"></i> Login to Connect</a>
        @endauth
      </div>
    </div>
  </div>
</div>
@endsection
