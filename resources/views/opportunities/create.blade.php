@extends('layouts.app')
@section('title','Post Opportunity')
@section('content')
<div class="container" style="padding:2rem 1.5rem;max-width:800px;">
  <div style="text-align:center;margin-bottom:2rem;"><div class="badge badge-warning" style="margin-bottom:.75rem;"><i class="fas fa-bolt"></i> Post Opportunity</div><h1 style="font-size:2rem;font-weight:800;">Create an <span class="gradient-text">Innovation Opportunity</span></h1></div>
  @if($errors->any())<div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}</div>@endif
  <div class="card">
    <form method="POST" action="{{ route('opportunities.store') }}">
      @csrf
      <div class="form-group"><label>Opportunity Title *</label><input type="text" name="title" placeholder="e.g. AI Customer Service Automation Challenge" value="{{ old('title') }}" required></div>
      <div class="grid-2">
        <div class="form-group"><label>Opportunity Type *</label>
          <select name="type" required>
            @foreach(['innovation_challenge'=>'Innovation Challenge','pilot_project'=>'Pilot Project','vendor_requirement'=>'Vendor Requirement','acquisition'=>'Acquisition Interest','internship'=>'Internship Program','api_integration'=>'API Integration','procurement'=>'Procurement'] as $k=>$v)
            <option value="{{ $k }}" {{ old('type')===$k?'selected':'' }}>{{ $v }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group"><label>Industry Focus</label>
          <select name="industry">
            <option value="">Any Industry</option>
            @foreach(['AI/ML','FinTech','HealthTech','CleanTech','EdTech','SaaS','Cybersecurity','Logistics','E-commerce','Blockchain'] as $i)<option value="{{ $i }}" {{ old('industry')===$i?'selected':'' }}>{{ $i }}</option>@endforeach
          </select>
        </div>
      </div>
      <div class="form-group"><label>Description *</label><textarea name="description" rows="5" placeholder="Describe what you're looking for in detail..." required>{{ old('description') }}</textarea></div>
      <div class="form-group"><label>Requirements (one per line)</label><textarea name="requirements" rows="4" placeholder="Proven product with live customers&#10;Team of at least 5 people&#10;Ability to start within 30 days">{{ old('requirements') }}</textarea></div>
      <div class="grid-3">
        <div class="form-group"><label>Min Budget (₹)</label><input type="number" name="budget_min" placeholder="500000" value="{{ old('budget_min') }}"></div>
        <div class="form-group"><label>Max Budget (₹)</label><input type="number" name="budget_max" placeholder="5000000" value="{{ old('budget_max') }}"></div>
        <div class="form-group"><label>Application Deadline</label><input type="date" name="deadline" value="{{ old('deadline') }}"></div>
      </div>
      <div class="grid-2">
        <div class="form-group"><label>Preferred Startup Stage</label>
          <select name="preferred_startup_stage">
            <option value="">Any Stage</option>
            @foreach(['Pre-Seed','Seed','Series A','Series B','Growth'] as $s)<option value="{{ $s }}" {{ old('preferred_startup_stage')===$s?'selected':'' }}>{{ $s }}</option>@endforeach
          </select>
        </div>
        <div class="form-group"><label>Preferred Tech Stack (comma separated)</label><input type="text" name="preferred_tech_stack" placeholder="AI, Python, Cloud, React..." value="{{ old('preferred_tech_stack') }}"></div>
      </div>
      <div class="form-group"><label>Tags (comma separated)</label><input type="text" name="tags" placeholder="innovation, AI, automation, pilot..." value="{{ old('tags') }}"></div>
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;font-size:1rem;padding:.9rem;"><i class="fas fa-bolt"></i> Post Opportunity</button>
    </form>
  </div>
</div>
@endsection
