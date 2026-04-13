<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'annonce_id',
        'donor_id',
        'donor_name',
        'donor_email',
        'type',
        'amount_or_qty',
        'method',
        'message',
        'status',
    ];

    public function annonce(): BelongsTo
    {
        return $this->belongsTo(Annonce::class);
    }

    public function donor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'donor_id');
    }

    public function conversation(): HasOne
    {
        return $this->hasOne(Conversation::class);
    }
}
