<?php

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;
// use Modules\Auth\Database\Factories\ChatMessageFactory;

class ChatMessage extends Model
{
//    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    // protected static function newFactory(): ChatMessageFactory
    // {
    //     // return ChatMessageFactory::new();
    // }
}
