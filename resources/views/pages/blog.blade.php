@extends('layouts.app')
@section('title','Blog & Resources')
@section('content')
<div class="container" style="padding:2rem 1.5rem;">
  <div style="text-align:center;margin-bottom:3rem;"><div class="badge badge-cyan" style="margin-bottom:1rem;"><i class="fas fa-newspaper"></i> Knowledge Hub</div><h1 class="section-title">Insights & <span class="gradient-text">Resources</span></h1></div>
  <div class="grid-3">
    @php $posts=[
      ['🚀','How TechNova Closed a ₹50L Pilot with InnoBank in 30 Days','A step-by-step case study of how our AI matchmaking led to a landmark partnership.','Corporate Strategy','8 min read','#6366f1'],
      ['🌱','Top 10 ESG Innovation Trends Corporates Should Know in 2024','From carbon credits to circular economy — the sustainability priorities shaping corporate innovation.','Sustainability','6 min read','#10b981'],
      ['💰','How to Raise Series A: The Complete Indian Startup Playbook','Everything from term sheets to due diligence — written by founders who\'ve been through it.','Fundraising','12 min read','#a855f7'],
      ['🤖','AI is Reshaping How Corporates Scout Startups','From manual scouting to intelligent matchmaking — the future of corporate innovation.','AI & Tech','5 min read','#06b6d4'],
      ['⚖️','NDA Best Practices for Startup-Corporate Partnerships','Protect your IP while enabling open collaboration. A legal guide for founders.','Legal','7 min read','#f59e0b'],
      ['📊','How to Build a Pitch Deck That Corporates Actually Want to See','Ditch the VC template. Here\'s what corporate innovation teams really look for.','Pitching','9 min read','#ec4899'],
    ]; @endphp
    @foreach($posts as $p)
    <div class="card" style="cursor:pointer;" onclick="alert('Blog article coming soon!')">
      <div style="font-size:2rem;margin-bottom:.75rem;">{{ $p[0] }}</div>
      <div style="display:flex;gap:.5rem;margin-bottom:.75rem;">
        <span class="badge badge-primary">{{ $p[3] }}</span>
        <span style="font-size:.75rem;color:var(--text-muted);align-self:center;"><i class="fas fa-clock"></i> {{ $p[4] }}</span>
      </div>
      <h3 style="font-weight:700;font-size:.95rem;line-height:1.4;margin-bottom:.75rem;">{{ $p[1] }}</h3>
      <p style="color:var(--text-muted);font-size:.82rem;line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $p[2] }}</p>
      <div style="margin-top:1rem;padding-top:.75rem;border-top:1px solid var(--card-border);">
        <span style="font-size:.8rem;color:{{ $p[5] }};">Read more <i class="fas fa-arrow-right"></i></span>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
