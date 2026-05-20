@extends('layouts.app')
@section('title','How It Works')
@section('content')
<div class="container" style="padding:2rem 1.5rem;">
  <div style="text-align:center;margin-bottom:3rem;"><div class="badge badge-cyan" style="margin-bottom:1rem;"><i class="fas fa-play"></i> How It Works</div><h1 class="section-title">Your Path to <span class="gradient-text">Innovation Partnership</span></h1></div>
  @foreach([['fas fa-user-plus','Create Your Profile','Sign up and build your profile in under 10 minutes. Startups add their pitch, tech stack, traction and team. Corporates list their innovation goals, procurement needs and budget ranges.','#6366f1',true],['fas fa-brain','Get AI-Matched','Our engine runs 50+ compatibility checks — industry fit, tech alignment, ESG goals, funding stage, geography and more — and surfaces your top matches daily.','#a855f7',false],['fas fa-comments','Connect & Communicate','One-click NDA, real-time messaging, video calls and smart meeting scheduling. Every interaction is secure and logged for compliance.','#06b6d4',true],['fas fa-handshake','Close the Deal','Submit proposals, manage applications, track deal pipeline, sign contracts digitally and measure partnership ROI — all inside the platform.','#10b981',false]] as $step)
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;margin-bottom:4rem;{{ $step[4] ? '' : 'direction:rtl;' }}">
    <div style="{{ $step[4] ? '' : 'direction:ltr;' }}">
      <div style="width:60px;height:60px;border-radius:16px;background:rgba(0,0,0,.3);display:flex;align-items:center;justify-content:center;font-size:1.5rem;color:{{ $step[4] }};margin-bottom:1rem;"><i class="{{ $step[0] }}" style="color:{{ $step[3] }};"></i></div>
      <div style="display:inline-block;background:{{ $step[3] }}20;color:{{ $step[3] }};padding:.25rem .75rem;border-radius:20px;font-size:.8rem;font-weight:700;margin-bottom:.75rem;">Step {{ $loop->iteration }}</div>
      <h2 style="font-size:1.6rem;font-weight:800;margin-bottom:.75rem;">{{ $step[1] }}</h2>
      <p style="color:var(--text-muted);line-height:1.7;">{{ $step[2] }}</p>
    </div>
    <div style="{{ $step[4] ? '' : 'direction:ltr;' }}">
      <div style="background:var(--card);border:1px solid var(--card-border);border-radius:20px;padding:2rem;height:200px;display:flex;align-items:center;justify-content:center;">
        <i class="{{ $step[0] }}" style="font-size:5rem;color:{{ $step[3] }};opacity:.3;"></i>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection
