<x-filament-widgets::widget class="subscription-overview-widget">

    <style>
        .subscription-overview-widget .fi-section-content:first-of-type {
            padding: 0;
        }

        .subscription-overview-widget .outer-wrapper h2 {
            position: relative;
            padding: 16px;
            font-size: 1rem;
            font-weight: 600;
            color: inherit;
        }

        .subscription-overview-widget .outer-wrapper h2::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 1px;
            background-color: currentColor;
            opacity: 0.1;
        }

        .inner-wrapper {
            display: flex;
            flex-direction: column;
            padding: 16px;
            gap: 16px;
        }

        .input-wrapper h3 {
            position: relative;
            font-size: 1rem;
            font-weight: 600;
            padding: 1rem;
            color: inherit;
        }

        .input-wrapper h3::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 1px;
            background-color: currentColor;
            opacity: 0.1;
        }

        .input-wrapper {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .subscription-overview-wrapper {
            height: fit-content;
        }

        .subscription-overview-wrapper div {
            border-radius: 8px;
            padding: 1rem;
        }

        .subscription-overview-wrapper div:first-of-type {
            background: oklch(98% 0.016 73.684);
        }

        .subscription-overview-wrapper div:not(:last-of-type) {
        }

        .subscription-overview-wrapper div p {
            font-size: 0.875rem;
            color: oklch(0.552 0.016 285.938);
        }

        .subscription-overview-wrapper div strong {
            font-size: 1rem;
            font-weight: 600;
            color: #252525;
        }

        .space-y-sm {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .inner-wrapper .separator {
            height: 1px;
            background-color: currentColor;
            opacity: 0.1;
        }

        .subscriptions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 16px;
        }

        .subscription-card {
            border-radius: 8px;
            padding: 1rem;
            border: 1px solid oklch(0.9 0.01 285.938);
            transition: all 0.2s ease;
        }

        /* Color backgrounds */
        .subscription-card.red {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        }

        .subscription-card.blue {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        }

        .subscription-card.green {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        }

        .subscription-card.yellow {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        }

        .subscription-card.purple {
            background: linear-gradient(135deg, #e9d5ff 0%, #d8b4fe 100%);
        }

        .subscription-card.orange {
            background: linear-gradient(135deg, #fed7aa 0%, #fdba74 100%);
        }

        .subscription-card.pink {
            background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%);
        }

        .subscription-card.gray {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        }

        .subscription-card-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 12px;
        }

        .subscription-card-name {
            font-size: 1rem;
            font-weight: 600;
            color: #252525;
        }

        .subscription-card-status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .subscription-card-status.active {
            background: rgba(34, 197, 94, 0.2);
            color: rgb(22, 163, 74);
        }

        .subscription-card-status.inactive {
            background: rgba(239, 68, 68, 0.2);
            color: rgb(220, 38, 38);
        }

        .subscription-card-info {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .subscription-card-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .subscription-card-label {
            font-size: 0.875rem;
            color: oklch(0.552 0.016 285.938);
        }

        .subscription-card-value {
            font-size: 0.875rem;
            font-weight: 600;
            color: #252525;
        }

        @media (max-width: 748px) {
            .inner-wrapper {
                flex-direction: column;
            }

            .subscriptions-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <x-filament::section class="outer-wrapper">
        <h2>{{ __('Subscriptions & Expense Overview') }}</h2>

        <div class="inner-wrapper">
            <div class="input-wrapper">
                <div class="input-wrapper">
                    <div class="space-y-sm">
                        {{ $this->form }}
                    </div>
                </div>
            </div>
            <div class="subscription-overview-wrapper">
                <div>
                    <p>{{ __('Total Expense') }}</p>
                    <strong>{{ $this->totalExpense }} <span>{{ auth()->user()->currency }}</span></strong>
                </div>
            </div>
            <div class="separator"></div>
            <div class="subscriptions-grid">
                @forelse($this->subscriptions as $subscription)
                    <a href="{{ route('filament.app.resources.subscriptions.view', $subscription) }}">
                        <div class="subscription-card {{ $subscription->color ?? 'gray' }}">
                            <div class="subscription-card-header">
                                <h3 class="subscription-card-name">{{ $subscription->name }}</h3>
                                <span class="subscription-card-status {{ $subscription->status ? 'active' : 'inactive' }}">
                                    {{ $subscription->status ? __('Active') : __('Inactive') }}
                                </span>
                            </div>
                            <div class="subscription-card-info">
                                <div class="subscription-card-row">
                                    <span class="subscription-card-label">{{ __('Price') }}</span>
                                    <span class="subscription-card-value">{{ number_format($subscription->price, 2) }} <span>{{ auth()->user()->currency }}</span></span>
                                </div>
                                <div class="subscription-card-row">
                                    <span class="subscription-card-label">{{ __('Cycle') }}</span>
                                    <span class="subscription-card-value">{{ ucfirst($subscription->cycle) }}</span>
                                </div>
                                <div class="subscription-card-row">
                                    <span class="subscription-card-label">{{ __('Next Bill Date') }}</span>
                                    <span class="subscription-card-value">{{ $subscription->next_bill_date->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="subscription-card-label">{{ __('No subscriptions found.') }}</p>
                @endforelse
            </div>
        </div>
    </x-filament::section>

</x-filament-widgets::widget>
