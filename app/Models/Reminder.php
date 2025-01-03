<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'rental_id', 'due_date', 'is_sent'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
    public function sendReminderNotification()
    {
        
        Notification::send($this->user, new ReminderNotification($this));
    }
}

