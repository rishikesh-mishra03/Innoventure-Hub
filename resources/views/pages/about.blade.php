@extends('layouts.app')
@section('title','About InnoVenture Hub')
@section('content')
<div class="container" style="padding:2rem 1.5rem;">
  <div style="text-align:center;margin-bottom:4rem;padding:3rem 0;">
    <div class="badge badge-primary" style="margin-bottom:1rem;"><i class="fas fa-info-circle"></i> About Us</div>
    <h1 class="section-title">Bridging the Gap Between<br><span class="gradient-text">Startups & Corporates</span></h1>
    <p style="color:var(--text-muted);font-size:1.1rem;max-width:700px;margin:0 auto;">InnoVenture Hub was built on a simple belief: the best innovations happen when agile startups and resource-rich corporates come together. We make that collaboration effortless, intelligent, and impactful.</p>
  </div>
  <div class="grid-4" style="margin-bottom:4rem;">
    @foreach([['2022','Year Founded'],['12,400+','Members'],['₹480Cr+','Deals'],['95%','Match Accuracy']] as $s)
    <div class="stat-card"><div class="stat-value">{{ $s[0] }}</div><div class="stat-label">{{ $s[1] }}</div></div>
    @endforeach
  </div>
  <div class="grid-3" style="margin-bottom:4rem;">
    @foreach([
      ['fas fa-brain','AI-First Approach','Every match, recommendation and insight is powered by our proprietary AI engine trained on thousands of successful partnerships.','#6366f1'],
      ['fas fa-shield-alt','Trust & Verification','Multi-layer verification including KYC, company checks, LinkedIn verification and fraud detection ensures every member is genuine.','#10b981'],
      ['fas fa-globe','Global Ecosystem','Connecting innovators across India, SEA, Europe and North America in one unified platform.','#a855f7'],
    ] as $v)
    <div class="card" style="text-align:center;padding:2.5rem;">
      <div style="width:64px;height:64px;border-radius:20px;background:rgba(0,0,0,.3);display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;font-size:1.8rem;color:{{ $v[3] }};"><i class="{{ $v[0] }}"></i></div>
      <h3 style="font-size:1.1rem;font-weight:700;margin-bottom:.75rem;">{{ $v[1] }}</h3>
      <p style="color:var(--text-muted);font-size:.9rem;line-height:1.6;">{{ $v[2] }}</p>
    </div>
    @endforeach
  </div>
  <div style="background:linear-gradient(135deg,rgba(99,102,241,.15),rgba(168,85,247,.1));border:1px solid var(--card-border);border-radius:20px;padding:3rem;text-align:center;">
    <h2 style="font-size:1.8rem;font-weight:800;margin-bottom:1rem;">Ready to <span class="gradient-text">Join Us?</span></h2>
    <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;margin-top:1.5rem;">
      <a href="{{ route('register') }}" class="btn btn-primary">Get Started Free</a>
      <a href="{{ route('contact') }}" class="btn btn-outline">Contact Us</a>
    </div>
  </div>
</div>
@endsection
