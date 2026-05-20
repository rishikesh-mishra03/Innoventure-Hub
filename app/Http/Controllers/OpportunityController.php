<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\Corporate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OpportunityController extends Controller
{
    public function index(Request $request)
    {
        $query = Opportunity::where('is_active', true);

        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }
        if ($request->has('industry') && $request->industry) {
            $query->where('industry', $request->industry);
        }
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'regex', '/'.$request->search.'/i')
                  ->orWhere('description', 'regex', '/'.$request->search.'/i');
            });
        }

        $opportunities = $query->orderBy('created_at', 'desc')->paginate(10);
        $types = [
            'innovation_challenge' => 'Innovation Challenge',
            'pilot_project' => 'Pilot Project',
            'vendor_requirement' => 'Vendor Requirement',
            'acquisition' => 'Acquisition Interest',
            'internship' => 'Internship',
            'api_integration' => 'API Integration',
            'procurement' => 'Procurement',
        ];

        return view('opportunities.index', compact('opportunities', 'types'));
    }

    public function show($id)
    {
        $opportunity = Opportunity::findOrFail($id);
        $opportunity->increment('views_count');
        $corporate = Corporate::find($opportunity->corporate_id);
        return view('opportunities.show', compact('opportunity', 'corporate'));
    }

    public function create()
    {
        $this->middleware('auth');
        return view('opportunities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string',
        ]);

        $user = Auth::user();
        $corporate = Corporate::where('user_id', (string)$user->_id)->first();

        Opportunity::create([
            'corporate_id' => $corporate ? (string)$corporate->_id : null,
            'user_id' => (string)$user->_id,
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'industry' => $request->industry,
            'budget_min' => $request->budget_min ?? 0,
            'budget_max' => $request->budget_max ?? 0,
            'deadline' => $request->deadline,
            'requirements' => $request->requirements ? explode("\n", $request->requirements) : [],
            'preferred_startup_stage' => $request->preferred_startup_stage,
            'preferred_tech_stack' => $request->preferred_tech_stack ? explode(',', $request->preferred_tech_stack) : [],
            'tags' => $request->tags ? explode(',', $request->tags) : [],
            'applications_count' => 0,
            'views_count' => 0,
            'is_featured' => false,
            'is_active' => true,
            'status' => 'open',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('opportunities.index')->with('success', 'Opportunity posted successfully!');
    }

    public function apply(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to apply.');
        }

        $opportunity = Opportunity::findOrFail($id);
        $opportunity->increment('applications_count');

        return back()->with('success', 'Application submitted successfully! The corporate team will review it.');
    }
}
