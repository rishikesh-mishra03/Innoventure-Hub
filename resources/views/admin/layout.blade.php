@extends('layouts.app')
@section('title', 'Admin Panel')
@section('content')

{{-- Admin Sidebar Layout --}}
<div style="display:flex;min-height:calc(100vh - 80px);">

  {{-- Sidebar --}}
  <div style="width:240px;background:var(--dark-2);border-right:1px solid var(--card-border);padding:1.5rem 1rem;flex-shrink:0;position:sticky;top:80px;height:calc(100vh - 80px);overflow-y:auto;">
    <div style="margin-bottom:1.5rem;">
      <div class="badge badge-danger" style="margin-bottom:.5rem;"><i class="fas fa-shield-alt"></i> Admin Panel</div>
      <div style="font-size:.8rem;color:var(--text-muted);">Logged as: {{ auth()->user()->name ?? 'Admin' }}</div>
    </div>

    <nav>
      <a href="{{ route('admin.index') }}"         class="sidebar-link {{ request()->routeIs('admin.index')        ? 'active' : '' }}"><i class="fas fa-th-large"></i> Overview</a>
      <a href="{{ route('admin.users') }}"         class="sidebar-link {{ request()->routeIs('admin.users')        ? 'active' : '' }}"><i class="fas fa-users"></i> Users</a>
      <a href="{{ route('admin.startups') }}"      class="sidebar-link {{ request()->routeIs('admin.startups')     ? 'active' : '' }}"><i class="fas fa-rocket"></i> Startups</a>
      <a href="{{ route('admin.corporates') }}"    class="sidebar-link {{ request()->routeIs('admin.corporates')   ? 'active' : '' }}"><i class="fas fa-building"></i> Corporates</a>
      <a href="{{ route('admin.opportunities') }}" class="sidebar-link {{ request()->routeIs('admin.opportunities')? 'active' : '' }}"><i class="fas fa-bolt"></i> Opportunities</a>
    </nav>

    <hr style="border-color:var(--card-border);margin:1.5rem 0;">

    <a href="{{ route('home') }}" class="sidebar-link"><i class="fas fa-external-link-alt"></i> Back to Site</a>
  </div>

  {{-- Main Content --}}
  <div style="flex:1;padding:2rem;overflow-y:auto;">
    @if(session('success'))
    <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif

    @yield('admin-content')
  </div>
</div>
@endsection
