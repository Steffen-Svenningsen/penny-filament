<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    /**
     * Calculate the next bill date based on the cycle
     */
    protected function nextBillDate(): Attribute
    {
        return Attribute::make(
            get: function () {
                $billDate = Carbon::parse($this->bill_date);
                $today = Carbon::today();

                // If bill date is in the future, that's the next bill date
                if ($billDate->isFuture()) {
                    return $billDate;
                }

                // Calculate next occurrence based on cycle
                switch ($this->cycle) {
                    case 'daily':
                        while ($billDate->isPast()) {
                            $billDate->addDay();
                        }
                        break;

                    case 'weekly':
                        while ($billDate->isPast()) {
                            $billDate->addWeek();
                        }
                        break;

                    case 'monthly':
                        while ($billDate->isPast()) {
                            $billDate->addMonth();
                        }
                        break;

                    case 'yearly':
                        while ($billDate->isPast()) {
                            $billDate->addYear();
                        }
                        break;

                    default:
                        return $billDate;
                }

                return $billDate;
            }
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
