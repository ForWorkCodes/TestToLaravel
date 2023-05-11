<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserOperaion extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'balance_id',
        'status',
        'action'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function balance(): BelongsTo
    {
        return $this->belongsTo(UserBalance::class, 'balance_id');
    }
}
