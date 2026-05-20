@extends('layouts.app')
@section('title',($corporate->name??'Corporate').' Profile')
@section('content')
<div class="container" style="padding:2rem 1.5rem;">
  <div style="background:linear-gradient(135deg,rgba(168,85,247,.15),rgba(99,102,241,.1));border:1px solid var(--card-border);border-radius:20px;padding:2.5rem;margin-bottom:2rem;">
    <div style="display:flex;gap:2rem;align-items:flex-start;flex-wrap:wrap;">
      <div style="width:100px;height:100px;border-radius:20px;background:linear-gradient(135deg,#a855f7,#6366f1);display:flex;align-items:center;justify-content:center;font-size:2.5rem;font-weight:900;flex-shrink:0;">{{ strtoupper(substr($corporate->name,0,1)) }}</div>
      <div style="flex:1;">
        <div style="display:flex;align-items:center;gap:1rem;flex-wrap:wrap;margin-bottom:.5rem;">
          <h1 style="font-size:2rem;font-weight:800;">{{ $corporate->name }}</h1>
          @if($corporate->is_verified)<span class="badge badge-cyan"><i class="fas fa-circle-check"></i> Verified</span>@endif
        </div>
        <p style="color:var(--text-muted);margin-bottom:1rem;">{{ $corporate->tagline }}</p>
        <div style="display:flex;gap:.75rem;flex-wrap:wrap;">
          <span class="badge badge-purple">{{ $corporate->industry }}</span>
          @if($corporate->company_size)<span class="badge badge-primary"><i class="fas fa-users"></i> {{ $corporate->company_size }} employees</span>@endif
          @if($corporate->headquarters)<span class="badge badge-cyan"><i class="fas fa-map-marker-alt"></i> {{ $corporate->headquarters }}</span>@endif
        </div>
      </div>
      <div style="display:flex;flex-direction:column;gap:1rem;align-items:center;">
        <div style="background:rgba(168,85,247,.15);border:2px solid #a855f7;border-radius:16px;padding:1rem 1.5rem;text-align:center;">
          <div style="font-size:2.5rem;font-weight:900;background:var(--gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">{{ round($corporate->innovation_score ?? rand(75,95)) }}</div>
          <div style="font-size:.75rem;color:var(--text-muted);">Innovation Score</div>
        </div>
        <div style="display:flex;gap:.5rem;">
          @auth<a href="#" class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i> Connect</a>
          @else<a href="{{ route('login') }}" class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i> Connect</a>@endauth
          <button class="btn btn-outline btn-sm"><i class="fas fa-bookmark"></i></button>
        </div>
      </div>
    </div>
  </div>
  <div style="display:grid;grid-template-columns:2fr 1fr;gap:2rem;">
    <div>
      <div class="card" style="margin-bottom:1.5rem;">
        <h2 style="font-size:1.1rem;font-weight:700;margin-bottom:1rem;"><i class="fas fa-info-circle" style="color:var(--primary);"></i> About</h2>
        <p style="color:var(--text-muted);line-height:1.7;">{{ $corporate->description ?? 'No description provided.' }}</p>
      </div>
      @if($corporate->innovation_goals && count($corporate->innovation_goals))
      <div class="card" style="margin-bottom:1.5rem;">
        <h2 style="font-size:1.1rem;font-weight:700;margin-bottom:1rem;"><i class="fas fa-lightbulb" style="color:var(--warning);"></i> Innovation Goals</h2>
        <div style="display:flex;flex-wrap:wrap;gap:.5rem;">
          @foreach($corporate->innovation_goals as $g)<span class="tag" style="font-size:.85rem;padding:.4rem .8rem;">{{ $g }}</span>@endforeach
        </div>
      </div>
      @endif
      @if($opportunities->count())
      <div class="card">
        <h2 style="font-size:1.1rem;font-weight:700;margin-bottom:1rem;"><i class="fas fa-bolt" style="color:var(--warning);"></i> Open Opportunities</h2>
        @foreach($opportunities as $opp)
        <div style="display:flex;align-items:center;gap:1rem;padding:1rem;background:rgba(255,255,255,.03);border-radius:10px;margin-bottom:.75rem;border:1px solid var(--card-border);">
          <div style="width:40px;height:40px;border-radius:10px;background:rgba(99,102,241,.15);display:flex;align-items:center;justify-content:center;"><i class="fas fa-briefcase" style="color:var(--primary);"></i></div>
          <div style="flex:1;"><div style="font-weight:600;font-size:.9rem;">{{ $opp->title }}</div><div style="font-size:.75rem;color:var(--text-muted);">{{ ucwords(str_replace('_',' ',$opp->type??'')) }}</div></div>
          <a href="{{ route('opportunities.show',$opp->id) }}" class="btn btn-outline btn-sm">View</a>
        </div>
        @endforeach
      </div>
      @endif
    </div>
    <div>
      <div class="card" style="margin-bottom:1.5rem;">
        <h3 style="font-weight:700;margin-bottom:1rem;">Stats</h3>
        @foreach([['fas fa-handshake','Partnerships',$corporate->partnerships_count??rand(5,40),'#6366f1'],['fas fa-search','Startups Scouted',$corporate->startups_scouted??rand(20,200),'#a855f7'],['fas fa-star','Innovation Score',round($corporate->innovation_score??80),'#f59e0b']] as $s)
        <div style="display:flex;align-items:center;gap:.75rem;padding:.75rem 0;border-bottom:1px solid rgba(255,255,255,.05);">
          <i class="{{ $s[0] }}" style="color:{{ $s[3] }};width:16px;"></i>
          <span style="flex:1;font-size:.85rem;color:var(--text-muted);">{{ $s[1] }}</span>
          <span style="font-weight:700;color:{{ $s[3] }};">{{ $s[2] }}</span>
        </div>
        @endforeach
      </div>
      @if($corporate->preferred_industries && count($corporate->preferred_industries))
      <div class="card" style="margin-bottom:1.5rem;">
        <h3 style="font-weight:700;margin-bottom:.75rem;">Looking For</h3>
        @foreach($corporate->preferred_industries as $ind)
        <span class="tag" style="margin:.2rem;">{{ $ind }}</span>
        @endforeach
      </div>
      @endif
      <div class="card">
        <h3 style="font-weight:700;margin-bottom:1rem;">Partnership Budget</h3>
        @if($corporate->budget_range_min || $corporate->budget_range_max)
        <div style="padding:1rem;background:rgba(16,185,129,.1);border-radius:10px;text-align:center;">
          <div style="font-size:1.3rem;font-weight:800;color:#10b981;">₹{{ number_format(($corporate->budget_range_min??0)/100000,0) }}L - ₹{{ number_format(($corporate->budget_range_max??0)/100000,0) }}L</div>
          <div style="font-size:.75rem;color:var(--text-muted);margin-top:.25rem;">Per partnership</div>
        </div>
        @else<p style="color:var(--text-muted);font-size:.85rem;">Budget discussed on case-by-case basis</p>@endif
      </div>
    </div>
  </div>
</div>
@endsection
