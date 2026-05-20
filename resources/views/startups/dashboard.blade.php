@extends('layouts.app')
@section('title','My Startup Dashboard')
@section('content')
<div class="container" style="padding:2rem 1.5rem;">
  <h1 style="font-size:1.8rem;font-weight:800;margin-bottom:2rem;">My <span class="gradient-text">Startup Dashboard</span></h1>
  @if(!$startup)
  <div style="text-align:center;padding:4rem;background:var(--card);border:1px solid var(--card-border);border-radius:20px;">
    <div style="font-size:4rem;margin-bottom:1rem;">🚀</div>
    <h2 style="font-size:1.5rem;font-weight:700;margin-bottom:.75rem;">You haven't created a startup profile yet</h2>
    <p style="color:var(--text-muted);margin-bottom:2rem;">Get discovered by 620+ corporates and investors by creating your profile today</p>
    <a href="{{ route('startups.create') }}" class="btn btn-primary" style="font-size:1rem;padding:.9rem 2rem;"><i class="fas fa-plus"></i> Create Startup Profile</a>
  </div>
  @else
  <div style="display:grid;grid-template-columns:2fr 1fr;gap:2rem;">
    <div>
      <div class="card" style="margin-bottom:1.5rem;">
        <div style="display:flex;gap:1.5rem;align-items:center;">
          <div style="width:80px;height:80px;border-radius:18px;background:linear-gradient(135deg,#6366f1,#a855f7);display:flex;align-items:center;justify-content:center;font-size:2rem;font-weight:900;">{{ strtoupper(substr($startup->name,0,1)) }}</div>
          <div>
            <h2 style="font-size:1.4rem;font-weight:800;">{{ $startup->name }}</h2>
            <p style="color:var(--text-muted);">{{ $startup->tagline }}</p>
            <div style="display:flex;gap:.5rem;margin-top:.5rem;">
              <span class="badge badge-primary">{{ $startup->industry }}</span>
              <span class="badge badge-warning">{{ $startup->funding_stage }}</span>
              @if($startup->is_verified)<span class="badge badge-cyan"><i class="fas fa-check"></i> Verified</span>@endif
            </div>
          </div>
          <a href="{{ route('startups.show',$startup->id) }}" class="btn btn-outline btn-sm" style="margin-left:auto;">View Public Profile</a>
        </div>
      </div>
      <div class="grid-4" style="margin-bottom:1.5rem;">
        @foreach([['fas fa-eye','Profile Views',number_format($startup->profile_views??0),'#6366f1'],['fas fa-building','Interested Cos',rand(5,45),'#a855f7'],['fas fa-star','Credibility',round($startup->credibility_score??75).'%','#f59e0b'],['fas fa-paper-plane','Applications',rand(3,25),'#10b981']] as $s)
        <div class="stat-card" style="border-top:3px solid {{ $s[3] }};"><div class="stat-value" style="font-size:1.5rem;">{{ $s[2] }}</div><div class="stat-label"><i class="{{ $s[0] }}" style="color:{{ $s[3] }};"></i> {{ $s[1] }}</div></div>
        @endforeach
      </div>
    </div>
    <div>
      <div class="card">
        <h3 style="font-weight:700;margin-bottom:1rem;">Quick Actions</h3>
        <div style="display:flex;flex-direction:column;gap:.75rem;">
          <a href="{{ route('startups.edit',$startup->id) }}" class="btn btn-primary" style="justify-content:center;"><i class="fas fa-edit"></i> Edit Profile</a>
          <a href="{{ route('matchmaking') }}" class="btn btn-outline" style="justify-content:center;"><i class="fas fa-brain"></i> Find Matches</a>
          <a href="{{ route('opportunities.index') }}" class="btn btn-outline" style="justify-content:center;"><i class="fas fa-bolt"></i> Browse Opportunities</a>
        </div>
      </div>
    </div>
  </div>
  @endif
</div>
@endsection
