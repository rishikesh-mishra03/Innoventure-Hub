<?php

namespace App\Http\Controllers;

use App\Models\Startup;
use App\Models\Corporate;
use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = $this->getStats($user);
        $recentActivity = $this->getRecentActivity($user);
        $recommendations = $this->getRecommendations($user);
        $opportunities = Opportunity::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard.index', compact('user', 'stats', 'recentActivity', 'recommendations', 'opportunities'));
    }

    private function getStats($user)
    {
        if ($user->role === 'startup') {
            $startup = Startup::where('user_id', (string)$user->_id)->first();
            return [
                'profile_views' => $startup ? ($startup->profile_views ?? rand(150, 2500)) : 0,
                'interested_corporates' => rand(5, 45),
                'meeting_requests' => rand(2, 18),
                'applications_sent' => rand(3, 25),
                'match_score' => rand(75, 98),
                'credibility_score' => $startup ? ($startup->credibility_score ?? rand(70, 95)) : rand(70, 95),
            ];
        } elseif ($user->role === 'corporate') {
            return [
                'startups_scouted' => rand(20, 180),
                'active_challenges' => rand(2, 10),
                'partnerships_count' => rand(5, 35),
                'pending_applications' => rand(10, 65),
                'innovation_score' => rand(72, 96),
                'total_invested' => rand(500000, 5000000),
            ];
        } elseif ($user->role === 'investor') {
            return [
                'portfolio_startups' => rand(8, 35),
                'total_investments' => rand(2000000, 50000000),
                'avg_roi' => rand(15, 45),
                'due_diligence_pending' => rand(3, 12),
                'new_opportunities' => rand(5, 20),
                'funded_this_year' => rand(2, 8),
            ];
        } elseif ($user->role === 'admin') {
            return [
                'total_users' => User::count(),
                'total_startups' => Startup::count(),
                'total_corporates' => Corporate::count(),
                'total_opportunities' => Opportunity::count(),
                'pending_verifications' => User::where('kyc_status', 'pending')->count(),
                'active_today' => rand(150, 800),
            ];
        }
        return [];
    }

    private function getRecentActivity($user)
    {
        $activities = [
            ['icon' => 'eye', 'text' => 'TechCorp viewed your profile', 'time' => '2 hours ago', 'type' => 'view'],
            ['icon' => 'handshake', 'text' => 'New partnership request from InnovateCo', 'time' => '5 hours ago', 'type' => 'request'],
            ['icon' => 'star', 'text' => 'Your startup was featured in AI category', 'time' => '1 day ago', 'type' => 'feature'],
            ['icon' => 'message-circle', 'text' => 'New message from GlobalCorp Innovation Team', 'time' => '1 day ago', 'type' => 'message'],
            ['icon' => 'trending-up', 'text' => 'Match score increased to 92%', 'time' => '2 days ago', 'type' => 'match'],
            ['icon' => 'check-circle', 'text' => 'KYC verification completed', 'time' => '3 days ago', 'type' => 'verified'],
        ];
        return $activities;
    }

    private function getRecommendations($user)
    {
        if ($user->role === 'startup') {
            return Corporate::where('is_active', true)->limit(4)->get();
        } elseif ($user->role === 'corporate') {
            return Startup::where('is_active', true)->limit(4)->get();
        }
        return collect([]);
    }
}
