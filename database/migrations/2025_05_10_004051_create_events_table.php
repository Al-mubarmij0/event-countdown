<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('event_name'); // Name of the event
            $table->text('description'); // Detailed description of the event
            $table->dateTime('start_time'); // Event start date and time
            $table->dateTime('end_time'); // Event end date and time
            $table->string('location'); // Event location
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // User who created the event (assumes users table exists)
            $table->timestamps(); // Created and updated timestamps
        });

        // Pivot table for attending users (many-to-many relationship)
        Schema::create('event_user', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('event_id')->constrained()->onDelete('cascade'); // Reference to events
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Reference to users
            $table->timestamps(); // Attending timestamps (optional, you could add RSVP status here too)
            $table->unique(['event_id', 'user_id']); // To avoid duplicate entries
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_user');
        Schema::dropIfExists('events');
    }
}
