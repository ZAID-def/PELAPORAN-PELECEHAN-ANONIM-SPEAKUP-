<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_chat';

    protected $fillable = [
        'session_id',
        'message',
        'sender',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}