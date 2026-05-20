<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Startup extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'startups';

    protected $fillable = [
        'user_id',
        'name',
        'logo',
        'tagline',
        'description',
        'industry',
        'sub_industry',
        'founded_year',
        'headquarters',
        'team_size',
        'website',
        'linkedin',
        'twitter',
        'github',
        'problem_solving',
        'solution',
        'funding_stage', // pre-seed, seed, series-a, series-b, series-c, ipo
        'total_raised',
        'revenue_model',
        'annual_revenue',
        'monthly_growth_rate',
        'customer_count',
        'tech_stack',
        'patents',
        'pitch_deck_url',
        'demo_video_url',
        'product_demo_url',
        'team_members',
        'investors',
        'case_studies',
        'client_portfolio',
        'traction_metrics',
        'target_markets',
        'competitors',
        'unique_value_proposition',
        'esg_focus',
        'women_led',
        'ai_profile_summary',
        'match_score',
        'credibility_score',
        'profile_views',
        'is_featured',
        'is_verified',
        'is_active',
        'tags',
        'sdg_goals',
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'patents' => 'array',
        'team_members' => 'array',
        'investors' => 'array',
        'case_studies' => 'array',
        'client_portfolio' => 'array',
        'traction_metrics' => 'array',
        'target_markets' => 'array',
        'competitors' => 'array',
        'tags' => 'array',
        'sdg_goals' => 'array',
        'esg_focus' => 'boolean',
        'women_led' => 'boolean',
        'is_featured' => 'boolean',
        'is_verified' => 'boolean',
        'is_active' => 'boolean',
        'founded_year' => 'integer',
        'team_size' => 'integer',
        'total_raised' => 'float',
        'annual_revenue' => 'float',
        'monthly_growth_rate' => 'float',
        'customer_count' => 'integer',
        'profile_views' => 'integer',
        'credibility_score' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class, 'startup_id');
    }

    public function getIndustryBadgeColorAttribute()
    {
        $colors = [
            'FinTech' => '#6366f1',
            'HealthTech' => '#10b981',
            'EdTech' => '#f59e0b',
            'AgriTech' => '#84cc16',
            'CleanTech' => '#06b6d4',
            'AI/ML' => '#8b5cf6',
            'Blockchain' => '#f97316',
            'SaaS' => '#3b82f6',
            'E-commerce' => '#ec4899',
            'Logistics' => '#14b8a6',
        ];
        return $colors[$this->industry] ?? '#64748b';
    }
}
