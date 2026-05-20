@extends('admin.layout')
@section('title','Admin — Startups')
@section('admin-content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
  <div>
    <h1 style="font-size:1.5rem;font-weight:800;">🚀 All <span class="gradient-text">Startups</span></h1>
    <p style="color:var(--text-muted);font-size:.875rem;">{{ $startups->total() }} startups stored in MongoDB</p>
  </div>
</div>

<form method="GET" style="background:var(--card);border:1px solid var(--card-border);border-radius:12px;padding:1rem;margin-bottom:1.5rem;display:flex;gap:1rem;align-items:flex-end;flex-wrap:wrap;">
  <div class="form-group" style="margin:0;flex:1;min-width:200px;">
    <label>Search</label>
    <input type="text" name="search" placeholder="Startup name..." value="{{ request('search') }}">
  </div>
  <div class="form-group" style="margin:0;min-width:160px;">
    <label>Industry</label>
    <select name="industry">
      <option value="">All</option>
      @foreach(['AI/ML','FinTech','HealthTech','CleanTech','EdTech','SaaS','Blockchain','Cybersecurity','AgriTech','Logistics','PropTech','LegalTech'] as $ind)
      <option value="{{ $ind }}" {{ request('industry')===$ind?'selected':'' }}>{{ $ind }}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Filter</button>
  <a href="{{ route('admin.startups') }}" class="btn btn-outline btn-sm">Clear</a>
</form>

<div class="card" style="padding:0;overflow:hidden;">
  <div style="overflow-x:auto;">
    <table style="width:100%;border-collapse:collapse;">
      <thead>
        <tr style="background:rgba(255,255,255,.05);border-bottom:1px solid var(--card-border);">
          @foreach(['#','Name','Industry','Stage','Team','Location','Views','Credibility','Verified','Actions'] as $h)
          <th style="padding:1rem 1.25rem;text-align:left;font-size:.75rem;font-weight:700;text-transform:uppercase;color:var(--text-muted);">{{ $h }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @forelse($startups as $s)
        <tr style="border-bottom:1px solid rgba(255,255,255,.05);" onmouseover="this.style.background='rgba(255,255,255,.03)'" onmouseout="this.style.background='transparent'">
          <td style="padding:.9rem 1.25rem;font-size:.8rem;color:var(--text-muted);">{{ $startups->firstItem() + $loop->index }}</td>
          <td style="padding:.9rem 1.25rem;">
            <div style="display:flex;align-items:center;gap:.75rem;">
              <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#6366f1,#a855f7);display:flex;align-items:center;justify-content:center;font-weight:800;color:#fff;font-size:.9rem;flex-shrink:0;">{{ strtoupper(substr($s->name,0,1)) }}</div>
              <div>
                <div style="font-weight:600;font-size:.875rem;">{{ $s->name }}</div>
                <div style="font-size:.72rem;color:var(--text-muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:180px;">{{ $s->tagline }}</div>
              </div>
            </div>
          </td>
          <td style="padding:.9rem 1.25rem;"><span class="badge badge-primary">{{ $s->industry }}</span></td>
          <td style="padding:.9rem 1.25rem;font-size:.85rem;">{{ $s->funding_stage }}</td>
          <td style="padding:.9rem 1.25rem;font-size:.85rem;">{{ $s->team_size ?? '—' }}</td>
          <td style="padding:.9rem 1.25rem;font-size:.8rem;color:var(--text-muted);">{{ $s->headquarters ?? '—' }}</td>
          <td style="padding:.9rem 1.25rem;font-size:.85rem;">{{ number_format($s->profile_views ?? 0) }}</td>
          <td style="padding:.9rem 1.25rem;">
            <span style="font-weight:700;color:#10b981;">{{ round($s->credibility_score ?? 0) }}%</span>
          </td>
          <td style="padding:.9rem 1.25rem;">
            @if($s->is_verified)
              <i class="fas fa-circle-check" style="color:#10b981;"></i>
            @else
              <i class="fas fa-circle-xmark" style="color:#ef4444;"></i>
            @endif
          </td>
          <td style="padding:.9rem 1.25rem;">
            <div style="display:flex;gap:.5rem;">
              <a href="{{ route('startups.show', $s->id) }}" class="btn btn-outline btn-sm" title="View" target="_blank"><i class="fas fa-eye"></i></a>
              <form method="POST" action="{{ route('admin.startups.delete', $s->id) }}" onsubmit="return confirm('Delete startup {{ addslashes($s->name) }}?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="10" style="padding:3rem;text-align:center;color:var(--text-muted);">No startups found</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@if($startups->hasPages())
<div style="margin-top:1.5rem;display:flex;justify-content:center;">{{ $startups->withQueryString()->links() }}</div>
@endif

@endsection
