<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'price',
        'bill_date',
        'cycle',
        'status',
        'color',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'bill_date' => 'date',
            'price' => 'decimal:2',
            'status' => 'boolean',
        ];
    }

    public function getFormattedCycleAttribute(): string
    {
        return ucfirst($this->cycle);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
