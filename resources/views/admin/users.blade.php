@extends('admin.layout')
@section('title','Admin — Users')
@section('admin-content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
  <div>
    <h1 style="font-size:1.5rem;font-weight:800;">👤 All <span class="gradient-text">Users</span></h1>
    <p style="color:var(--text-muted);font-size:.875rem;">{{ $users->total() }} total registered users in MongoDB</p>
  </div>
</div>

{{-- Filters --}}
<form method="GET" style="background:var(--card);border:1px solid var(--card-border);border-radius:12px;padding:1rem;margin-bottom:1.5rem;display:flex;gap:1rem;align-items:flex-end;flex-wrap:wrap;">
  <div class="form-group" style="margin:0;flex:1;min-width:200px;">
    <label>Search name or email</label>
    <input type="text" name="search" placeholder="john@example.com" value="{{ request('search') }}">
  </div>
  <div class="form-group" style="margin:0;min-width:150px;">
    <label>Role</label>
    <select name="role">
      <option value="">All Roles</option>
      @foreach(['startup','corporate','investor','mentor','admin'] as $r)
      <option value="{{ $r }}" {{ request('role')===$r?'selected':'' }}>{{ ucfirst($r) }}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Filter</button>
  <a href="{{ route('admin.users') }}" class="btn btn-outline btn-sm">Clear</a>
</form>

{{-- Table --}}
<div class="card" style="padding:0;overflow:hidden;">
  <div style="overflow-x:auto;">
    <table style="width:100%;border-collapse:collapse;">
      <thead>
        <tr style="background:rgba(255,255,255,.05);border-bottom:1px solid var(--card-border);">
          <th style="padding:1rem 1.25rem;text-align:left;font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--text-muted);">#</th>
          <th style="padding:1rem 1.25rem;text-align:left;font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--text-muted);">Name</th>
          <th style="padding:1rem 1.25rem;text-align:left;font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--text-muted);">Email</th>
          <th style="padding:1rem 1.25rem;text-align:left;font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--text-muted);">Role</th>
          <th style="padding:1rem 1.25rem;text-align:left;font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--text-muted);">KYC</th>
          <th style="padding:1rem 1.25rem;text-align:left;font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--text-muted);">Verified</th>
          <th style="padding:1rem 1.25rem;text-align:left;font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--text-muted);">Registered</th>
          <th style="padding:1rem 1.25rem;text-align:left;font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--text-muted);">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $user)
        @php
          $roleColors = ['startup'=>'#6366f1','corporate'=>'#a855f7','investor'=>'#10b981','mentor'=>'#f59e0b','admin'=>'#ef4444'];
          $rc = $roleColors[$user->role] ?? '#64748b';
        @endphp
        <tr style="border-bottom:1px solid rgba(255,255,255,.05);transition:background .15s;" onmouseover="this.style.background='rgba(255,255,255,.03)'" onmouseout="this.style.background='transparent'">
          <td style="padding:.9rem 1.25rem;font-size:.8rem;color:var(--text-muted);">{{ $users->firstItem() + $loop->index }}</td>
          <td style="padding:.9rem 1.25rem;">
            <div style="display:flex;align-items:center;gap:.75rem;">
              <div style="width:36px;height:36px;border-radius:10px;background:{{ $rc }};display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.9rem;color:#fff;flex-shrink:0;">
                {{ strtoupper(substr($user->name,0,1)) }}
              </div>
              <span style="font-weight:600;font-size:.875rem;">{{ $user->name }}</span>
            </div>
          </td>
          <td style="padding:.9rem 1.25rem;font-size:.875rem;color:var(--text-muted);">{{ $user->email }}</td>
          <td style="padding:.9rem 1.25rem;">
            <span class="badge" style="background:{{ $rc }}22;color:{{ $rc }};border:1px solid {{ $rc }}55;">{{ ucfirst($user->role) }}</span>
          </td>
          <td style="padding:.9rem 1.25rem;">
            @if($user->kyc_status === 'verified')
              <span class="badge badge-success"><i class="fas fa-check"></i> Verified</span>
            @elseif($user->kyc_status === 'pending')
              <span class="badge badge-warning">⏳ Pending</span>
            @else
              <span class="badge badge-danger">✗ {{ ucfirst($user->kyc_status ?? 'N/A') }}</span>
            @endif
          </td>
          <td style="padding:.9rem 1.25rem;">
            @if($user->is_verified)
              <i class="fas fa-circle-check" style="color:#10b981;"></i>
            @else
              <i class="fas fa-circle-xmark" style="color:#ef4444;"></i>
            @endif
          </td>
          <td style="padding:.9rem 1.25rem;font-size:.8rem;color:var(--text-muted);">
            {{ $user->created_at ? $user->created_at->format('d M Y, H:i') : 'N/A' }}
          </td>
          <td style="padding:.9rem 1.25rem;">
            <form method="POST" action="{{ route('admin.users.delete', $user->id) }}" onsubmit="return confirm('Delete user {{ addslashes($user->name) }}?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash"></i></button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="8" style="padding:3rem;text-align:center;color:var(--text-muted);">
            <i class="fas fa-users" style="font-size:2rem;display:block;margin-bottom:.75rem;"></i> No users found
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- Pagination --}}
@if($users->hasPages())
<div style="margin-top:1.5rem;display:flex;justify-content:center;">
  {{ $users->withQueryString()->links() }}
</div>
@endif

@endsection
