@extends('admin.layout')
@section('title','Admin — Overview')
@section('admin-content')

<h1 style="font-size:1.8rem;font-weight:800;margin-bottom:2rem;">
  📊 Database <span class="gradient-text">Overview</span>
</h1>

{{-- Stat Cards --}}
<div class="grid-4" style="margin-bottom:3rem;">
  @foreach([
    ['fas fa-users',       'Total Users',        $stats['users'],         route('admin.users'),        '#6366f1'],
    ['fas fa-rocket',      'Total Startups',     $stats['startups'],      route('admin.startups'),     '#10b981'],
    ['fas fa-building',    'Total Corporates',   $stats['corporates'],    route('admin.corporates'),   '#a855f7'],
    ['fas fa-bolt',        'Opportunities',      $stats['opportunities'], route('admin.opportunities'),'#f59e0b'],
  ] as $s)
  <a href="{{ $s[3] }}" style="text-decoration:none;">
    <div class="card" style="text-align:center;border-top:3px solid {{ $s[4] }};cursor:pointer;">
      <div style="width:50px;height:50px;border-radius:14px;background:rgba(0,0,0,.3);display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;font-size:1.3rem;color:{{ $s[4] }};">
        <i class="{{ $s[0] }}"></i>
      </div>
      <div style="font-size:2rem;font-weight:900;color:{{ $s[4] }};">{{ $s[2] }}</div>
      <div style="color:var(--text-muted);font-size:.85rem;margin-top:.25rem;">{{ $s[1] }}</div>
    </div>
  </a>
  @endforeach
</div>

{{-- Quick Links --}}
<div class="grid-2">
  <div class="card">
    <h2 style="font-size:1rem;font-weight:700;margin-bottom:1rem;"><i class="fas fa-database" style="color:var(--primary);"></i> Collections in MongoDB</h2>
    @foreach([
      ['users',         'fas fa-users',    $stats['users'],         '#6366f1'],
      ['startups',      'fas fa-rocket',   $stats['startups'],      '#10b981'],
      ['corporates',    'fas fa-building', $stats['corporates'],    '#a855f7'],
      ['opportunities', 'fas fa-bolt',     $stats['opportunities'], '#f59e0b'],
    ] as $col)
    <div style="display:flex;align-items:center;gap:1rem;padding:.8rem 0;border-bottom:1px solid rgba(255,255,255,.05);">
      <i class="{{ $col[1] }}" style="color:{{ $col[3] }};width:18px;text-align:center;"></i>
      <span style="flex:1;font-weight:500;">{{ $col[0] }}</span>
      <span style="background:rgba(0,0,0,.3);padding:.25rem .75rem;border-radius:20px;font-size:.8rem;font-weight:700;color:{{ $col[3] }};">{{ $col[2] }} docs</span>
    </div>
    @endforeach
  </div>

  <div class="card">
    <h2 style="font-size:1rem;font-weight:700;margin-bottom:1rem;"><i class="fas fa-info-circle" style="color:var(--accent);"></i> Connection Info</h2>
    @foreach([
      ['Driver',    'MongoDB'],
      ['Host',      env('DB_HOST','127.0.0.1')],
      ['Port',      env('DB_PORT','27017')],
      ['Database',  env('DB_DATABASE','innoventure_hub')],
      ['Status',    '✅ Connected'],
    ] as $info)
    <div style="display:flex;justify-content:space-between;padding:.75rem 0;border-bottom:1px solid rgba(255,255,255,.05);font-size:.875rem;">
      <span style="color:var(--text-muted);">{{ $info[0] }}</span>
      <span style="font-weight:600;">{{ $info[1] }}</span>
    </div>
    @endforeach
  </div>
</div>

@endsection
