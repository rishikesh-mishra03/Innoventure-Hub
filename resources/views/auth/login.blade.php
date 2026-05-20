@extends('layouts.app')
@section('title','Login')
@section('content')
<div style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:2rem;">
  <div style="position:fixed;inset:0;background:radial-gradient(ellipse at 30% 40%,rgba(99,102,241,.2),transparent 60%),radial-gradient(ellipse at 70% 70%,rgba(168,85,247,.15),transparent 60%);pointer-events:none;"></div>
  <div style="width:100%;max-width:480px;position:relative;z-index:1;">
    <div style="text-align:center;margin-bottom:2.5rem;">
      <a href="{{ route('home') }}" class="nav-brand" style="justify-content:center;text-decoration:none;margin-bottom:1.5rem;display:flex;">
        <div class="nav-logo" style="width:52px;height:52px;font-size:1.5rem;"><i class="fas fa-rocket"></i></div>
        <span class="nav-brand-text" style="font-size:1.6rem;">InnoVenture Hub</span>
      </a>
      <h1 style="font-size:1.8rem;font-weight:800;margin-bottom:.5rem;">Welcome Back</h1>
      <p style="color:var(--text-muted);">Sign in to continue your innovation journey</p>
    </div>

    @if($errors->any())
    <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}</div>
    @endif

    <!-- Demo Login Buttons -->
    <div style="background:var(--card);border:1px solid var(--card-border);border-radius:16px;padding:1.5rem;margin-bottom:1.5rem;">
      <p style="font-size:.8rem;color:var(--text-muted);text-align:center;margin-bottom:1rem;font-weight:600;text-transform:uppercase;letter-spacing:.05em;">Quick Demo Access</p>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;">
        @foreach([['startup','#6366f1','fas fa-rocket','Startup'],['corporate','#a855f7','fas fa-building','Corporate'],['investor','#10b981','fas fa-coins','Investor'],['admin','#f59e0b','fas fa-shield-alt','Admin']] as $d)
        <a href="{{ route('demo.login') }}?role={{ $d[0] }}" style="display:flex;align-items:center;gap:.5rem;padding:.65rem 1rem;background:rgba({{$d[0]=='startup'?'99,102,241':($d[0]=='corporate'?'168,85,247':($d[0]=='investor'?'16,185,129':'245,158,11'))}},.15);border:1px solid rgba({{$d[0]=='startup'?'99,102,241':($d[0]=='corporate'?'168,85,247':($d[0]=='investor'?'16,185,129':'245,158,11'))}},.3);border-radius:10px;text-decoration:none;color:var(--text);font-size:.82rem;font-weight:600;transition:all .2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
          <i class="{{ $d[2] }}" style="color:{{ $d[1] }};"></i> {{ $d[3] }}
        </a>
        @endforeach
      </div>
    </div>

    <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem;">
      <div style="flex:1;height:1px;background:var(--card-border);"></div>
      <span style="color:var(--text-muted);font-size:.8rem;">or login with email</span>
      <div style="flex:1;height:1px;background:var(--card-border);"></div>
    </div>

    <div class="card" style="padding:2rem;">
      <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="form-group">
          <label><i class="fas fa-envelope"></i> Email Address</label>
          <input type="email" name="email" placeholder="you@company.com" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
          <label><i class="fas fa-lock"></i> Password</label>
          <div style="position:relative;">
            <input type="password" id="pwd" name="password" placeholder="••••••••" required>
            <button type="button" onclick="togglePwd()" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:var(--text-muted);cursor:pointer;"><i class="fas fa-eye" id="eye"></i></button>
          </div>
        </div>
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
          <label style="display:flex;align-items:center;gap:.5rem;margin:0;cursor:pointer;color:var(--text-muted);font-size:.85rem;">
            <input type="checkbox" name="remember" style="width:auto;"> Remember me
          </label>
          <a href="#" style="color:var(--primary);font-size:.85rem;text-decoration:none;">Forgot password?</a>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;font-size:1rem;padding:.9rem;">
          <i class="fas fa-sign-in-alt"></i> Sign In
        </button>
      </form>
    </div>

    <p style="text-align:center;margin-top:1.5rem;color:var(--text-muted);font-size:.9rem;">
      Don't have an account? <a href="{{ route('register') }}" style="color:var(--primary);font-weight:600;">Sign up free</a>
    </p>
  </div>
</div>
@endsection
@section('scripts')
<script>
function togglePwd(){
  const i=document.getElementById('pwd'),e=document.getElementById('eye');
  i.type=i.type==='password'?'text':'password';
  e.className=i.type==='password'?'fas fa-eye':'fas fa-eye-slash';
}
</script>
@endsection
