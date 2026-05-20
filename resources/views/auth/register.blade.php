@extends('layouts.app')
@section('title','Register')
@section('content')
<div style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:6rem 2rem 2rem;">
  <div style="position:fixed;inset:0;background:radial-gradient(ellipse at 70% 30%,rgba(168,85,247,.2),transparent 60%),radial-gradient(ellipse at 30% 70%,rgba(6,182,212,.15),transparent 60%);pointer-events:none;"></div>
  <div style="width:100%;max-width:560px;position:relative;z-index:1;">
    <div style="text-align:center;margin-bottom:2rem;">
      <h1 style="font-size:2rem;font-weight:800;margin-bottom:.5rem;">Join <span class="gradient-text">InnoVenture Hub</span></h1>
      <p style="color:var(--text-muted);">Start connecting with the innovation ecosystem</p>
    </div>

    @if($errors->any())
    <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}</div>
    @endif

    <!-- Role Selector -->
    <div style="margin-bottom:1.5rem;">
      <p style="font-size:.85rem;color:var(--text-muted);margin-bottom:.75rem;font-weight:600;">I am joining as:</p>
      <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:.75rem;" id="roleSelector">
        @foreach([['startup','fas fa-rocket','Startup','#6366f1'],['corporate','fas fa-building','Corporate','#a855f7'],['investor','fas fa-coins','Investor','#10b981'],['mentor','fas fa-graduation-cap','Mentor','#f59e0b']] as $r)
        <div class="role-card" data-role="{{ $r[0] }}" onclick="selectRole('{{ $r[0] }}')" style="background:var(--card);border:2px solid var(--card-border);border-radius:12px;padding:1rem;text-align:center;cursor:pointer;transition:all .3s;">
          <i class="{{ $r[2] }}" style="font-size:1.5rem;color:{{ $r[3] }};margin-bottom:.5rem;display:block;"></i>
          <div style="font-size:.85rem;font-weight:600;">{{ $r[1] }}</div>
        </div>
        @endforeach
      </div>
    </div>

    <div class="card" style="padding:2rem;">
      <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <input type="hidden" name="role" id="roleInput" value="{{ old('role','startup') }}">
        <div class="grid-2">
          <div class="form-group">
            <label><i class="fas fa-user"></i> Full Name</label>
            <input type="text" name="name" placeholder="John Smith" value="{{ old('name') }}" required>
          </div>
          <div class="form-group">
            <label><i class="fas fa-envelope"></i> Email</label>
            <input type="email" name="email" placeholder="you@company.com" value="{{ old('email') }}" required>
          </div>
        </div>
        <div class="grid-2">
          <div class="form-group">
            <label><i class="fas fa-lock"></i> Password</label>
            <input type="password" name="password" placeholder="Min. 8 characters" required>
          </div>
          <div class="form-group">
            <label><i class="fas fa-lock"></i> Confirm Password</label>
            <input type="password" name="password_confirmation" placeholder="Repeat password" required>
          </div>
        </div>
        <div class="form-group">
          <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer;margin:0;">
            <input type="checkbox" required style="width:auto;"> 
            <span style="color:var(--text-muted);font-size:.85rem;">I agree to the <a href="#" style="color:var(--primary);">Terms of Service</a> and <a href="#" style="color:var(--primary);">Privacy Policy</a></span>
          </label>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;font-size:1rem;padding:.9rem;">
          <i class="fas fa-rocket"></i> Create My Account
        </button>
      </form>
    </div>

    <p style="text-align:center;margin-top:1.5rem;color:var(--text-muted);font-size:.9rem;">
      Already have an account? <a href="{{ route('login') }}" style="color:var(--primary);font-weight:600;">Sign in</a>
    </p>
  </div>
</div>
@endsection
@section('scripts')
<script>
const roleColors={'startup':'99,102,241','corporate':'168,85,247','investor':'16,185,129','mentor':'245,158,11'};
function selectRole(role){
  document.getElementById('roleInput').value=role;
  document.querySelectorAll('.role-card').forEach(c=>{
    const r=c.dataset.role;
    if(r===role){c.style.borderColor=`rgb(${roleColors[r]})`;c.style.background=`rgba(${roleColors[r]},.15)`;}
    else{c.style.borderColor='var(--card-border)';c.style.background='var(--card)';}
  });
}
// Init with startup selected
selectRole('{{ old("role","startup") }}');
</script>
@endsection
