@extends('layouts.app')
@section('title','Startup Registration')
@section('content')
<div class="container" style="padding:2rem 1.5rem;max-width:800px;">
  <div style="text-align:center;margin-bottom:2rem;">
    <div class="badge badge-primary" style="margin-bottom:.75rem;"><i class="fas fa-rocket"></i> List Your Startup</div>
    <h1 style="font-size:2rem;font-weight:800;">Create Your <span class="gradient-text">Startup Profile</span></h1>
    <p style="color:var(--text-muted);">Get discovered by 620+ corporates and 3000+ investors</p>
  </div>
  @if($errors->any())
  <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}</div>
  @endif
  <div class="card">
    <form method="POST" action="{{ route('startups.store') }}">
      @csrf
      <div style="display:grid;grid-template-columns:2fr 1fr;gap:1rem;margin-bottom:1.5rem;padding-bottom:1.5rem;border-bottom:1px solid var(--card-border);">
        <div class="form-group" style="margin:0;"><label><i class="fas fa-rocket"></i> Startup Name *</label><input type="text" name="name" placeholder="e.g. TechNova AI" value="{{ old('name') }}" required></div>
        <div class="form-group" style="margin:0;"><label>Industry *</label>
          <select name="industry" required>
            <option value="">Select Industry</option>
            @foreach(['FinTech','HealthTech','EdTech','AgriTech','CleanTech','AI/ML','Blockchain','SaaS','E-commerce','Logistics','DeepTech','BioTech','Cybersecurity','SpaceTech','GovTech','LegalTech','PropTech','RetailTech','SupplyChain','Other'] as $i)
            <option value="{{ $i }}" {{ old('industry')===$i?'selected':'' }}>{{ $i }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group"><label><i class="fas fa-quote-left"></i> Tagline *</label><input type="text" name="tagline" placeholder="A one-line description of what you do" value="{{ old('tagline') }}" required></div>
      <div class="grid-2">
        <div class="form-group"><label>Funding Stage *</label>
          <select name="funding_stage" required>
            @foreach(['Pre-Seed','Seed','Series A','Series B','Series C','Growth','Bootstrapped','IPO'] as $s)
            <option value="{{ $s }}" {{ old('funding_stage')===$s?'selected':'' }}>{{ $s }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group"><label>Revenue Model</label>
          <select name="revenue_model">
            @foreach(['SaaS Subscription','Freemium','Marketplace','Transaction Fee','B2B License','D2C','API Monetization','Ad-based','Other'] as $r)
            <option value="{{ $r }}" {{ old('revenue_model')===$r?'selected':'' }}>{{ $r }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group"><label><i class="fas fa-exclamation-triangle" style="color:#ef4444;"></i> Problem You're Solving *</label><textarea name="problem_solving" placeholder="Describe the core problem your startup addresses" required>{{ old('problem_solving') }}</textarea></div>
      <div class="form-group"><label><i class="fas fa-lightbulb" style="color:#10b981;"></i> Your Solution *</label><textarea name="solution" placeholder="Explain how your product/service solves this problem" required>{{ old('solution') }}</textarea></div>
      <div class="form-group"><label>Full Description *</label><textarea name="description" rows="5" placeholder="Detailed description of your startup..." required>{{ old('description') }}</textarea></div>
      <div class="grid-3">
        <div class="form-group"><label>Team Size</label><input type="number" name="team_size" placeholder="e.g. 12" value="{{ old('team_size') }}" min="1"></div>
        <div class="form-group"><label>Founded Year</label><input type="number" name="founded_year" placeholder="{{ date('Y') }}" value="{{ old('founded_year',date('Y')) }}" min="2000" max="{{ date('Y') }}"></div>
        <div class="form-group"><label>Headquarters</label><input type="text" name="headquarters" placeholder="City, Country" value="{{ old('headquarters') }}"></div>
      </div>
      <div class="form-group"><label><i class="fas fa-code"></i> Tech Stack (comma separated)</label><input type="text" name="tech_stack" placeholder="React, Node.js, MongoDB, AWS, Python..." value="{{ old('tech_stack') }}"></div>
      <div class="grid-2">
        <div class="form-group"><label>Website URL</label><input type="url" name="website" placeholder="https://yoursite.com" value="{{ old('website') }}"></div>
        <div class="form-group"><label>LinkedIn URL</label><input type="url" name="linkedin" placeholder="https://linkedin.com/company/..." value="{{ old('linkedin') }}"></div>
      </div>
      <div style="display:flex;gap:2rem;margin-bottom:1.5rem;">
        <label style="display:flex;align-items:center;gap:.75rem;cursor:pointer;">
          <input type="checkbox" name="women_led" style="width:auto;"> <span>👩 Women-led startup</span>
        </label>
        <label style="display:flex;align-items:center;gap:.75rem;cursor:pointer;">
          <input type="checkbox" name="esg_focus" style="width:auto;"> <span>🌱 ESG / Sustainability focused</span>
        </label>
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;font-size:1rem;padding:.9rem;">
        <i class="fas fa-rocket"></i> Create Startup Profile
      </button>
    </form>
  </div>
</div>
@endsection
