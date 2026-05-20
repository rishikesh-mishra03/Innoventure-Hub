@extends('layouts.app')
@section('title','My Corporate Dashboard')
@section('content')
<div class="container" style="padding:2rem 1.5rem;">
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;">
    <h1 style="font-size:1.8rem;font-weight:800;">Corporate <span class="gradient-text">Dashboard</span></h1>
    <div style="display:flex;gap:.75rem;">
      <a href="{{ route('opportunities.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Post Opportunity</a>
      <a href="{{ route('matchmaking') }}" class="btn btn-outline btn-sm"><i class="fas fa-brain"></i> Scout Startups</a>
    </div>
  </div>
  @if(!$corporate)
  <div style="text-align:center;padding:4rem;background:var(--card);border:1px solid var(--card-border);border-radius:20px;">
    <div style="font-size:4rem;margin-bottom:1rem;">🏢</div>
    <h2 style="font-size:1.5rem;font-weight:700;margin-bottom:.75rem;">Create your Corporate Profile</h2>
    <p style="color:var(--text-muted);margin-bottom:2rem;">Start scouting from 3,800+ startups and post innovation challenges</p>
    <a href="{{ route('corporates.create') }}" class="btn btn-primary" style="font-size:1rem;padding:.9rem 2rem;"><i class="fas fa-plus"></i> Create Corporate Profile</a>
  </div>
  @else
  <div class="grid-4" style="margin-bottom:2rem;">
    @foreach([['fas fa-search','Startups Scouted',$corporate->startups_scouted??0,'#6366f1'],['fas fa-bolt','Active Challenges',$opportunities->count(),'#a855f7'],['fas fa-handshake','Partnerships',$corporate->partnerships_count??0,'#10b981'],['fas fa-star','Innovation Score',round($corporate->innovation_score??0),'#f59e0b']] as $s)
    <div class="stat-card" style="border-top:3px solid {{ $s[3] }};"><div class="stat-value" style="font-size:1.5rem;">{{ $s[2] }}</div><div class="stat-label"><i class="{{ $s[0] }}" style="color:{{ $s[3] }};"></i> {{ $s[1] }}</div></div>
    @endforeach
  </div>
  <div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
      <h2 style="font-size:1.1rem;font-weight:700;"><i class="fas fa-bolt" style="color:var(--warning);"></i> My Opportunities</h2>
      <a href="{{ route('opportunities.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> New</a>
    </div>
    @forelse($opportunities as $opp)
    <div style="display:flex;gap:1rem;align-items:center;padding:.75rem;background:rgba(255,255,255,.03);border-radius:10px;margin-bottom:.5rem;">
      <div style="flex:1;"><div style="font-weight:600;">{{ $opp->title }}</div><div style="font-size:.75rem;color:var(--text-muted);">{{ $opp->applications_count ?? 0 }} applications · {{ $opp->views_count ?? 0 }} views</div></div>
      <span class="badge badge-success">{{ ucfirst($opp->status ?? 'open') }}</span>
      <a href="{{ route('opportunities.show',$opp->id) }}" class="btn btn-outline btn-sm">View</a>
    </div>
    @empty
    <div style="text-align:center;padding:2rem;color:var(--text-muted);"><i class="fas fa-inbox" style="font-size:2rem;display:block;margin-bottom:.75rem;"></i> No opportunities posted yet</div>
    @endforelse
  </div>
  @endif
</div>
@endsection
