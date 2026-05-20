@extends('layouts.app')
@section('title','Pricing')
@section('content')
<div class="container" style="padding:2rem 1.5rem;">
  <div style="text-align:center;margin-bottom:3rem;">
    <div class="badge badge-success" style="margin-bottom:1rem;"><i class="fas fa-tag"></i> Pricing</div>
    <h1 class="section-title">Simple, <span class="gradient-text">Transparent Pricing</span></h1>
    <p style="color:var(--text-muted);font-size:1.1rem;">Start free, scale as you grow</p>
  </div>
  <div class="grid-3" style="margin-bottom:4rem;align-items:start;">
    @foreach([
      ['Free','Startup Starter','₹0','/month',['5 connection requests/month','Basic profile listing','Browse opportunities','Community access'],false,'#64748b'],
      ['Growth','Startup Pro','₹2,999','/month',['Unlimited connections','Featured listing','AI match suggestions','Priority support','Pitch deck hosting','Analytics dashboard'],true,'#6366f1'],
      ['Enterprise','Corporate','₹19,999','/month',['Unlimited startup scouting','Post unlimited opportunities','Dedicated account manager','Custom AI matching','API access','Advanced analytics'],false,'#a855f7'],
    ] as $plan)
    <div class="card" style="{{ $plan[5] ? 'border-color:var(--primary);background:rgba(99,102,241,.05);transform:scale(1.03);' : '' }}">
      @if($plan[5])<div class="badge badge-primary" style="margin-bottom:1rem;"><i class="fas fa-crown"></i> Most Popular</div>@endif
      <div style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.05em;color:{{ $plan[6] }};margin-bottom:.5rem;">{{ $plan[0] }}</div>
      <h3 style="font-size:1.2rem;font-weight:700;margin-bottom:.5rem;">{{ $plan[1] }}</h3>
      <div style="margin-bottom:1.5rem;"><span style="font-size:2.5rem;font-weight:900;background:var(--gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">{{ $plan[2] }}</span><span style="color:var(--text-muted);">{{ $plan[3] }}</span></div>
      <ul style="list-style:none;margin-bottom:1.5rem;display:flex;flex-direction:column;gap:.75rem;">
        @foreach($plan[4] as $f)
        <li style="display:flex;gap:.75rem;font-size:.875rem;color:var(--text-muted);"><i class="fas fa-check-circle" style="color:#10b981;margin-top:.1rem;"></i>{{ $f }}</li>
        @endforeach
      </ul>
      <a href="{{ route('register') }}" class="btn {{ $plan[5] ? 'btn-primary' : 'btn-outline' }}" style="width:100%;justify-content:center;">Get Started</a>
    </div>
    @endforeach
  </div>
</div>
@endsection
