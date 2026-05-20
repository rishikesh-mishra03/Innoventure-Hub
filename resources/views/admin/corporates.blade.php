@extends('admin.layout')
@section('title','Admin — Corporates')
@section('admin-content')

<div style="margin-bottom:1.5rem;">
  <h1 style="font-size:1.5rem;font-weight:800;">🏢 All <span class="gradient-text">Corporates</span></h1>
  <p style="color:var(--text-muted);font-size:.875rem;">{{ $corporates->total() }} corporates in MongoDB</p>
</div>

<form method="GET" style="background:var(--card);border:1px solid var(--card-border);border-radius:12px;padding:1rem;margin-bottom:1.5rem;display:flex;gap:1rem;align-items:flex-end;">
  <div class="form-group" style="margin:0;flex:1;">
    <label>Search</label>
    <input type="text" name="search" placeholder="Company name..." value="{{ request('search') }}">
  </div>
  <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Filter</button>
  <a href="{{ route('admin.corporates') }}" class="btn btn-outline btn-sm">Clear</a>
</form>

<div class="card" style="padding:0;overflow:hidden;">
  <div style="overflow-x:auto;">
    <table style="width:100%;border-collapse:collapse;">
      <thead>
        <tr style="background:rgba(255,255,255,.05);border-bottom:1px solid var(--card-border);">
          @foreach(['#','Company','Industry','Size','Partnerships','Inno Score','Budget Range','Verified'] as $h)
          <th style="padding:1rem 1.25rem;text-align:left;font-size:.75rem;font-weight:700;text-transform:uppercase;color:var(--text-muted);">{{ $h }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @forelse($corporates as $c)
        <tr style="border-bottom:1px solid rgba(255,255,255,.05);" onmouseover="this.style.background='rgba(255,255,255,.03)'" onmouseout="this.style.background='transparent'">
          <td style="padding:.9rem 1.25rem;font-size:.8rem;color:var(--text-muted);">{{ $corporates->firstItem() + $loop->index }}</td>
          <td style="padding:.9rem 1.25rem;">
            <div style="display:flex;align-items:center;gap:.75rem;">
              <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#a855f7,#6366f1);display:flex;align-items:center;justify-content:center;font-weight:800;color:#fff;font-size:.9rem;flex-shrink:0;">{{ strtoupper(substr($c->name,0,1)) }}</div>
              <div>
                <div style="font-weight:600;font-size:.875rem;">{{ $c->name }}</div>
                <div style="font-size:.72rem;color:var(--text-muted);">{{ $c->tagline }}</div>
              </div>
            </div>
          </td>
          <td style="padding:.9rem 1.25rem;"><span class="badge badge-purple">{{ $c->industry }}</span></td>
          <td style="padding:.9rem 1.25rem;font-size:.85rem;">{{ $c->company_size ?? '—' }}</td>
          <td style="padding:.9rem 1.25rem;font-size:.85rem;">{{ $c->partnerships_count ?? 0 }}</td>
          <td style="padding:.9rem 1.25rem;font-weight:700;color:#10b981;">{{ round($c->innovation_score ?? 0) }}</td>
          <td style="padding:.9rem 1.25rem;font-size:.8rem;color:var(--text-muted);">
            @if($c->budget_range_min || $c->budget_range_max)
              ₹{{ number_format(($c->budget_range_min??0)/100000,0) }}L — ₹{{ number_format(($c->budget_range_max??0)/100000,0) }}L
            @else —
            @endif
          </td>
          <td style="padding:.9rem 1.25rem;">
            @if($c->is_verified)
              <i class="fas fa-circle-check" style="color:#10b981;"></i>
            @else
              <i class="fas fa-circle-xmark" style="color:#ef4444;"></i>
            @endif
          </td>
        </tr>
        @empty
        <tr><td colspan="8" style="padding:3rem;text-align:center;color:var(--text-muted);">No corporates found</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@if($corporates->hasPages())
<div style="margin-top:1.5rem;display:flex;justify-content:center;">{{ $corporates->withQueryString()->links() }}</div>
@endif

@endsection
