@extends('layouts.app')
@section('title','Opportunity Details')
@section('content')
<div class="container" style="padding:2rem 1.5rem;">
  <div style="display:grid;grid-template-columns:2fr 1fr;gap:2rem;">
    <div>
      <div class="card" style="margin-bottom:1.5rem;">
        <div style="display:flex;gap:1rem;align-items:flex-start;margin-bottom:1.5rem;">
          <div style="width:64px;height:64px;border-radius:16px;background:linear-gradient(135deg,#6366f1,#a855f7);display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0;"><i class="fas fa-lightbulb"></i></div>
          <div>
            <h1 style="font-size:1.6rem;font-weight:800;margin-bottom:.5rem;">{{ $opportunity->title }}</h1>
            <div style="display:flex;gap:.5rem;flex-wrap:wrap;">
              <span class="badge badge-primary">{{ ucwords(str_replace('_',' ',$opportunity->type ?? '')) }}</span>
              @if($opportunity->industry)<span class="badge badge-purple">{{ $opportunity->industry }}</span>@endif
              <span class="badge badge-success">{{ ucfirst($opportunity->status ?? 'Open') }}</span>
            </div>
          </div>
        </div>
        <h3 style="font-weight:700;margin-bottom:.75rem;">Description</h3>
        <p style="color:var(--text-muted);line-height:1.7;">{{ $opportunity->description }}</p>
        @if($opportunity->requirements && count($opportunity->requirements))
        <h3 style="font-weight:700;margin:1.5rem 0 .75rem;">Requirements</h3>
        <ul style="list-style:none;display:flex;flex-direction:column;gap:.5rem;">
          @foreach($opportunity->requirements as $req)
          <li style="display:flex;gap:.75rem;align-items:flex-start;color:var(--text-muted);font-size:.9rem;">
            <i class="fas fa-check-circle" style="color:#10b981;margin-top:.1rem;flex-shrink:0;"></i> {{ $req }}
          </li>
          @endforeach
        </ul>
        @endif
        @if($opportunity->preferred_tech_stack && count($opportunity->preferred_tech_stack))
        <h3 style="font-weight:700;margin:1.5rem 0 .75rem;">Preferred Tech Stack</h3>
        <div style="display:flex;flex-wrap:wrap;gap:.5rem;">
          @foreach($opportunity->preferred_tech_stack as $tech)
          <span class="tag" style="font-size:.85rem;padding:.4rem .8rem;">{{ $tech }}</span>
          @endforeach
        </div>
        @endif
      </div>
    </div>
    <div>
      <div class="card" style="margin-bottom:1.5rem;">
        <h3 style="font-weight:700;margin-bottom:1rem;">Opportunity Details</h3>
        @if($opportunity->budget_min || $opportunity->budget_max)
        <div style="padding:1rem;background:rgba(16,185,129,.1);border-radius:10px;margin-bottom:1rem;text-align:center;">
          <div style="font-size:.8rem;color:var(--text-muted);">Budget Range</div>
          <div style="font-size:1.5rem;font-weight:800;color:#10b981;">₹{{ number_format(($opportunity->budget_min??0)/100000,1) }}L - ₹{{ number_format(($opportunity->budget_max??0)/100000,1) }}L</div>
        </div>
        @endif
        @foreach([['fas fa-tag','Type',ucwords(str_replace('_',' ',$opportunity->type??''))],['fas fa-industry','Industry',$opportunity->industry??'N/A'],['fas fa-clock','Deadline',$opportunity->deadline?\Carbon\Carbon::parse($opportunity->deadline)->format('M j, Y'):'N/A'],['fas fa-seedling','Preferred Stage',$opportunity->preferred_startup_stage??'Any'],['fas fa-eye','Views',number_format($opportunity->views_count??0)],['fas fa-paper-plane','Applications',number_format($opportunity->applications_count??0)]] as $d)
        <div style="display:flex;gap:.75rem;padding:.6rem 0;border-bottom:1px solid rgba(255,255,255,.05);">
          <i class="{{ $d[0] }}" style="color:var(--primary);width:16px;"></i>
          <div style="flex:1;display:flex;justify-content:space-between;">
            <span style="font-size:.8rem;color:var(--text-muted);">{{ $d[1] }}</span>
            <span style="font-size:.85rem;font-weight:600;">{{ $d[2] }}</span>
          </div>
        </div>
        @endforeach
      </div>
      @if($corporate)
      <div class="card" style="margin-bottom:1.5rem;">
        <h3 style="font-weight:700;margin-bottom:1rem;">Posted By</h3>
        <div style="display:flex;gap:1rem;align-items:center;">
          <div style="width:50px;height:50px;border-radius:12px;background:linear-gradient(135deg,#a855f7,#6366f1);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.2rem;">{{ strtoupper(substr($corporate->name,0,1)) }}</div>
          <div>
            <div style="font-weight:700;">{{ $corporate->name }}</div>
            <div style="font-size:.8rem;color:var(--text-muted);">{{ $corporate->industry }}</div>
          </div>
        </div>
        <a href="{{ route('corporates.show',$corporate->id) }}" class="btn btn-outline btn-sm" style="width:100%;justify-content:center;margin-top:1rem;">View Company</a>
      </div>
      @endif
      <div class="card" style="border-color:rgba(99,102,241,.3);">
        <h3 style="font-weight:700;margin-bottom:1rem;"><i class="fas fa-paper-plane" style="color:var(--primary);"></i> Apply Now</h3>
        @auth
        <form method="POST" action="{{ route('opportunities.apply',$opportunity->id) }}">
          @csrf
          <div class="form-group"><label>Cover Letter</label><textarea name="cover_letter" placeholder="Why are you a great fit for this opportunity?" rows="4"></textarea></div>
          <div class="form-group"><label>Bid Amount (₹)</label><input type="number" name="bid_amount" placeholder="Your proposed budget"></div>
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;"><i class="fas fa-paper-plane"></i> Submit Application</button>
        </form>
        @else
        <p style="color:var(--text-muted);font-size:.9rem;margin-bottom:1rem;">Login to apply for this opportunity</p>
        <a href="{{ route('login') }}" class="btn btn-primary" style="width:100%;justify-content:center;">Login to Apply</a>
        @endauth
      </div>
    </div>
  </div>
</div>
@endsection
