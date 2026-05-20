@extends('layouts.app')
@section('title','Contact Us')
@section('content')
<div class="container" style="padding:2rem 1.5rem;max-width:900px;">
  <div style="text-align:center;margin-bottom:3rem;"><div class="badge badge-purple" style="margin-bottom:1rem;"><i class="fas fa-envelope"></i> Contact</div><h1 class="section-title">Get in <span class="gradient-text">Touch</span></h1></div>
  <div class="grid-2" style="align-items:start;">
    <div class="card">
      <h2 style="font-size:1.2rem;font-weight:700;margin-bottom:1.5rem;">Send us a message</h2>
      <form onsubmit="event.preventDefault();alert('Thank you! We will respond within 24 hours.')">
        <div class="form-group"><label>Name</label><input type="text" placeholder="Your name" required></div>
        <div class="form-group"><label>Email</label><input type="email" placeholder="you@company.com" required></div>
        <div class="form-group"><label>Subject</label>
          <select><option>General Inquiry</option><option>Partnership</option><option>Technical Support</option><option>Press/Media</option><option>Investor Relations</option></select>
        </div>
        <div class="form-group"><label>Message</label><textarea rows="5" placeholder="How can we help?" required></textarea></div>
        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;"><i class="fas fa-paper-plane"></i> Send Message</button>
      </form>
    </div>
    <div>
      @foreach([['fas fa-envelope','Email','hello@innoventurehub.com','#6366f1'],['fas fa-phone','Phone','+91 98765 43210','#a855f7'],['fas fa-map-marker-alt','Office','InnoVenture Hub, Koramangala, Bangalore 560034','#06b6d4'],['fas fa-clock','Hours','Mon-Fri, 9am - 6pm IST','#10b981']] as $c)
      <div class="card" style="margin-bottom:1rem;display:flex;gap:1rem;align-items:center;">
        <div style="width:44px;height:44px;border-radius:12px;background:rgba(0,0,0,.3);display:flex;align-items:center;justify-content:center;color:{{ $c[3] }};flex-shrink:0;"><i class="{{ $c[0] }}"></i></div>
        <div><div style="font-size:.75rem;color:var(--text-muted);">{{ $c[1] }}</div><div style="font-weight:600;font-size:.9rem;">{{ $c[2] }}</div></div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
