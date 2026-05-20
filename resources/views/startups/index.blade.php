@extends('layouts.app')
@section('title','Browse Startups')
@section('content')
<div class="container" style="padding:2rem 1.5rem;">
  <!-- Header -->
  <div style="margin-bottom:2rem;">
    <div class="badge badge-primary" style="margin-bottom:.75rem;"><i class="fas fa-rocket"></i> Startup Discovery</div>
    <div style="display:flex;justify-content:space-between;align-items:flex-end;">
      <div>
        <h1 style="font-size:2rem;font-weight:800;">Discover <span class="gradient-text">Startups</span></h1>
        <p style="color:var(--text-muted);">Browse {{ $startups->total() }} innovative startups ready to partner</p>
      </div>
      @auth @if(auth()->user()->role==='startup')
      <a href="{{ route('startups.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> List My Startup</a>
      @endif @endauth
    </div>
  </div>

  <!-- Filters -->
  <form method="GET" style="background:var(--card);border:1px solid var(--card-border);border-radius:16px;padding:1.5rem;margin-bottom:2rem;">
    <div style="display:grid;grid-template-columns:2fr 1fr 1fr auto auto;gap:1rem;align-items:end;">
      <div class="form-group" style="margin:0;">
        <label>Search Startups</label>
        <input type="text" name="search" placeholder="Search by name, industry..." value="{{ request('search') }}" style="margin:0;">
      </div>
      <div class="form-group" style="margin:0;">
        <label>Industry</label>
        <select name="industry" style="margin:0;">
          <option value="">All Industries</option>
          @foreach($industries as $ind)
          <option value="{{ $ind }}" {{ request('industry')===$ind?'selected':'' }}>{{ $ind }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group" style="margin:0;">
        <label>Funding Stage</label>
        <select name="stage" style="margin:0;">
          <option value="">All Stages</option>
          @foreach($stages as $s)
          <option value="{{ $s }}" {{ request('stage')===$s?'selected':'' }}>{{ $s }}</option>
          @endforeach
        </select>
      </div>
      <div style="display:flex;gap:.5rem;align-items:flex-end;">
        <label style="display:flex;align-items:center;gap:.4rem;font-size:.8rem;color:var(--text-muted);cursor:pointer;margin:0;padding:.75rem 0;">
          <input type="checkbox" name="women_led" {{ request('women_led')?'checked':'' }} style="width:auto;"> Women-led
        </label>
        <label style="display:flex;align-items:center;gap:.4rem;font-size:.8rem;color:var(--text-muted);cursor:pointer;margin:0;padding:.75rem 0;">
          <input type="checkbox" name="esg" {{ request('esg')?'checked':'' }} style="width:auto;"> ESG
        </label>
      </div>
      <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
    </div>
  </form>

  <!-- Quick Filter Tags -->
  <div style="display:flex;gap:.75rem;flex-wrap:wrap;margin-bottom:2rem;">
    <span style="color:var(--text-muted);font-size:.85rem;align-self:center;">Trending:</span>
    @foreach(['AI/ML','FinTech','CleanTech','HealthTech','SaaS','Blockchain','EdTech'] as $tag)
    <a href="?industry={{ $tag }}" class="btn btn-outline btn-sm" style="border-radius:20px;padding:.3rem .9rem;">{{ $tag }}</a>
    @endforeach
  </div>

  <!-- Results Grid -->
  <div class="grid-3">
    @forelse($startups as $s)
    <div class="card" style="display:flex;flex-direction:column;">
      <!-- Card Header -->
      <div style="display:flex;align-items:flex-start;gap:1rem;margin-bottom:1rem;">
        <div style="width:56px;height:56px;border-radius:14px;background:linear-gradient(135deg,{{ ['#6366f1','#a855f7','#06b6d4','#10b981','#f59e0b'][array_rand(['#6366f1','#a855f7','#06b6d4','#10b981','#f59e0b'])] }},{{ ['#4f46e5','#9333ea','#0891b2','#059669','#d97706'][array_rand(['#4f46e5','#9333ea','#0891b2','#059669','#d97706'])] }});display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0;">
          @if($s->logo) <img src="{{ $s->logo }}" style="width:100%;height:100%;object-fit:cover;border-radius:14px;">
          @else {{ strtoupper(substr($s->name,0,1)) }} @endif
        </div>
        <div style="flex:1;min-width:0;">
          <div style="display:flex;align-items:center;gap:.5rem;flex-wrap:wrap;">
            <h3 style="font-weight:700;font-size:1rem;">{{ $s->name }}</h3>
            @if($s->is_verified)<i class="fas fa-circle-check" style="color:#06b6d4;" title="Verified"></i>@endif
          </div>
          <p style="color:var(--text-muted);font-size:.8rem;margin-top:.25rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $s->tagline }}</p>
        </div>
        <div style="text-align:right;flex-shrink:0;">
          <div style="font-size:1.2rem;font-weight:800;color:#10b981;">{{ rand(70,97) }}%</div>
          <div style="font-size:.65rem;color:var(--text-muted);">Match</div>
        </div>
      </div>

      <!-- Tags -->
      <div style="margin-bottom:1rem;">
        <span class="badge badge-primary">{{ $s->industry }}</span>
        <span class="badge badge-warning" style="margin-left:.4rem;">{{ $s->funding_stage }}</span>
        @if($s->women_led)<span class="badge badge-purple" style="margin-left:.4rem;">👩 Women-led</span>@endif
        @if($s->esg_focus)<span class="badge badge-success" style="margin-left:.4rem;">🌱 ESG</span>@endif
      </div>

      <!-- Description -->
      <p style="color:var(--text-muted);font-size:.85rem;line-height:1.5;flex:1;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;">{{ $s->description ?? $s->problem_solving }}</p>

      <!-- Metrics -->
      <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:.5rem;margin:1rem 0;padding:.75rem;background:rgba(255,255,255,.03);border-radius:8px;">
        <div style="text-align:center;">
          <div style="font-size:.8rem;font-weight:700;">{{ $s->team_size ?? '5-10' }}</div>
          <div style="font-size:.65rem;color:var(--text-muted);">Team</div>
        </div>
        <div style="text-align:center;border-left:1px solid var(--card-border);">
          <div style="font-size:.8rem;font-weight:700;">{{ $s->founded_year ?? '2022' }}</div>
          <div style="font-size:.65rem;color:var(--text-muted);">Founded</div>
        </div>
        <div style="text-align:center;border-left:1px solid var(--card-border);">
          <div style="font-size:.8rem;font-weight:700;">{{ number_format($s->profile_views ?? rand(100,5000)) }}</div>
          <div style="font-size:.65rem;color:var(--text-muted);">Views</div>
        </div>
      </div>

      <!-- Actions -->
      <div style="display:flex;gap:.75rem;">
        <a href="{{ route('startups.show', $s->id) }}" class="btn btn-primary btn-sm" style="flex:1;justify-content:center;">View Profile</a>
        <button class="btn btn-outline btn-sm" title="Save"><i class="fas fa-bookmark"></i></button>
        <button class="btn btn-outline btn-sm" title="Connect"><i class="fas fa-paper-plane"></i></button>
      </div>
    </div>
    @empty
    <div style="grid-column:1/-1;text-align:center;padding:4rem;">
      <i class="fas fa-rocket" style="font-size:3rem;color:var(--text-muted);margin-bottom:1rem;display:block;"></i>
      <h3 style="color:var(--text-muted);">No startups found</h3>
      <p style="color:var(--text-muted);margin:.5rem 0 1.5rem;">Try adjusting your filters or <a href="{{ route('startups.create') }}" style="color:var(--primary);">list the first startup</a></p>
    </div>
    @endforelse
  </div>

  <!-- Pagination -->
  @if($startups->hasPages())
  <div style="display:flex;justify-content:center;margin-top:2rem;">
    {{ $startups->withQueryString()->links() }}
  </div>
  @endif
</div>
@endsection
