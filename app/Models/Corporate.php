<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Corporate extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'corporates';

    protected $fillable = [
        'user_id',
        'name',
        'logo',
        'tagline',
        'description',
        'industry',
        'company_size',
        'revenue_range',
        'founded_year',
        'headquarters',
        'website',
        'linkedin',
        'twitter',
        'innovation_goals',
        'open_challenges',
        'procurement_needs',
        'csr_opportunities',
        'investment_interests',
        'partnership_programs',
        'api_requirements',
        'pilot_opportunities',
        'budget_range_min',
        'budget_range_max',
        'preferred_industries',
        'preferred_startup_stages',
        'preferred_locations',
        'esg_goals',
        'innovation_score',
        'partnerships_count',
        'startups_scouted',
        'is_verified',
        'is_featured',
        'is_active',
        'contact_person',
        'contact_email',
    ];

    protected $casts = [
        'innovation_goals' => 'array',
        'open_challenges' => 'array',
        'procurement_needs' => 'array',
        'csr_opportunities' => 'array',
        'investment_interests' => 'array',
        'partnership_programs' => 'array',
        'api_requirements' => 'array',
        'pilot_opportunities' => 'array',
        'preferred_industries' => 'array',
        'preferred_startup_stages' => 'array',
        'preferred_locations' => 'array',
        'esg_goals' => 'array',
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'founded_year' => 'integer',
        'budget_range_min' => 'float',
        'budget_range_max' => 'float',
        'innovation_score' => 'float',
        'partnerships_count' => 'integer',
        'startups_scouted' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class, 'corporate_id');
    }
}
