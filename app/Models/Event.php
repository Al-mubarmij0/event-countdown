<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',             
        'description',      
        'event_date',       
        'start_time',       
        'end_time',         
    ];

    // Relationship: An event can have many attendees (users)
    public function attendees()
    {
        return $this->belongsToMany(User::class, 'event_user', 'event_id', 'user_id');
    }

    // Relationship: Event can be created by a user (creator)
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
