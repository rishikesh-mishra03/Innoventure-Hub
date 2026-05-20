<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Message extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'messages';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'conversation_id',
        'content',
        'type', // text, file, image
        'file_url',
        'file_name',
        'is_read',
        'nda_required',
        'nda_signed',
        'deleted_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'nda_required' => 'boolean',
        'nda_signed' => 'boolean',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}

class Application extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'applications';

    protected $fillable = [
        'opportunity_id',
        'startup_id',
        'user_id',
        'cover_letter',
        'proposal_url',
        'status', // pending, shortlisted, rejected, accepted
        'feedback',
        'bid_amount',
        'timeline',
        'attachments',
    ];

    protected $casts = [
        'attachments' => 'array',
        'bid_amount' => 'float',
    ];
}

class Match extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'matches';

    protected $fillable = [
        'startup_id',
        'corporate_id',
        'match_score',
        'match_reasons',
        'status', // suggested, viewed, connected, declined
        'initiated_by',
    ];

    protected $casts = [
        'match_reasons' => 'array',
        'match_score' => 'float',
    ];
}

class Event extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'events';

    protected $fillable = [
        'organizer_id',
        'title',
        'description',
        'type', // expo, demo_day, summit, hackathon, webinar, workshop
        'start_date',
        'end_date',
        'location',
        'is_virtual',
        'meeting_link',
        'banner_image',
        'max_attendees',
        'registered_count',
        'ticket_price',
        'is_free',
        'tags',
        'speakers',
        'sponsors',
        'is_featured',
        'is_active',
        'status', // upcoming, live, completed, cancelled
    ];

    protected $casts = [
        'is_virtual' => 'boolean',
        'is_free' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'tags' => 'array',
        'speakers' => 'array',
        'sponsors' => 'array',
        'max_attendees' => 'integer',
        'registered_count' => 'integer',
        'ticket_price' => 'float',
    ];
}

class BlogPost extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'blog_posts';

    protected $fillable = [
        'author_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'banner_image',
        'category',
        'tags',
        'views_count',
        'likes_count',
        'is_published',
        'published_at',
        'read_time',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_published' => 'boolean',
        'views_count' => 'integer',
        'likes_count' => 'integer',
        'read_time' => 'integer',
    ];
}
