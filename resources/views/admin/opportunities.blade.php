@extends('admin.layout')
@section('title','Admin — Opportunities')
@section('admin-content')

<div style="margin-bottom:1.5rem;">
  <h1 style="font-size:1.5rem;font-weight:800;">⚡ All <span class="gradient-text">Opportunities</span></h1>
  <p style="color:var(--text-muted);font-size:.875rem;">{{ $opportunities->total() }} opportunities in MongoDB</p>
</div>

<form method="GET" style="background:var(--card);border:1px solid var(--card-border);border-radius:12px;padding:1rem;margin-bottom:1.5rem;display:flex;gap:1rem;align-items:flex-end;flex-wrap:wrap;">
  <div class="form-group" style="margin:0;flex:1;min-width:200px;">
    <label>Search</label>
    <input type="text" name="search" placeholder="Opportunity title..." value="{{ request('search') }}">
  </div>
  <div class="form-group" style="margin:0;min-width:180px;">
    <label>Type</label>
    <select name="type">
      <option value="">All Types</option>
      @foreach(['innovation_challenge'=>'Innovation Challenge','pilot_project'=>'Pilot Project','vendor_requirement'=>'Vendor Requirement','acquisition'=>'Acquisition','api_integration'=>'API Integration','procurement'=>'Procurement'] as $k=>$v)
      <option value="{{ $k }}" {{ request('type')===$k?'selected':'' }}>{{ $v }}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Filter</button>
  <a href="{{ route('admin.opportunities') }}" class="btn btn-outline btn-sm">Clear</a>
</form>

<div class="card" style="padding:0;overflow:hidden;">
  <div style="overflow-x:auto;">
    <table style="width:100%;border-collapse:collapse;">
      <thead>
        <tr style="background:rgba(255,255,255,.05);border-bottom:1px solid var(--card-border);">
          @foreach(['#','Title','Type','Industry','Budget','Applications','Views','Status','Actions'] as $h)
          <th style="padding:1rem 1.25rem;text-align:left;font-size:.75rem;font-weight:700;text-transform:uppercase;color:var(--text-muted);">{{ $h }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @forelse($opportunities as $o)
        @php
          $typeColors=['innovation_challenge'=>'#6366f1','pilot_project'=>'#a855f7','vendor_requirement'=>'#06b6d4','acquisition'=>'#ef4444','api_integration'=>'#f59e0b','procurement'=>'#10b981'];
          $tc=$typeColors[$o->type??''] ?? '#64748b';
        @endphp
        <tr style="border-bottom:1px solid rgba(255,255,255,.05);" onmouseover="this.style.background='rgba(255,255,255,.03)'" onmouseout="this.style.background='transparent'">
          <td style="padding:.9rem 1.25rem;font-size:.8rem;color:var(--text-muted);">{{ $opportunities->firstItem() + $loop->index }}</td>
          <td style="padding:.9rem 1.25rem;">
            <div style="font-weight:600;font-size:.875rem;max-width:220px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $o->title }}</div>
          </td>
          <td style="padding:.9rem 1.25rem;">
            <span class="badge" style="background:{{ $tc }}22;color:{{ $tc }};border:1px solid {{ $tc }}55;font-size:.7rem;">{{ ucwords(str_replace('_',' ',$o->type??'')) }}</span>
          </td>
          <td style="padding:.9rem 1.25rem;font-size:.85rem;">{{ $o->industry ?? '—' }}</td>
          <td style="padding:.9rem 1.25rem;font-size:.8rem;color:#10b981;font-weight:600;">
            @if($o->budget_max) ₹{{ number_format($o->budget_max/100000,0) }}L @else — @endif
          </td>
          <td style="padding:.9rem 1.25rem;font-size:.85rem;text-align:center;">{{ $o->applications_count ?? 0 }}</td>
          <td style="padding:.9rem 1.25rem;font-size:.85rem;text-align:center;">{{ number_format($o->views_count ?? 0) }}</td>
          <td style="padding:.9rem 1.25rem;">
            @if(($o->status ?? 'open') === 'open')
              <span class="badge badge-success">Open</span>
            @else
              <span class="badge badge-danger">{{ ucfirst($o->status) }}</span>
            @endif
          </td>
          <td style="padding:.9rem 1.25rem;">
            <div style="display:flex;gap:.5rem;">
              <a href="{{ route('opportunities.show', $o->id) }}" class="btn btn-outline btn-sm" target="_blank"><i class="fas fa-eye"></i></a>
              <form method="POST" action="{{ route('admin.opportunities.delete', $o->id) }}" onsubmit="return confirm('Delete this opportunity?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="9" style="padding:3rem;text-align:center;color:var(--text-muted);">No opportunities found</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@if($opportunities->hasPages())
<div style="margin-top:1.5rem;display:flex;justify-content:center;">{{ $opportunities->withQueryString()->links() }}</div>
@endif

@endsection
