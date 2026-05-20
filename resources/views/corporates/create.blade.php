@extends('layouts.app')
@section('title','Create Corporate Profile')
@section('content')
<div class="container" style="padding:2rem 1.5rem;max-width:800px;">
  <div style="text-align:center;margin-bottom:2rem;"><div class="badge badge-purple" style="margin-bottom:.75rem;"><i class="fas fa-building"></i> List Your Company</div><h1 style="font-size:2rem;font-weight:800;">Create <span class="gradient-text">Corporate Profile</span></h1></div>
  @if($errors->any())<div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}</div>@endif
  <div class="card">
    <form method="POST" action="{{ route('corporates.store') }}">
      @csrf
      <div class="grid-2">
        <div class="form-group"><label>Company Name *</label><input type="text" name="name" placeholder="e.g. TechCorp Global" value="{{ old('name') }}" required></div>
        <div class="form-group"><label>Industry *</label>
          <select name="industry" required>
            @foreach(['Technology','Banking','Healthcare','Manufacturing','Retail','Energy','Telecom','Automotive','FMCG','Real Estate','Education','Insurance','Media','Agriculture'] as $i)
            <option value="{{ $i }}" {{ old('industry')===$i?'selected':'' }}>{{ $i }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group"><label>Tagline</label><input type="text" name="tagline" placeholder="A brief description of your company" value="{{ old('tagline') }}"></div>
      <div class="form-group"><label>Company Description *</label><textarea name="description" rows="4" placeholder="Tell startups about your company, culture and what makes you a great partner..." required>{{ old('description') }}</textarea></div>
      <div class="grid-3">
        <div class="form-group"><label>Company Size</label>
          <select name="company_size">
            @foreach(['1-100','100-500','500-1000','1,000-5,000','5,000-10,000','10,000-50,000','50,000+'] as $s)<option value="{{ $s }}" {{ old('company_size')===$s?'selected':'' }}>{{ $s }}</option>@endforeach
          </select>
        </div>
        <div class="form-group"><label>Headquarters</label><input type="text" name="headquarters" placeholder="City, Country" value="{{ old('headquarters') }}"></div>
        <div class="form-group"><label>Website</label><input type="url" name="website" placeholder="https://yourcompany.com" value="{{ old('website') }}"></div>
      </div>
      <div class="form-group"><label>Innovation Goals (comma separated)</label><input type="text" name="innovation_goals" placeholder="AI Integration, Supply Chain Optimization, Digital Transformation..." value="{{ old('innovation_goals') }}"></div>
      <div class="form-group"><label>Preferred Startup Industries</label>
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:.5rem;margin-top:.5rem;">
          @foreach(['AI/ML','FinTech','HealthTech','CleanTech','EdTech','SaaS','Blockchain','Cybersecurity','Logistics','DeepTech','AgriTech','PropTech'] as $ind)
          <label style="display:flex;align-items:center;gap:.4rem;font-size:.8rem;cursor:pointer;color:var(--text-muted);">
            <input type="checkbox" name="preferred_industries[]" value="{{ $ind }}" style="width:auto;"> {{ $ind }}
          </label>
          @endforeach
        </div>
      </div>
      <div class="grid-2">
        <div class="form-group"><label>Min Partnership Budget (₹)</label><input type="number" name="budget_range_min" placeholder="500000" value="{{ old('budget_range_min') }}"></div>
        <div class="form-group"><label>Max Partnership Budget (₹)</label><input type="number" name="budget_range_max" placeholder="10000000" value="{{ old('budget_range_max') }}"></div>
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;font-size:1rem;padding:.9rem;"><i class="fas fa-building"></i> Create Corporate Profile</button>
    </form>
  </div>
</div>
@endsection
