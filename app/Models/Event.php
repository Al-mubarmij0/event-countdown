<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Event.php

class Event extends Model
{
    protected $fillable = ['name', 'description', 'event_date'];
}

