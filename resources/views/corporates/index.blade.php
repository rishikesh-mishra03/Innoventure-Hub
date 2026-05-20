@extends('layouts.app')
@section('title','Browse Corporates')
@section('content')
<div class="container" style="padding:2rem 1.5rem;">
  <div style="margin-bottom:2rem;">
    <div class="badge badge-purple" style="margin-bottom:.75rem;"><i class="fas fa-building"></i> Corporate Partners</div>
    <div style="display:flex;justify-content:space-between;align-items:flex-end;">
      <div>
        <h1 style="font-size:2rem;font-weight:800;">Find <span class="gradient-text">Corporate Partners</span></h1>
        <p style="color:var(--text-muted);">{{ $corporates->total() }} corporates actively seeking startup partnerships</p>
      </div>
      @auth @if(auth()->user()->role==='corporate')
      <a href="{{ route('corporates.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> List My Company</a>
      @endif @endauth
    </div>
  </div>
  <form method="GET" style="background:var(--card);border:1px solid var(--card-border);border-radius:16px;padding:1.25rem;margin-bottom:2rem;">
    <div style="display:grid;grid-template-columns:2fr 1fr auto;gap:1rem;align-items:end;">
      <div class="form-group" style="margin:0;"><label>Search</label><input type="text" name="search" placeholder="Search corporates..." value="{{ request('search') }}"></div>
      <div class="form-group" style="margin:0;"><label>Industry</label>
        <select name="industry">
          <option value="">All Industries</option>
          @foreach($industries as $i)<option value="{{ $i }}" {{ request('industry')===$i?'selected':'' }}>{{ $i }}</option>@endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
    </div>
  </form>
  <div class="grid-3">
    @forelse($corporates as $corp)
    <div class="card">
      <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1rem;">
        <div style="width:56px;height:56px;border-radius:14px;background:linear-gradient(135deg,#a855f7,#6366f1);display:flex;align-items:center;justify-content:center;font-size:1.5rem;font-weight:900;flex-shrink:0;">{{ strtoupper(substr($corp->name,0,1)) }}</div>
        <div>
          <div style="display:flex;align-items:center;gap:.5rem;">
            <h3 style="font-weight:700;font-size:1rem;">{{ $corp->name }}</h3>
            @if($corp->is_verified)<i class="fas fa-circle-check" style="color:#06b6d4;font-size:.8rem;"></i>@endif
          </div>
          <span class="badge badge-purple" style="font-size:.7rem;">{{ $corp->industry }}</span>
        </div>
        <div style="margin-left:auto;text-align:center;">
          <div style="font-size:1.1rem;font-weight:800;color:#6366f1;">{{ rand(70,96) }}%</div>
          <div style="font-size:.65rem;color:var(--text-muted);">Match</div>
        </div>
      </div>
      <p style="color:var(--text-muted);font-size:.85rem;line-height:1.5;margin-bottom:1rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $corp->tagline ?? $corp->description }}</p>
      <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:.5rem;margin-bottom:1rem;padding:.75rem;background:rgba(255,255,255,.03);border-radius:8px;">
        <div style="text-align:center;"><div style="font-size:.8rem;font-weight:700;">{{ $corp->company_size ?? '1000+' }}</div><div style="font-size:.65rem;color:var(--text-muted);">Employees</div></div>
        <div style="text-align:center;border-left:1px solid var(--card-border);"><div style="font-size:.8rem;font-weight:700;">{{ $corp->partnerships_count ?? rand(5,40) }}</div><div style="font-size:.65rem;color:var(--text-muted);">Partners</div></div>
        <div style="text-align:center;border-left:1px solid var(--card-border);"><div style="font-size:.8rem;font-weight:700;color:#10b981;">{{ round($corp->innovation_score ?? rand(70,95)) }}</div><div style="font-size:.65rem;color:var(--text-muted);">Inno Score</div></div>
      </div>
      @if($corp->preferred_industries && count($corp->preferred_industries))
      <div style="margin-bottom:1rem;">
        @foreach(array_slice($corp->preferred_industries,0,3) as $ind)
        <span class="tag">{{ $ind }}</span>
        @endforeach
      </div>
      @endif
      <div style="display:flex;gap:.75rem;">
        <a href="{{ route('corporates.show',$corp->id) }}" class="btn btn-primary btn-sm" style="flex:1;justify-content:center;">View Profile</a>
        <button class="btn btn-outline btn-sm" title="Save"><i class="fas fa-bookmark"></i></button>
      </div>
    </div>
    @empty
    <div style="grid-column:1/-1;text-align:center;padding:4rem;background:var(--card);border:1px solid var(--card-border);border-radius:16px;color:var(--text-muted);">
      <i class="fas fa-building" style="font-size:3rem;margin-bottom:1rem;display:block;"></i> No corporates found
    </div>
    @endforelse
  </div>
  @if($corporates->hasPages())
  <div style="display:flex;justify-content:center;margin-top:2rem;">{{ $corporates->withQueryString()->links() }}</div>
  @endif
</div>
@endsection
