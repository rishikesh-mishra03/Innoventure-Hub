<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Startup;
use App\Models\Corporate;
use App\Models\Opportunity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // Summary counts
        $stats = [
            'users'         => User::count(),
            'startups'      => Startup::count(),
            'corporates'    => Corporate::count(),
            'opportunities' => Opportunity::count(),
        ];

        return view('admin.index', compact('stats'));
    }

    public function users(Request $request)
    {
        $query = User::query();
        if ($request->role) $query->where('role', $request->role);
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name',  'regex', '/' . $request->search . '/i')
                  ->orWhere('email','regex', '/' . $request->search . '/i');
            });
        }
        $users = $query->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function startups(Request $request)
    {
        $query = Startup::query();
        if ($request->industry) $query->where('industry', $request->industry);
        if ($request->search)   $query->where('name', 'regex', '/' . $request->search . '/i');
        $startups = $query->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.startups', compact('startups'));
    }

    public function corporates(Request $request)
    {
        $query = Corporate::query();
        if ($request->search) $query->where('name', 'regex', '/' . $request->search . '/i');
        $corporates = $query->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.corporates', compact('corporates'));
    }

    public function opportunities(Request $request)
    {
        $query = Opportunity::query();
        if ($request->type)   $query->where('type', $request->type);
        if ($request->search) $query->where('title', 'regex', '/' . $request->search . '/i');
        $opportunities = $query->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.opportunities', compact('opportunities'));
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    public function deleteStartup($id)
    {
        Startup::findOrFail($id)->delete();
        return back()->with('success', 'Startup deleted.');
    }

    public function deleteOpportunity($id)
    {
        Opportunity::findOrFail($id)->delete();
        return back()->with('success', 'Opportunity deleted.');
    }
}
