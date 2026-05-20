<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Opportunity extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'opportunities';

    protected $fillable = [
        'corporate_id',
        'user_id',
        'title',
        'description',
        'type', // innovation_challenge, pilot_project, vendor_requirement, acquisition, internship, api_integration, procurement
        'industry',
        'budget_min',
        'budget_max',
        'deadline',
        'requirements',
        'preferred_startup_stage',
        'preferred_tech_stack',
        'preferred_locations',
        'applications_count',
        'views_count',
        'is_featured',
        'is_active',
        'status', // open, closed, in_review, completed
        'tags',
        'attachments',
    ];

    protected $casts = [
        'requirements' => 'array',
        'preferred_tech_stack' => 'array',
        'preferred_locations' => 'array',
        'tags' => 'array',
        'attachments' => 'array',
        'budget_min' => 'float',
        'budget_max' => 'float',
        'applications_count' => 'integer',
        'views_count' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function corporate()
    {
        return $this->belongsTo(Corporate::class, 'corporate_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'opportunity_id');
    }
}
