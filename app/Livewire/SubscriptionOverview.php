<?php

namespace App\Livewire;

use App\Models\Subscription;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class SubscriptionOverview extends Widget implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'livewire.subscription-overview';

    protected int|string|array $columnSpan = 'full';

    public ?int $userId = null;

    public ?string $presetRange = 'monthly';

    protected function getFormSchema(): array
    {
        return [
            Select::make('presetRange')
                ->options([
                    'monthly' => 'Monthly',
                    'yearly' => 'Yearly',
                ])
                ->hiddenLabel()
                ->default('monthly')
                ->native(false)
                ->live(),
        ];
    }

    public function mount(): void
    {
        $this->userId = Auth::id();
        $this->presetRange = 'monthly';
    }

    public function getTotalExpenseProperty(): float
    {
        $subscriptions = Subscription::query()
            ->where('user_id', $this->userId)
            ->where('status', 1)
            ->get();

        $total = 0;

        foreach ($subscriptions as $subscription) {
            $price = $subscription->price;

            if ($this->presetRange === 'monthly') {
                $total += match($subscription->cycle) {
                    'daily' => $price * 30,
                    'weekly' => $price * 4.33,
                    'monthly' => $price,
                    'yearly' => $price / 12,
                    default => $price,
                };
            } else {
                $total += match($subscription->cycle) {
                    'daily' => $price * 365,
                    'weekly' => $price * 52,
                    'monthly' => $price * 12,
                    'yearly' => $price,
                    default => $price * 12,
                };
            }
        }

        return round($total, 2);
    }

    public function getSubscriptionsProperty()
    {
        return Subscription::query()
            ->where('user_id', $this->userId)
            ->orderBy('status', 'desc')
            ->orderBy('name')
            ->get();
    }
}
