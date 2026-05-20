<?php

namespace App\Http\Controllers;

use App\Models\Corporate;
use App\Models\Opportunity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CorporateController extends Controller
{
    public function index(Request $request)
    {
        $query = Corporate::where('is_active', true);

        if ($request->has('industry') && $request->industry) {
            $query->where('industry', $request->industry);
        }
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'regex', '/'.$request->search.'/i')
                  ->orWhere('tagline', 'regex', '/'.$request->search.'/i');
            });
        }

        $corporates = $query->orderBy('innovation_score', 'desc')->paginate(12);
        $industries = ['Technology', 'Banking', 'Healthcare', 'Manufacturing', 'Retail', 'Energy', 'Telecom', 'Automotive', 'FMCG', 'Real Estate'];

        return view('corporates.index', compact('corporates', 'industries'));
    }

    public function show($id)
    {
        $corporate = Corporate::findOrFail($id);
        $opportunities = Opportunity::where('corporate_id', (string)$corporate->_id)
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        return view('corporates.show', compact('corporate', 'opportunities'));
    }

    public function create()
    {
        return view('corporates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'industry' => 'required|string',
            'description' => 'required|string',
        ]);

        $corporate = Corporate::create([
            'user_id' => (string)Auth::id(),
            'name' => $request->name,
            'tagline' => $request->tagline,
            'description' => $request->description,
            'industry' => $request->industry,
            'company_size' => $request->company_size,
            'website' => $request->website,
            'headquarters' => $request->headquarters,
            'innovation_goals' => $request->innovation_goals ? explode(',', $request->innovation_goals) : [],
            'preferred_industries' => $request->preferred_industries ? (array)$request->preferred_industries : [],
            'budget_range_min' => $request->budget_range_min ?? 0,
            'budget_range_max' => $request->budget_range_max ?? 0,
            'is_active' => true,
            'is_verified' => false,
            'is_featured' => false,
            'partnerships_count' => 0,
            'startups_scouted' => 0,
            'innovation_score' => rand(60, 90),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('corporates.show', $corporate->id)
            ->with('success', 'Corporate profile created successfully!');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $corporate = Corporate::where('user_id', (string)$user->_id)->first();
        $opportunities = $corporate ? Opportunity::where('corporate_id', (string)$corporate->_id)->get() : collect([]);
        return view('corporates.dashboard', compact('user', 'corporate', 'opportunities'));
    }
}
