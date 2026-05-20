@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<div class="container" style="padding:2rem 1.5rem;">
  <!-- Header -->
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;">
    <div>
      <h1 style="font-size:1.8rem;font-weight:800;">Welcome back, <span class="gradient-text">{{ auth()->user()->name }}</span> 👋</h1>
      <p style="color:var(--text-muted);">{{ now()->format('l, F j, Y') }} · Role: <span class="badge badge-primary">{{ ucfirst(auth()->user()->role) }}</span></p>
    </div>
    <div style="display:flex;gap:.75rem;">
      @if(auth()->user()->role === 'startup')
      <a href="{{ route('startups.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Create Startup Profile</a>
      @elseif(auth()->user()->role === 'corporate')
      <a href="{{ route('opportunities.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Post Opportunity</a>
      @endif
      <a href="{{ route('matchmaking') }}" class="btn btn-outline btn-sm"><i class="fas fa-brain"></i> AI Match</a>
    </div>
  </div>

  <!-- Stats Grid -->
  <div class="grid-4" style="margin-bottom:2rem;">
    @php
    $statIcons = ['fas fa-eye','fas fa-building','fas fa-calendar-check','fas fa-paper-plane','fas fa-star','fas fa-chart-line'];
    $i=0;
    $statColors = ['#6366f1','#a855f7','#06b6d4','#10b981','#f59e0b','#ef4444'];
    @endphp
    @foreach($stats as $key => $val)
    @php $label = ucwords(str_replace('_',' ',$key)); $color=$statColors[$i%6]; $icon=$statIcons[$i%6]; $i++; @endphp
    <div class="card" style="text-align:center;border-top:3px solid {{$color}};">
      <div style="width:44px;height:44px;border-radius:12px;background:rgba(0,0,0,.3);display:flex;align-items:center;justify-content:center;margin:0 auto .75rem;color:{{$color}};font-size:1.1rem;">
        <i class="{{ $icon }}"></i>
      </div>
      <div style="font-size:1.8rem;font-weight:800;color:{{$color}};">
        @if(is_float($val) && $val > 1000) ₹{{ number_format($val/100000,1) }}L
        @elseif(is_float($val) && $val <= 100) {{ $val }}%
        @else {{ number_format($val) }}
        @endif
      </div>
      <div style="color:var(--text-muted);font-size:.8rem;margin-top:.25rem;">{{ $label }}</div>
    </div>
    @endforeach
  </div>

  <div style="display:grid;grid-template-columns:2fr 1fr;gap:2rem;">
    <!-- Main Content -->
    <div>
      <!-- Opportunities -->
      <div class="card" style="margin-bottom:2rem;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
          <h2 style="font-size:1.1rem;font-weight:700;"><i class="fas fa-bolt" style="color:var(--warning);"></i> Live Opportunities</h2>
          <a href="{{ route('opportunities.index') }}" class="btn btn-outline btn-sm">View All</a>
        </div>
        @forelse($opportunities as $opp)
        <div style="display:flex;gap:1rem;align-items:center;padding:1rem;background:rgba(255,255,255,.03);border-radius:12px;margin-bottom:.75rem;border:1px solid var(--card-border);">
          <div style="width:44px;height:44px;border-radius:10px;background:linear-gradient(135deg,#6366f1,#a855f7);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <i class="fas fa-briefcase" style="color:#fff;"></i>
          </div>
          <div style="flex:1;">
            <div style="font-weight:600;font-size:.9rem;">{{ $opp->title }}</div>
            <div style="font-size:.75rem;color:var(--text-muted);">{{ ucwords(str_replace('_',' ',$opp->type ?? 'opportunity')) }} · {{ $opp->created_at ? $opp->created_at->diffForHumans() : 'Recently' }}</div>
          </div>
          <div style="display:flex;gap:.5rem;">
            <span class="badge badge-success">{{ $opp->status ?? 'Open' }}</span>
            <a href="{{ route('opportunities.show', $opp->id) }}" class="btn btn-outline btn-sm">Apply</a>
          </div>
        </div>
        @empty
        <div style="text-align:center;padding:2rem;color:var(--text-muted);">
          <i class="fas fa-inbox" style="font-size:2rem;margin-bottom:.75rem;display:block;"></i>
          No opportunities yet. <a href="{{ route('opportunities.index') }}" style="color:var(--primary);">Browse all</a>
        </div>
        @endforelse
      </div>

      <!-- Recommendations -->
      @if($recommendations->count() > 0)
      <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
          <h2 style="font-size:1.1rem;font-weight:700;"><i class="fas fa-magic" style="color:var(--primary);"></i> AI Recommendations</h2>
          <span class="badge badge-primary">Personalized</span>
        </div>
        <div class="grid-2">
          @foreach($recommendations as $rec)
          <div style="background:rgba(255,255,255,.03);border:1px solid var(--card-border);border-radius:12px;padding:1rem;">
            <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:.75rem;">
              <div style="width:40px;height:40px;border-radius:10px;background:linear-gradient(135deg,#6366f1,#a855f7);display:flex;align-items:center;justify-content:center;font-weight:800;">{{ strtoupper(substr($rec->name,0,1)) }}</div>
              <div>
                <div style="font-weight:700;font-size:.9rem;">{{ $rec->name }}</div>
                <div style="font-size:.75rem;color:var(--text-muted);">{{ $rec->industry ?? 'Technology' }}</div>
              </div>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;">
              <span class="badge badge-success">{{ rand(78,97) }}% Match</span>
              <a href="#" class="btn btn-outline btn-sm">Connect</a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @endif
    </div>

    <!-- Sidebar -->
    <div>
      <!-- Profile Completion -->
      <div class="card" style="margin-bottom:1.5rem;">
        <h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem;"><i class="fas fa-user-check" style="color:var(--success);"></i> Profile Health</h3>
        @php $completion = auth()->user()->profile_complete ? 85 : 45; @endphp
        <div style="display:flex;justify-content:space-between;margin-bottom:.5rem;">
          <span style="font-size:.85rem;color:var(--text-muted);">Completeness</span>
          <span style="font-weight:700;color:{{ $completion > 70 ? '#10b981' : '#f59e0b' }};">{{ $completion }}%</span>
        </div>
        <div class="progress" style="margin-bottom:1rem;"><div class="progress-bar" style="width:{{ $completion }}%;"></div></div>
        @foreach(['Add profile photo','Complete bio','Add team members','Upload pitch deck'] as $tip)
        <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.5rem;font-size:.8rem;color:var(--text-muted);">
          <i class="fas fa-circle-check" style="color:{{ $loop->index < 2 ? '#10b981' : 'var(--text-muted)' }};font-size:.7rem;"></i> {{ $tip }}
        </div>
        @endforeach
      </div>

      <!-- Quick Actions -->
      <div class="card" style="margin-bottom:1.5rem;">
        <h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem;">Quick Actions</h3>
        @foreach([
          ['fas fa-search','Browse Matches',route('matchmaking'),'#6366f1'],
          ['fas fa-envelope','Messages','#','#a855f7'],
          ['fas fa-calendar','Schedule Meeting','#','#06b6d4'],
          ['fas fa-file-alt','Upload Pitch Deck','#','#10b981'],
        ] as $qa)
        <a href="{{ $qa[2] }}" style="display:flex;align-items:center;gap:.75rem;padding:.75rem;border-radius:10px;color:var(--text);text-decoration:none;transition:background .2s;margin-bottom:.25rem;" onmouseover="this.style.background='rgba(255,255,255,.05)'" onmouseout="this.style.background='transparent'">
          <div style="width:34px;height:34px;border-radius:8px;background:rgba(0,0,0,.3);display:flex;align-items:center;justify-content:center;color:{{ $qa[3] }};font-size:.9rem;">
            <i class="{{ $qa[0] }}"></i>
          </div>
          <span style="font-size:.875rem;font-weight:500;">{{ $qa[1] }}</span>
        </a>
        @endforeach
      </div>

      <!-- Recent Activity -->
      <div class="card">
        <h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem;"><i class="fas fa-bell" style="color:var(--warning);"></i> Activity</h3>
        @foreach(array_slice($recentActivity,0,4) as $act)
        <div style="display:flex;gap:.75rem;align-items:flex-start;padding:.75rem 0;border-bottom:1px solid rgba(255,255,255,.05);">
          <div style="width:32px;height:32px;border-radius:8px;background:rgba(99,102,241,.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <i class="fas fa-{{ $act['icon'] }}" style="font-size:.75rem;color:var(--primary);"></i>
          </div>
          <div>
            <div style="font-size:.8rem;font-weight:500;">{{ $act['text'] }}</div>
            <div style="font-size:.72rem;color:var(--text-muted);margin-top:.2rem;">{{ $act['time'] }}</div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
