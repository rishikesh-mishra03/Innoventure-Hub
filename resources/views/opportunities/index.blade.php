@extends('layouts.app')
@section('title','Opportunities Marketplace')
@section('content')
<div class="container" style="padding:2rem 1.5rem;">
  <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:2rem;">
    <div>
      <div class="badge badge-warning" style="margin-bottom:.75rem;"><i class="fas fa-bolt"></i> Live Opportunities</div>
      <h1 style="font-size:2rem;font-weight:800;">Innovation <span class="gradient-text">Marketplace</span></h1>
      <p style="color:var(--text-muted);">{{ $opportunities->total() }} active opportunities from leading corporates</p>
    </div>
    @auth @if(auth()->user()->role === 'corporate')
    <a href="{{ route('opportunities.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Post Opportunity</a>
    @endif @endauth
  </div>

  <!-- Filters -->
  <form method="GET" style="background:var(--card);border:1px solid var(--card-border);border-radius:16px;padding:1.25rem;margin-bottom:2rem;">
    <div style="display:grid;grid-template-columns:2fr 1fr 1fr auto;gap:1rem;align-items:end;">
      <div class="form-group" style="margin:0;"><label>Search</label><input type="text" name="search" placeholder="Search opportunities..." value="{{ request('search') }}"></div>
      <div class="form-group" style="margin:0;"><label>Type</label>
        <select name="type">
          <option value="">All Types</option>
          @foreach($types as $key => $label)
          <option value="{{ $key }}" {{ request('type')===$key?'selected':'' }}>{{ $label }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group" style="margin:0;"><label>Industry</label>
        <select name="industry">
          <option value="">All Industries</option>
          @foreach(['FinTech','HealthTech','EdTech','AgriTech','CleanTech','AI/ML','SaaS','Logistics'] as $i)
          <option value="{{ $i }}" {{ request('industry')===$i?'selected':'' }}>{{ $i }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
    </div>
  </form>

  <!-- Type Filter Tabs -->
  <div style="display:flex;gap:.5rem;flex-wrap:wrap;margin-bottom:2rem;">
    <a href="{{ route('opportunities.index') }}" class="btn {{ !request('type') ? 'btn-primary' : 'btn-outline' }} btn-sm">All</a>
    @foreach($types as $key => $label)
    <a href="?type={{ $key }}" class="btn {{ request('type')===$key ? 'btn-primary' : 'btn-outline' }} btn-sm">{{ $label }}</a>
    @endforeach
  </div>

  <!-- Opportunities List -->
  <div style="display:flex;flex-direction:column;gap:1.25rem;">
    @forelse($opportunities as $opp)
    @php
    $typeColors=['innovation_challenge'=>'#6366f1','pilot_project'=>'#a855f7','vendor_requirement'=>'#06b6d4','acquisition'=>'#ef4444','internship'=>'#10b981','api_integration'=>'#f59e0b','procurement'=>'#8b5cf6'];
    $typeIcons=['innovation_challenge'=>'fas fa-lightbulb','pilot_project'=>'fas fa-flask','vendor_requirement'=>'fas fa-handshake','acquisition'=>'fas fa-building','internship'=>'fas fa-graduation-cap','api_integration'=>'fas fa-code','procurement'=>'fas fa-shopping-cart'];
    $c=$typeColors[$opp->type??'innovation_challenge']??'#6366f1';
    $ic=$typeIcons[$opp->type??'innovation_challenge']??'fas fa-bolt';
    @endphp
    <div class="card" style="border-left:4px solid {{ $c }};">
      <div style="display:flex;gap:1.5rem;align-items:flex-start;">
        <div style="width:54px;height:54px;border-radius:14px;background:rgba(0,0,0,.3);display:flex;align-items:center;justify-content:center;color:{{ $c }};font-size:1.3rem;flex-shrink:0;">
          <i class="{{ $ic }}"></i>
        </div>
        <div style="flex:1;">
          <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:.5rem;">
            <div>
              <h2 style="font-size:1.1rem;font-weight:700;margin-bottom:.25rem;">{{ $opp->title }}</h2>
              <div style="display:flex;gap:.5rem;flex-wrap:wrap;">
                <span class="badge" style="background:rgba(0,0,0,.3);color:{{ $c }};">{{ $types[$opp->type] ?? ucwords(str_replace('_',' ',$opp->type ?? '')) }}</span>
                @if($opp->industry)<span class="badge badge-primary">{{ $opp->industry }}</span>@endif
                @if($opp->is_featured)<span class="badge badge-warning"><i class="fas fa-star"></i> Featured</span>@endif
              </div>
            </div>
            <div style="text-align:right;">
              @if($opp->budget_min || $opp->budget_max)
              <div style="font-weight:800;color:#10b981;font-size:1rem;">
                ₹{{ number_format(($opp->budget_min??0)/100000,0) }}L - ₹{{ number_format(($opp->budget_max??0)/100000,0) }}L
              </div>
              @endif
              @if($opp->deadline)
              <div style="font-size:.75rem;color:var(--text-muted);">Deadline: {{ \Carbon\Carbon::parse($opp->deadline)->format('M j, Y') }}</div>
              @endif
            </div>
          </div>
          <p style="color:var(--text-muted);font-size:.875rem;line-height:1.5;margin:1rem 0;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $opp->description }}</p>
          <div style="display:flex;justify-content:space-between;align-items:center;">
            <div style="display:flex;gap:1.5rem;">
              <span style="font-size:.8rem;color:var(--text-muted);"><i class="fas fa-eye"></i> {{ number_format($opp->views_count ?? 0) }} views</span>
              <span style="font-size:.8rem;color:var(--text-muted);"><i class="fas fa-paper-plane"></i> {{ number_format($opp->applications_count ?? 0) }} applied</span>
              <span style="font-size:.8rem;color:var(--text-muted);"><i class="fas fa-clock"></i> {{ $opp->created_at ? $opp->created_at->diffForHumans() : 'Recently' }}</span>
            </div>
            <div style="display:flex;gap:.75rem;">
              <a href="{{ route('opportunities.show', $opp->id) }}" class="btn btn-outline btn-sm">View Details</a>
              @auth
              <form method="POST" action="{{ route('opportunities.apply', $opp->id) }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i> Apply Now</button>
              </form>
              @else
              <a href="{{ route('login') }}" class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i> Apply Now</a>
              @endauth
            </div>
          </div>
        </div>
      </div>
    </div>
    @empty
    <div style="text-align:center;padding:4rem;background:var(--card);border:1px solid var(--card-border);border-radius:16px;">
      <i class="fas fa-bolt" style="font-size:3rem;color:var(--text-muted);margin-bottom:1rem;display:block;"></i>
      <h3 style="color:var(--text-muted);">No opportunities yet</h3>
      @auth @if(auth()->user()->role==='corporate')
      <a href="{{ route('opportunities.create') }}" class="btn btn-primary" style="margin-top:1rem;">Post First Opportunity</a>
      @endif @endauth
    </div>
    @endforelse
  </div>

  @if($opportunities->hasPages())
  <div style="display:flex;justify-content:center;margin-top:2rem;">{{ $opportunities->withQueryString()->links() }}</div>
  @endif
</div>
@endsection
