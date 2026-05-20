@extends('layouts.app')
@section('title','Edit Startup Profile')
@section('content')
<div class="container" style="padding:2rem 1.5rem;max-width:800px;">
  <div style="text-align:center;margin-bottom:2rem;"><h1 style="font-size:2rem;font-weight:800;">Edit <span class="gradient-text">Startup Profile</span></h1></div>
  @if($errors->any())<div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}</div>@endif
  <div class="card">
    <form method="POST" action="{{ route('startups.update',$startup->id) }}">
      @csrf @method('PUT')
      <div class="grid-2">
        <div class="form-group"><label>Startup Name *</label><input type="text" name="name" value="{{ old('name',$startup->name) }}" required></div>
        <div class="form-group"><label>Industry *</label>
          <select name="industry" required>
            @foreach(['FinTech','HealthTech','EdTech','AgriTech','CleanTech','AI/ML','Blockchain','SaaS','E-commerce','Logistics','DeepTech','BioTech','Cybersecurity','Other'] as $i)
            <option value="{{ $i }}" {{ old('industry',$startup->industry)===$i?'selected':'' }}>{{ $i }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group"><label>Tagline</label><input type="text" name="tagline" value="{{ old('tagline',$startup->tagline) }}"></div>
      <div class="form-group"><label>Funding Stage</label>
        <select name="funding_stage">
          @foreach(['Pre-Seed','Seed','Series A','Series B','Series C','Growth','Bootstrapped','IPO'] as $s)
          <option value="{{ $s }}" {{ old('funding_stage',$startup->funding_stage)===$s?'selected':'' }}>{{ $s }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group"><label>Problem Solving</label><textarea name="problem_solving">{{ old('problem_solving',$startup->problem_solving) }}</textarea></div>
      <div class="form-group"><label>Solution</label><textarea name="solution">{{ old('solution',$startup->solution) }}</textarea></div>
      <div class="form-group"><label>Description</label><textarea name="description" rows="5">{{ old('description',$startup->description) }}</textarea></div>
      <div class="grid-3">
        <div class="form-group"><label>Team Size</label><input type="number" name="team_size" value="{{ old('team_size',$startup->team_size) }}"></div>
        <div class="form-group"><label>Founded Year</label><input type="number" name="founded_year" value="{{ old('founded_year',$startup->founded_year) }}"></div>
        <div class="form-group"><label>Headquarters</label><input type="text" name="headquarters" value="{{ old('headquarters',$startup->headquarters) }}"></div>
      </div>
      <div class="form-group"><label>Tech Stack (comma separated)</label><input type="text" name="tech_stack" value="{{ old('tech_stack',is_array($startup->tech_stack)?implode(',',$startup->tech_stack):'') }}"></div>
      <div class="grid-2">
        <div class="form-group"><label>Website</label><input type="url" name="website" value="{{ old('website',$startup->website) }}"></div>
        <div class="form-group"><label>LinkedIn</label><input type="url" name="linkedin" value="{{ old('linkedin',$startup->linkedin) }}"></div>
      </div>
      <div style="display:flex;gap:1rem;margin-bottom:1.5rem;">
        <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer;">
          <input type="checkbox" name="women_led" style="width:auto;" {{ $startup->women_led?'checked':'' }}> 👩 Women-led
        </label>
        <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer;">
          <input type="checkbox" name="esg_focus" style="width:auto;" {{ $startup->esg_focus?'checked':'' }}> 🌱 ESG Focus
        </label>
      </div>
      <div style="display:flex;gap:1rem;">
        <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center;"><i class="fas fa-save"></i> Update Profile</button>
        <a href="{{ route('startups.show',$startup->id) }}" class="btn btn-outline">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
