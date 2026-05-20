@extends('layouts.app')
@section('title','Events & Networking')
@section('content')
<div class="container" style="padding:2rem 1.5rem;">
  <div style="text-align:center;margin-bottom:3rem;">
    <div class="badge badge-warning" style="margin-bottom:1rem;"><i class="fas fa-calendar"></i> Events & Networking</div>
    <h1 class="section-title">Innovation <span class="gradient-text">Events</span></h1>
    <p style="color:var(--text-muted);">Startup expos, demo days, hackathons, and corporate summits</p>
  </div>
  @php $events=[
    ['🚀','InnoVenture Summit 2024','The biggest startup-corporate connect event in India','June 15-17, 2024','Bangalore','5,000+',true,'fas fa-star','Flagship Event'],
    ['💡','AI Innovation Hackathon','48-hour build challenge for AI startups','July 5-7, 2024','Virtual','2,000+',true,'fas fa-laptop-code','Hackathon'],
    ['🤝','Corporate-Startup Speed Dating','Quick 10-min pitches to 50+ corporates','June 28, 2024','Mumbai','500+',false,'fas fa-handshake','Networking'],
    ['📊','FinTech Demo Day','Top 20 FinTech startups pitch to VCs','July 12, 2024','Delhi','800+',false,'fas fa-chart-line','Demo Day'],
    ['🌱','ESG Innovation Summit','Sustainability startups meet green investors','August 3, 2024','Hyderabad','1,200+',false,'fas fa-leaf','Summit'],
    ['🎓','Founder Masterclass Series','Learn from unicorn founders','Weekly Online','Virtual','Unlimited',false,'fas fa-graduation-cap','Webinar'],
  ]; @endphp
  <div class="grid-3">
    @foreach($events as $e)
    <div class="card" style="{{ $e[6] ? 'border-color:rgba(245,158,11,.4);' : '' }}">
      @if($e[6])<div class="badge badge-warning" style="margin-bottom:1rem;"><i class="{{ $e[7] }}"></i> {{ $e[8] }}</div>@endif
      <div style="font-size:2rem;margin-bottom:.75rem;">{{ $e[0] }}</div>
      <h3 style="font-weight:700;margin-bottom:.5rem;">{{ $e[1] }}</h3>
      <p style="color:var(--text-muted);font-size:.85rem;margin-bottom:1rem;line-height:1.5;">{{ $e[2] }}</p>
      <div style="display:flex;flex-direction:column;gap:.4rem;margin-bottom:1rem;">
        <div style="font-size:.8rem;color:var(--text-muted);"><i class="fas fa-calendar" style="color:var(--primary);width:16px;"></i> {{ $e[3] }}</div>
        <div style="font-size:.8rem;color:var(--text-muted);"><i class="fas fa-map-marker-alt" style="color:var(--danger);width:16px;"></i> {{ $e[4] }}</div>
        <div style="font-size:.8rem;color:var(--text-muted);"><i class="fas fa-users" style="color:var(--success);width:16px;"></i> {{ $e[5] }} attendees expected</div>
      </div>
      <div style="display:flex;gap:.75rem;">
        <button class="btn btn-primary btn-sm" style="flex:1;justify-content:center;" onclick="alert('Event registration coming soon!')"><i class="fas fa-ticket-alt"></i> Register</button>
        <button class="btn btn-outline btn-sm"><i class="fas fa-info-circle"></i></button>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
