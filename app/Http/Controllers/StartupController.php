<?php

namespace App\Http\Controllers;

use App\Models\Startup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StartupController extends Controller
{
    public function index(Request $request)
    {
        $query = Startup::where('is_active', true);

        if ($request->has('industry') && $request->industry) {
            $query->where('industry', $request->industry);
        }
        if ($request->has('stage') && $request->stage) {
            $query->where('funding_stage', $request->stage);
        }
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'regex', '/'.$request->search.'/i')
                  ->orWhere('tagline', 'regex', '/'.$request->search.'/i')
                  ->orWhere('industry', 'regex', '/'.$request->search.'/i');
            });
        }
        if ($request->has('women_led') && $request->women_led) {
            $query->where('women_led', true);
        }
        if ($request->has('esg') && $request->esg) {
            $query->where('esg_focus', true);
        }

        $startups = $query->orderBy('credibility_score', 'desc')->paginate(12);

        $industries = ['FinTech', 'HealthTech', 'EdTech', 'AgriTech', 'CleanTech', 'AI/ML', 'Blockchain', 'SaaS', 'E-commerce', 'Logistics', 'DeepTech', 'BioTech'];
        $stages = ['Pre-Seed', 'Seed', 'Series A', 'Series B', 'Series C', 'Growth', 'IPO'];

        return view('startups.index', compact('startups', 'industries', 'stages'));
    }

    public function show($id)
    {
        $startup = Startup::findOrFail($id);
        $startup->increment('profile_views');
        $relatedStartups = Startup::where('industry', $startup->industry)
            ->where('_id', '!=', $id)
            ->limit(4)
            ->get();
        return view('startups.show', compact('startup', 'relatedStartups'));
    }

    public function create()
    {
        return view('startups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'required|string|max:500',
            'industry' => 'required|string',
            'funding_stage' => 'required|string',
            'description' => 'required|string',
            'problem_solving' => 'required|string',
        ]);

        $startup = Startup::create([
            'user_id' => (string)Auth::id(),
            'name' => $request->name,
            'tagline' => $request->tagline,
            'description' => $request->description,
            'industry' => $request->industry,
            'funding_stage' => $request->funding_stage,
            'problem_solving' => $request->problem_solving,
            'solution' => $request->solution,
            'revenue_model' => $request->revenue_model,
            'tech_stack' => $request->tech_stack ? explode(',', $request->tech_stack) : [],
            'website' => $request->website,
            'team_size' => $request->team_size ?? 1,
            'founded_year' => $request->founded_year ?? date('Y'),
            'headquarters' => $request->headquarters,
            'esg_focus' => $request->boolean('esg_focus'),
            'women_led' => $request->boolean('women_led'),
            'is_active' => true,
            'is_verified' => false,
            'is_featured' => false,
            'profile_views' => 0,
            'credibility_score' => rand(50, 80),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Auth::user()->update(['profile_complete' => true]);

        return redirect()->route('startups.show', $startup->id)
            ->with('success', 'Startup profile created successfully!');
    }

    public function edit($id)
    {
        $startup = Startup::findOrFail($id);
        return view('startups.edit', compact('startup'));
    }

    public function update(Request $request, $id)
    {
        $startup = Startup::findOrFail($id);
        $startup->update($request->except(['_token', '_method']));
        return redirect()->route('startups.show', $id)->with('success', 'Profile updated!');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $startup = Startup::where('user_id', (string)$user->_id)->first();
        return view('startups.dashboard', compact('user', 'startup'));
    }
}
