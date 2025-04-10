<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;


    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content',
        'is_read',
    ];


    // relations:
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }


    public function getFullDatetimeAttribute()
    {
        $date = \Carbon\Carbon::parse($this->created_at);

        if ($date->isToday()) {
            $formatted_date = 'Today';
        } elseif ($date->isYesterday()) {
            $formatted_date = 'Yesterday';
        } else {
            $formatted_date = $date->format('d M Y');
        }

        $formatted_time = $date->format('h:i A');
        return $formatted_date . ', ' . $formatted_time;
    }
}
