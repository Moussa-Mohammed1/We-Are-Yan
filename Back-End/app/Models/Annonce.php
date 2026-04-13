<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Annonce extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'beneficiary_id',
        'title',
        'description',
        'category',
        'quantity',
        'city',
        'urgency',
        'status',
        'image',
        'raport',
        'reviewed_at',
    ];

    protected function casts(): array
    {
        return [
            'reviewed_at' => 'datetime',
        ];
    }

    public function beneficiary(): BelongsTo
    {
        return $this->belongsTo(User::class, 'beneficiary_id');
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }
}
